@php $partners = \App\Models\Partner::all(); @endphp

@if($partners->count() > 0)
<div class="py-12 bg-white border-t border-slate-100">
    <p class="text-center text-xs font-semibold text-slate-400 uppercase tracking-widest mb-10">
        Our Strategic Partners &amp; Major Clients
    </p>
    <div class="relative overflow-hidden">
        <div class="absolute left-0 top-0 bottom-0 w-24 bg-gradient-to-r from-white to-transparent z-10"></div>
        <div class="absolute right-0 top-0 bottom-0 w-24 bg-gradient-to-l from-white to-transparent z-10"></div>

        <div class="flex">
            @foreach([1,2,3,4] as $track)
            <div class="flex items-center animate-marquee whitespace-nowrap flex-shrink-0"
                 aria-hidden="{{ $track > 1 ? 'true' : 'false' }}">
                @foreach($partners as $partner)
                <img src="{{ Storage::url($partner->logo_path) }}"
                     alt="{{ $partner->name }}"
                     class="h-16 object-contain flex-shrink-0 px-10">
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</div>

@else
<div class="py-12 bg-white border-t border-slate-100">
    <p class="text-center text-xs font-semibold text-slate-400 uppercase tracking-widest mb-10">
        Our Strategic Partners &amp; Major Clients
    </p>
    <div class="relative overflow-hidden">
        <div class="absolute left-0 top-0 bottom-0 w-24 bg-gradient-to-r from-white to-transparent z-10"></div>
        <div class="absolute right-0 top-0 bottom-0 w-24 bg-gradient-to-l from-white to-transparent z-10"></div>

        <div class="flex">
            @foreach([1,2,3,4] as $track)
            <div class="flex items-center animate-marquee whitespace-nowrap flex-shrink-0"
                 aria-hidden="{{ $track > 1 ? 'true' : 'false' }}">
                @foreach(['MINETECH', 'ECO-GLOBAL', 'INDUSTRIA', 'S&P METALS', 'BLUECORE', 'NOVALINK', 'TERRACORP'] as $name)
                <span class="text-slate-400 font-bold text-xl tracking-widest flex-shrink-0 px-10">{{ $name }}</span>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
