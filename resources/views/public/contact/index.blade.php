@extends('layouts.public')

@section('title', 'Kontak — PT. Sumber Bumi Putera')

@section('content')

{{-- Page Header --}}
<div class="bg-navy py-16">
    <div class="max-w-[1280px] mx-auto px-6">
        <div class="flex items-center gap-2 text-white/50 text-sm mb-3">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">{{ __('app.breadcrumb_home') }}</a>
            <span>/</span>
            <span class="text-white">{{ __('app.nav_contact') }}</span>
        </div>
        <h1 class="text-3xl md:text-4xl font-bold text-white">{{ __('app.contact_title') }}</h1>
        <p class="text-white/60 mt-2">{{ __('app.contact_desc') }}</p>
    </div>
</div>

{{-- Content --}}
<div class="max-w-[1280px] mx-auto px-6 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

        {{-- Info Kontak --}}
        <div class="space-y-6">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <div class="w-8 h-0.5 bg-primary"></div>
                    <span class="text-primary text-sm font-semibold uppercase tracking-wider">Get In Touch</span>
                </div>
                <h2 class="text-2xl font-bold text-navy">{{ __('app.contact_title') }}</h2>
                <p class="text-slate-500 text-sm mt-2 leading-relaxed">{{ __('app.contact_desc') }}</p>
            </div>

            @php
                $contacts = [
                    [
                        'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>',
                        'label' => __('app.contact_address'),
                        'value' => $address,
                        'color' => 'bg-primary/10 text-primary',
                    ],
                    [
                        'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>',
                        'label' => __('app.contact_phone'),
                        'value' => $phone,
                        'color' => 'bg-green-100 text-green-600',
                    ],
                    [
                        'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
                        'label' => __('app.contact_email'),
                        'value' => $email,
                        'color' => 'bg-blue-100 text-blue-600',
                    ],
                    [
                        'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                        'label' => __('app.contact_hours'),
                        'value' => $hours,
                        'color' => 'bg-amber-100 text-amber-600',
                    ],
                ];
            @endphp

            @foreach($contacts as $contact)
            <div class="flex items-start gap-4 p-4 bg-white rounded-2xl shadow-card border border-slate-100">
                <div class="w-10 h-10 rounded-xl {{ $contact['color'] }} flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $contact['icon'] !!}
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1">{{ $contact['label'] }}</p>
                    <p class="text-sm font-medium text-navy leading-relaxed">{{ $contact['value'] }}</p>
                </div>
            </div>
            @endforeach

        </div>

        {{-- Form Kontak --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-card border border-slate-100 overflow-hidden">

                <div class="px-8 py-6 border-b border-slate-100">
                    <h3 class="font-bold text-navy text-lg">{{ __('app.contact_title') }}</h3>
                    <p class="text-slate-400 text-sm mt-1">{{ __('app.contact_desc') }}</p>
                </div>

                @if(session('success'))
                <div class="mx-8 mt-6 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl"
                     x-data="{ show: true }" x-show="show">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <p class="text-sm font-medium">{{ __('app.contact_success') }}</p>
                    <button @click="show = false" class="ml-auto text-green-500 hover:text-green-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}" class="p-8 space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-navy mb-1.5">
                                {{ __('app.contact_name') }} <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy placeholder-slate-300
                                          focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all
                                          @error('name') border-red-400 bg-red-50 @enderror">
                            @error('name')
                            <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-navy mb-1.5">
                                {{ __('app.contact_email') }} <span class="text-red-400">*</span>
                            </label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy placeholder-slate-300
                                          focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all
                                          @error('email') border-red-400 bg-red-50 @enderror">
                            @error('email')
                            <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-navy mb-1.5">{{ __('app.contact_phone_field') }}</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy placeholder-slate-300
                                      focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-navy mb-1.5">
                            {{ __('app.contact_message') }} <span class="text-red-400">*</span>
                        </label>
                        <textarea name="message" rows="6"
                                  class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy placeholder-slate-300
                                         focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all resize-none
                                         @error('message') border-red-400 bg-red-50 @enderror">{{ old('message') }}</textarea>
                        @error('message')
                        <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <p class="text-xs text-slate-400">
                            <span class="text-red-400">*</span> {{ __('app.contact_required') }}
                        </p>
                        <button type="submit"
                                class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white font-semibold px-8 py-3 rounded-xl transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                            </svg>
                            {{ __('app.contact_send') }}
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>

    {{-- Google Maps --}}
    <div class="mt-12">
        <div class="flex items-center gap-2 mb-6">
            <div class="w-8 h-0.5 bg-primary"></div>
            <span class="text-primary text-sm font-semibold uppercase tracking-wider">{{ __('app.contact_location') }}</span>
        </div>

        <div class="bg-white rounded-2xl shadow-card border border-slate-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-navy">Kantor PT. Sumber Bumi Putera</p>
                    <p class="text-xs text-slate-400">{{ $address }}</p>
                </div>
            </div>

            <div class="relative w-full h-[450px]">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.8!2d106.7952603!3d-6.2006642!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f703a8b21b4f%3A0x6190051c939344fb!2sPT.%20Sumber%20Bumi%20Putera!5e0!3m2!1sid!2sid!4v1718000000000!5m2!1sid!2sid"
                    width="100%"
                    height="100%"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    class="absolute inset-0">
                </iframe>
            </div>

            <div class="px-6 py-4 border-t border-slate-100 flex flex-wrap items-center gap-6">
                <div class="flex items-center gap-2 text-sm text-slate-500">
                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    {{ $phone }}
                </div>
                <div class="flex items-center gap-2 text-sm text-slate-500">
                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    {{ $email }}
                </div>
                <div class="flex items-center gap-2 text-sm text-slate-500">
                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $hours }}
                </div>
                <a href="https://maps.app.goo.gl/frcroWkV9y4gxAiA9"
                   target="_blank"
                   class="ml-auto inline-flex items-center gap-2 bg-primary text-white text-sm font-semibold px-5 py-2 rounded-xl hover:bg-primary-dark transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    {{ __('app.contact_open_maps') }}
                </a>
            </div>
        </div>
    </div>

</div>

@endsection
