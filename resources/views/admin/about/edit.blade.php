@extends('layouts.admin')

@section('title', 'Kelola Tentang Kami')
@section('page-title', 'Kelola Tentang Kami')
@section('page-subtitle', 'Edit konten halaman Tentang Kami.')

@section('content')

<form method="POST" action="{{ route('admin.about.update') }}" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="space-y-6">

        @php
            $sectionLabels = [
                'company'        => 'Tentang Perusahaan',
                'vision_mission' => 'Visi & Misi',
                'history'        => 'Sejarah Singkat',
                'assets'         => 'Aset Perusahaan',
            ];
        @endphp

        @foreach($sections as $key => $section)

        {{-- ===== TENTANG PERUSAHAAN + STATISTIK ===== --}}
        @if($key === 'company')
        <div class="bg-white rounded-2xl shadow-card border border-slate-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
                <h3 class="font-semibold text-navy">Tentang Perusahaan</h3>
                <p class="text-xs text-slate-400 mt-0.5">Konten dan statistik halaman Tentang Perusahaan.</p>
            </div>
            <div class="p-6 space-y-5">

                {{-- Judul --}}
                <div>
                    <label class="block text-sm font-semibold text-navy mb-1.5">Judul <span class="text-red-400">*</span></label>
                    <input type="text"
                           name="sections[{{ $key }}][title]"
                           value="{{ old('sections.'.$key.'.title', $section->title) }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy
                                  focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                </div>

                {{-- Konten --}}
                <div>
                    <label class="block text-sm font-semibold text-navy mb-1.5">Konten <span class="text-red-400">*</span></label>
                    <textarea name="sections[{{ $key }}][content]" rows="5"
                              class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy
                                     focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all resize-none">{{ old('sections.'.$key.'.content', $section->content) }}</textarea>
                </div>

                {{-- Gambar --}}
                <div x-data="{ preview: null }">
                    <label class="block text-sm font-semibold text-navy mb-1.5">Gambar</label>
                    @if($section->image)
                    <div class="mb-3">
                        <img src="{{ Storage::url($section->image) }}"
                             alt="{{ $section->title }}"
                             class="h-24 rounded-xl object-cover">
                        <p class="text-xs text-slate-400 mt-1">Gambar saat ini</p>
                    </div>
                    @endif
                    <div class="flex items-center gap-3">
                        <input type="file" name="sections[{{ $key }}][image]"
                               accept="image/*" class="hidden"
                               x-ref="imgInput"
                               @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null">
                        <button type="button" @click="$refs.imgInput.click()"
                                class="px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-400
                                       hover:border-primary hover:text-primary transition-all">
                            <span x-text="preview ? 'Gambar dipilih ✓' : '{{ $section->image ? 'Ganti Gambar' : 'Upload Gambar' }}'"></span>
                        </button>
                        <template x-if="preview">
                            <img :src="preview" class="h-12 rounded-xl object-cover">
                        </template>
                    </div>
                </div>

                {{-- Divider --}}
                <div class="border-t border-slate-100 pt-5">
                    <p class="text-sm font-semibold text-navy mb-4">Statistik Perusahaan</p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-navy mb-1.5">Tahun Berdiri</label>
                            <input type="text" name="stat_founded"
                                   value="{{ old('stat_founded', \App\Models\SiteSetting::get('stat_founded', '1988')) }}"
                                   placeholder="1988"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy
                                          focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-navy mb-1.5">Jumlah Karyawan</label>
                            <input type="text" name="stat_employees"
                                   value="{{ old('stat_employees', \App\Models\SiteSetting::get('stat_employees', '5K+')) }}"
                                   placeholder="5K+"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy
                                          focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-navy mb-1.5">Lokasi Tambang</label>
                            <input type="text" name="stat_locations"
                                   value="{{ old('stat_locations', \App\Models\SiteSetting::get('stat_locations', '14')) }}"
                                   placeholder="14"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy
                                          focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- ===== VISI & MISI ===== --}}
        @elseif($key === 'vision_mission')
        <div class="bg-white rounded-2xl shadow-card border border-slate-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
                <h3 class="font-semibold text-navy">Visi & Misi</h3>
                <p class="text-xs text-slate-400 mt-0.5">Visi dan misi perusahaan.</p>
            </div>
            <div class="p-6 space-y-5">

                <div>
                    <label class="block text-sm font-semibold text-navy mb-1.5">Judul Halaman <span class="text-red-400">*</span></label>
                    <input type="text"
                           name="sections[{{ $key }}][title]"
                           value="{{ old('sections.'.$key.'.title', $section->title) }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy
                                  focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                </div>

                {{-- Visi --}}
                <div class="p-4 bg-surface rounded-xl border border-slate-100">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                        <p class="font-semibold text-navy text-sm">Visi</p>
                    </div>
                    <textarea name="company_vision" rows="3"
                              placeholder="Tulis visi perusahaan..."
                              class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy
                                     focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all resize-none">{{ old('company_vision', \App\Models\SiteSetting::get('company_vision')) }}</textarea>
                </div>

                {{-- Misi --}}
                <div class="p-4 bg-surface rounded-xl border border-slate-100">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <p class="font-semibold text-navy text-sm">Misi</p>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <label class="text-xs text-slate-400 mb-1 block">Misi 1</label>
                            <input type="text" name="company_mission_1"
                                   value="{{ old('company_mission_1', \App\Models\SiteSetting::get('company_mission_1')) }}"
                                   placeholder="Tulis misi pertama..."
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy
                                          focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                        </div>
                        <div>
                            <label class="text-xs text-slate-400 mb-1 block">Misi 2</label>
                            <input type="text" name="company_mission_2"
                                   value="{{ old('company_mission_2', \App\Models\SiteSetting::get('company_mission_2')) }}"
                                   placeholder="Tulis misi kedua..."
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy
                                          focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                        </div>
                        <div>
                            <label class="text-xs text-slate-400 mb-1 block">Misi 3</label>
                            <input type="text" name="company_mission_3"
                                   value="{{ old('company_mission_3', \App\Models\SiteSetting::get('company_mission_3')) }}"
                                   placeholder="Tulis misi ketiga..."
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy
                                          focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- ===== SEJARAH SINGKAT + TIMELINE ===== --}}
        @elseif($key === 'history')
        <div class="bg-white rounded-2xl shadow-card border border-slate-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
                <h3 class="font-semibold text-navy">Sejarah Singkat</h3>
                <p class="text-xs text-slate-400 mt-0.5">Paragraf pembuka dan timeline sejarah perusahaan.</p>
            </div>
            <div class="p-6 space-y-5">

                {{-- Judul --}}
                <div>
                    <label class="block text-sm font-semibold text-navy mb-1.5">Judul <span class="text-red-400">*</span></label>
                    <input type="text"
                           name="sections[{{ $key }}][title]"
                           value="{{ old('sections.'.$key.'.title', $section->title) }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy
                                  focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                </div>

                {{-- Paragraf --}}
                <div>
                    <label class="block text-sm font-semibold text-navy mb-1.5">Paragraf Pembuka</label>
                    <textarea name="sections[{{ $key }}][content]" rows="3"
                              class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy
                                     focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all resize-none">{{ old('sections.'.$key.'.content', $section->content) }}</textarea>
                </div>

                {{-- Timeline --}}
                <div class="border-t border-slate-100 pt-5">
                    <p class="text-sm font-semibold text-navy mb-4">Timeline Sejarah</p>
                    <div class="space-y-4">
                        @foreach([1,2,3,4] as $n)
                        <div class="p-4 bg-surface rounded-xl border border-slate-100">
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-3">Milestone {{ $n }}</p>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <div>
                                    <label class="text-xs text-slate-400 mb-1 block">Tahun / Label</label>
                                    <input type="text" name="timeline_{{ $n }}_year"
                                           value="{{ old('timeline_'.$n.'_year', \App\Models\SiteSetting::get('timeline_'.$n.'_year')) }}"
                                           placeholder="Contoh: 1988 atau Kini"
                                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy
                                                  focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                                </div>
                                <div>
                                    <label class="text-xs text-slate-400 mb-1 block">Judul Milestone</label>
                                    <input type="text" name="timeline_{{ $n }}_title"
                                           value="{{ old('timeline_'.$n.'_title', \App\Models\SiteSetting::get('timeline_'.$n.'_title')) }}"
                                           placeholder="Contoh: Pendirian Perusahaan"
                                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy
                                                  focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                                </div>
                                <div>
                                    <label class="text-xs text-slate-400 mb-1 block">Deskripsi</label>
                                    <input type="text" name="timeline_{{ $n }}_desc"
                                           value="{{ old('timeline_'.$n.'_desc', \App\Models\SiteSetting::get('timeline_'.$n.'_desc')) }}"
                                           placeholder="Deskripsi singkat..."
                                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy
                                                  focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

        {{-- ===== ASET PERUSAHAAN ===== --}}
        @else
        <div class="bg-white rounded-2xl shadow-card border border-slate-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
                <h3 class="font-semibold text-navy">{{ $sectionLabels[$key] ?? $key }}</h3>
            </div>
            <div class="p-6 space-y-4">

                <div>
                    <label class="block text-sm font-semibold text-navy mb-1.5">Judul <span class="text-red-400">*</span></label>
                    <input type="text"
                           name="sections[{{ $key }}][title]"
                           value="{{ old('sections.'.$key.'.title', $section->title) }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy
                                  focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-navy mb-1.5">Konten <span class="text-red-400">*</span></label>
                    <textarea name="sections[{{ $key }}][content]" rows="5"
                              class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy
                                     focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all resize-none">{{ old('sections.'.$key.'.content', $section->content) }}</textarea>
                </div>

            </div>
        </div>
        @endif

        @endforeach

        {{-- Submit --}}
        <div class="flex items-center gap-3">
            <button type="submit"
                    class="inline-flex items-center gap-2 bg-primary text-white text-sm font-semibold px-8 py-3 rounded-xl hover:bg-primary-dark transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Semua Perubahan
            </button>
            <a href="{{ route('admin.dashboard') }}"
               class="text-sm font-semibold text-slate-400 hover:text-navy transition-colors">
                Batal
            </a>
        </div>

    </div>
</form>

@endsection
