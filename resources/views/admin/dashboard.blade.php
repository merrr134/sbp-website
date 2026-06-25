@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Operations Overview')
@section('page-subtitle', 'Manage the PT. Sumber Bumi Putera digital ecosystem.')

@section('content')

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">

    @php
        $stats = [
            [
                'label'  => 'Total News',
                'value'  => $totalNews,
                'badge'  => '+12%',
                'badge_color' => 'text-green-600 bg-green-50',
                'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>',
                'color'  => 'text-primary bg-primary/10',
            ],
            [
                'label'  => 'Pending Messages',
                'value'  => $unreadMessages,
                'badge'  => 'Active',
                'badge_color' => 'text-red-600 bg-red-50',
                'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
                'color'  => 'text-amber-600 bg-amber-50',
            ],
            [
                'label'  => 'Total Foto',
                'value'  => $totalPhotos,
                'badge'  => 'Galeri',
                'badge_color' => 'text-blue-600 bg-blue-50',
                'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
                'color'  => 'text-indigo-600 bg-indigo-50',
            ],
            [
                'label'  => 'Mitra',
                'value'  => $totalPartners,
                'badge'  => 'Partners',
                'badge_color' => 'text-slate-600 bg-slate-100',
                'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>',
                'color'  => 'text-purple-600 bg-purple-50',
            ],
        ];
    @endphp

    @foreach($stats as $stat)
    <div class="bg-white rounded-2xl p-5 shadow-card border border-slate-100">
        <div class="flex items-start justify-between mb-4">
            <div class="w-10 h-10 rounded-xl {{ $stat['color'] }} flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {!! $stat['icon'] !!}
                </svg>
            </div>
            <span class="text-xs font-semibold px-2 py-1 rounded-lg {{ $stat['badge_color'] }}">
                {{ $stat['badge'] }}
            </span>
        </div>
        <p class="text-2xl font-bold text-navy">{{ $stat['value'] }}</p>
        <p class="text-xs text-slate-400 mt-1 uppercase tracking-wide">{{ $stat['label'] }}</p>
    </div>
    @endforeach

</div>

{{-- Main Grid --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- News Table --}}
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-card border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-semibold text-navy">News Management</h3>
            <a href="{{ route('admin.berita.index') }}"
               class="text-xs text-primary font-semibold hover:underline">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-slate-100">
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">News Title</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Date</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Status</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($recentNews as $item)
                    <tr class="hover:bg-surface/50 transition-colors">
                        <td class="px-6 py-4 text-sm font-medium text-navy max-w-[200px] truncate">
                            {{ $item->title }}
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-400">
                            {{ $item->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4">
                            @if($item->is_published)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                Published
                            </span>
                            @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-500">
                                Draft
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.berita.edit', $item->id) }}"
                                   class="p-1.5 rounded-lg text-slate-400 hover:text-primary hover:bg-primary/10 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('admin.berita.destroy', $item->id) }}"
                                      onsubmit="return confirm('Hapus berita ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="p-1.5 rounded-lg text-slate-400 hover:text-red-500 hover:bg-red-50 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-slate-400 text-sm">
                            Belum ada berita. <a href="{{ route('admin.berita.create') }}" class="text-primary font-semibold">Tambah sekarang</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Recent Messages --}}
    <div class="bg-white rounded-2xl shadow-card border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-semibold text-navy">Recent Messages</h3>
            <a href="{{ route('admin.messages.index') }}"
               class="text-xs text-primary font-semibold hover:underline">View All</a>
        </div>
        <div class="divide-y divide-slate-50">
            @forelse($recentMessages as $msg)
            <a href="{{ route('admin.messages.show', $msg->id) }}"
               class="block px-6 py-4 hover:bg-surface/50 transition-colors">
                <div class="flex items-start justify-between mb-1">
                    <p class="text-sm font-semibold {{ $msg->is_read ? 'text-slate-500' : 'text-navy' }}">
                        {{ $msg->name }}
                    </p>
                    <span class="text-[10px] text-slate-400">
                        {{ $msg->created_at->diffForHumans() }}
                    </span>
                </div>
                <p class="text-xs text-slate-400 truncate">{{ $msg->message }}</p>
                @if(!$msg->is_read)
                <span class="inline-block mt-1.5 w-2 h-2 rounded-full bg-primary"></span>
                @endif
            </a>
            @empty
            <div class="px-6 py-10 text-center text-slate-400 text-sm">
                Belum ada pesan masuk.
            </div>
            @endforelse
        </div>
    </div>

</div>

@endsection
