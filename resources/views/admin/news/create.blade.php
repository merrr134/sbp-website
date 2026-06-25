@extends('layouts.admin')

@section('title', 'Tambah Berita')
@section('page-title', 'Tambah Berita')
@section('page-subtitle', 'Buat artikel berita baru.')

@section('content')

<div class="max-w-3xl">
    <form method="POST" action="{{ route('admin.berita.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="bg-white rounded-2xl shadow-card border border-slate-100 overflow-hidden">

            <div class="px-6 py-4 border-b border-slate-100">
                <h3 class="font-semibold text-navy">Informasi Berita</h3>
            </div>

            <div class="p-6 space-y-5">

                {{-- Judul --}}
                <div>
                    <label class="block text-sm font-semibold text-navy mb-1.5">
                        Judul Berita <span class="text-red-400">*</span>
                    </label>
                    <input type="text" name="title" value="{{ old('title') }}"
                           placeholder="Masukkan judul berita..."
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy placeholder-slate-300
                                  focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all
                                  @error('title') border-red-400 @enderror">
                    @error('title')
                    <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Foto --}}
                <div>
                    <label class="block text-sm font-semibold text-navy mb-1.5">Foto Berita</label>
                    <div class="border-2 border-dashed border-slate-200 rounded-xl p-6 text-center hover:border-primary/50 transition-colors"
                         x-data="{ preview: null }"
                         @dragover.prevent
                         @drop.prevent="
                             const file = $event.dataTransfer.files[0];
                             if (file) {
                                 preview = URL.createObjectURL(file);
                                 $refs.fileInput.files = $event.dataTransfer.files;
                             }
                         ">
                        <input type="file" name="image" accept="image/*" class="hidden"
                               x-ref="fileInput"
                               @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null">

                        <template x-if="!preview">
                            <div>
                                <svg class="w-10 h-10 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-sm text-slate-400 mb-1">Drag & drop foto atau</p>
                                <button type="button" @click="$refs.fileInput.click()"
                                        class="text-sm font-semibold text-primary hover:underline">
                                    Pilih File
                                </button>
                                <p class="text-xs text-slate-300 mt-2">PNG, JPG, WEBP — Maks. 2MB</p>
                            </div>
                        </template>

                        <template x-if="preview">
                            <div class="relative">
                                <img :src="preview" class="max-h-48 mx-auto rounded-xl object-cover">
                                <button type="button"
                                        @click="preview = null; $refs.fileInput.value = ''"
                                        class="absolute top-2 right-2 w-7 h-7 bg-red-500 text-white rounded-full flex items-center justify-center hover:bg-red-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </template>
                    </div>
                    @error('image')
                    <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Konten --}}
                <div>
                    <label class="block text-sm font-semibold text-navy mb-1.5">
                        Isi Berita <span class="text-red-400">*</span>
                    </label>
                    <textarea name="content" rows="10"
                              placeholder="Tulis isi berita di sini..."
                              class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy placeholder-slate-300
                                     focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all resize-none
                                     @error('content') border-red-400 @enderror">{{ old('content') }}</textarea>
                    @error('content')
                    <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status Publish --}}
                <div class="flex items-center gap-3 p-4 bg-surface rounded-xl">
                    <input type="checkbox" name="is_published" id="is_published" value="1"
                           {{ old('is_published') ? 'checked' : '' }}
                           class="w-4 h-4 rounded text-primary focus:ring-primary/30">
                    <div>
                        <label for="is_published" class="text-sm font-semibold text-navy cursor-pointer">
                            Publish sekarang
                        </label>
                        <p class="text-xs text-slate-400">Berita akan langsung tampil di website</p>
                    </div>
                </div>

            </div>

            {{-- Footer Form --}}
            <div class="px-6 py-4 border-t border-slate-100 flex items-center gap-3">
                <button type="submit"
                        class="inline-flex items-center gap-2 bg-primary text-white text-sm font-semibold px-6 py-2.5 rounded-xl hover:bg-primary-dark transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Berita
                </button>
                <a href="{{ route('admin.berita.index') }}"
                   class="text-sm font-semibold text-slate-400 hover:text-navy transition-colors">
                    Batal
                </a>
            </div>

        </div>
    </form>
</div>

@endsection
