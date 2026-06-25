@extends('layouts.public')

@section('title', $asset->name . ' — PT. Sumber Bumi Putera')

@section('content')

{{-- Page Header --}}
<div class="bg-navy py-16">
    <div class="max-w-[1280px] mx-auto px-6">
        <div class="flex items-center gap-2 text-white/50 text-sm mb-3">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">{{ __('app.breadcrumb_home') }}</a>
            <span>/</span>
            <a href="{{ route('about.assets') }}" class="hover:text-white transition-colors">{{ __('app.nav_about_assets') }}</a>
            <span>/</span>
            <span class="text-white">{{ $asset->name }}</span>
        </div>
        <h1 class="text-3xl md:text-4xl font-bold text-white">{{ $asset->name }}</h1>
        <p class="text-white/60 mt-2">Dokumentasi foto {{ $asset->name }} PT. Sumber Bumi Putera.</p>
    </div>
</div>

<div class="max-w-[1280px] mx-auto px-6 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

        {{-- Sidebar --}}
        <div class="space-y-6">

            {{-- Info Aset --}}
            <div class="bg-white rounded-2xl shadow-card border border-slate-100 overflow-hidden">
                <div class="bg-surface p-8 flex items-center justify-center">
                    <img src="{{ Storage::url($asset->thumbnail) }}"
                         alt="{{ $asset->name }}"
                         class="h-32 object-contain">
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-navy text-lg uppercase">{{ $asset->name }}</h3>
                    @if($asset->description)
                    <p class="text-slate-500 text-sm mt-2 leading-relaxed">{{ $asset->description }}</p>
                    @endif
                    <div class="mt-3">
                        <span class="text-xs bg-primary/10 text-primary px-3 py-1 rounded-full font-semibold">
                            {{ $asset->photos->count() }} {{ __('app.asset_photos') }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Aset Lainnya --}}
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">{{ __('app.asset_other') }}</p>
                <div class="space-y-2">
                    @foreach($assets as $other)
                    <a href="{{ route('about.assets.show', $other->slug) }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all
                              {{ $other->id === $asset->id
                                  ? 'bg-primary text-white'
                                  : 'text-slate-500 hover:bg-surface hover:text-navy' }}">
                        <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center flex-shrink-0 border border-slate-100">
                            <img src="{{ Storage::url($other->thumbnail) }}"
                                 alt="{{ $other->name }}"
                                 class="w-8 h-8 object-contain">
                        </div>
                        <span class="text-sm font-medium">{{ $other->name }}</span>
                    </a>
                    @endforeach
                </div>
            </div>

        </div>

        {{-- Foto Grid dengan Lightbox --}}
        <div class="lg:col-span-2" x-data="lightbox()">

            <div class="flex items-center gap-2 mb-3">
                <div class="w-8 h-0.5 bg-primary"></div>
                <span class="text-primary text-sm font-semibold uppercase tracking-wider">{{ __('app.asset_doc') }}</span>
            </div>

            <h2 class="text-2xl font-bold text-navy mb-6">
                Foto {{ $asset->name }}
                <span class="text-sm font-normal text-slate-400 ml-2">({{ $asset->photos->count() }} foto)</span>
            </h2>

            @if($asset->photos->count() > 0)

            <div class="columns-2 md:columns-3 gap-3 space-y-3">
                @foreach($asset->photos as $index => $photo)
                <div class="break-inside-avoid overflow-hidden rounded-xl group cursor-pointer"
                     @click="open({{ $index }})">
                    <img src="{{ Storage::url($photo->file_path) }}"
                         alt="{{ $asset->name }}"
                         class="w-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                @endforeach
            </div>

            {{-- Lightbox --}}
            <div x-show="isOpen"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-50 bg-black/90 flex items-center justify-center"
                 @click.self="isOpen = false"
                 @keydown.escape.window="isOpen = false"
                 @keydown.arrow-left.window="prev()"
                 @keydown.arrow-right.window="next()"
                 style="display:none">

                <button @click="isOpen = false"
                        class="absolute top-4 right-4 w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white transition-colors z-10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                <div class="absolute top-4 left-1/2 -translate-x-1/2 bg-black/50 text-white text-sm px-4 py-1.5 rounded-full z-10">
                    <span x-text="currentIndex + 1"></span> / <span x-text="photos.length"></span>
                </div>

                <button @click="prev()"
                        class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/10 hover:bg-white/25 rounded-full flex items-center justify-center text-white transition-colors z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                <img :src="photos[currentIndex]"
                     class="max-w-[85vw] max-h-[85vh] object-contain rounded-xl shadow-2xl select-none">

                <button @click="next()"
                        class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/10 hover:bg-white/25 rounded-full flex items-center justify-center text-white transition-colors z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center gap-2 z-10 max-w-[80vw] overflow-x-auto">
                    <template x-for="(photo, index) in photos" :key="index">
                        <button @click="currentIndex = index"
                                class="w-12 h-12 rounded-lg overflow-hidden border-2 transition-all duration-200 flex-shrink-0"
                                :class="currentIndex === index ? 'border-white opacity-100' : 'border-transparent opacity-50 hover:opacity-75'">
                            <img :src="photo" class="w-full h-full object-cover">
                        </button>
                    </template>
                </div>

            </div>

            @else
            <div class="text-center py-16 bg-surface rounded-2xl">
                <svg class="w-12 h-12 mx-auto text-slate-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-slate-400 text-sm">{{ __('app.asset_empty') }}</p>
            </div>
            @endif

            {{-- Kembali --}}
            <div class="mt-8">
                <a href="{{ route('about.assets') }}"
                class="inline-flex items-center gap-2 text-primary text-sm font-semibold hover:gap-3 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    {{ __('app.asset_back') }}
                </a>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function lightbox() {
    return {
        isOpen: false,
        currentIndex: 0,
        photos: @json($asset->photos->map(fn($p) => Storage::url($p->file_path))->values()),
        open(index) {
            this.currentIndex = index;
            this.isOpen = true;
            document.body.style.overflow = 'hidden';
        },
        prev() {
            this.currentIndex = this.currentIndex === 0
                ? this.photos.length - 1
                : this.currentIndex - 1;
        },
        next() {
            this.currentIndex = this.currentIndex === this.photos.length - 1
                ? 0
                : this.currentIndex + 1;
        }
    }
}
</script>
@endpush
