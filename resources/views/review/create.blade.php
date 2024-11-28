@extends('review.layout.layout')

@section('content')
    <div class="container">
        <h4 class="text-4xl my-4">Tambah Review</h4>
        @if(count($errors)>0)
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif
        <form class="flex w-full flex-col gap-4" method="post" action="{{ route('review.store') }}" enctype="multipart/form-data" id="bukuForm">
            @csrf
            <div>Buku
                <select name="buku_id" id="buku_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @foreach($bukus as $buku)
                        <option value="{{ $buku->id }}">{{ $buku->judul }}</option>
                    @endforeach
                </select>
            </div>
            <div>Review
                <textarea class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" name="review" rows="5"></textarea>
            </div>
            <div>Tag
                <div class="w-full flex gap-2 my-3" id="tagsContainer" >
                    <!-- <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded ">Default</span> -->
                </div>
                <div class="flex gap-2">
                    <input id="addTag" list="tagList" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="text" value="{{ old('tag') }}">
                    <button id="btn_add" type="button" class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                            <span class="sr-only">Tambah</span>
                        </button>
                </div>
                <datalist id="tagList">
                  @foreach($tags as $tag)
                    <option value="{{ $tag->tag_name }}">
                    @endforeach
                </datalist>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ">Submit</button>

        </form>
    </div>
@endsection

@push('js')
    <script>
        // JavaScript to toggle the dropdown
            const dropdownButton = document.getElementById('dropdown-button');
            const dropdownMenu = document.getElementById('dropdown-menu');
            const searchInput = document.getElementById('search-input');
            let isOpen = false; // Set to true to open the dropdown by default

            // Function to toggle the dropdown state
            function toggleDropdown() {
              isOpen = !isOpen;
              dropdownMenu.classList.toggle('hidden', !isOpen);
            }

            // Set initial state
            toggleDropdown();

            dropdownButton.addEventListener('click', () => {
              toggleDropdown();
            });

            // Add event listener to filter items based on input
            searchInput.addEventListener('input', () => {
              const searchTerm = searchInput.value.toLowerCase();
              const items = dropdownMenu.querySelectorAll('a');

              items.forEach((item) => {
                const text = item.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                  item.style.display = 'block';
                } else {
                  item.style.display = 'none';
                }
              });
            });
    </script>

        <script>
        // add tag
        const addTagButton = document.getElementById('btn_add');
        const tagsContainer = document.getElementById('tagsContainer');
        const tagInput = document.getElementById('addTag');

        addTagButton.addEventListener('click', function() {
            const tag = tagInput.value;
            if(tag.trim() === '') return;
            const tagElement = document.createElement('span');
            tagElement.classList.add('bg-blue-100', 'text-blue-800', 'text-xs', 'font-medium', 'me-2', 'px-2.5', 'py-0.5', 'rounded');
            tagElement.textContent = tag;
            tagsContainer.appendChild(tagElement);
            tagInput.value = '';

            // create hidden input
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'tags[]';
            hiddenInput.value = tag;
            tagsContainer.appendChild(hiddenInput);

        });

        // create listener on enter
        tagInput.addEventListener('keypress', function(e) {
            if(e.key === 'Enter') {
                e.preventDefault();
                addTagButton.click();
            }
        });
        </script>

        <script></script>
@endpush
