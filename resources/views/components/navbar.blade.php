<nav x-data="{ open: false, aboutOpen: false, scrolled: false }"
     x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
     :class="scrolled ? 'bg-white shadow-md' : 'bg-white/80 backdrop-blur-md'"
     class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">

    <div class="max-w-[1280px] mx-auto px-6">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('img/logo.png') }}"
                     alt="Logo SBP"
                     class="h-10 object-contain">
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden md:flex items-center gap-1">

                <a href="{{ route('home') }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200
                          {{ request()->routeIs('home') ? 'text-primary bg-primary/10' : 'text-slate-600 hover:text-primary hover:bg-slate-50' }}">
                    {{ __('app.nav_home') }}
                </a>

                {{-- Dropdown Tentang Kami --}}
                <div class="relative" x-data="{ aboutOpen: false }">
                    <button @click="aboutOpen = !aboutOpen"
                            @click.outside="aboutOpen = false"
                            class="flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200
                                   {{ request()->routeIs('about.*') ? 'text-primary bg-primary/10' : 'text-slate-600 hover:text-primary hover:bg-slate-50' }}">
                        {{ __('app.nav_about') }}
                        <svg class="w-3.5 h-3.5 transition-transform duration-200"
                             :class="{ 'rotate-180': aboutOpen }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="aboutOpen"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                         x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                         class="absolute top-full left-0 mt-2 w-56 bg-white rounded-2xl shadow-modal border border-slate-100 py-2 z-50 origin-top-left">

                        @php
                            $aboutItems = [
                                ['route' => 'about.company',        'label' => __('app.nav_about_company'), 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                                ['route' => 'about.vision-mission', 'label' => __('app.nav_about_vision'),  'icon' => 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'],
                                ['route' => 'about.history',        'label' => __('app.nav_about_history'), 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                                ['route' => 'about.assets',         'label' => __('app.nav_about_assets'),  'icon' => 'M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18'],
                            ];
                        @endphp

                        @foreach($aboutItems as $item)
                        <a href="{{ route($item['route']) }}"
                           class="flex items-center gap-3 px-4 py-2.5 text-sm transition-colors
                                  {{ request()->routeIs($item['route']) ? 'text-primary bg-primary/5' : 'text-slate-600 hover:bg-slate-50 hover:text-primary' }}">
                            <div class="w-7 h-7 rounded-lg {{ request()->routeIs($item['route']) ? 'bg-primary/10' : 'bg-slate-100' }} flex items-center justify-center flex-shrink-0">
                                <svg class="w-3.5 h-3.5 {{ request()->routeIs($item['route']) ? 'text-primary' : 'text-slate-400' }}"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                                </svg>
                            </div>
                            {{ $item['label'] }}
                        </a>
                        @endforeach

                    </div>
                </div>

                <a href="{{ route('news.index') }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200
                          {{ request()->routeIs('news.*') ? 'text-primary bg-primary/10' : 'text-slate-600 hover:text-primary hover:bg-slate-50' }}">
                    {{ __('app.nav_news') }}
                </a>

                <a href="{{ route('gallery.index') }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200
                          {{ request()->routeIs('gallery.*') ? 'text-primary bg-primary/10' : 'text-slate-600 hover:text-primary hover:bg-slate-50' }}">
                    {{ __('app.nav_gallery') }}
                </a>

                <a href="{{ route('contact.index') }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200
                          {{ request()->routeIs('contact.*') ? 'text-primary bg-primary/10' : 'text-slate-600 hover:text-primary hover:bg-slate-50' }}">
                    {{ __('app.nav_contact') }}
                </a>

            </div>

            {{-- Kanan: Language + Mobile Button --}}
            <div class="flex items-center gap-3">

                {{-- Language Switcher --}}
                <div class="hidden md:flex items-center bg-slate-100 rounded-lg p-0.5">
                    <a href="{{ route('lang.switch', 'id') }}"
                       class="px-3 py-1.5 rounded-md text-xs font-semibold transition-all duration-200
                              {{ session('lang', 'id') === 'id' ? 'bg-white text-primary shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">
                        ID
                    </a>
                    <a href="{{ route('lang.switch', 'en') }}"
                       class="px-3 py-1.5 rounded-md text-xs font-semibold transition-all duration-200
                              {{ session('lang') === 'en' ? 'bg-white text-primary shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">
                        EN
                    </a>
                    <a href="{{ route('lang.switch', 'zh') }}"
                       class="px-3 py-1.5 rounded-md text-xs font-semibold transition-all duration-200
                              {{ session('lang') === 'zh' ? 'bg-white text-primary shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">
                        中文
                    </a>
                </div>

                {{-- Mobile Hamburger --}}
                <button @click="open = !open"
                        class="md:hidden w-9 h-9 flex items-center justify-center rounded-lg text-slate-600 hover:bg-slate-100 transition-colors">
                    <svg x-show="!open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="md:hidden bg-white border-t border-slate-100 px-6 py-4">

        <div class="space-y-1">
            <a href="{{ route('home') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors
                      {{ request()->routeIs('home') ? 'text-primary bg-primary/10' : 'text-slate-600 hover:bg-slate-50' }}">
                {{ __('app.nav_home') }}
            </a>

            {{-- Mobile Tentang Kami --}}
            <div x-data="{ mobileAbout: false }">
                <button @click="mobileAbout = !mobileAbout"
                        class="w-full flex items-center justify-between px-4 py-3 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50 transition-colors">
                    {{ __('app.nav_about') }}
                    <svg class="w-4 h-4 transition-transform duration-200"
                         :class="{ 'rotate-180': mobileAbout }"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="mobileAbout" class="ml-4 mt-1 space-y-1">
                    <a href="{{ route('about.company') }}"        class="block px-4 py-2.5 rounded-xl text-sm text-slate-500 hover:text-primary hover:bg-slate-50 transition-colors">{{ __('app.nav_about_company') }}</a>
                    <a href="{{ route('about.vision-mission') }}" class="block px-4 py-2.5 rounded-xl text-sm text-slate-500 hover:text-primary hover:bg-slate-50 transition-colors">{{ __('app.nav_about_vision') }}</a>
                    <a href="{{ route('about.history') }}"        class="block px-4 py-2.5 rounded-xl text-sm text-slate-500 hover:text-primary hover:bg-slate-50 transition-colors">{{ __('app.nav_about_history') }}</a>
                    <a href="{{ route('about.assets') }}"         class="block px-4 py-2.5 rounded-xl text-sm text-slate-500 hover:text-primary hover:bg-slate-50 transition-colors">{{ __('app.nav_about_assets') }}</a>
                </div>
            </div>

            <a href="{{ route('news.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors
                      {{ request()->routeIs('news.*') ? 'text-primary bg-primary/10' : 'text-slate-600 hover:bg-slate-50' }}">
                {{ __('app.nav_news') }}
            </a>

            <a href="{{ route('gallery.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors
                      {{ request()->routeIs('gallery.*') ? 'text-primary bg-primary/10' : 'text-slate-600 hover:bg-slate-50' }}">
                {{ __('app.nav_gallery') }}
            </a>

            <a href="{{ route('contact.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors
                      {{ request()->routeIs('contact.*') ? 'text-primary bg-primary/10' : 'text-slate-600 hover:bg-slate-50' }}">
                {{ __('app.nav_contact') }}
            </a>
        </div>

        {{-- Language Mobile --}}
        <div class="flex items-center gap-2 mt-4 pt-4 border-t border-slate-100">
            <p class="text-xs text-slate-400 mr-1">Bahasa:</p>
            <a href="{{ route('lang.switch', 'id') }}"
               class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-all
                      {{ session('lang', 'id') === 'id' ? 'bg-primary text-white' : 'bg-slate-100 text-slate-500' }}">
                ID
            </a>
            <a href="{{ route('lang.switch', 'en') }}"
               class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-all
                      {{ session('lang') === 'en' ? 'bg-primary text-white' : 'bg-slate-100 text-slate-500' }}">
                EN
            </a>
            <a href="{{ route('lang.switch', 'zh') }}"
               class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-all
                      {{ session('lang') === 'zh' ? 'bg-primary text-white' : 'bg-slate-100 text-slate-500' }}">
                中文
            </a>
        </div>

    </div>

</nav>

<div class="h-16"></div>
