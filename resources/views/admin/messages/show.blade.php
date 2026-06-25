@extends('layouts.admin')

@section('title', 'Detail Pesan')
@section('page-title', 'Detail Pesan')
@section('page-subtitle', 'Baca pesan dari pengunjung.')

@section('content')

<div class="max-w-2xl">
    <div class="bg-white rounded-2xl shadow-card border border-slate-100 overflow-hidden">

        {{-- Header --}}
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center">
                    <span class="text-primary font-bold">
                        {{ strtoupper(substr($message->name, 0, 1)) }}
                    </span>
                </div>
                <div>
                    <p class="font-semibold text-navy text-sm">{{ $message->name }}</p>
                    <p class="text-xs text-slate-400">{{ $message->email }}</p>
                </div>
            </div>
            <span class="text-xs text-slate-400">{{ $message->created_at->format('d M Y, H:i') }}</span>
        </div>

        {{-- Info --}}
        <div class="px-6 py-4 bg-surface/50 border-b border-slate-100">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs text-slate-400 mb-0.5">Email</p>
                    <p class="text-sm font-medium text-navy">{{ $message->email }}</p>
                </div>
                @if($message->phone)
                <div>
                    <p class="text-xs text-slate-400 mb-0.5">No. HP</p>
                    <p class="text-sm font-medium text-navy">{{ $message->phone }}</p>
                </div>
                @endif
            </div>
        </div>

        {{-- Pesan --}}
        <div class="px-6 py-6">
            <p class="text-xs text-slate-400 mb-3 uppercase tracking-wide font-semibold">Isi Pesan</p>
            <div class="bg-surface rounded-xl p-4">
                <p class="text-sm text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $message->message }}</p>
            </div>
        </div>

        {{-- Footer --}}
        <div class="px-6 py-4 border-t border-slate-100 flex items-center gap-3">
            <a href="mailto:{{ $message->email }}"
               class="inline-flex items-center gap-2 bg-primary text-white text-sm font-semibold px-5 py-2.5 rounded-xl hover:bg-primary-dark transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Balas via Email
            </a>
            <a href="{{ route('admin.messages.index') }}"
               class="text-sm font-semibold text-slate-400 hover:text-navy transition-colors">
                ← Kembali
            </a>
            <form method="POST" action="{{ route('admin.messages.destroy', $message->id) }}"
                  onsubmit="return confirm('Hapus pesan ini?')"
                  class="ml-auto">
                @csrf @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center gap-2 text-sm font-semibold text-red-400 hover:text-red-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus Pesan
                </button>
            </form>
        </div>

    </div>
</div>

@endsection
