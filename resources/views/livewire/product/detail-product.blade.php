<main class="flex-grow w-full max-w-7xl mx-auto px-6 py-8">
    <!-- Breadcrumbs -->
    <nav aria-label="Breadcrumb" class="flex text-slate-500 text-sm mb-8 space-x-2 items-center">
        <a class="hover:text-primary transition-colors font-medium" href="{{ route('landing') }}" wire:navigate>Beranda</a>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <a class="hover:text-primary transition-colors font-medium" href="{{ route('products') }}" wire:navigate>Semua Produk</a>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <span class="text-primary font-bold">Detail Produk</span>
    </nav>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 mb-16">
        
        <!-- Left Column: Image Gallery (Span 5) -->
        <div class="lg:col-span-5 flex flex-col gap-4">
            <!-- Main Image -->
            <div class="w-full aspect-square rounded-2xl overflow-hidden shadow-sm relative group bg-slate-100 dark:bg-slate-800">
                <img alt="Detail Produk" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" 
                     src="https://lh3.googleusercontent.com/aida-public/AB6AXuAkc1ZStZaI8HA6WyvcoYeRrVQcV_BRsGg_0FR6KdLeDpCuzv-S7xsIVYfyceHTaIgyhK1bJq_Y30GJ_h2G10o9iFp9fbgbt87cA9yk0F1X_B7eLKE-RCgspGM5kOTNmYr3ehGuYmcWuZDe9ngjLUEzIVYKmpzpcqFapDB4wIAlupKl7dcpJ3f6_tVRbBOKCAz1Zel7XFTwk2YxiBXnX-RmQ2XLocNgb-3lAHiuTzvlNlxrGab3660_RIvrAW65MgqqixDKkJ_VFDQ"/>
                
                <button class="absolute top-4 right-4 w-10 h-10 flex items-center justify-center rounded-full bg-white/80 dark:bg-slate-900/80 backdrop-blur text-slate-600 hover:text-red-500 transition-colors shadow-sm z-10">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 0;">favorite</span>
                </button>
            </div>
        </div>

        <!-- Middle Column: Product Info (Span 4) -->
        <div class="lg:col-span-4 flex flex-col">
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white leading-tight mb-3">Buku Kalkulus Purcell Edisi 9</h1>
            
            <!-- Rating & Sold -->
            <div class="flex items-center gap-2 mb-5">
                <div class="flex text-amber-400">
                    @for ($i = 0; $i < 5; $i++)
                        <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
                    @endfor
                </div>
                <span class="text-slate-500 text-sm font-medium">4.8 (24 Ulasan)</span>
                <span class="text-slate-300 mx-1">•</span>
                <span class="text-slate-500 text-sm font-medium">15 Terjual</span>
            </div>

            <p class="text-3xl font-extrabold text-primary mb-6">Rp 125.000</p>

            <div class="flex items-center gap-3 mb-6 border-b border-slate-100 dark:border-slate-800 pb-6">
                <span class="bg-primary/10 text-primary px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider">
                    Bekas - Seperti Baru
                </span>
                <span class="text-slate-500 text-sm flex items-center">
                    <span class="material-symbols-outlined text-sm mr-1">schedule</span> 2 jam yang lalu
                </span>
            </div>

            <!-- Description Tabs -->
            <div class="mb-8">
                <div class="flex gap-6 border-b border-slate-100 dark:border-slate-800 mb-5">
                    <button wire:click="$set('activeTab', 'deskripsi')" 
                            class="pb-3 text-sm font-bold transition-all {{ $activeTab === 'deskripsi' ? 'text-primary border-b-2 border-primary' : 'text-slate-500 hover:text-slate-700' }}">
                        Deskripsi
                    </button>
                    <button wire:click="$set('activeTab', 'spesifikasi')" 
                            class="pb-3 text-sm font-bold transition-all {{ $activeTab === 'spesifikasi' ? 'text-primary border-b-2 border-primary' : 'text-slate-500 hover:text-slate-700' }}">
                        Spesifikasi
                    </button>
                    <button wire:click="$set('activeTab', 'penjual')" 
                            class="pb-3 text-sm font-bold transition-all {{ $activeTab === 'penjual' ? 'text-primary border-b-2 border-primary' : 'text-slate-500 hover:text-slate-700' }}">
                        penjual
                    </button>
                </div>
                
                <div class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                    @if($activeTab === 'deskripsi')
                        Buku Kalkulus Edisi 9 karya Purcell, Varberg, dan Rigdon. Kondisi masih sangat mulus, tidak ada coretan, halaman lengkap. Cocok untuk mahasiswa TPB/Tingkat 1 teknik atau MIPA. Dijual karena sudah lulus mata kuliah.
                    @elseif($activeTab === 'spesifikasi')
                        <ul class="space-y-2">
                            <li><span class="font-bold">Penulis:</span> Purcell, Varberg, Rigdon</li>
                            <li><span class="font-bold">Edisi:</span> Ke-9</li>
                            <li><span class="font-bold">Bahasa:</span> Indonesia</li>
                        </ul>
                    @elseif($activeTab === 'penjual')
                        <div class="flex items-center gap-4">
                            <img alt="Seller" class="w-16 h-16 rounded-full object-cover border-2 border-white dark:border-slate-700" src="https://ui-avatars.com/api/?name=Budi+Santoso&background=0df2f2&color=102222&bold=true"/>
                            <div>
                                <h4 class="font-bold text-slate-900 dark:text-white">Budi Santoso</h4>
                                <p class="text-sm text-slate-500">Mahasiswa Teknik • Aktif 2j lalu</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column: Buy Box (Span 3) -->
        <div class="lg:col-span-3">
            <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-800 sticky top-24">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-5">Atur Pesanan</h3>
                
                <!-- Quantity Selector -->
                <div class="flex items-center justify-between mb-6">
                    <span class="text-sm font-medium text-slate-600 dark:text-slate-400">Kuantitas</span>
                    <div class="flex items-center border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                        <button wire:click="decrement" class="px-3 py-1.5 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-300 disabled:opacity-30" {{ $quantity <= 1 ? 'disabled' : '' }}>-</button>
                        <span class="w-10 text-center font-bold text-sm">{{ $quantity }}</span>
                        <button wire:click="increment" class="px-3 py-1.5 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-300">+</button>
                    </div>
                </div>
                
                <p class="text-xs text-slate-400 mb-6 text-right font-medium">Stok Tersedia: 1</p>

                <!-- Total Price -->
                <div class="flex justify-between items-center mb-6 pt-4 border-t border-slate-50 dark:border-slate-800">
                    <span class="text-sm text-slate-500">Subtotal</span>
                    <span class="text-xl font-black text-slate-900 dark:text-white">Rp {{ number_format($productPrice * $quantity, 0, ',', '.') }}</span>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col gap-3">
                    <button class="w-full bg-primary text-slate-900 font-black py-4 rounded-xl shadow-lg shadow-primary/20 hover:brightness-110 active:scale-95 transition-all">
                        Beli Langsung
                    </button>
                    <button class="w-full bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white border border-slate-200 dark:border-slate-700 font-bold py-4 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-700 transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">chat</span> Chat Penjual
                    </button>
                </div>

                <!-- Trust Signals -->
                <div class="mt-6 space-y-3 pt-6 border-t border-slate-50 dark:border-slate-800">
                    <div class="flex items-center text-[11px] text-slate-500 font-bold uppercase tracking-wider">
                        <span class="material-symbols-outlined text-primary text-[18px] mr-2">local_shipping</span>
                        Bisa COD di Area Kampus
                    </div>
                    <div class="flex items-center text-[11px] text-slate-500 font-bold uppercase tracking-wider">
                        <span class="material-symbols-outlined text-primary text-[18px] mr-2">verified_user</span>
                        Garansi Aman CampusHub
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products Section -->
    <section class="mt-12 border-t border-slate-100 dark:border-slate-800 pt-12">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-2xl font-black text-slate-900 dark:text-white">Produk Serupa</h2>
                <p class="text-slate-500 text-sm">Mungkin kamu juga butuh ini</p>
            </div>
            <a class="text-primary font-bold text-sm hover:underline flex items-center gap-1" href="#">
                Lihat Semua <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <!-- Card Dummy 1 -->
            <div class="group flex flex-col h-full">
                <div class="relative aspect-[4/3] bg-slate-100 dark:bg-slate-800 rounded-2xl overflow-hidden mb-3 border border-slate-100 dark:border-slate-800">
                    <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD939VIFIgrvw1Ya5myMNyXhq0h7aIMlTlypCvFWBchGjzk_oIWzL16c3rfmMBNw1maQLUExbBxeNwC5lfhI6kxPXIhJ0UegVB3BmkyRjOAHM14mPwhQ1ba-GGCwF3xoFNx4BOS8jrG9p3zbBLVcxlfdlJdXmYyDD4gliXFTxFF9wCuxwEFqkgZ3v_Z7C7D2UOF3uWpxwLfPnvX39ee1vNYrBXEkI_cHjRIJT6ufacbiIhJvdUMcEp30W68IgJgRzGlrXx8PjcdlkY"/>
                    <div class="absolute bottom-2 left-2 bg-black/50 backdrop-blur-md text-white text-[10px] font-bold px-2 py-0.5 rounded">Bekas</div>
                </div>
                <h3 class="font-bold text-slate-900 dark:text-white text-sm line-clamp-2">Fisika Dasar Halliday Edisi 10 Jilid 1</h3>
                <p class="text-primary font-black mt-1">Rp 110.000</p>
                <div class="mt-2 flex items-center gap-1 text-slate-400 text-[10px] font-bold uppercase tracking-tight">
                    <span class="material-symbols-outlined text-[14px]">location_on</span> Fakultas Teknik
                </div>
            </div>
            
            <!-- Card Dummy 2 (Lanjutkan card lain sesuai kebutuhan) -->
        </div>
    </section>
</main>