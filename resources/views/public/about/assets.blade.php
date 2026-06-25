@extends('layouts.public')

@section('title', 'Aset Perusahaan — PT. Sumber Bumi Putera')

@section('content')

{{-- Page Header --}}
<div class="bg-navy py-16">
    <div class="max-w-[1280px] mx-auto px-6">
        <div class="flex items-center gap-2 text-white/50 text-sm mb-3">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">{{ __('app.breadcrumb_home') }}</a>
            <span>/</span>
            <span class="text-white">{{ __('app.nav_about') }}</span>
            <span>/</span>
            <span class="text-white">{{ __('app.nav_about_assets') }}</span>
        </div>
        <h1 class="text-3xl md:text-4xl font-bold text-white">Aset Perusahaan</h1>
        <p class="text-white/60 mt-2">Portofolio alat berat dan kendaraan operasional PT. Sumber Bumi Putera.</p>
    </div>
</div>

<div class="max-w-[1280px] mx-auto px-6 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

        {{-- Sidebar --}}
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
        <div class="lg:col-span-2">

            <div class="flex items-center gap-2 mb-4">
                <div class="w-8 h-0.5 bg-primary"></div>
                <span class="text-primary text-sm font-semibold uppercase tracking-wider">{{ __('app.about_assets_label') }}</span>
            </div>

            <h2 class="text-3xl font-bold text-navy mb-3">Aset Perusahaan PT. Sumber Bumi Putera</h2>
            <p class="text-slate-500 text-sm leading-relaxed mb-10">
                Saat ini PT. Sumber Bumi Putera memiliki alat-alat berat diantaranya Excavator, Fuel Truck,
                Greader, Ambulance, Water Truck, Dump Truck, Light Vehicle, Vibro, dan Motor Trail.
                Klik salah satu untuk melihat dokumentasi foto lengkapnya.
            </p>

            @if($assets->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($assets as $asset)
                <a href="{{ route('about.assets.show', $asset->slug) }}"
                   class="group bg-white rounded-2xl border border-slate-100 shadow-card hover:shadow-modal hover:border-primary/30 hover:-translate-y-1 transition-all duration-300 overflow-hidden">

                    <div class="h-36 bg-surface flex items-center justify-center p-4 overflow-hidden">
                        <img src="{{ Storage::url($asset->thumbnail) }}"
                             alt="{{ $asset->name }}"
                             class="h-full object-contain group-hover:scale-110 transition-transform duration-500">
                    </div>

                    <div class="px-4 py-3 border-t border-slate-100">
                        <p class="text-sm font-bold text-navy text-center uppercase tracking-wide group-hover:text-primary transition-colors">
                            {{ $asset->name }}
                        </p>
                        @if($asset->description)
                        <p class="text-xs text-slate-400 text-center mt-1 line-clamp-1">{{ $asset->description }}</p>
                        @endif
                    </div>

                </a>
                @endforeach
            </div>

            @else
            <div class="text-center py-16 bg-surface rounded-2xl">
                <svg class="w-16 h-16 mx-auto text-slate-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/>
                </svg>
                <p class="text-slate-400">Belum ada data aset.</p>
            </div>
            @endif

        </div>
    </div>
</div>

@endsection
