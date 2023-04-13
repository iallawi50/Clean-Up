<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@300;400&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body dir="rtl" class="text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-blue-400">


        <div class="w-full sm:max-w-md  mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div>
            <a href="/" class="mb-5 block pb-5">
                <x-application-logo class="w-50 h-20 fill-current text-gray-500" style="width: 10px"/>
            </a>
        </div>
            {{ $slot }}
        </div>
        @if (request()->routeIs('register') || request()->routeIs('login'))
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

                @if (request()->routeIs('register'))
                    <p class="text-center">لديك حساب ؟ <a href="{{ route('login') }}"
                            class="text-blue-500 font-bold">تسجيل دخول</a></p>
                @else
                    <p class="text-center">لاتمتلك حساباً ؟ <a href="{{ route('register') }}"
                            class="text-blue-500 font-bold">تسجيل جديد</a></p>
                @endif

            </div>
        @endif
    </div>
</body>

</html>
