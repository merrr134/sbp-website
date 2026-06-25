@extends('layouts.public')

@section('title', 'Home — PT. Sumber Bumi Putera')

@section('content')

{{-- ===== HERO SECTION ===== --}}
<section class="relative h-screen max-h-[800px] min-h-[600px] overflow-hidden"
         x-data="heroSlider()" x-init="init()">

    {{-- Background Slides --}}
    @foreach($slides as $index => $slide)
    <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out"
        x-bind:style="current === {{ $index }}
            ? 'z-index: 2; opacity: 1; transition: opacity 1s ease-in-out'
            : 'z-index: 1; opacity: 0; transition: opacity 1s ease-in-out'">
        <img src="{{ $slide['img'] }}"
            alt="Mining"
            class="w-full h-full object-cover object-center">
        <div class="absolute inset-0 bg-gradient-to-r from-navy-deep/90 via-navy/60 to-transparent"></div>
    </div>
    @endforeach

    {{-- Content --}}
    <div class="absolute inset-0 z-10 flex items-center">
        <div class="max-w-[1280px] w-full mx-auto px-6">
            <div class="max-w-2xl">

                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full px-4 py-1.5 mb-6">
                    <span class="w-2 h-2 rounded-full bg-amber-brand animate-pulse"></span>
                    <span class="text-white/90 text-sm font-medium">{{ __('app.hero_badge') }}</span>
                </div>

                {{-- Titles --}}
<div class="relative h-[90px] sm:h-[120px] md:h-[140px] mb-2 md:mb-6">
    @foreach($slides as $index => $slide)
    <h1 class="absolute inset-0 text-2xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight transition-all duration-700 ease-in-out"
        x-bind:style="current === {{ $index }}
            ? 'opacity: 1; transform: translateY(0); pointer-events: auto'
            : 'opacity: 0; transform: translateY(16px); pointer-events: none'">
        {{ $slide['title'] }}
    </h1>
    @endforeach
</div>

{{-- Subtitles --}}
<div class="relative h-[80px] sm:h-[80px] mb-5 md:mb-10">
    @foreach($slides as $index => $slide)
    <p class="absolute inset-0 text-white/80 text-sm sm:text-lg leading-relaxed transition-all duration-700 ease-in-out"
       x-bind:style="current === {{ $index }}
           ? 'opacity: 1; transform: translateY(0)'
           : 'opacity: 0; transform: translateY(12px)'">
        {{ $slide['subtitle'] }}
    </p>
    @endforeach
</div>

                {{-- CTA Buttons --}}
                <div class="flex flex-wrap gap-4 mb-10">
                    <a href="{{ route('contact.index') }}"
                       class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white font-semibold px-7 py-3.5 rounded-lg transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5">
                        {{ $settings['hero_cta_primary'] }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a href="#"
                       class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/30 text-white font-semibold px-7 py-3.5 rounded-lg transition-all duration-200">
                        {{ $settings['hero_cta_secondary'] }}
                    </a>
                </div>

                {{-- Dots --}}
                <div class="flex items-center gap-2">
                    @foreach($slides as $index => $slide)
                    <button @click="goTo({{ $index }})"
                            class="transition-all duration-300 rounded-full bg-white"
                            x-bind:style="current === {{ $index }}
                                ? 'width: 2rem; height: 0.5rem; opacity: 1'
                                : 'width: 0.5rem; height: 0.5rem; opacity: 0.4'">
                    </button>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

</section>

{{-- ===== ABOUT SNIPPET SECTION ===== --}}
<section class="py-20 bg-white">
    <div class="max-w-[1280px] mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- Gambar kiri --}}
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800&q=80"
                     alt="Mining Worker"
                     class="w-full h-[420px] object-cover rounded-2xl shadow-card">

                <div class="absolute bottom-6 left-6 bg-primary rounded-xl px-5 py-4 shadow-modal"
                     x-data="{ count: 0 }"
                     x-init="
                         const observer = new IntersectionObserver((entries) => {
                             if (entries[0].isIntersecting) {
                                 let start = 0;
                                 const target = 25;
                                 const duration = 2000;
                                 const step = target / (duration / 16);
                                 const interval = setInterval(() => {
                                     start = Math.min(Math.round(start + step), target);
                                     count = start;
                                     if (start >= target) clearInterval(interval);
                                 }, 16);
                                 observer.disconnect();
                             }
                         }, { threshold: 0.5 });
                         observer.observe($el);
                     ">
                    <p class="text-3xl font-bold text-white">
                        <span x-text="count"></span>+
                    </p>
                    <p class="text-white/80 text-sm mt-0.5">Global Awards in<br>Environmental Safety</p>
                </div>
            </div>

            {{-- Teks kanan --}}
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-8 h-0.5 bg-primary"></div>
                    <span class="text-primary text-sm font-semibold uppercase tracking-wider">{{ __('app.about_label') }}</span>
                </div>

                <h2 class="text-3xl md:text-4xl font-bold text-navy leading-tight mb-6">
                    {{ $settings['about_home_title'] }}
                </h2>

                <p class="text-slate-600 leading-relaxed mb-8">
                    {{ $settings['about_home_content'] }}
                </p>

                <a href="{{ route('about.company') }}"
                   class="inline-flex items-center gap-2 text-primary font-semibold hover:gap-3 transition-all duration-200">
                    {{ __('app.about_link') }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ===== BERITA SECTION ===== --}}
<section class="py-20 bg-white">
    <div class="max-w-[1280px] mx-auto px-6">

        <div class="flex items-end justify-between mb-10">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <div class="w-8 h-0.5 bg-primary"></div>
                    <span class="text-primary text-sm font-semibold uppercase tracking-wider">{{ __('app.news_label') }}</span>
                </div>
                <h2 class="text-3xl font-bold text-navy">{{ __('app.news_title') }}</h2>
            </div>
            <a href="{{ route('news.index') }}" class="hidden md:inline-flex items-center gap-2 text-primary text-sm font-semibold hover:gap-3 transition-all">
                {{ __('app.news_view_all') }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        @if($latestNews->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($latestNews as $item)
            <article class="bg-white rounded-2xl overflow-hidden shadow-card border border-slate-100 hover:shadow-modal hover:-translate-y-1 transition-all duration-300 group">
                <div class="h-48 overflow-hidden">
                    @if($item->image)
                    <img src="{{ Storage::url($item->image) }}"
                         alt="{{ $item->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-primary/20 to-navy/30 flex items-center justify-center">
                        <svg class="w-12 h-12 text-primary/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9"/>
                        </svg>
                    </div>
                    @endif
                </div>
                <div class="p-6">
                    <p class="text-xs text-slate-400 mb-2">{{ $item->published_at?->format('d M Y') }}</p>
                    <h3 class="font-bold text-navy text-lg leading-snug mb-3 group-hover:text-primary transition-colors line-clamp-2">
                        {{ $item->title }}
                    </h3>
                    <p class="text-slate-500 text-sm leading-relaxed line-clamp-3">
                        {{ Str::limit(strip_tags($item->content), 100) }}
                    </p>
                    <a href="{{ route('news.show', $item->slug) }}"
                       class="inline-flex items-center gap-1 text-primary text-sm font-semibold mt-4 hover:gap-2 transition-all">
                        {{ __('app.news_read_more') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
        @else
        <div class="text-center py-16 text-slate-400">
            <svg class="w-12 h-12 mx-auto mb-3 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9"/>
            </svg>
            <p>{{ __('app.news_empty') }}</p>
        </div>
        @endif
    </div>
</section>

{{-- ===== FOTO DOKUMENTASI SECTION ===== --}}
<section class="py-20 bg-surface">
    <div class="max-w-[1280px] mx-auto px-6">

        <div class="flex items-end justify-between mb-10">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <div class="w-8 h-0.5 bg-primary"></div>
                    <span class="text-primary text-sm font-semibold uppercase tracking-wider">{{ __('app.gallery_label') }}</span>
                </div>
                <h2 class="text-3xl font-bold text-navy">{{ __('app.gallery_title') }}</h2>
            </div>
            <a href="{{ route('gallery.index') }}" class="hidden md:inline-flex items-center gap-2 text-primary text-sm font-semibold hover:gap-3 transition-all">
                {{ __('app.gallery_view_all') }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        @if($photos->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($photos as $photo)
            <div class="overflow-hidden rounded-xl aspect-video group">
                <img src="{{ Storage::url($photo->file_path) }}"
                     alt="Dokumentasi"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16 text-slate-400">
            <svg class="w-12 h-12 mx-auto mb-3 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p>{{ __('app.gallery_empty') }}</p>
        </div>
        @endif
    </div>
</section>

{{-- ===== CTA BANNER SECTION ===== --}}
<section class="py-24 bg-navy">
    <div class="max-w-[1280px] mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
            {{ __('app.cta_title') }}
        </h2>
        <p class="text-white/70 text-lg max-w-xl mx-auto mb-10">
            {{ __('app.cta_desc') }}
        </p>
        <a href="{{ route('contact.index') }}"
           class="inline-flex items-center gap-2 border-2 border-white/40 hover:border-white text-white font-semibold px-8 py-3.5 rounded-lg transition-all duration-200 hover:bg-white/10">
            {{ __('app.cta_button') }}
        </a>
    </div>
</section>

@endsection

@push('scripts')
<script>
    const heroSlides = @json($slides);
</script>

<script>
function heroSlider() {
    return {
        current: 0,
        total: {{ count($slides) }},
        timer: null,
        init() {
            this.startTimer();
        },
        startTimer() {
            clearInterval(this.timer);
            this.timer = setInterval(() => {
                this.current = (this.current + 1) % this.total;
            }, 5000);
        },
        goTo(index) {
            this.current = index;
            this.startTimer();
        }
    }
}

function counterAnimation() {
    return {
        count: 0,
        started: false,
        startCount() {
            if (this.started) return;
            this.started = true;
            const target = 25;
            const duration = 2000;
            const step = target / (duration / 16);
            const interval = setInterval(() => {
                this.count = Math.min(Math.round(this.count + step), target);
                if (this.count >= target) clearInterval(interval);
            }, 16);
        }
    }
}
</script>
@endpush
