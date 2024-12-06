@extends('buku.layout.layout')
@php
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\Auth;
@endphp

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if(Session::has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{Session::get('success') }}</span>
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Daftar Buku</h2>
        <div class="space-x-2 flex">
             <a href="/" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg shadow-sm transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Home
            </a>
            @if(\Illuminate\Support\Facades\Auth::user())
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="py-2 px-4 border-2 bg-teal-500 hover:bg-teal-400 active:bg-teal-600 rounded-lg text-white cursor-pointer font-semibold">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                    </button>
                </form>
            @endif
            <a href="{{ route('buku.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-colors">
                <i class="fas fa-plus mr-1"></i> Tambah Buku
            </a>
            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'internal_review')
                <a href="{{ route('review.create') }}" class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-700 text-white font-medium rounded-lg shadow-sm transition-colors">
                    <i class="fas fa-star mr-1"></i> Review Buku
                </a>
            @endif
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Judul Buku
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Penulis
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Harga
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tanggal Terbit
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Thumbnail
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($data_buku as $index => $buku)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $index+1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $buku->judul }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $buku->penulis }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ "Rp. ".number_format($buku->harga, 2, ',', '.') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $buku->tgl_terbit->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                           <img src="{{ asset($buku->filepath) }}" alt="thumbnail" width="100" class="rounded">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap space-x-2">
                            <a href="{{ route('buku.edit', $buku->id) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>

                            <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin mau di hapus?')" type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    <i class="fas fa-trash mr-1"></i> Hapus
                                </button>
                            </form>

                            <a href="{{ route('buku.show', $buku->id) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                <i class="fas fa-eye mr-1"></i> Lihat
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{$data_buku->links()}}</div>
    <div class="mt-4 text-gray-600">Jumlah Buku : {{$jumlah_buku}}</div>
</div>
@endsection
