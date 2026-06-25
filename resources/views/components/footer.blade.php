<footer class="bg-[#001E2F] text-white">

    {{-- Main Footer --}}
    <div class="max-w-[1280px] mx-auto px-6 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

            {{-- Kolom 1 — Brand --}}
            <div class="lg:col-span-1">
                <a href="{{ route('home') }}" class="flex items-center gap-2 mb-4">
                    <img src="{{ asset('img/logo.png') }}"
                         alt="Logo SBP"
                         class="h-10 object-contain">
                </a>
                <p class="text-white/50 text-sm leading-relaxed mb-6">
                    {{ __('app.footer_desc') }}
                </p>
                {{-- Social Media --}}
                <div class="flex items-center gap-3">
                    <a href="#" class="w-9 h-9 rounded-lg bg-white/10 hover:bg-primary flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-lg bg-white/10 hover:bg-primary flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-lg bg-white/10 hover:bg-primary flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Kolom 2 — Company --}}
            <div>
                <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-5">
                    {{ __('app.footer_company') }}
                </h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}"            class="text-white/50 text-sm hover:text-white transition-colors">{{ __('app.nav_home') }}</a></li>
                    <li><a href="{{ route('about.company') }}"   class="text-white/50 text-sm hover:text-white transition-colors">{{ __('app.nav_about') }}</a></li>
                    <li><a href="{{ route('news.index') }}"      class="text-white/50 text-sm hover:text-white transition-colors">{{ __('app.nav_news') }}</a></li>
                    <li><a href="{{ route('gallery.index') }}"   class="text-white/50 text-sm hover:text-white transition-colors">{{ __('app.nav_gallery') }}</a></li>
                </ul>
            </div>

            {{-- Kolom 3 — Operations --}}
            <div>
                <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-5">
                    {{ __('app.footer_ops') }}
                </h4>
                <ul class="space-y-3">
                    <li><a href="#" class="text-white/50 text-sm hover:text-white transition-colors">{{ __('app.footer_safety') }}</a></li>
                    <li><a href="#" class="text-white/50 text-sm hover:text-white transition-colors">{{ __('app.footer_sustain') }}</a></li>
                    <li><a href="#" class="text-white/50 text-sm hover:text-white transition-colors">{{ __('app.footer_explore') }}</a></li>
                    <li><a href="#" class="text-white/50 text-sm hover:text-white transition-colors">{{ __('app.footer_annual') }}</a></li>
                </ul>
            </div>

            {{-- Kolom 4 — Legal & Contact --}}
            <div>
                <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-5">
                    {{ __('app.footer_legal') }}
                </h4>
                <ul class="space-y-3 mb-6">
                    <li><a href="{{ route('contact.index') }}"  class="text-white/50 text-sm hover:text-white transition-colors">{{ __('app.footer_contact') }}</a></li>
                    <li><a href="#"                             class="text-white/50 text-sm hover:text-white transition-colors">{{ __('app.footer_privacy') }}</a></li>
                    <li><a href="#"                             class="text-white/50 text-sm hover:text-white transition-colors">{{ __('app.footer_terms') }}</a></li>
                </ul>
                <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-3">
                    {{ __('app.footer_hq') }}
                </h4>
                <p class="text-white/50 text-sm leading-relaxed">
                    @php echo nl2br(e(\App\Models\SiteSetting::get('contact_address'))) @endphp
                </p>
                <p class="text-white/50 text-sm mt-2">
                    {{ \App\Models\SiteSetting::get('contact_phone') }}
                </p>
            </div>

        </div>
    </div>

    {{-- Bottom Bar --}}
    <div class="border-t border-white/10">
        <div class="max-w-[1280px] mx-auto px-6 py-5 flex flex-col md:flex-row items-center justify-between gap-3">
            <p class="text-white/40 text-sm">
                {{ __('app.footer_copy', ['year' => date('Y')]) }}
            </p>
            <p class="text-white/40 text-sm">
                {{ __('app.footer_tagline') }}
            </p>
        </div>
    </div>

</footer>
