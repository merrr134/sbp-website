@extends('layouts.admin')

@section('title', 'Kelola Berita')
@section('page-title', 'Kelola Berita')
@section('page-subtitle', 'Tambah, edit, dan hapus artikel berita.')

@section('content')

<div class="bg-white rounded-2xl shadow-card border border-slate-100 overflow-hidden">

    {{-- Header --}}
    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
        <h3 class="font-semibold text-navy">Semua Berita</h3>
        <a href="{{ route('admin.berita.create') }}"
           class="inline-flex items-center gap-2 bg-primary text-white text-sm font-semibold px-4 py-2.5 rounded-xl hover:bg-primary-dark transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Berita
        </a>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-slate-100 bg-surface/50">
                    <th class="text-left px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Berita</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Tanggal</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Status</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($news as $item)
                <tr class="hover:bg-surface/30 transition-colors">

                    {{-- Berita --}}
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            @if($item->image)
                            <img src="{{ Storage::url($item->image) }}"
                                 alt="{{ $item->title }}"
                                 class="w-14 h-14 rounded-xl object-cover flex-shrink-0">
                            @else
                            <div class="w-14 h-14 rounded-xl bg-surface flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            @endif
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-navy truncate max-w-[280px]">{{ $item->title }}</p>
                                <p class="text-xs text-slate-400 mt-0.5 truncate max-w-[280px]">
                                    {{ Str::limit(strip_tags($item->content), 60) }}
                                </p>
                            </div>
                        </div>
                    </td>

                    {{-- Tanggal --}}
                    <td class="px-6 py-4 text-sm text-slate-400 whitespace-nowrap">
                        {{ $item->created_at->format('d M Y') }}
                    </td>

                    {{-- Status --}}
                    <td class="px-6 py-4">
                        @if($item->is_published)
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                            Published
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-500">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                            Draft
                        </span>
                        @endif
                    </td>

                    {{-- Aksi --}}
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.berita.edit', $item->id) }}"
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-primary bg-primary/10 hover:bg-primary hover:text-white transition-all">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.berita.destroy', $item->id) }}"
                                  onsubmit="return confirm('Yakin hapus berita ini?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-red-500 bg-red-50 hover:bg-red-500 hover:text-white transition-all">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-16 text-center">
                        <svg class="w-12 h-12 mx-auto text-slate-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        <p class="text-slate-400 text-sm">Belum ada berita.</p>
                        <a href="{{ route('admin.berita.create') }}" class="text-primary text-sm font-semibold mt-1 inline-block">
                            Tambah berita pertama
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($news->hasPages())
    <div class="px-6 py-4 border-t border-slate-100">
        {{ $news->links() }}
    </div>
    @endif

</div>

@endsection
