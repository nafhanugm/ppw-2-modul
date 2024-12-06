@extends('review.layout.layout')
@php
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
@endphp

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header Section -->
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">
                <i class="fas fa-tags mr-2 text-blue-500"></i>Review Tags
            </h2>
        </div>

        <!-- Tags Filter Section -->
        <div class="p-6 bg-white border-b border-gray-200">
            <h3 class="text-sm font-medium text-gray-700 mb-4">
                <i class="fas fa-filter mr-2"></i>Filter by Tags
            </h3>
            <div class="flex flex-wrap gap-2">
                @foreach($tags as $tag)
                    <div id="tag_{{$tag->id}}" class="group flex items-center px-4 py-2 rounded-full border transition-all duration-200 cursor-pointer hover:shadow-md">
                        <i class="fas fa-tag mr-2 text-sm"></i>
                        <span class="text-sm font-medium">{{ $tag->tag_name}}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Table Section -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <i class="fas fa-hashtag mr-1"></i>No
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <i class="fas fa-user mr-1"></i>Reviewer
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <i class="fas fa-book mr-1"></i>Book Title
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <i class="fas fa-pen mr-1"></i>Author
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <i class="fas fa-tag mr-1"></i>Price
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <i class="fas fa-calendar mr-1"></i>Publication Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <i class="fas fa-comment mr-1"></i>Review
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <i class="fas fa-tags mr-1"></i>Tags
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($reviews as $index => $review)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $index+1 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8">
                                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-blue-100">
                                            <span class="text-sm font-medium text-blue-700">{{ substr($review->user->name, 0, 1) }}</span>
                                        </span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $review->user->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $review->book->judul }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $review->book->penulis }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ "Rp. ".number_format($review->book->harga, 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $review->book->tgl_terbit->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-500 line-clamp-2">{{ $review->review }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1">
                                    @foreach($review->reviewTags as $tag)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <i class="fas fa-tag mr-1 text-xs"></i>
                                            {{ $tag->tag->tag_name }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Footer Section -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            <div class="text-sm text-gray-600">
                <i class="fas fa-list-ul mr-2"></i>
                Total Reviews: {{ count($reviews) }}
            </div>
        </div>
    </div>
</div>
@endsection

@push("js")
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tagElements = document.querySelectorAll('[id^="tag_"]');
    const currentUrl = new URL(window.location.href);
    const existingTagsParam = currentUrl.searchParams.get('tag');
    const existingTags = existingTagsParam ? existingTagsParam.split(',') : [];

    // Mark initially selected tags
    existingTags.forEach(tagId => {
        const tagElement = document.getElementById(`tag_${tagId}`);
        if (tagElement) {
            tagElement.classList.remove('border-gray-200', 'text-gray-700');
            tagElement.classList.add('bg-blue-500', 'text-white', 'border-blue-500');
        }
    });

    tagElements.forEach(tag => {
        tag.addEventListener('click', function() {
            const tagId = this.id.replace('tag_', '');
            const newUrl = new URL(window.location.href);
            const currentTagsParam = newUrl.searchParams.get('tag');
            const currentTags = currentTagsParam ? currentTagsParam.split(',') : [];
            const tagIndex = currentTags.indexOf(tagId);

            if (tagIndex > -1) {
                currentTags.splice(tagIndex, 1);
                this.classList.remove('bg-blue-500', 'text-white', 'border-blue-500');
                this.classList.add('border-gray-200', 'text-gray-700');
            } else {
                currentTags.push(tagId);
                this.classList.remove('border-gray-200', 'text-gray-700');
                this.classList.add('bg-blue-500', 'text-white', 'border-blue-500');
            }

            if (currentTags.length > 0) {
                newUrl.searchParams.set('tag', currentTags.join(','));
            } else {
                newUrl.searchParams.delete('tag');
            }

            window.location.href = newUrl.toString();
        });
    });
});
</script>
@endpush
