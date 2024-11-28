@extends('review.layout.layout')
@php
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\Auth;
@endphp

@section('content')
<body>
    <div class="mx-10 mt-10">
    <div>Pemberi Review
        <select name="reviewer" id="reviewer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option value="">Semua</option>
            @foreach($reviewers as $reviewer)
                <option value="{{ $reviewer->id }}" {{ $reviewer->id == $selectedReviewer ? 'selected' : '' }}>{{ $reviewer->name }}</option>
            @endforeach
        </select>
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
    // set query params
    const selectedReviewer = document.getElementById('reviewer');
    selectedReviewer.addEventListener('change', function() {
        window.location.href = `?reviewer=${selectedReviewer.value}`;
    });
</script>

@endpush
