@extends('layouts.admin')

@section('title', 'Kelola Home')
@section('page-title', 'Kelola Home')
@section('page-subtitle', 'Edit konten halaman utama website.')

@section('content')

<form method="POST" action="{{ route('admin.home.update') }}" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="space-y-6">

        {{-- Hero Slides --}}
        <div class="bg-white rounded-2xl shadow-card border border-slate-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
                <h3 class="font-semibold text-navy">Hero Slideshow</h3>
                <p class="text-xs text-slate-400 mt-0.5">Edit judul, subjudul, dan foto untuk setiap slide.</p>
            </div>
            <div class="p-6 space-y-6">

                @foreach($slides as $i => $slide)
                <div class="p-5 bg-surface rounded-2xl border border-slate-100">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">
                        Slide {{ $i }}
                    </p>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

                        {{-- Upload Foto --}}
                        <div x-data="{ preview: null }">
                            <label class="block text-sm font-semibold text-navy mb-1.5">Foto Slide {{ $i }}</label>

                            @if($slide['img'])
                            <div class="mb-2">
                                <img src="{{ Storage::url($slide['img']) }}"
                                     alt="Slide {{ $i }}"
                                     class="w-full h-24 object-cover rounded-xl">
                                <p class="text-xs text-slate-400 mt-1">Foto saat ini</p>
                            </div>
                            @else
                            <div class="mb-2 w-full h-24 bg-slate-100 rounded-xl flex items-center justify-center">
                                <p class="text-xs text-slate-300">Pakai foto default</p>
                            </div>
                            @endif

                            <input type="file" name="slides[{{ $i }}][img]"
                                   accept="image/*" class="hidden"
                                   x-ref="fileInput{{ $i }}"
                                   @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null">

                            <template x-if="preview">
                                <img :src="preview" class="w-full h-24 object-cover rounded-xl mb-2">
                            </template>

                            <button type="button"
                                    @click="$refs['fileInput{{ $i }}'].click()"
                                    class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-400
                                           hover:border-primary hover:text-primary transition-all">
                                <span x-text="preview ? 'Foto dipilih ✓' : '{{ $slide['img'] ? 'Ganti Foto' : 'Upload Foto' }}'"></span>
                            </button>
                        </div>

                        {{-- Judul & Subjudul --}}
                        <div class="lg:col-span-2 space-y-3">
                            <div>
                                <label class="block text-sm font-semibold text-navy mb-1.5">
                                    Judul Slide {{ $i }} <span class="text-red-400">*</span>
                                </label>
                                <input type="text"
                                       name="slides[{{ $i }}][title]"
                                       value="{{ old('slides.'.$i.'.title', $slide['title']) }}"
                                       placeholder="Judul slide {{ $i }}"
                                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy
                                              focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-navy mb-1.5">
                                    Subjudul Slide {{ $i }} <span class="text-red-400">*</span>
                                </label>
                                <textarea name="slides[{{ $i }}][subtitle]" rows="3"
                                          placeholder="Subjudul slide {{ $i }}"
                                          class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy
                                                 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all resize-none">{{ old('slides.'.$i.'.subtitle', $slide['subtitle']) }}</textarea>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach

            </div>
        </div>

        {{-- CTA Buttons --}}
        <div class="bg-white rounded-2xl shadow-card border border-slate-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
                <h3 class="font-semibold text-navy">Tombol CTA Hero</h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-navy mb-1.5">Tombol Utama <span class="text-red-400">*</span></label>
                    <input type="text" name="hero_cta_primary"
                           value="{{ old('hero_cta_primary', $settings['hero_cta_primary']) }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy
                                  focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-navy mb-1.5">Tombol Sekunder <span class="text-red-400">*</span></label>
                    <input type="text" name="hero_cta_secondary"
                           value="{{ old('hero_cta_secondary', $settings['hero_cta_secondary']) }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy
                                  focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                </div>
            </div>
        </div>

        {{-- About Section --}}
        <div class="bg-white rounded-2xl shadow-card border border-slate-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
                <h3 class="font-semibold text-navy">Tentang Kami (Ringkasan Home)</h3>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-navy mb-1.5">Judul <span class="text-red-400">*</span></label>
                    <input type="text" name="about_home_title"
                           value="{{ old('about_home_title', $settings['about_home_title']) }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy
                                  focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-navy mb-1.5">Paragraf <span class="text-red-400">*</span></label>
                    <textarea name="about_home_content" rows="4"
                              class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy
                                     focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all resize-none">{{ old('about_home_content', $settings['about_home_content']) }}</textarea>
                </div>
            </div>
        </div>

        {{-- Kontak --}}
        <div class="bg-white rounded-2xl shadow-card border border-slate-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
                <h3 class="font-semibold text-navy">Informasi Kontak</h3>
                <p class="text-xs text-slate-400 mt-0.5">Tampil di halaman kontak dan footer.</p>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-navy mb-1.5">Alamat <span class="text-red-400">*</span></label>
                    <textarea name="contact_address" rows="2"
                              class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy
                                     focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all resize-none">{{ old('contact_address', $settings['contact_address']) }}</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-navy mb-1.5">Telepon <span class="text-red-400">*</span></label>
                        <input type="text" name="contact_phone"
                               value="{{ old('contact_phone', $settings['contact_phone']) }}"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy
                                      focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-navy mb-1.5">Email <span class="text-red-400">*</span></label>
                        <input type="email" name="contact_email"
                               value="{{ old('contact_email', $settings['contact_email']) }}"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy
                                      focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-navy mb-1.5">Jam Operasional <span class="text-red-400">*</span></label>
                    <input type="text" name="contact_hours"
                           value="{{ old('contact_hours', $settings['contact_hours']) }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy
                                  focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                </div>
            </div>
        </div>

        {{-- Submit --}}
        <div class="flex items-center gap-3">
            <button type="submit"
                    class="inline-flex items-center gap-2 bg-primary text-white text-sm font-semibold px-8 py-3 rounded-xl hover:bg-primary-dark transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.dashboard') }}"
               class="text-sm font-semibold text-slate-400 hover:text-navy transition-colors">
                Batal
            </a>
        </div>

    </div>
</form>

@endsection
