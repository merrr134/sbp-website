@extends('layouts.public')

@section('title', 'Tentang Perusahaan — PT. Sumber Bumi Putera')

@section('content')

{{-- Page Header --}}
<div class="bg-navy py-16">
    <div class="max-w-[1280px] mx-auto px-6">
        <div class="flex items-center gap-2 text-white/50 text-sm mb-3">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">{{ __('app.breadcrumb_home') }}</a>
            <span>/</span>
            <span class="text-white">{{ __('app.nav_about') }}</span>
            <span>/</span>
            <span class="text-white">{{ __('app.nav_about_company') }}</span>
        </div>
        <h1 class="text-3xl md:text-4xl font-bold text-white">Tentang Perusahaan</h1>
        <p class="text-white/60 mt-2">Mengenal lebih dekat PT. Sumber Bumi Putera.</p>
    </div>
</div>

<div class="max-w-[1280px] mx-auto px-6 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

        {{-- Sidebar Navigasi --}}
        <div class="space-y-2">
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4">Tentang Kami</p>

            @php
                $aboutNav = [
                    ['route' => 'about.company',        'label' => __('app.nav_about_company')],
                    ['route' => 'about.vision-mission', 'label' => __('app.nav_about_vision')],
                    ['route' => 'about.history',        'label' => __('app.nav_about_history')],
                    ['route' => 'about.assets',         'label' => __('app.nav_about_assets')],
                ];
            @endphp

            @foreach($aboutNav as $nav)
            <a href="{{ route($nav['route']) }}"
               class="flex items-center justify-between px-4 py-3 rounded-xl text-sm font-medium transition-all
                      {{ request()->routeIs($nav['route'])
                          ? 'bg-primary text-white shadow-sm'
                          : 'text-slate-500 hover:bg-surface hover:text-navy' }}">
                {{ $nav['label'] }}
                @if(request()->routeIs($nav['route']))
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                @endif
            </a>
            @endforeach
        </div>

        {{-- Konten --}}
        <div class="lg:col-span-2 space-y-8">

            {{-- Gambar --}}
            @if($about->image)
            <div class="rounded-2xl overflow-hidden">
                <img src="{{ Storage::url($about->image) }}"
                     alt="{{ $about->title }}"
                     class="w-full h-[350px] object-cover">
            </div>
            @else
            <div class="rounded-2xl overflow-hidden bg-gradient-to-br from-primary/20 to-navy/30 h-[350px] flex items-center justify-center">
                <svg class="w-20 h-20 text-primary/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            @endif

            {{-- Label --}}
            <div class="flex items-center gap-2">
                <div class="w-8 h-0.5 bg-primary"></div>
                <span class="text-primary text-sm font-semibold uppercase tracking-wider">{{ __('app.about_company_label') }}</span>
            </div>

            {{-- Judul --}}
            <h2 class="text-3xl font-bold text-navy leading-tight">
                {{ $about->title }}
            </h2>

            {{-- Konten --}}
            <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed">
                {!! nl2br(e($about->content)) !!}
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-3 gap-6 py-8 border-t border-b border-slate-100">
                @foreach($stats as $stat)
                <div class="text-center">
                    <p class="text-3xl font-bold text-navy">{{ $stat['value'] }}</p>
                    <p class="text-slate-400 text-sm mt-1">{{ $stat['label'] }}</p>
                </div>
                @endforeach
            </div>

            {{-- Navigasi Halaman --}}
            <div class="flex justify-end">
                <a href="{{ route('about.vision-mission') }}"
                class="inline-flex items-center gap-2 bg-primary text-white text-sm font-semibold px-6 py-3 rounded-xl hover:bg-primary-dark transition-all">
                    {{ __('app.nav_about_vision') }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

        </div>
    </div>
</div>

@endsection
