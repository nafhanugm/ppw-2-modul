@extends('buku.layout.layout')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Tambah Buku</h3>
                <p class="mt-1 text-sm text-gray-600">
                    Isi formulir di bawah ini untuk menambahkan buku baru.
                </p>
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            @if(count($errors)>0)
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <div>
                            <label for="judul" class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-book mr-1"></i> Judul
                            </label>
                            <input type="text" name="judul" id="judul" class="p-2.5 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('judul') }}">
                        </div>

                        <div>
                            <label for="penulis" class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-user-edit mr-1"></i> Penulis
                            </label>
                            <input type="text" name="penulis" id="penulis" class="p-2.5 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('penulis') }}">
                        </div>

                        <div>
                            <label for="harga" class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-tag mr-1"></i> Harga
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">Rp</span>
                                </div>
                                <input type="number" name="harga" id="harga" class="p-2.5 pl-12 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('harga') }}">
                            </div>
                        </div>

                        <div>
                            <label for="tgl_terbit" class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-calendar-alt mr-1"></i> Tanggal Terbit
                            </label>
                            <input type="date" name="tgl_terbit" id="tgl_terbit" class="p-2.5 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('tgl_terbit') }}">
                        </div>

                        <!-- Editorial Pick -->
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="editorial_pick" name="editorial_pick" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" {{ old('editorial_pick') ? 'checked' : '' }}>
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="editorial_pick" class="font-medium text-gray-700">
                                    <i class="fas fa-star mr-1 text-yellow-400"></i> Editorial Pick
                                </label>
                                <p class="text-gray-500">Tandai buku ini sebagai pilihan editor</p>
                            </div>
                        </div>

                        <!-- Discount Percentage -->
                        <div>
                            <label for="discount_percentage" class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-percent mr-1"></i> Discount Percentage
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="number" name="discount_percentage" id="discount_percentage" min="0" max="100" class="p-2.5 pr-12 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('discount_percentage', 0) }}">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">%</span>
                                </div>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Masukkan persentase diskon (0-100)</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-image mr-1"></i> Thumbnail
                            </label>
                            <div class="mt-1 flex items-center">
                                <input type="file" name="thumbnail" id="thumbnail" class="p-2.5 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>

                        <!-- Gallery section remains the same but with icon -->
                        <div x-data="{ gallery: [] }">
                            <label class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-images mr-1"></i> Gallery
                            </label>
                            <div class="mt-1 flex flex-col">
                                <template x-for="(image, index) in gallery" :key="index">
                                    <div class="flex items-center space-x-2 mb-2">
                                        <input type="file" x-bind:name="'gallery[]'" class="p-2.5 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                        <input type="text" x-model="image.keterangan" x-bind:name="'gallery_keterangan[]'" placeholder="Keterangan" class="p-2.5 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                        <button type="button" @click="gallery.splice(index, 1)" class="inline-flex items-center px-2 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </template>

                                <button type="button" @click="gallery.push({keterangan: ''})" class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <i class="fas fa-plus mr-1"></i>
                                    Add Image
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-book mr-1"></i> Related Book
                            </label>

                            <div class="w-full flex flex-wrap gap-2 my-3" id="tagsContainer">
                            </div>

                            <div class="flex gap-2">
                                <div class="relative flex-grow">
                                    <input id="addTag" list="tagList" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" placeholder="Tambahkan buku yang berkaitan..." value="{{ old('tag') }}">
                                    <datalist id="tagList">
                                        @foreach($books as $book)
                                            <option value="{{ $book->judul }}">
                                        @endforeach
                                    </datalist>
                                </div>
                                <button id="btn_add" type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 space-x-2">
                        <a href="{{ url()->previous() }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali
                        </a>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fas fa-save mr-1"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('imageData', () => ({
        gallery: [{}], // Start with one input field
    }))
})
</script>

<script>
    // Tag functionality
    const addTagButton = document.getElementById('btn_add');
    const tagsContainer = document.getElementById('tagsContainer');
    const tagInput = document.getElementById('addTag');

    function addTag() {
        const tag = tagInput.value;
        if(tag.trim() === '') return;

        const tagElement = document.createElement('span');
        tagElement.classList.add('inline-flex', 'items-center', 'px-2.5', 'py-0.5', 'rounded-full', 'text-xs', 'font-medium', 'bg-indigo-100', 'text-indigo-800');

        // Add tag text
        const tagText = document.createTextNode(tag);
        tagElement.appendChild(tagText);

        // Add remove button
        const removeButton = document.createElement('button');
        removeButton.innerHTML = '<i class="fas fa-times ml-1"></i>';
        removeButton.classList.add('ml-1', 'text-indigo-400', 'hover:text-indigo-600', 'focus:outline-none');
        removeButton.onclick = function() {
            tagElement.remove();
            hiddenInput.remove();
        };
        tagElement.appendChild(removeButton);

        tagsContainer.appendChild(tagElement);

        // Create hidden input
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'related_books[]';
        hiddenInput.value = tag;
        tagsContainer.appendChild(hiddenInput);

        tagInput.value = '';
    }

    addTagButton.addEventListener('click', addTag);

    tagInput.addEventListener('keypress', function(e) {
        if(e.key === 'Enter') {
            e.preventDefault();
            addTag();
        }
    });
</script>
@endpush
