<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
// tambahkan code berikut untuk memanggil model buku yang sudah dibuat
use App\Models\Buku;
use App\Util\StorageUtil;
use Illuminate\Support\Str;

class BukuController extends Controller
{
    public function index()
    {
        $batas = 10;
        $jumlah_buku = Buku::count();
        $data_buku = Buku::orderBy("id", "desc")->simplePaginate($batas);
        $no = $batas * ($data_buku->currentPage() - 1);

        return view("buku.index", compact("data_buku", "no", "jumlah_buku"));
    }

    public function show($id)
    {
        $buku = Buku::with([
            "galeri",
            "reviews.user",
            "reviews.reviewTags.tag",
            "relatedBooks",
        ])->findOrFail($id);
        return view("buku.show", compact("buku"));
    }

    public function create()
    {
        $books = Buku::all();
        return view("buku.create", compact("books"));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "judul" => "required|string",
            "penulis" => "required|string|max:30",
            "harga" => "required|numeric",
            "tgl_terbit" => "required|date",
            "thumbnail" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "gallery.*" => "image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "discount_percentage" => "nullable|numeric|min:0|max:100",
        ]);

        // Handle Thumbnail Upload
        $filename = time() . "_" . $request->thumbnail->getClientOriginalName();
        $filepath = StorageUtil::uploadBookImage($request->thumbnail);

        $buku = Buku::create([
            "judul" => $request->judul,
            "penulis" => $request->penulis,
            "harga" => $request->harga,
            "tgl_terbit" => $request->tgl_terbit,
            "filename" => $filename,
            "filepath" => $filepath,
            "editorial_pick" => $request->has("editorial_pick"),
            "discount_percentage" => $request->discount_percentage ?? 0,
        ]);

        // Handle Gallery Upload
        if ($request->hasFile("gallery")) {
            foreach ($request->file("gallery") as $key => $galleryImage) {
                $galleryFilename =
                    time() . "_" . $galleryImage->getClientOriginalName();
                $galleryPath = StorageUtil::uploadBookImage($galleryImage);

                Galeri::create([
                    "nama_galeri" => $galleryFilename,
                    "path" => $galleryPath,
                    "galeri_seo" => Str::slug($galleryFilename),
                    "keterangan" =>
                        $buku->judul .
                        " - " .
                        $request->input("gallery_keterangan." . $key),
                    "foto" => $galleryFilename,
                    "buku_id" => $buku->id,
                ]);
            }
        }

        if ($request->has("related_books")) {
            foreach ($request->related_books as $relatedBookJudul) {
                $relatedBook = Buku::where("judul", $relatedBookJudul)->first();
                if ($relatedBook) {
                    $buku->relatedBooks()->create([
                        "related_book_id" => $relatedBook->id,
                    ]);
                }
            }
        }

        return redirect("/buku")->with(
            "success",
            "Data buku berhasil ditambahkan"
        );
    }

    public function edit($id)
    {
        $buku = Buku::with("galeri", "relatedBooks")->find($id);
        $allBooksExceptCurrentAndRelated = Buku::where("id", "!=", $id)
            ->whereNotIn("id", $buku->relatedBooks->pluck("related_book_id"))
            ->get();

        return view(
            "buku.edit",
            compact("buku", "allBooksExceptCurrentAndRelated")
        );
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "judul" => "required|string",
            "penulis" => "required|string|max:30",
            "harga" => "required|numeric",
            "tgl_terbit" => "required|date",
            "thumbnail" => "image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "gallery.*" => "image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "discount_percentage" => "nullable|numeric|min:0|max:100",
        ]);

        $buku = Buku::find($id);
        $filename = $buku->filename;
        $filepath = $buku->filepath;

        // Handle thumbnail update
        if ($request->hasFile("thumbnail")) {
            $filename =
                time() . "_" . $request->thumbnail->getClientOriginalName();
            $filepath = StorageUtil::uploadBookImage($request->thumbnail);
        }

        // Update basic book info
        $buku->update([
            "judul" => $request->judul,
            "penulis" => $request->penulis,
            "harga" => $request->harga,
            "tgl_terbit" => $request->tgl_terbit,
            "filename" => $filename,
            "filepath" => $filepath,
            "editorial_pick" => $request->has("editorial_pick"),
            "discount_percentage" => $request->discount_percentage ?? 0,
        ]);

        // Handle existing gallery images update
        if ($request->has("existing_gallery_ids")) {
            foreach ($request->existing_gallery_ids as $galleryId) {
                if (!in_array($galleryId, $request->delete_gallery_ids ?? [])) {
                    $galeri = Galeri::find($galleryId);
                    if ($galeri) {
                        $keterangan = $request->input(
                            "existing_gallery_keterangan.$galleryId"
                        );
                        $galeri->update([
                            "keterangan" => $keterangan,
                        ]);
                    }
                }
            }
        }

        if ($request->has("related_books")) {
            foreach ($request->related_books as $relatedBookJudul) {
                $relatedBook = Buku::where("judul", $relatedBookJudul)->first();
                if ($relatedBook) {
                    $buku->relatedBooks()->create([
                        "related_book_id" => $relatedBook->id,
                    ]);
                }
            }
        }

        // Handle deletion of gallery images
        if ($request->has("delete_gallery_ids")) {
            Galeri::whereIn("id", $request->delete_gallery_ids)->delete();
        }

        // Handle new gallery images
        if ($request->hasFile("gallery")) {
            foreach ($request->file("gallery") as $key => $galleryImage) {
                $galleryFilename =
                    time() . "_" . $galleryImage->getClientOriginalName();
                $galleryPath = StorageUtil::uploadBookImage($galleryImage);

                Galeri::create([
                    "nama_galeri" => $galleryFilename,
                    "path" => $galleryPath,
                    "galeri_seo" => Str::slug($galleryFilename),
                    "keterangan" =>
                        $request->input("gallery_keterangan.$key") ?? "",
                    "foto" => $galleryFilename,
                    "buku_id" => $buku->id,
                ]);
            }
        }

        return redirect("/buku")->with("success", "Data buku berhasil diubah");
    }

    public function destroy($id)
    {
        $buku = Buku::find($id);
        $galeri = Galeri::where("buku_id", $id)->get();
        foreach ($galeri as $g) {
            $g->delete();
        }
        $buku->delete();

        return redirect("/buku");
    }
}
