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
}
