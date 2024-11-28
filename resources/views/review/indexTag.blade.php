@extends('review.layout.layout')
@php
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\Auth;
@endphp

@section('content')
<body>
    <div class="mx-10 mt-10">
    <div>Tag Tersedia
        <div class="flex w-full">
            @foreach($tags as $tag)
                <div id="tag_{{$tag->id}}" class="flex justify-center items-center m-1 font-medium py-3 px-4 cursor-pointer  bg-white rounded-full text-gray-700 border border-gray-300 ">
                        <div class="text-lg font-normal leading-none max-w-full flex-initial">{{ $tag->tag_name}}</div>
                </div>
            @endforeach
        </div>
    </div>
    <table class="table table-stripped">
        <thead>
            <tr>
                <th>no</th>
                <th>Pemberi Review</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Tanggal Terbit</th>
                <th>Review</th>
                <th>Tag</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $index => $review)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $review->user->name }}</td>
                    <td>{{ $review->book->judul }}</td>
                    <td>{{ $review->book->penulis }}</td>
                    <td>{{ "Rp. ".number_format($review->book->harga, 2, ',', '.') }}</td>
                    <td>{{ $review->book->tgl_terbit->format('d/m/Y') }}</td>
                    <td>{{ $review->review }}</td>
                    <td>
                        @foreach($review->reviewTags as $tag)
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded ">{{ $tag->tag->tag_name }}</span>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
@endsection

@push("js")
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all tag elements
    const tagElements = document.querySelectorAll('[id^="tag_"]');

    // Get current URL and existing tag parameters
    const currentUrl = new URL(window.location.href);
    const existingTagsParam = currentUrl.searchParams.get('tag');
    const existingTags = existingTagsParam ? existingTagsParam.split(',') : [];

    // Mark initially selected tags
    existingTags.forEach(tagId => {
        const tagElement = document.getElementById(`tag_${tagId}`);
        if (tagElement) {
            tagElement.classList.remove('bg-white', 'text-blue-700', 'border-blue-300');
            tagElement.classList.add('bg-blue-700', 'text-white', 'border-blue-700');
        }
    });

    tagElements.forEach(tag => {
        tag.addEventListener('click', function() {
            // Get the tag ID
            const tagId = this.id.replace('tag_', '');

            // Create a new URL object to modify parameters
            const newUrl = new URL(window.location.href);

            // Get current tags from URL
            const currentTagsParam = newUrl.searchParams.get('tag');
            const currentTags = currentTagsParam ? currentTagsParam.split(',') : [];

            // Check if tag is already selected
            const tagIndex = currentTags.indexOf(tagId);

            if (tagIndex > -1) {
                // Remove the tag if it's already selected
                currentTags.splice(tagIndex, 1);
            } else {
                // Add the tag if it's not selected
                currentTags.push(tagId);
            }

            // Update URL parameters
            if (currentTags.length > 0) {
                newUrl.searchParams.set('tag', currentTags.join(','));
            } else {
                newUrl.searchParams.delete('tag');
            }

            // Toggle visual state
            this.classList.toggle('bg-white');
            this.classList.toggle('text-blue-700');
            this.classList.toggle('border-blue-300');
            this.classList.toggle('bg-blue-700');
            this.classList.toggle('text-white');
            this.classList.toggle('border-blue-700');

            // Navigate to the new URL
            window.location.href = newUrl.toString();
        });
    });
});
</script>
@endpush
