@extends('layouts.admin')

@section('title', 'Kelola Aset')
@section('page-title', 'Kelola Aset')
@section('page-subtitle', 'Tambah dan kelola aset perusahaan.')

@section('content')

<div class="space-y-6">

    {{-- Form Tambah --}}
    <div class="bg-white rounded-2xl shadow-card border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100">
            <h3 class="font-semibold text-navy">Tambah Aset Baru</h3>
        </div>
        <div class="p-6">
            <form method="POST" action="{{ route('admin.assets.store') }}" enctype="multipart/form-data"
                  x-data="{ preview: null }">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-navy mb-1.5">Nama Aset <span class="text-red-400">*</span></label>
                        <input type="text" name="name" placeholder="Contoh: Excavator"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-navy mb-1.5">Thumbnail <span class="text-red-400">*</span></label>
                        <div class="flex items-center gap-3">
                            <input type="file" name="thumbnail" accept="image/*" class="hidden"
                                   x-ref="thumbInput"
                                   @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null">
                            <button type="button" @click="$refs.thumbInput.click()"
                                    class="flex-1 px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-400 hover:border-primary hover:text-primary transition-all text-left truncate">
                                <span x-text="preview ? 'Foto dipilih ✓' : 'Pilih thumbnail...'"></span>
                            </button>
                            <template x-if="preview">
                                <img :src="preview" class="w-10 h-10 object-contain rounded-lg border border-slate-200 bg-surface flex-shrink-0">
                            </template>
                        </div>
                    </div>

                    <div class="flex items-end">
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 bg-primary text-white text-sm font-semibold px-6 py-2.5 rounded-xl hover:bg-primary-dark transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Aset
                        </button>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-semibold text-navy mb-1.5">Deskripsi (opsional)</label>
                    <input type="text" name="description" placeholder="Contoh: 7 unit excavator kapasitas 20 Ton"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                </div>

            </form>
        </div>
    </div>

    {{-- Grid Aset --}}
    <div class="bg-white rounded-2xl shadow-card border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-semibold text-navy">Semua Aset</h3>
            <span class="text-xs text-slate-400">{{ $assets->count() }} aset</span>
        </div>

        @if($assets->count() > 0)
        <div class="p-6 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @foreach($assets as $asset)
            <div class="relative group border border-slate-100 rounded-2xl overflow-hidden hover:border-primary/30 hover:shadow-card transition-all">

                <div class="bg-surface h-28 flex items-center justify-center p-3">
                    <img src="{{ Storage::url($asset->thumbnail) }}"
                         alt="{{ $asset->name }}"
                         class="h-full object-contain">
                </div>

                <div class="p-3 border-t border-slate-100">
                    <p class="text-xs font-bold text-navy uppercase text-center">{{ $asset->name }}</p>
                    <p class="text-[10px] text-slate-400 text-center mt-0.5">{{ $asset->photos_count }} foto</p>
                </div>

                <div class="absolute inset-0 bg-black/50 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-2 p-2">
                    <a href="{{ route('admin.assets.show', $asset->id) }}"
                       class="w-full inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl text-xs font-semibold bg-white text-navy hover:bg-primary hover:text-white transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"/>
                        </svg>
                        Kelola Foto
                    </a>
                    <form method="POST" action="{{ route('admin.assets.destroy', $asset->id) }}"
                          onsubmit="return confirm('Hapus aset {{ $asset->name }}?')"
                          class="w-full">
                        @csrf @method('DELETE')
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl text-xs font-semibold bg-red-500 text-white hover:bg-red-600 transition-all">
                            Hapus
                        </button>
                    </form>
                </div>

            </div>
            @endforeach
        </div>
        @else
        <div class="p-16 text-center">
            <svg class="w-12 h-12 mx-auto text-slate-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/>
            </svg>
            <p class="text-slate-400 text-sm">Belum ada aset. Tambahkan sekarang!</p>
        </div>
        @endif
    </div>

</div>

@endsection
