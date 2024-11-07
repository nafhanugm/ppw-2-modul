<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
// tambahkan code berikut untuk memanggil model buku yang sudah dibuat
use App\Models\Buku;
use App\Util\StorageUtil;
use Illuminate\Support\Str;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class BukuController extends Controller
{
    public function index (){
        $batas = 10;
        $jumlah_buku = Buku::count();
        $data_buku = Buku::orderBy('id', 'desc')->simplePaginate($batas);
        $no = $batas * ($data_buku->currentPage() - 1);

        return view('buku.index', compact('data_buku', 'no', 'jumlah_buku'));
    }

    public function create(){
        return view('buku.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Handle Thumbnail Upload
        $filename = time()."_".$request->thumbnail->getClientOriginalName();
        $filepath = StorageUtil::uploadBookImage($request->thumbnail);

        $buku = Buku::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit,
            'filename' => $filename,
            'filepath' => $filepath,
        ]);

        // Handle Gallery Upload
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $galleryImage) {
                $galleryFilename = time().'_'.$galleryImage->getClientOriginalName();
                $galleryPath = StorageUtil::uploadBookImage($galleryImage);

                Galeri::create([
                    'nama_galeri' => $galleryFilename,
                    'path' => $galleryPath,
                    'galeri_seo' => Str::slug($galleryFilename),
                    'keterangan' => 'Gallery image for '.$buku->judul,
                    'foto' => $galleryFilename,
                    'buku_id' => $buku->id,
                ]);
            }
        }

        return redirect('/buku')->with('success', 'Data buku berhasil ditambahkan');
    }


    public function edit($id){
        $buku = Buku::with('galeri')->find($id);
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate each gallery image
        ]);

        $buku = Buku::find($id);
        $filename = $buku->filename;
        $filepath = $buku->filepath;

        // Handle thumbnail update
        if ($request->hasFile('thumbnail')) {
            $filename = time()."_".$request->thumbnail->getClientOriginalName();
            $filepath = StorageUtil::uploadBookImage($request->thumbnail);
        }

        if ($request->has('delete_gallery_ids')) {
            $deleteGalleryIds = $request->delete_gallery_ids;
            Galeri::whereIn('id', $deleteGalleryIds)->delete();
        }


        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit,
            'filename' => $filename,
            'filepath' => $filepath,
        ]);

        // Handle new gallery images
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $galleryImage) {
                $galleryFilename = time().'_'.$galleryImage->getClientOriginalName();
                $galleryPath = StorageUtil::uploadBookImage($galleryImage);

                Galeri::create([
                    'nama_galeri' => $galleryFilename,
                    'path' => $galleryPath,
                    'galeri_seo' => Str::slug($galleryFilename),
                    'keterangan' => 'Gallery image for '.$buku->judul,
                    'foto' => $galleryFilename,
                    'buku_id' => $buku->id,
                ]);
            }
        }

        // Optional: Handle gallery deletions if needed
        if ($request->has('delete_gallery_ids')) {
            $deleteGalleryIds = $request->delete_gallery_ids;
            Galeri::whereIn('id', $deleteGalleryIds)->delete();
        }

        return redirect('/buku')->with('success', 'Data buku berhasil diubah');
    }


    public function destroy($id){
        $buku = Buku::find($id);
        $galeri = Galeri::where('buku_id', $id)->get();
        foreach ($galeri as $g) {
            $g->delete();
        }
        $buku->delete();

        return redirect('/buku');
    }
}
