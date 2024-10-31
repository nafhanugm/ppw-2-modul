@extends('buku.layout.layout')
@php
    use Illuminate\Support\Facades\Session;
@endphp

@section('content')
<body>
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success') }}
        </div>
    @endif
    @if(\Illuminate\Support\Facades\Auth::user())
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="py-2 px-4  border-2 bg-teal-500 hover:bg-teal-400 active:bg-teal-600 rounded-lg text-white cursor-pointer font-semibold">
                Logout
            </button>
        </form>
    @endif
    <a href="{{ route('buku.create') }}" class="btn btn-primary float-end">Tambah Buku</a>
    <table class="table table-stripped">
        <thead>
            <tr>
                <th>id</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Tanggal Terbit</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data_buku as $index => $buku)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ "Rp. ".number_format($buku->harga, 2, ',', '.') }}</td>
                    <td>{{ $buku->tgl_terbit->format('d/m/Y') }}</td>
                    <td>
                        <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin mau di hapus?')" type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>{{$data_buku->links()}}</div>
    <div>Jumlah Buku : {{$jumlah_buku}}</div>
@endsection
