@extends('layouts.admin')

@section('title', 'Foto ' . $asset->name)
@section('page-title', 'Kelola Foto: ' . $asset->name)
@section('page-subtitle', 'Upload dan hapus foto ' . $asset->name)

@section('content')

<div class="space-y-6">

    {{-- Upload Foto --}}
    <div class="bg-white rounded-2xl shadow-card border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100">
            <h3 class="font-semibold text-navy">Upload Foto {{ $asset->name }}</h3>
        </div>
        <div class="p-6">
            <form method="POST" action="{{ route('admin.assets.upload-photos', $asset->id) }}"
                  enctype="multipart/form-data" x-data="{ previews: [] }">
                @csrf

                <div class="border-2 border-dashed border-slate-200 rounded-xl p-8 text-center hover:border-primary/50 transition-colors"
                     @dragover.prevent
                     @drop.prevent="
                         previews = Array.from($event.dataTransfer.files).map(f => URL.createObjectURL(f));
                         $refs.fileInput.files = $event.dataTransfer.files;
                     ">
                    <input type="file" name="photos[]" multiple accept="image/*" class="hidden"
                           x-ref="fileInput"
                           @change="previews = Array.from($event.target.files).map(f => URL.createObjectURL(f))">

                    <svg class="w-10 h-10 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-sm text-slate-400 mb-1">Drag & drop atau</p>
                    <button type="button" @click="$refs.fileInput.click()"
                            class="text-sm font-semibold text-primary hover:underline">Pilih File</button>
                    <p class="text-xs text-slate-300 mt-1">Bisa pilih banyak sekaligus</p>
                </div>

                <div class="grid grid-cols-6 gap-2 mt-3" x-show="previews.length > 0">
                    <template x-for="preview in previews">
                        <img :src="preview" class="w-full aspect-square object-cover rounded-xl">
                    </template>
                </div>

                <div class="mt-4 flex items-center gap-3">
                    <button type="submit"
                            class="inline-flex items-center gap-2 bg-primary text-white text-sm font-semibold px-6 py-2.5 rounded-xl hover:bg-primary-dark transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        Upload Foto
                    </button>
                    <p class="text-xs text-slate-400" x-show="previews.length > 0">
                        <span x-text="previews.length"></span> foto dipilih
                    </p>
                </div>

            </form>
        </div>
    </div>

    {{-- Grid Foto --}}
    <div class="bg-white rounded-2xl shadow-card border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-semibold text-navy">Semua Foto {{ $asset->name }}</h3>
            <div class="flex items-center gap-3">
                <span class="text-xs text-slate-400">{{ $asset->photos->count() }} foto</span>
                <a href="{{ route('admin.assets.index') }}"
                   class="text-xs text-primary font-semibold hover:underline">← Kembali</a>
            </div>
        </div>

        @if($asset->photos->count() > 0)
        <div class="p-6 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3">
            @foreach($asset->photos as $photo)
            <div class="relative group aspect-square overflow-hidden rounded-xl">
                <img src="{{ Storage::url($photo->file_path) }}"
                     alt="{{ $asset->name }}"
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                    <form method="POST" action="{{ route('admin.assets.destroy-photo', $photo->id) }}"
                          onsubmit="return confirm('Hapus foto ini?')">
                        @csrf @method('DELETE')
                        <button type="submit"
                                class="w-9 h-9 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="p-16 text-center">
            <p class="text-slate-400 text-sm">Belum ada foto untuk aset ini.</p>
        </div>
        @endif
    </div>

</div>

@endsection
