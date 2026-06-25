@extends('layouts.public')

@section('title', $news->title . ' — PT. Sumber Bumi Putera')

@section('content')

{{-- Page Header --}}
<div class="bg-navy py-16">
    <div class="max-w-[1280px] mx-auto px-6">
        <div class="flex items-center gap-2 text-white/50 text-sm mb-3">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">{{ __('app.breadcrumb_home') }}</a>
            <span>/</span>
            <a href="{{ route('news.index') }}" class="hover:text-white transition-colors">{{ __('app.nav_news') }}</a>
            <span>/</span>
            <span class="text-white truncate max-w-[200px]">{{ $news->title }}</span>
        </div>
        <h1 class="text-3xl md:text-4xl font-bold text-white leading-tight max-w-3xl">
            {{ $news->title }}
        </h1>
        <p class="text-white/50 text-sm mt-3">
            {{ $news->published_at?->format('d M Y') }}
        </p>
    </div>
</div>

{{-- Content --}}
<div class="max-w-[1280px] mx-auto px-6 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

        {{-- Artikel --}}
        <div class="lg:col-span-2">

            {{-- Foto --}}
            @if($news->image)
            <div class="mb-8 rounded-2xl overflow-hidden">
                <img src="{{ Storage::url($news->image) }}"
                     alt="{{ $news->title }}"
                     class="w-full h-[400px] object-cover">
            </div>
            @endif

            {{-- Isi Konten --}}
            <div class="prose prose-slate max-w-none">
                {!! nl2br(e($news->content)) !!}
            </div>

            {{-- Navigasi Prev / Next --}}
            <div class="mt-12 pt-8 border-t border-slate-100 grid grid-cols-2 gap-4">
                @if($prev)
                <a href="{{ route('news.show', $prev->slug) }}"
                   class="group flex flex-col gap-1 p-4 rounded-xl border border-slate-100 hover:border-primary/30 hover:shadow-card transition-all">
                    <span class="text-xs text-slate-400 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        {{ __('app.news_prev_art') }}
                    </span>
                    <span class="text-sm font-semibold text-navy group-hover:text-primary transition-colors line-clamp-2">
                        {{ $prev->title }}
                    </span>
                </a>
                @else
                <div></div>
                @endif

                @if($next)
                <a href="{{ route('news.show', $next->slug) }}"
                   class="group flex flex-col gap-1 p-4 rounded-xl border border-slate-100 hover:border-primary/30 hover:shadow-card transition-all text-right">
                    <span class="text-xs text-slate-400 flex items-center gap-1 justify-end">
                        {{ __('app.news_next_art') }}
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </span>
                    <span class="text-sm font-semibold text-navy group-hover:text-primary transition-colors line-clamp-2">
                        {{ $next->title }}
                    </span>
                </a>
                @endif
            </div>

        </div>

        {{-- Sidebar --}}
        <div class="space-y-6">

            {{-- Kembali ke berita --}}
            <a href="{{ route('news.index') }}"
            class="flex items-center gap-2 text-primary text-sm font-semibold hover:gap-3 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                {{ __('app.news_view_all') }}
            </a>

            {{-- Berita Lainnya --}}
            @php
                $otherNews = \App\Models\News::published()
                    ->where('id', '!=', $news->id)
                    ->take(4)
                    ->get();
            @endphp

            @if($otherNews->count() > 0)
            <div class="bg-white rounded-2xl shadow-card border border-slate-100 p-5">
                <h3 class="font-bold text-navy text-sm mb-4 uppercase tracking-wide">{{ __('app.news_others') }}</h3>
                <div class="space-y-4">
                    @foreach($otherNews as $other)
                    <a href="{{ route('news.show', $other->slug) }}"
                       class="flex gap-3 group">
                        <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0">
                            @if($other->image)
                            <img src="{{ Storage::url($other->image) }}"
                                 alt="{{ $other->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                            <div class="w-full h-full bg-surface flex items-center justify-center">
                                <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"/>
                                </svg>
                            </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-slate-400 mb-1">{{ $other->published_at?->format('d M Y') }}</p>
                            <p class="text-sm font-semibold text-navy group-hover:text-primary transition-colors line-clamp-2 leading-snug">
                                {{ $other->title }}
                            </p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
</div>

@endsection
