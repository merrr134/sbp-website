@extends('layouts.admin')

@section('title', 'Kelola Galeri')
@section('page-title', 'Kelola Galeri')
@section('page-subtitle', 'Upload dan hapus foto dokumentasi.')

@section('content')

<div class="space-y-6">

    {{-- Upload Form --}}
    <div class="bg-white rounded-2xl shadow-card border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100">
            <h3 class="font-semibold text-navy">Upload Foto Baru</h3>
        </div>
        <div class="p-6">
            <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data"
                  x-data="{ files: [], previews: [] }">
                @csrf

                {{-- Drop Zone --}}
                <div class="border-2 border-dashed border-slate-200 rounded-xl p-8 text-center hover:border-primary/50 transition-colors"
                     @dragover.prevent
                     @drop.prevent="
                         const newFiles = Array.from($event.dataTransfer.files);
                         files = [...files, ...newFiles];
                         newFiles.forEach(f => previews.push(URL.createObjectURL(f)));
                     ">
                    <input type="file" name="photos[]" multiple accept="image/*" class="hidden"
                           x-ref="fileInput"
                           @change="
                               const newFiles = Array.from($event.target.files);
                               files = [...files, ...newFiles];
                               newFiles.forEach(f => previews.push(URL.createObjectURL(f)));
                           ">

                    <svg class="w-12 h-12 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-slate-400 text-sm mb-1">Drag & drop foto atau</p>
                    <button type="button" @click="$refs.fileInput.click()"
                            class="text-primary font-semibold text-sm hover:underline">
                        Pilih File
                    </button>
                    <p class="text-xs text-slate-300 mt-2">PNG, JPG, WEBP — Bisa pilih banyak sekaligus</p>
                </div>

                {{-- Preview Grid --}}
                <div class="grid grid-cols-4 md:grid-cols-6 gap-3 mt-4"
                     x-show="previews.length > 0">
                    <template x-for="(preview, index) in previews" :key="index">
                        <div class="relative group aspect-square">
                            <img :src="preview" class="w-full h-full object-cover rounded-xl">
                            <button type="button"
                                    @click="previews.splice(index, 1); files.splice(index, 1)"
                                    class="absolute top-1 right-1 w-6 h-6 bg-red-500 text-white rounded-full
                                           flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </template>
                </div>

                {{-- Submit --}}
                <div class="mt-4 flex items-center gap-3">
                    <button type="submit"
                            class="inline-flex items-center gap-2 bg-primary text-white text-sm font-semibold px-6 py-2.5 rounded-xl hover:bg-primary-dark transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        Upload Foto
                    </button>
                    <p class="text-xs text-slate-400" x-show="files.length > 0">
                        <span x-text="files.length"></span> foto dipilih
                    </p>
                </div>

                @error('photos')
                <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                @enderror
                @error('photos.*')
                <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                @enderror
            </form>
        </div>
    </div>

    {{-- Foto Grid --}}
    <div class="bg-white rounded-2xl shadow-card border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-semibold text-navy">Semua Foto</h3>
            <span class="text-xs text-slate-400">{{ $photos->total() }} foto</span>
        </div>

        @if($photos->count() > 0)
        <div class="p-6 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($photos as $photo)
            <div class="relative group aspect-square">
                <img src="{{ Storage::url($photo->file_path) }}"
                     alt="Foto"
                     class="w-full h-full object-cover rounded-xl">

                {{-- Overlay Hapus --}}
                <div class="absolute inset-0 bg-black/50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                    <form method="POST" action="{{ route('admin.gallery.destroy', $photo->id) }}"
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

        {{-- Pagination --}}
        @if($photos->hasPages())
        <div class="px-6 py-4 border-t border-slate-100">
            {{ $photos->links() }}
        </div>
        @endif

        @else
        <div class="p-16 text-center">
            <svg class="w-12 h-12 mx-auto text-slate-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="text-slate-400 text-sm">Belum ada foto. Upload sekarang!</p>
        </div>
        @endif
    </div>

</div>

@endsection
