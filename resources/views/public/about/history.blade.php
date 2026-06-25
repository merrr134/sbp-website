@extends('layouts.public')

@section('title', 'Sejarah — PT. Sumber Bumi Putera')

@section('content')

{{-- Page Header --}}
<div class="bg-navy py-16">
    <div class="max-w-[1280px] mx-auto px-6">
        <div class="flex items-center gap-2 text-white/50 text-sm mb-3">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">{{ __('app.breadcrumb_home') }}</a>
            <span>/</span>
            <span class="text-white">{{ __('app.nav_about') }}</span>
            <span>/</span>
            <span class="text-white">{{ __('app.nav_about_history') }}</span>
        </div>
        <h1 class="text-3xl md:text-4xl font-bold text-white">Sejarah Singkat</h1>
        <p class="text-white/60 mt-2">Perjalanan PT. Sumber Bumi Putera dari masa ke masa.</p>
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
                <span class="text-primary text-sm font-semibold uppercase tracking-wider">{{ __('app.about_history_label') }}</span>
            </div>

            <h2 class="text-3xl font-bold text-navy">{{ $about->title }}</h2>

            <p class="text-slate-600 leading-relaxed">
                {!! nl2br(e($about->content)) !!}
            </p>

            {{-- Timeline --}}
            <div class="space-y-0">
                @php
                    $timeline = [];
                    foreach ([1,2,3,4] as $n) {
                        $year  = \App\Models\SiteSetting::get("timeline_{$n}_year");
                        $title = \App\Models\SiteSetting::get("timeline_{$n}_title");
                        $desc  = \App\Models\SiteSetting::get("timeline_{$n}_desc");
                        if ($year && $title) {
                            $timeline[] = [
                                'year'  => $year,
                                'title' => $title,
                                'desc'  => $desc,
                                'color' => $n === 4 ? 'bg-green-500' : ($n === 3 ? 'bg-amber-brand' : 'bg-primary'),
                            ];
                        }
                    }
                @endphp

                @foreach($timeline as $index => $item)
                <div class="flex gap-6">
                    <div class="flex flex-col items-center">
                        <div class="w-12 h-12 rounded-full {{ $item['color'] }} flex items-center justify-center flex-shrink-0 shadow-md">
                            <span class="text-white text-xs font-bold">{{ $item['year'] }}</span>
                        </div>
                        @if(!$loop->last)
                        <div class="w-0.5 h-full bg-slate-200 my-2 min-h-[40px]"></div>
                        @endif
                    </div>
                    <div class="pb-8 pt-2">
                        <h4 class="font-bold text-navy text-lg mb-2">{{ $item['title'] }}</h4>
                        <p class="text-slate-500 text-sm leading-relaxed">{{ $item['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Navigasi --}}
            <div class="flex justify-between pt-4 border-t border-slate-100">
                <a href="{{ route('about.vision-mission') }}"
                class="inline-flex items-center gap-2 text-slate-400 text-sm font-semibold hover:text-navy transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    {{ __('app.nav_about_vision') }}
                </a>
                <a href="{{ route('about.assets') }}"
                class="inline-flex items-center gap-2 bg-primary text-white text-sm font-semibold px-6 py-3 rounded-xl hover:bg-primary-dark transition-all">
                    {{ __('app.nav_about_assets') }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

        </div>
    </div>
</div>

@endsection
