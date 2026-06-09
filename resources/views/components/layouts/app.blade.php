<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'CampusHub - Marketplace Mahasiswa' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <style data-navigate-track>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen flex flex-col antialiased">
    
    @php
        $cartCount = auth()->check() ? auth()->user()->cartItems()->sum('quantity') : 0;
        $unreadCount = auth()->check() ? app(App\Services\MessageService::class)->getUnreadCount(auth()->id()) : 0;
        $buyerOrdersCount = auth()->check() ? auth()->user()->buyerOrders()->whereIn('status', [\App\Enums\OrderStatus::Pending, \App\Enums\OrderStatus::Confirmed])->count() : 0;
        $sellerOrdersCount = auth()->check() ? auth()->user()->sellerOrders()->whereIn('status', [\App\Enums\OrderStatus::Pending, \App\Enums\OrderStatus::Confirmed])->count() : 0;
        $totalOrdersCount = $buyerOrdersCount + $sellerOrdersCount;
    @endphp

    <header class="border-b border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <a href="{{ route('landing') }}" wire:navigate class="flex items-center gap-2">
                    <div class="bg-primary p-1.5 flex items-center justify-center rounded-[12px]">
                        <span class="material-symbols-outlined text-slate-900">shopping_bag</span>
                    </div>
                    <h1 class="text-xl font-bold tracking-tight text-slate-900 dark:text-slate-100">CampusHub</h1>
                </a>
            </div>
            
            <!-- NAVBAR LENGKAP -->
            <nav class="hidden md:flex items-center gap-8">
                <a class="text-sm font-medium hover:text-primary transition-colors" href="{{ route('landing') }}" wire:navigate>Home</a>
                <a class="text-sm font-medium hover:text-primary transition-colors" href="{{ route('products') }}" wire:navigate>Produk</a>
                @auth
                    <a class="text-sm font-medium hover:text-primary transition-colors" href="{{ route('my-products') }}" wire:navigate>Produk Saya</a>
                    <a class="text-sm font-medium hover:text-primary transition-colors flex items-center gap-1" href="{{ route('cart') }}" wire:navigate>
                        <span>Keranjang</span>
                        @if($cartCount > 0)
                            <span class="bg-primary text-slate-900 text-[10px] px-1.5 py-0.5 rounded-full font-bold">{{ $cartCount }}</span>
                        @endif
                    </a>
                    <a class="text-sm font-medium hover:text-primary transition-colors flex items-center gap-1" href="{{ route('my-orders') }}" wire:navigate title="Beli: {{ $buyerOrdersCount }} | Jual: {{ $sellerOrdersCount }}">
                        <span>Pesanan</span>
                        @if($totalOrdersCount > 0)
                            <span class="bg-primary text-slate-900 text-[10px] px-1.5 py-0.5 rounded-full font-bold">{{ $totalOrdersCount }}</span>
                        @endif
                    </a>
                    <a class="text-sm font-medium hover:text-primary transition-colors flex items-center gap-1" href="{{ route('messages') }}" wire:navigate>
                        <span>Pesan</span>
                        @if($unreadCount > 0)
                            <span class="bg-primary text-slate-900 text-[10px] px-1.5 py-0.5 rounded-full font-bold">{{ $unreadCount }}</span>
                        @endif
                    </a>
                @endauth
            </nav>

            <div class="flex items-center gap-4">
                <!-- BAGIAN PROFIL USER (DINAMIS DENGAN DROPDOWN) -->
                <div class="flex items-center gap-3 pl-4 border-l border-slate-200 dark:border-slate-800 ml-2">
                    
                    {{-- JIKA USER BELUM LOGIN --}}
                    @guest
                        <a href="{{ route('login') }}" wire:navigate class="text-sm font-bold text-slate-700 dark:text-slate-300 hover:text-primary transition-colors">Masuk</a>
                        <a href="{{ route('register') }}" wire:navigate class="hidden sm:block bg-primary text-slate-900 text-sm font-bold py-2 px-4 rounded-[12px] hover:opacity-90 transition-opacity">Daftar</a>
                    @endguest

                    {{-- JIKA USER SUDAH LOGIN --}}
                    @auth
                        <div x-data="{ open: false }" class="relative flex items-center gap-3">
                            <div class="text-right hidden sm:block">
                                <p class="text-sm font-bold text-slate-900 dark:text-slate-100 leading-none">{{ auth()->user()->name }}</p>
                                <p class="text-[10px] text-slate-500 uppercase font-bold tracking-wider mt-1">
                                    {{ auth()->user()->role ? auth()->user()->role->label() : 'Mahasiswa' }}
                                </p>
                            </div>
                            
                            <!-- Tombol Avatar Trigger -->
                            <button @click="open = !open" @click.away="open = false" class="w-10 h-10 rounded-[12px] overflow-hidden border-2 border-white dark:border-slate-700 shadow-sm focus:outline-none transition-transform active:scale-95">
                                <img alt="{{ auth()->user()->name }}" class="w-full h-full object-cover" src="{{ auth()->user()->avatar_url }}"/>
                            </button>

                            <!-- Menu Dropdown Melayang -->
                            <div x-show="open" 
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 top-12 mt-2 w-48 bg-white dark:bg-slate-800 rounded-[12px] shadow-lg border border-slate-100 dark:border-slate-700 py-1 z-50"
                                 style="display: none;">
                                
                                <div class="px-4 py-2 border-b border-slate-100 dark:border-slate-700 block sm:hidden">
                                    <p class="text-sm font-bold text-slate-900 dark:text-slate-100">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-slate-500">{{ auth()->user()->role ? auth()->user()->role->label() : 'Mahasiswa' }}</p>
                                </div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors border-t border-slate-100 dark:border-slate-700 mt-1">
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endauth

                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow flex items-center justify-center px-4 py-12">
        {{ $slot }}
    </main>

    <footer class="bg-white dark:bg-background-dark border-t border-slate-200 dark:border-slate-800 pt-12 pb-8 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-8">
                <div class="col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="bg-primary p-1.5 rounded-[12px]">
                            <span class="material-symbols-outlined text-slate-900 text-sm">shopping_bag</span>
                        </div>
                        <span class="font-bold text-lg">CampusHub</span>
                    </div>
                    <p class="text-slate-500 dark:text-slate-400 text-sm max-w-xs">
                        Platform jual beli aman dan terpercaya khusus untuk mahasiswa dan civitas akademika di kampus Anda.
                    </p>
                </div>
                <div>
                    <h4 class="font-bold mb-4 text-sm uppercase tracking-wider">Link Populer</h4>
                    <ul class="space-y-2 text-sm text-slate-500 dark:text-slate-400">
                        <li><a class="hover:text-primary" href="{{ route('products') }}" wire:navigate>Buku Perkuliahan</a></li>
                        <li><a class="hover:text-primary" href="{{ route('products') }}" wire:navigate>Elektronik &amp; Laptop</a></li>
                        <li><a class="hover:text-primary" href="{{ route('products') }}" wire:navigate>Perlengkapan Kost</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4 text-sm uppercase tracking-wider">Tentang</h4>
                    <ul class="space-y-2 text-sm text-slate-500 dark:text-slate-400">
                        <li><a class="hover:text-primary" href="#">Kebijakan Privasi</a></li>
                        <li><a class="hover:text-primary" href="#">Syarat &amp; Ketentuan</a></li>
                        <li><a class="hover:text-primary" href="#">Kontak Kami</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-slate-100 dark:border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-xs text-slate-400">© 2026 CampusHub. Dibuat dengan bangga untuk Mahasiswa.</p>
                <div class="flex gap-6">
                    <a class="text-slate-400 hover:text-primary" href="#"><span class="material-symbols-outlined text-xl">language</span></a>
                    <a class="text-slate-400 hover:text-primary" href="#"><span class="material-symbols-outlined text-xl">mail</span></a>
                    <a class="text-slate-400 hover:text-primary" href="#"><span class="material-symbols-outlined text-xl">help</span></a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>