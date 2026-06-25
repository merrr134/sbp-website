@extends('layouts.admin')

@section('title', 'Kelola Mitra')
@section('page-title', 'Kelola Mitra')
@section('page-subtitle', 'Tambah dan hapus logo mitra kerja sama.')

@section('content')

<div class="space-y-6">

    {{-- Form Tambah Mitra --}}
    <div class="bg-white rounded-2xl shadow-card border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100">
            <h3 class="font-semibold text-navy">Tambah Mitra Baru</h3>
        </div>
        <div class="p-6">
            <form method="POST" action="{{ route('admin.partners.store') }}" enctype="multipart/form-data"
                  x-data="{ preview: null }">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">

                    {{-- Nama Mitra --}}
                    <div>
                        <label class="block text-sm font-semibold text-navy mb-1.5">
                            Nama Mitra <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               placeholder="Contoh: PT. Minetech Global"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-navy placeholder-slate-300
                                      focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all
                                      @error('name') border-red-400 @enderror">
                        @error('name')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Upload Logo --}}
                    <div>
                        <label class="block text-sm font-semibold text-navy mb-1.5">
                            Logo <span class="text-red-400">*</span>
                        </label>
                        <div class="flex items-center gap-3">
                            <input type="file" name="logo_path" accept="image/*" class="hidden"
                                   x-ref="logoInput"
                                   @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null">
                            <button type="button" @click="$refs.logoInput.click()"
                                    class="flex-1 px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-400
                                           hover:border-primary hover:text-primary transition-all text-left truncate">
                                <span x-text="preview ? 'Logo dipilih ✓' : 'Pilih file logo...'"></span>
                            </button>
                            <template x-if="preview">
                                <img :src="preview" class="w-10 h-10 object-contain rounded-lg border border-slate-200">
                            </template>
                        </div>
                        @error('logo_path')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <div>
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 bg-primary text-white text-sm font-semibold px-6 py-2.5 rounded-xl hover:bg-primary-dark transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Mitra
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- Grid Mitra --}}
    <div class="bg-white rounded-2xl shadow-card border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-semibold text-navy">Semua Mitra</h3>
            <span class="text-xs text-slate-400">{{ $partners->count() }} mitra</span>
        </div>

        @if($partners->count() > 0)
        <div class="p-6 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @foreach($partners as $partner)
            <div class="relative group border border-slate-100 rounded-2xl p-4 flex flex-col items-center gap-3 hover:border-primary/30 hover:shadow-card transition-all">
                <img src="{{ Storage::url($partner->logo_path) }}"
                     alt="{{ $partner->name }}"
                     class="h-12 object-contain">
                <p class="text-xs text-slate-500 font-medium text-center truncate w-full">{{ $partner->name }}</p>

                {{-- Hapus --}}
                <form method="POST" action="{{ route('admin.partners.destroy', $partner->id) }}"
                      onsubmit="return confirm('Hapus mitra {{ $partner->name }}?')"
                      class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="w-7 h-7 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </form>
            </div>
            @endforeach
        </div>
        @else
        <div class="p-16 text-center">
            <svg class="w-12 h-12 mx-auto text-slate-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <p class="text-slate-400 text-sm">Belum ada mitra. Tambahkan sekarang!</p>
        </div>
        @endif
    </div>

</div>

@endsection
