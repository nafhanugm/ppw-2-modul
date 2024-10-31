@extends('buku.layout.layout')

@section('content')
    <div class="container">
        <h4 class="text-4xl my-4">Tambah Buku</h4>
        @if(count($errors)>0)
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif
        <form class="flex w-full flex-col gap-4" method="post" action="{{route('buku.store')}}">
            @csrf
            <div>Judul <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " type="text" name="judul"></div>
            <div>Penulis <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " type="text" name="penulis"></div>
            <div>Harga <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " type="text" name="harga"></div>
            <div>Tanggal Terbit <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " type="date" class="date form-control" placeholder="yyyy/mm/dd" name="tgl_terbit"></div>
            <div class="w-full flex justify-end mt-3">
            <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center" type="submit">Simpan</button>
            </div>
        </form>
    </div>
@endsection

