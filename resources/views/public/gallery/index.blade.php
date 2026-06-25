@extends('layouts.public')

@section('title', 'Galeri — PT. Sumber Bumi Putera')

@section('content')

{{-- Page Header --}}
<div class="bg-navy py-16">
    <div class="max-w-[1280px] mx-auto px-6">
        <div class="flex items-center gap-2 text-white/50 text-sm mb-3">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">{{ __('app.breadcrumb_home') }}</a>
            <span>/</span>
            <span class="text-white">{{ __('app.nav_gallery') }}</span>
        </div>
        <h1 class="text-3xl md:text-4xl font-bold text-white">{{ __('app.nav_gallery') }}</h1>
        <p class="text-white/60 mt-2">{{ __('app.gallery_header_desc') }}</p>
    </div>
</div>

{{-- Content --}}
<div class="max-w-[1280px] mx-auto px-6 py-16">

    @if($photos->count() > 0)

    {{-- Info --}}
    <div class="flex items-center justify-between mb-8">
        <p class="text-sm text-slate-400">
            {{ __('app.gallery_showing') }}
            <span class="font-semibold text-navy">{{ $photos->firstItem() }}</span>
            –
            <span class="font-semibold text-navy">{{ $photos->lastItem() }}</span>
            {{ __('app.gallery_of') }}
            <span class="font-semibold text-navy">{{ $photos->total() }}</span>
            {{ __('app.gallery_photos') }}
        </p>
    </div>

    {{-- Grid --}}
    <div x-data="lightbox()" class="columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4">

        @foreach($photos as $index => $photo)
        <div class="break-inside-avoid overflow-hidden rounded-2xl group cursor-pointer"
             @click="open({{ $index }})">
            <img src="{{ Storage::url($photo->file_path) }}"
                 alt="Dokumentasi"
                 class="w-full object-cover group-hover:scale-105 transition-transform duration-500">
        </div>
        @endforeach

        {{-- Lightbox Overlay --}}
        <div x-show="isOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 bg-black/90 flex items-center justify-center"
            @click.self="close()"
            @keydown.escape.window="close()"
            @keydown.arrow-left.window="prev()"
            @keydown.arrow-right.window="next()"
            style="display:none">

            {{-- Close --}}
            <button @click="close()"
        class="absolute top-4 right-4 w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white transition-colors z-10">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            {{-- Counter --}}
            <div class="absolute top-4 left-1/2 -translate-x-1/2 bg-black/50 text-white text-sm px-4 py-1.5 rounded-full z-10">
                <span x-text="currentIndex + 1"></span> / <span x-text="photos.length"></span>
            </div>

            {{-- Prev Button --}}
            <button @click="prev()"
                    class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/10 hover:bg-white/25 rounded-full flex items-center justify-center text-white transition-colors z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>

            {{-- Gambar --}}
            <img :src="photos[currentIndex]"
                 class="max-w-[85vw] max-h-[85vh] object-contain rounded-xl shadow-2xl select-none"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100">

            {{-- Next Button --}}
            <button @click="next()"
                    class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/10 hover:bg-white/25 rounded-full flex items-center justify-center text-white transition-colors z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            {{-- Thumbnail Strip --}}
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center gap-2 z-10">
                <template x-for="(photo, index) in photos" :key="index">
                    <button @click="currentIndex = index"
                            class="w-12 h-12 rounded-lg overflow-hidden border-2 transition-all duration-200 flex-shrink-0"
                            :class="currentIndex === index ? 'border-white opacity-100' : 'border-transparent opacity-50 hover:opacity-75'">
                        <img :src="photo" class="w-full h-full object-cover">
                    </button>
                </template>
            </div>

        </div>
    </div>

    {{-- Pagination --}}
    @if($photos->hasPages())
    <div class="mt-10 flex flex-col md:flex-row items-center justify-between gap-4">
        <p class="text-sm text-slate-400">
            Menampilkan
            <span class="font-semibold text-navy">{{ $photos->firstItem() }}</span>
            –
            <span class="font-semibold text-navy">{{ $photos->lastItem() }}</span>
            dari
            <span class="font-semibold text-navy">{{ $photos->total() }}</span>
            foto
        </p>
        <div class="flex items-center gap-2">
            @if($photos->onFirstPage())
            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold text-slate-300 bg-slate-50 cursor-not-allowed">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Prev
            </span>
            @else
            <a href="{{ $photos->previousPageUrl() }}"
               class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold text-slate-600 bg-white border border-slate-200 hover:border-primary hover:text-primary transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Prev
            </a>
            @endif

            @foreach($photos->getUrlRange(1, $photos->lastPage()) as $page => $url)
            @if($page == $photos->currentPage())
            <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-sm font-bold bg-primary text-white shadow-sm">
                {{ $page }}
            </span>
            @else
            <a href="{{ $url }}"
               class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-sm font-semibold text-slate-500 bg-white border border-slate-200 hover:border-primary hover:text-primary transition-all">
                {{ $page }}
            </a>
            @endif
            @endforeach

            @if($photos->hasMorePages())
            <a href="{{ $photos->nextPageUrl() }}"
               class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold text-slate-600 bg-white border border-slate-200 hover:border-primary hover:text-primary transition-all">
                Next
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
            @else
            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold text-slate-300 bg-slate-50 cursor-not-allowed">
                Next
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
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <p class="text-slate-400">{{ __('app.gallery_empty') }}</p>
    </div>
    @endif

</div>

@endsection

@push('scripts')
<script>
function lightbox() {
    return {
        isOpen: false,
        currentIndex: 0,
        photos: @json($photos->map(fn($p) => Storage::url($p->file_path))->values()),
        open(index) {
            this.currentIndex = index;
            this.isOpen = true;
            document.body.style.overflow = 'hidden';
        },
        close() {
            this.isOpen = false;
            document.body.style.overflow = '';
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
