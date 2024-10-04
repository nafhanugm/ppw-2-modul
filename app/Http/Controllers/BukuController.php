<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// tambahkan code berikut untuk memanggil model buku yang sudah dibuat
use App\Models\Buku;

class BukuController extends Controller
{
    public function index (){
        $data_buku = Buku::all();

        return view('buku.index', compact('data_buku'));
    }

    public function create(){
        return view('buku.create');
    }

    public function store(Request $request){
        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->save();

        return redirect('/buku');
    }

    public function destroy($id){
        $buku = Buku::find($id);
        $buku->delete();

        return redirect('/buku');
    }
}
