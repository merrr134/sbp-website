<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — SBP Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F0F4F8] font-sans antialiased" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">

        {{-- ===== SIDEBAR ===== --}}
        <aside class="fixed inset-y-0 left-0 z-50 w-[220px] bg-white border-r border-slate-100 flex flex-col
                       transform transition-transform duration-300 ease-in-out
                       md:relative md:translate-x-0"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">

            {{-- Logo --}}
            <div class="px-6 py-5 border-b border-slate-100">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2">
                    <svg width="32" height="32" viewBox="0 0 36 36" fill="none">
                        <rect width="36" height="36" rx="8" fill="#006591"/>
                        <path d="M8 26L14 10L18 20L22 14L28 26H8Z" fill="#F59E0B"/>
                        <circle cx="22" cy="11" r="3" fill="#0EA5E9"/>
                    </svg>
                    <div class="leading-tight">
                        <span class="block font-bold text-navy text-sm">SBP Admin</span>
                    </div>
                </a>
            </div>

            {{-- User Info --}}
            <div class="px-4 py-4 border-b border-slate-100">
                <div class="flex items-center gap-3 bg-surface rounded-xl px-3 py-2.5">
                    <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center flex-shrink-0">
                        <span class="text-white text-xs font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </span>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-semibold text-navy truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-slate-400 uppercase tracking-wide">Operations Lead</p>
                    </div>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto">

                @php
                    $navItems = [
                        [
                            'route' => 'admin.dashboard',
                            'label' => 'Dashboard',
                            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>',
                        ],
                        [
                            'route' => 'admin.home.edit',
                            'label' => 'Kelola Home',
                            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>',
                        ],
                        [
                            'route' => 'admin.about.edit',
                            'label' => 'Tentang Kami',
                            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>',
                        ],
                        [
                            'route' => 'admin.berita.index',
                            'label' => 'Berita',
                            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>',
                        ],
                        [
                            'route' => 'admin.gallery.index',
                            'label' => 'Galeri',
                            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
                        ],
                        [
                            'route' => 'admin.partners.index',
                            'label' => 'Mitra',
                            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>',
                        ],
                        [
                            'route' => 'admin.messages.index',
                            'label' => 'Pesan',
                            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
                        ],
                        [
                            'route' => 'admin.assets.index',
                            'label' => 'Aset',
                            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/>',
                        ],
                    ];
                @endphp

                @foreach($navItems as $item)
                <a href="{{ route($item['route']) }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150
                          {{ request()->routeIs($item['route'])
                              ? 'bg-primary text-white shadow-sm'
                              : 'text-slate-500 hover:bg-surface hover:text-navy' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $item['icon'] !!}
                    </svg>
                    {{ $item['label'] }}

                    {{-- Badge pesan belum dibaca --}}
                    @if($item['route'] === 'admin.messages.index')
                        @php $unread = \App\Models\Message::where('is_read', false)->count(); @endphp
                        @if($unread > 0)
                        <span class="ml-auto bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">
                            {{ $unread }}
                        </span>
                        @endif
                    @endif
                </a>
                @endforeach

            </nav>

            {{-- Bottom — Logout & View Site --}}
            <div class="px-3 py-4 border-t border-slate-100 space-y-1">
                <a href="{{ route('home') }}" target="_blank"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-500 hover:bg-surface hover:text-navy transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Lihat Website
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-red-400 hover:bg-red-50 hover:text-red-600 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>

        </aside>

        {{-- Overlay mobile --}}
        <div x-show="sidebarOpen"
             @click="sidebarOpen = false"
             class="fixed inset-0 z-40 bg-black/40 md:hidden">
        </div>

        {{-- ===== MAIN CONTENT ===== --}}
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

            {{-- Topbar --}}
            <header class="bg-white border-b border-slate-100 px-6 py-4 flex items-center justify-between flex-shrink-0">
                <div class="flex items-center gap-4">
                    {{-- Hamburger mobile --}}
                    <button @click="sidebarOpen = !sidebarOpen"
                            class="md:hidden p-2 rounded-lg text-slate-500 hover:bg-surface">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <div>
                        <h1 class="text-lg font-bold text-navy">@yield('page-title', 'Dashboard')</h1>
                        <p class="text-xs text-slate-400">@yield('page-subtitle', 'Manage the PT. Sumber Bumi Putera digital ecosystem.')</p>
                    </div>
                </div>

                {{-- Topbar Right --}}
                <div class="flex items-center gap-3">
                    {{-- Notif pesan --}}
                    @php $unreadCount = \App\Models\Message::where('is_read', false)->count(); @endphp
                    @if($unreadCount > 0)
                    <a href="{{ route('admin.messages.index') }}"
                       class="relative p-2 rounded-lg text-slate-500 hover:bg-surface transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    </a>
                    @endif

                    {{-- Avatar --}}
                    <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center">
                        <span class="text-white text-xs font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </span>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto p-6">

                {{-- Flash Message --}}
                @if(session('success'))
                <div class="mb-6 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl"
                     x-data="{ show: true }" x-show="show">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                    <button @click="show = false" class="ml-auto text-green-500 hover:text-green-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
