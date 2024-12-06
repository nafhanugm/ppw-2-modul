@extends('buku.layout.layout')

@section('content')
<div class="container mx-auto max-w-5xl px-4 py-8">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        {{-- Book Header --}}
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-6 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-4xl font-extrabold text-gray-800 tracking-tight">
                {{ $buku->judul }}
            </h2>
            <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg shadow-sm transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        {{-- Book Details Container --}}
        <div class="grid md:grid-cols-3 gap-8 p-6">
            {{-- Left Column: Book Cover & Gallery --}}
            <div class="md:col-span-1 space-y-6">
                {{-- Main Book Cover --}}
                <div class="relative group">
                    <img src="{{ asset($buku->filepath) }}" alt="Book Cover" class="w-full rounded-xl shadow-lg transform transition-transform duration-300 group-hover:scale-105">
                    <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-20 rounded-xl transition-opacity"></div>
                </div>

                {{-- Gallery Section --}}
                <div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Gallery</h3>
                    <div class="grid grid-cols-2 gap-6">
                        @foreach ($buku->galeri as $image)
                        <div class="relative group">
                            <img src="{{ asset($image->path) }}" alt="{{ $image->keterangan }}" class="w-full h-80 object-cover rounded-xl shadow-lg transform transition-transform duration-300 group-hover:scale-105">
                            <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-20 rounded-xl transition-opacity"></div>
                            <p class="text-center mt-2 text-gray-600">{{ $image->keterangan }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Related Book Section --}}
                <div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Related Book</h3>
                    <div class="grid grid-cols-2 gap-6">
                        @foreach ($buku->allRelatedBooks as $relatedBook)
                        <a href="{{ route('book.detail', $relatedBook->id) }}" class="relative group cursor-pointer">
                            <img src="{{ asset($relatedBook->filepath) }}" alt="{{ $relatedBook->filename }}" class="w-full h-80 object-cover rounded-xl shadow-lg transform transition-transform duration-300 group-hover:scale-105">
                            <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-20 rounded-xl transition-opacity"></div>
                            <p class="text-center mt-2 text-gray-600">{{ $relatedBook->judul }}</p>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Right Column: Book Information --}}
            <div class="md:col-span-2 space-y-6">
                {{-- Book Details Grid --}}
                <div class="grid md:grid-cols-2 gap-4 bg-gray-50 p-6 rounded-xl">
                    <div>
                        <div class="flex items-center mb-3">
                            <i class="fas fa-user-edit mr-2 text-blue-500"></i>
                            <span class="font-medium text-gray-600">Penulis:</span>
                            <span class="ml-2 font-semibold">{{ $buku->penulis }}</span>
                        </div>
                        <div class="flex items-center mb-3">
                            <i class="fas fa-calendar-alt mr-2 text-green-500"></i>
                            <span class="font-medium text-gray-600">Tanggal Terbit:</span>
                            <span class="ml-2">{{ $buku->tgl_terbit->format('d/m/Y') }}</span>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center mb-3">
                            <i class="fas fa-tags mr-2 text-purple-500"></i>
                            <span class="font-medium text-gray-600">Harga:</span>
                            <span class="ml-2 font-bold text-green-600">
                                {{ "Rp. " . number_format($buku->harga, 2, ',', '.') }}
                            </span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-star mr-2 text-yellow-500"></i>
                            <span class="font-medium text-gray-600">Editorial Pick:</span>
                            <span class="ml-2 {{ $buku->editorial_pick ? 'text-green-600' : 'text-red-600' }}">
                                {{ $buku->editorial_pick ? 'Ya' : 'Tidak' }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Reviews Section --}}
                <div class="bg-gray-50 p-6 rounded-xl">
                            <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">
                                Ulasan Buku
                                <span class="text-sm text-gray-500 ml-2">({{ $buku->reviews->count() }} ulasan)</span>
                            </h3>

                            @if ($buku->reviews->count() > 0)
                                <div class="space-y-4">
                                    @foreach ($buku->reviews as $review)
                                        <div class="bg-white p-4 rounded-lg shadow-sm border hover:shadow-md transition-shadow">
                                            <p class="text-gray-700 mb-3">{{ $review->review }}</p>
                                            <div class="flex items-center text-sm text-gray-500">
                                                <i class="fas fa-user mr-2"></i>
                                                {{ $review->user->name }}
                                            </div>
                                            <div class="mt-2">
                                                @foreach ($review->reviewTags as $tagReview)
                                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
                                                        #{{ $tagReview->tag->tag_name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center text-gray-500 italic">Belum ada ulasan untuk buku ini.</div>
                            @endif
                        </div>
            </div>
        </div>

        {{-- Price Information --}}
        <div class="bg-gray-50 p-6 border-t">
            <div class="flex items-center justify-end space-x-4">
                <div class="text-gray-600 line-through">Rp. {{ number_format($buku->harga, 2, ',', '.') }}</div>
                <div class="bg-green-500 text-white font-medium px-4 py-2 rounded-lg">{{ $buku->discount_percentage }}% off</div>
                <div class="text-2xl font-bold text-green-600">Rp. {{ number_format($buku->harga * (1 - $buku->discount_percentage / 100), 2, ',', '.') }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
