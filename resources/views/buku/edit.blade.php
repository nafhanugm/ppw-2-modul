@extends('buku.layout.layout')

@section('content')
    <div class="container">
        <h4 class="text-4xl my-4">Edit Buku</h4>
        @if(count($errors) > 0)
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <form class="flex w-full flex-col gap-4" method="post" action="{{ route('buku.update', $buku->id) }}" enctype="multipart/form-data" id="bukuForm">
            @csrf
            @method('PUT')
            <div>Judul
                <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                       type="text" name="judul" value="{{ old('judul', $buku->judul) }}">
            </div>
            <div>Penulis
                <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                       type="text" name="penulis" value="{{ old('penulis', $buku->penulis) }}">
            </div>
            <div>Harga
                <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                       type="text" name="harga" value="{{ old('harga', $buku->harga) }}">
            </div>
            <div>Tanggal Terbit
                <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                       type="date" name="tgl_terbit" value="{{ old('tgl_terbit', $buku->tgl_terbit->format('Y-m-d')) }}">
            </div>

            <!-- Thumbnail Section -->
            <div>Thumbnail
                <input id="fileInput" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                       type="file" name="thumbnail">
                @if($buku->filepath)
                    <img src="{{ asset($buku->filepath) }}" id="preview" alt="Current Thumbnail" class="mt-2" width="150">
                @endif
            </div>

            <!-- Gallery Section -->
            <div>Galeri
                <div id="galleryPreview" class="flex flex-wrap gap-2 mb-4">
                    <!-- Preview existing gallery images -->
                    @foreach($buku->galeri as $galleryImage)
                        <div class="gallery-item relative" data-id="{{ $galleryImage->id }}">
                            <img src="{{ asset($galleryImage->path) }}" alt="Gallery Image" width="150" class="mb-2">
                            <input type="checkbox" class="delete-checkbox absolute top-0 right-0">
                        </div>
                    @endforeach
                </div>

                <button type="button" id="deleteSelectedButton" class="bg-red-500 text-white px-4 py-2 rounded mb-4">Hapus Terpilih</button>

                <div id="galleryInputs" class="flex flex-col gap-2">
{{--                    <input type="file" name="gallery[]" class="gallery-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-2" multiple>--}}
                </div>
                <button type="button" id="addGalleryButton" class="mt-2 bg-green-500 text-white px-4 py-2 rounded">Tambah Gambar</button>
            </div>

            <div class="w-full flex justify-end mt-3">
                <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center" type="submit">Update</button>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        const fileInput = document.getElementById('fileInput');
        const preview = document.getElementById('preview');
        const galleryPreview = document.getElementById('galleryPreview');
        const galleryInputs = document.getElementById('galleryInputs');
        const addGalleryButton = document.getElementById('addGalleryButton');
        const deleteSelectedButton = document.getElementById('deleteSelectedButton');

        // Preview for thumbnail
        fileInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function () {
                    preview.src = reader.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // Add new input for gallery and set up preview with delete checkbox
        addGalleryButton.addEventListener('click', function () {
            const newInput = document.createElement('input');
            newInput.type = 'file';
            newInput.name = 'gallery[]';
            newInput.classList.add('gallery-input', 'bg-gray-50', 'border', 'border-gray-300', 'text-gray-900', 'text-sm', 'rounded-lg', 'focus:ring-blue-500', 'focus:border-blue-500', 'block', 'w-full', 'p-2.5', 'mt-2');
            galleryInputs.appendChild(newInput);

            // Add event listener to preview selected files with delete checkbox
            newInput.addEventListener('change', function () {
                Array.from(newInput.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        const newImageDiv = document.createElement('div');
                        newImageDiv.classList.add('gallery-item', 'relative');

                        // Add image and delete checkbox
                        newImageDiv.innerHTML = `
                            <img src="${event.target.result}" alt="New Gallery Image" width="150" class="mb-2">
                            <input type="checkbox" class="delete-checkbox absolute top-0 right-0">
                        `;

                        // Checkbox click to remove the new preview
                        newImageDiv.querySelector('.delete-checkbox').addEventListener('click', function() {
                        //     delete attribute name
                            if (newInput.getAttribute('name')) {
                                newInput.removeAttribute('name');
                            } else {
                                newInput.setAttribute('name', 'gallery[]');
                            }
                        });

                        galleryPreview.appendChild(newImageDiv);
                    };
                    reader.readAsDataURL(file);
                });
            });
        });

        // Handle deletion of existing gallery items on the interface only
        deleteSelectedButton.addEventListener('click', function () {
            const checkboxes = document.querySelectorAll('.delete-checkbox:checked');
            checkboxes.forEach(checkbox => {
                const galleryItem = checkbox.closest('.gallery-item');
                const galleryId = galleryItem.getAttribute('data-id');

                // Only add hidden input if image exists in the database
                if (galleryId) {
                    const deleteInput = document.createElement('input');
                    deleteInput.type = 'hidden';
                    deleteInput.name = 'delete_gallery_ids[]';
                    deleteInput.value = galleryId;
                    document.getElementById('bukuForm').appendChild(deleteInput);
                }

                // Remove the gallery item from the interface
                galleryItem.remove();
            });
        });
    </script>
@endpush
