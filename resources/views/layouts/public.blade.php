<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PT. Sumber Bumi Putera')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans text-slate-700 antialiased">

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Konten Halaman --}}
    <main>
        @yield('content')
    </main>

    @include('components.partners-marquee')
    {{-- Footer --}}
    @include('components.footer')

    @stack('scripts')

</body>
</html>
