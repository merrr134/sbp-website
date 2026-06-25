@extends('layouts.public')

@section('title', 'Visi & Misi — PT. Sumber Bumi Putera')

@section('content')

{{-- Page Header --}}
<div class="bg-navy py-16">
    <div class="max-w-[1280px] mx-auto px-6">
        <div class="flex items-center gap-2 text-white/50 text-sm mb-3">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">{{ __('app.breadcrumb_home') }}</a>
            <span>/</span>
            <span class="text-white">{{ __('app.nav_about') }}</span>
            <span>/</span>
            <span class="text-white">{{ __('app.nav_about_vision') }}</span>
        </div>
        <h1 class="text-3xl md:text-4xl font-bold text-white">Visi & Misi</h1>
        <p class="text-white/60 mt-2">Arah dan tujuan PT. Sumber Bumi Putera.</p>
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
        <div class="lg:col-span-2 space-y-8">

            <div class="flex items-center gap-2">
                <div class="w-8 h-0.5 bg-primary"></div>
                <span class="text-primary text-sm font-semibold uppercase tracking-wider">{{ __('app.about_vision_label') }}</span>
            </div>

            <h2 class="text-3xl font-bold text-navy">{{ $about->title }}</h2>

            {{-- Visi Card --}}
            <div class="bg-white rounded-2xl p-8 shadow-card border border-slate-100">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-navy">{{ __('app.vision_title') }}</h3>
                </div>
                <p class="text-slate-600 leading-relaxed">
                    {{ \App\Models\SiteSetting::get('company_vision', $about->content) }}
                </p>
            </div>

{{-- Misi Card --}}
<div class="bg-white rounded-2xl p-8 shadow-card border border-slate-100">
    <div class="flex items-center gap-3 mb-4">
        <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-navy">{{ __('app.mission_title') }}</h3>
    </div>
    @php
        $missions = array_filter([
            \App\Models\SiteSetting::get('company_mission_1'),
            \App\Models\SiteSetting::get('company_mission_2'),
            \App\Models\SiteSetting::get('company_mission_3'),
        ]);
    @endphp
    <ul class="space-y-3">
        @foreach($missions as $mission)
        <li class="flex items-start gap-3 text-slate-600 text-sm">
            <svg class="w-5 h-5 text-primary mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ $mission }}
        </li>
        @endforeach
    </ul>
</div>

            {{-- Nilai Perusahaan --}}
            <div>
                <h3 class="text-xl font-bold text-navy mb-5">{{ __('app.values_title') }}</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @php
                        $values = [
                            ['icon' => '⚖️', 'title' => __('app.value_1_title'), 'desc' => __('app.value_1_desc')],
                            ['icon' => '💡', 'title' => __('app.value_2_title'), 'desc' => __('app.value_2_desc')],
                            ['icon' => '🛡️', 'title' => __('app.value_3_title'), 'desc' => __('app.value_3_desc')],
                            ['icon' => '🌱', 'title' => __('app.value_4_title'), 'desc' => __('app.value_4_desc')],
                        ];
                    @endphp
                    @foreach($values as $value)
                    <div class="flex items-start gap-4 p-4 bg-surface rounded-xl border border-slate-100">
                        <span class="text-2xl">{{ $value['icon'] }}</span>
                        <div>
                            <p class="font-semibold text-navy text-sm">{{ $value['title'] }}</p>
                            <p class="text-slate-500 text-xs mt-1 leading-relaxed">{{ $value['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Navigasi --}}
            <div class="flex justify-between pt-4">
                <a href="{{ route('about.company') }}"
                class="inline-flex items-center gap-2 text-slate-400 text-sm font-semibold hover:text-navy transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    {{ __('app.nav_about_company') }}
                </a>
                <a href="{{ route('about.history') }}"
                class="inline-flex items-center gap-2 bg-primary text-white text-sm font-semibold px-6 py-3 rounded-xl hover:bg-primary-dark transition-all">
                    {{ __('app.nav_about_history') }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

        </div>
    </div>
</div>

@endsection
