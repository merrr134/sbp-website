@extends('layouts.admin')

@section('title', 'Pesan Masuk')
@section('page-title', 'Pesan Masuk')
@section('page-subtitle', 'Pesan dari form kontak website.')

@section('content')

<div class="bg-white rounded-2xl shadow-card border border-slate-100 overflow-hidden">

    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
        <h3 class="font-semibold text-navy">Semua Pesan</h3>
        @php $unread = \App\Models\Message::where('is_read', false)->count(); @endphp
        @if($unread > 0)
        <span class="text-xs font-semibold bg-red-100 text-red-600 px-2.5 py-1 rounded-full">
            {{ $unread }} belum dibaca
        </span>
        @endif
    </div>

    <div class="divide-y divide-slate-50">
        @forelse($messages as $msg)
        <div class="flex items-start gap-4 px-6 py-4 hover:bg-surface/30 transition-colors {{ !$msg->is_read ? 'bg-primary/5' : '' }}">

            {{-- Avatar --}}
            <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                <span class="text-primary font-bold text-sm">
                    {{ strtoupper(substr($msg->name, 0, 1)) }}
                </span>
            </div>

            {{-- Konten --}}
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between gap-2 mb-0.5">
                    <div class="flex items-center gap-2">
                        <p class="text-sm font-semibold {{ !$msg->is_read ? 'text-navy' : 'text-slate-500' }}">
                            {{ $msg->name }}
                        </p>
                        @if(!$msg->is_read)
                        <span class="w-2 h-2 rounded-full bg-primary flex-shrink-0"></span>
                        @endif
                    </div>
                    <span class="text-xs text-slate-400 flex-shrink-0">
                        {{ $msg->created_at->format('d M Y, H:i') }}
                    </span>
                </div>
                <p class="text-xs text-slate-400 mb-1">{{ $msg->email }}
                    @if($msg->phone) · {{ $msg->phone }} @endif
                </p>
                <p class="text-sm text-slate-600 truncate">{{ $msg->message }}</p>
            </div>

            {{-- Aksi --}}
            <div class="flex items-center gap-2 flex-shrink-0">
                <a href="{{ route('admin.messages.show', $msg->id) }}"
                   class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-primary bg-primary/10 hover:bg-primary hover:text-white transition-all">
                    Baca
                </a>
                <form method="POST" action="{{ route('admin.messages.destroy', $msg->id) }}"
                      onsubmit="return confirm('Hapus pesan ini?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-red-400 bg-red-50 hover:bg-red-500 hover:text-white transition-all">
                        Hapus
                    </button>
                </form>
            </div>

        </div>
        @empty
        <div class="px-6 py-16 text-center">
            <svg class="w-12 h-12 mx-auto text-slate-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <p class="text-slate-400 text-sm">Belum ada pesan masuk.</p>
        </div>
        @endforelse
    </div>

    @if($messages->hasPages())
    <div class="px-6 py-4 border-t border-slate-100">
        {{ $messages->links() }}
    </div>
    @endif

</div>

@endsection
