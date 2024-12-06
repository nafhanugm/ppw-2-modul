<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .profile-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
    </style>
</head>
<body class="antialiased bg-gray-100">
    <main class="container mx-auto px-4">
        <div class="max-w-3xl w-full mt-16 mx-auto">
            @if(\Illuminate\Support\Facades\Auth::user())
                <form method="POST" action="{{ route('logout') }}" class="text-right mb-4">
                    @csrf
                    <button type="submit" class="py-2 px-4 border-2 bg-teal-500 hover:bg-teal-600 active:bg-teal-700 rounded-lg text-white font-semibold transition duration-200">
                        <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
                    </button>
                    <a href="/buku" class="py-2 px-4 border-2 bg-teal-500 hover:bg-teal-600 active:bg-teal-700 rounded-lg text-white font-semibold transition duration-200">
                        <i class="fa-solid fa-home mr-2"></i> Dashboard
                    </a>
                </form>
            @else
                <div class="flex justify-end gap-4 mb-4">
                    <a href="/login" class="py-2 px-4 border-2 bg-teal-500 hover:bg-teal-600 active:bg-teal-700 rounded-lg text-white font-semibold transition duration-200">
                        <i class="fa-solid fa-right-to-bracket mr-2"></i> Login
                    </a>
                    <a href="/register" class="py-2 px-4 border-2 bg-teal-500 hover:bg-teal-600 active:bg-teal-700 rounded-lg text-white font-semibold transition duration-200">
                        <i class="fa-solid fa-user-plus mr-2"></i> Register
                    </a>
                </div>
            @endif

            <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                <div>
                    <h1 class="text-4xl md:text-6xl font-bold leading-tight">Hi, I'm Nafhan <span class="wave">👋</span></h1>
                    <p class="text-lg md:text-2xl mt-3 text-gray-600">Software Engineer turned Entrepreneur. I love building things and helping people. Very unactive on Twitter.</p>
                </div>
                <img src="/images/avatar.jpg" alt="Avatar" class="rounded-full profile-image mt-4 md:mt-0 border-4 border-teal-500 shadow-md">
            </div>

            <div class="mt-5 flex flex-wrap gap-4 justify-center md:justify-start">
                <a href="/bukuReview" class="py-2 px-4 bg-teal-500 hover:bg-teal-600 active:bg-teal-700 rounded-lg text-white font-semibold transition duration-200">
                    <i class="fa-solid fa-star mr-2"></i> Buku Berdasarkan Review
                </a>
                <a href="/bukuTag" class="py-2 px-4 bg-teal-500 hover:bg-teal-600 active:bg-teal-700 rounded-lg text-white font-semibold transition duration-200">
                    <i class="fa-solid fa-tags mr-2"></i> Buku Berdasarkan Tag
                </a>
            </div>

            @if ($books->isNotEmpty())
                <h2 class="text-2xl font-bold mt-12 mb-6">Buku Tersedia</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($books as $buku)
                        <div class="bg-white rounded-lg shadow-md p-4">
                            <img src="{{ asset($buku->filepath) }}" alt="{{ $buku->judul }}" class="w-full h-48 object-cover rounded-md mb-3">
                            <h3 class="text-lg font-semibold">{{ $buku->judul }}</h3>
                            <p class="text-gray-600">By {{ $buku->penulis }}</p>
                            <div class="flex items-baseline">
                                @if ($buku->discount_percentage > 0)
                                    <p class="text-gray-400 line-through mr-2 text-sm">Rp. {{ number_format($buku->harga) }}</p>
                                @endif
                                <p class="font-bold text-teal-500">Rp. {{ ($buku->discountedPrice) }}</p>
                            </div>
                            <p class="text-sm text-gray-500">
                                @if ($buku->discount_percentage > 0)
                                    Diskon: {{ $buku->discount_percentage }}%
                                @endif
                            </p>
                            <a href="/detail-buku/{{ $buku->id }}" class="py-2 px-4 mt-2 bg-teal-500 hover:bg-teal-600 active:bg-teal-700 rounded-lg text-white font-semibold text-center block transition duration-200">Detail <i class="fa-solid fa-arrow-right ml-2"></i></a>
                        </div>
                    @endforeach
                </div>
                 <div class="mt-6">{{$books->links()}}</div>
            @endif
        </div>
    </main>
</body>
</html>
