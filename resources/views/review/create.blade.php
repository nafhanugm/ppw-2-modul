@extends('review.layout.layout')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Tambah Review</h3>
                <p class="mt-1 text-sm text-gray-600">
                    Isi formulir di bawah ini untuk menambahkan review baru.
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
            <form action="{{ route('review.store') }}" method="POST" enctype="multipart/form-data" id="bukuForm">
                @csrf
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <!-- Buku Selection -->
                        <div>
                            <label for="buku_id" class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-book mr-1"></i> Pilih Buku
                            </label>
                            <select name="buku_id" id="buku_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach($bukus as $buku)
                                    <option class="py-2" value="{{ $buku->id }}">{{ $buku->judul }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Review Text -->
                        <div>
                            <label for="review" class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-comment mr-1"></i> Review
                            </label>
                            <textarea name="review" id="review" rows="5" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('review') }}</textarea>
                        </div>

                        <!-- Tags Section -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-tags mr-1"></i> Tags
                            </label>
                            <!-- Tags Container -->
                            <div class="w-full flex flex-wrap gap-2 my-3" id="tagsContainer">
                            </div>
                            <!-- Tag Input -->
                            <div class="flex gap-2">
                                <div class="relative flex-grow">
                                    <input id="addTag" list="tagList" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" placeholder="Tambahkan tag..." value="{{ old('tag') }}">
                                    <datalist id="tagList">
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->tag_name }}">
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
        hiddenInput.name = 'tags[]';
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
