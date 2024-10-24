<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Styles -->
</head>
<body class="antialiased">
<main class="flex w-full justify-center">
    <div class="flex max-w-3xl w-full mt-16 flex-col">
        @if(\Illuminate\Support\Facades\Auth::user())
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="py-2 px-4  border-2 bg-teal-500 hover:bg-teal-400 active:bg-teal-600 rounded-lg text-white cursor-pointer font-semibold">
                    Logout
                </button>
            </form>
        @else
            <div class="flex justify-end gap-4 mb-4">
                <a href="/login" class="py-2 px-4  border-2 bg-teal-500 hover:bg-teal-400 active:bg-teal-600 rounded-lg text-white cursor-pointer font-semibold">
                    Login
                </a>
                <a href="/register" class="py-2 px-4  border-2 bg-teal-500 hover:bg-teal-400 active:bg-teal-600 rounded-lg text-white cursor-pointer font-semibold">
                    Register
                </a>
            </div>
        @endif
        <div class="flex w-full justify-between">
            <div class="flex flex-col h-full justify-center">
                <h1 class="lg:text-6xl text-2xl font-bold">Hi, I'm Nafhan 👋</h1>
                <p class="text-2xl mt-3">Software Engineer turned Entrepreneur. I love building things and helping people. Very unactive on Twitter.</p>
            </div>
            <div class="p-3 rounded-full aspect-square bg-black w-44 h-44">
                <img src="/images/avatar.png" class="rounded-full w-full h-full object-contain" alt="Avatar">
            </div>
        </div>
        <div class="mt-5 flex w-full gap-2">
            <a href="/" class="py-2 px-4  border-2 bg-teal-500 hover:bg-teal-400 active:bg-teal-600 rounded-full text-white cursor-pointer">
                Home
            </a>
            <a href="/about" class="py-2 px-4  border-2 bg-teal-500 hover:bg-teal-400 active:bg-teal-600 rounded-full text-white cursor-pointer">
                About
            </a>
            <a href="/project" class="py-2 px-4  border-2 bg-teal-500 hover:bg-teal-400 active:bg-teal-600 rounded-full text-white cursor-pointer">
                Projects
            </a>
            <a href="/certificate" class="py-2 px-4  border-2 bg-teal-500 hover:bg-teal-400 active:bg-teal-600 rounded-full text-white cursor-pointer">
                Certificates
            </a>
        </div>
        <iframe src="https://nafhan.site/project" title="Nafhan Portofolio" class="w-full h-screen my-10 rounded-lg overflow-hidden"></iframe>
    </div>
</main>
</body>
</html>
