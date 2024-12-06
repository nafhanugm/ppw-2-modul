@php
$currentPath = \Illuminate\Http\Request::capture()->path();
@endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Buku</title>
    <script
        src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <style>
        .pattern {
            /* From - https://bgjar.com/meteor */
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' width='1440' height='560' opacity='0.05' preserveAspectRatio='none' viewBox='0 0 1440 560'%3e%3cg mask='url(%26quot%3b%23SvgjsMask1021%26quot%3b)' fill='none'%3e%3cpath d='M905 408L904 38' stroke-width='6' stroke='url(%23SvgjsLinearGradient1022)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M607 269L606 125' stroke-width='10' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M68 213L67 365' stroke-width='8' stroke='url(%23SvgjsLinearGradient1022)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M1397 326L1396 563' stroke-width='8' stroke='url(%23SvgjsLinearGradient1022)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M365 418L364 761' stroke-width='6' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M293 317L292 38' stroke-width='8' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M1247 130L1246 508' stroke-width='6' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M1339 5L1338 -305' stroke-width='10' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M831 7L830 -367' stroke-width='6' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M113 250L112 605' stroke-width='10' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M967 177L966 -236' stroke-width='6' stroke='url(%23SvgjsLinearGradient1022)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M922 538L921 160' stroke-width='6' stroke='url(%23SvgjsLinearGradient1022)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M1109 316L1108 32' stroke-width='8' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M1281 270L1280 50' stroke-width='10' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M1280 403L1279 17' stroke-width='8' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M308 106L307 490' stroke-width='10' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M517 147L516 374' stroke-width='10' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M690 30L689 341' stroke-width='10' stroke='url(%23SvgjsLinearGradient1022)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M614 367L613 154' stroke-width='10' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M770 486L769 188' stroke-width='6' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M1336 235L1335 573' stroke-width='10' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M303 441L302 96' stroke-width='10' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M970 211L969 384' stroke-width='10' stroke='url(%23SvgjsLinearGradient1022)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M151 243L150 26' stroke-width='6' stroke='url(%23SvgjsLinearGradient1022)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M184 391L183 201' stroke-width='10' stroke='url(%23SvgjsLinearGradient1022)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M1299 123L1298 -228' stroke-width='10' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M1024 466L1023 254' stroke-width='6' stroke='url(%23SvgjsLinearGradient1022)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M1385 330L1384 546' stroke-width='10' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M991 172L990 552' stroke-width='8' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M600 461L599 254' stroke-width='10' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M146 544L145 145' stroke-width='8' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M539 421L538 723' stroke-width='10' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M1408 130L1407 316' stroke-width='10' stroke='url(%23SvgjsLinearGradient1022)' stroke-linecap='round' class='Up'%3e%3c/path%3e%3cpath d='M1134 160L1133 572' stroke-width='8' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M810 190L809 39' stroke-width='8' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3cpath d='M1069 388L1068 46' stroke-width='8' stroke='url(%23SvgjsLinearGradient1023)' stroke-linecap='round' class='Down'%3e%3c/path%3e%3c/g%3e%3cdefs%3e%3cmask id='SvgjsMask1021'%3e%3crect width='1440' height='560' fill='white'%3e%3c/rect%3e%3c/mask%3e%3clinearGradient x1='0%25' y1='100%25' x2='0%25' y2='0%25' id='SvgjsLinearGradient1022'%3e%3cstop stop-color='rgba(255%2c 255%2c 255%2c 0)' offset='0'%3e%3c/stop%3e%3cstop stop-color='rgba(255%2c 255%2c 255%2c 1)' offset='1'%3e%3c/stop%3e%3c/linearGradient%3e%3clinearGradient x1='0%25' y1='0%25' x2='0%25' y2='100%25' id='SvgjsLinearGradient1023'%3e%3cstop stop-color='rgba(255%2c 255%2c 255%2c 0)' offset='0'%3e%3c/stop%3e%3cstop stop-color='rgba(255%2c 255%2c 255%2c 1)' offset='1'%3e%3c/stop%3e%3c/linearGradient%3e%3c/defs%3e%3c/svg%3e");
        }
    </style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @stack('style')

</head>
<body>

<div
    class="relative  w-screen h-screen "
>
    @if(\Illuminate\Support\Facades\Auth::user())
    <nav
        class="z-20 flex shrink-0 grow-0 justify-around gap-4 border-t border-gray-200 bg-white/50 p-2.5 shadow-lg backdrop-blur-lg fixed top-3/4 -translate-y-2/4 right-6 min-h-[auto] min-w-[64px] flex-col rounded-lg border"
    >
        @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin' )
            <a
                href="/users"
                class="flex aspect-square min-h-[32px] w-16 flex-col items-center justify-center gap-1 rounded-md p-1.5 {{$currentPath == 'users' ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-gray-100'}} "
            >
                <!-- HeroIcon - User -->
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6 shrink-0"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"
                    />
                </svg>

                <small class="text-center text-xs font-medium"> Users </small>
            </a>
        @endif


        <a
            href="/buku"
            class="flex aspect-square min-h-[32px] w-16 flex-col items-center justify-center gap-1 rounded-md p-1.5 {{$currentPath == 'buku' ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-gray-100'}}"
        >
            <!-- HeroIcon - Chart Bar -->
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-6 h-6 shrink-0"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"
                />
            </svg>

            <small class="text-center text-xs font-medium"> Books </small>
        </a>
    </nav>
    @endif
    @yield('content')
</div>


    <script type="text/javascript">
        $('.date').datepicker({
            format: 'yyyy/mm/dd',
            autoclose:true
        });
    </script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

@stack('js')

</body>
</html>
