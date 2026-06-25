@extends('layouts.public')

@section('title', 'Berita — PT. Sumber Bumi Putera')

@section('content')

{{-- Page Header --}}
<div class="bg-navy py-16">
    <div class="max-w-[1280px] mx-auto px-6">
        <div class="flex items-center gap-2 text-white/50 text-sm mb-3">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">{{ __('app.breadcrumb_home') }}</a>
            <span>/</span>
            <span class="text-white">{{ __('app.nav_news') }}</span>
        </div>
        <h1 class="text-3xl md:text-4xl font-bold text-white">{{ __('app.nav_news') }}</h1>
        <p class="text-white/60 mt-2">{{ __('app.news_header_desc') }}</p>
    </div>
</div>

{{-- Content --}}
<div class="max-w-[1280px] mx-auto px-6 py-16">

    @if($news->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($news as $item)
        <article class="bg-white rounded-2xl overflow-hidden shadow-card border border-slate-100
                        hover:shadow-modal hover:-translate-y-1 transition-all duration-300 group">

            <div class="h-48 overflow-hidden">
                @if($item->image)
                <img src="{{ Storage::url($item->image) }}"
                     alt="{{ $item->title }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                <div class="w-full h-full bg-gradient-to-br from-primary/20 to-navy/30 flex items-center justify-center">
                    <svg class="w-12 h-12 text-primary/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9"/>
                    </svg>
                </div>
                @endif
            </div>

            <div class="p-6">
                <p class="text-xs text-slate-400 mb-2">{{ $item->published_at?->format('d M Y') }}</p>
                <h2 class="text-lg font-bold text-navy mb-3 group-hover:text-primary transition-colors leading-snug line-clamp-2">
                    {{ $item->title }}
                </h2>
                <p class="text-slate-500 text-sm leading-relaxed line-clamp-3">
                    {{ Str::limit(strip_tags($item->content), 120) }}
                </p>
                <a href="{{ route('news.show', $item->slug) }}"
                   class="inline-flex items-center gap-2 text-primary text-sm font-semibold mt-4 hover:gap-3 transition-all duration-200">
                    {{ __('app.news_read_more') }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

        </article>
        @endforeach
    </div>

    {{-- Pagination --}}
    @if($news->hasPages())
    <div class="mt-10 flex flex-col md:flex-row items-center justify-between gap-4">
        <p class="text-sm text-slate-400">
            {{ __('app.news_showing') }}
            <span class="font-semibold text-navy">{{ $news->firstItem() }}</span>
            –
            <span class="font-semibold text-navy">{{ $news->lastItem() }}</span>
            {{ __('app.news_of') }}
            <span class="font-semibold text-navy">{{ $news->total() }}</span>
        </p>

        <div class="flex items-center gap-2">
            @if($news->onFirstPage())
            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold text-slate-300 bg-slate-50 cursor-not-allowed">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                {{ __('app.news_prev') }}
            </span>
            @else
            <a href="{{ $news->previousPageUrl() }}"
               class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold text-slate-600 bg-white border border-slate-200 hover:border-primary hover:text-primary transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                {{ __('app.news_prev') }}
            </a>
            @endif

            @foreach($news->getUrlRange(1, $news->lastPage()) as $page => $url)
            @if($page == $news->currentPage())
            <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-sm font-bold bg-primary text-white shadow-sm">{{ $page }}</span>
            @else
            <a href="{{ $url }}" class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-sm font-semibold text-slate-500 bg-white border border-slate-200 hover:border-primary hover:text-primary transition-all">{{ $page }}</a>
            @endif
            @endforeach

            @if($news->hasMorePages())
            <a href="{{ $news->nextPageUrl() }}"
               class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold text-slate-600 bg-white border border-slate-200 hover:border-primary hover:text-primary transition-all">
                {{ __('app.news_next') }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
            @else
            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold text-slate-300 bg-slate-50 cursor-not-allowed">
                {{ __('app.news_next') }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </span>
            @endif
        </div>
    </div>
    @endif

    @else
    <div class="text-center py-24">
        <svg class="w-16 h-16 mx-auto text-slate-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9"/>
        </svg>
        <p class="text-slate-400">{{ __('app.news_empty_list') }}</p>
    </div>
    @endif

</div>

@endsection
