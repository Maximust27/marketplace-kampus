<main class="flex-grow w-full max-w-[1200px] mx-auto px-4 sm:px-6 py-8 flex flex-col gap-8 relative">
    
    <!-- Search Bar Area -->
    <div class="flex w-full justify-center w-full">
        <div class="group relative flex w-full max-w-3xl items-center gap-2 rounded-xl border border-outline-variant/30 bg-surface-container-lowest p-2 shadow-sm hover:shadow-md transition-all focus-within:border-primary focus-within:ring-1 focus-within:ring-primary">
            <span class="material-symbols-outlined ml-3 text-on-surface-variant">search</span>
            <input class="w-full border-none bg-transparent px-2 py-2.5 text-base text-on-surface focus:outline-none focus:ring-0 placeholder:text-outline font-body-md" placeholder="Cari buku, elektronik, keperluan kost..." type="text"/>
            <button class="h-full rounded-lg bg-primary px-8 py-2.5 font-label-md text-base font-bold text-slate-900 transition-all hover:opacity-90 active:scale-95">
                Cari
            </button>
        </div>
    </div>

    <!-- Content Split Area (Sidebar + Grid) -->
    <div class="flex flex-col lg:flex-row gap-8 w-full">
        
        <!-- Sidebar Filters -->
        <aside class="w-full lg:w-64 flex-shrink-0 hidden md:block">
            <div class="sticky top-28 bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-outline-variant/30 flex flex-col gap-6">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="font-headline-md text-xl text-on-surface">Filter</h2>
                    <button class="text-primary font-label-md text-sm hover:underline">Reset</button>
                </div>
                <!-- Categories -->
                <div class="border-t border-outline-variant/30 pt-4">
                    <button class="flex items-center justify-between w-full text-left font-label-md text-base text-on-surface mb-3 group">
                        <span>Kategori</span>
                        <span class="material-symbols-outlined text-outline group-hover:text-primary transition-colors">expand_less</span>
                    </button>
                    <div class="flex flex-col gap-3">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input checked="" class="rounded text-primary focus:ring-primary border-outline-variant w-4 h-4" type="checkbox"/>
                            <span class="font-body-md text-sm text-on-surface-variant group-hover:text-primary transition-colors">Semua Kategori</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input class="rounded text-primary focus:ring-primary border-outline-variant w-4 h-4" type="checkbox"/>
                            <span class="font-body-md text-sm text-on-surface-variant group-hover:text-primary transition-colors">Buku &amp; Catatan</span>
                            <span class="ml-auto text-xs text-outline">(45)</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input class="rounded text-primary focus:ring-primary border-outline-variant w-4 h-4" type="checkbox"/>
                            <span class="font-body-md text-sm text-on-surface-variant group-hover:text-primary transition-colors">Elektronik</span>
                            <span class="ml-auto text-xs text-outline">(23)</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input class="rounded text-primary focus:ring-primary border-outline-variant w-4 h-4" type="checkbox"/>
                            <span class="font-body-md text-sm text-on-surface-variant group-hover:text-primary transition-colors">Pakaian &amp; Aksesoris</span>
                            <span class="ml-auto text-xs text-outline">(34)</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input class="rounded text-primary focus:ring-primary border-outline-variant w-4 h-4" type="checkbox"/>
                            <span class="font-body-md text-sm text-on-surface-variant group-hover:text-primary transition-colors">Kebutuhan Kos</span>
                            <span class="ml-auto text-xs text-outline">(22)</span>
                        </label>
                    </div>
                </div>
                <!-- Condition -->
                <div class="border-t border-outline-variant/30 pt-4">
                    <button class="flex items-center justify-between w-full text-left font-label-md text-base text-on-surface mb-3 group">
                        <span>Kondisi</span>
                        <span class="material-symbols-outlined text-outline group-hover:text-primary transition-colors">expand_less</span>
                    </button>
                    <div class="flex flex-col gap-3">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input checked="" class="text-primary focus:ring-primary border-outline-variant w-4 h-4" name="condition" type="radio"/>
                            <span class="font-body-md text-sm text-on-surface-variant group-hover:text-primary transition-colors">Semua Kondisi</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input class="text-primary focus:ring-primary border-outline-variant w-4 h-4" name="condition" type="radio"/>
                            <span class="font-body-md text-sm text-on-surface-variant group-hover:text-primary transition-colors">Baru</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input class="text-primary focus:ring-primary border-outline-variant w-4 h-4" name="condition" type="radio"/>
                            <span class="font-body-md text-sm text-on-surface-variant group-hover:text-primary transition-colors">Bekas (Bagus)</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input class="text-primary focus:ring-primary border-outline-variant w-4 h-4" name="condition" type="radio"/>
                            <span class="font-body-md text-sm text-on-surface-variant group-hover:text-primary transition-colors">Bekas (Layak Pakai)</span>
                        </label>
                    </div>
                </div>
                <!-- Price -->
                <div class="border-t border-outline-variant/30 pt-4">
                    <button class="flex items-center justify-between w-full text-left font-label-md text-base text-on-surface mb-3 group">
                        <span>Harga</span>
                        <span class="material-symbols-outlined text-outline group-hover:text-primary transition-colors">expand_less</span>
                    </button>
                    <div class="flex flex-col gap-4">
                        <div class="flex gap-2 items-center">
                            <div class="relative w-full">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-outline-variant text-sm">Rp</span>
                                <input class="w-full rounded-lg border-outline-variant/50 focus:border-primary focus:ring-primary text-sm py-2 pl-8 pr-2" placeholder="MIN" type="text"/>
                            </div>
                            <span class="text-outline">-</span>
                            <div class="relative w-full">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-outline-variant text-sm">Rp</span>
                                <input class="w-full rounded-lg border-outline-variant/50 focus:border-primary focus:ring-primary text-sm py-2 pl-8 pr-2" placeholder="MAX" type="text"/>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Rating -->
                <div class="border-t border-outline-variant/30 pt-4">
                    <button class="flex items-center justify-between w-full text-left font-label-md text-base text-on-surface mb-3 group">
                        <span>Penilaian Penjual</span>
                        <span class="material-symbols-outlined text-outline group-hover:text-primary transition-colors">expand_less</span>
                    </button>
                    <div class="flex flex-col gap-2">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input class="rounded text-primary focus:ring-primary border-outline-variant w-4 h-4" type="checkbox"/>
                            <div class="flex items-center gap-1 text-yellow-400">
                                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="text-sm text-on-surface-variant ml-1 font-body-md">Ke atas</span>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input class="rounded text-primary focus:ring-primary border-outline-variant w-4 h-4" type="checkbox"/>
                            <div class="flex items-center gap-1 text-yellow-400">
                                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-[18px] text-gray-300" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="text-sm text-on-surface-variant ml-1 font-body-md">Ke atas</span>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Product Grid Area -->
        <div class="flex-grow flex flex-col gap-6">
            <!-- Breadcrumbs & Title -->
            <div>
                <div class="flex items-center gap-2 text-sm text-on-surface-variant mb-2">
                    <a class="hover:text-primary" href="{{ route('landing') }}" wire:navigate>Beranda</a>
                    <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                    <span class="text-on-surface font-medium">Semua Produk</span>
                </div>
                <h1 class="font-headline-md text-2xl text-on-surface">Semua Produk</h1>
            </div>

            <!-- Top Bar Actions -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center bg-surface-container-lowest p-3 sm:p-4 rounded-xl shadow-sm border border-outline-variant/30 gap-4">
                <span class="font-body-md text-sm text-on-surface-variant">Menampilkan <strong class="text-primary">1 - 24</strong> dari <strong>124</strong> Produk</span>
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <button class="md:hidden flex items-center gap-2 px-4 py-2 border border-outline-variant/50 rounded-lg text-sm font-label-md">
                        <span class="material-symbols-outlined text-[18px]">filter_list</span> Filter
                    </button>
                    <div class="flex items-center gap-2 ml-auto sm:ml-0">
                        <span class="font-label-md text-sm text-on-surface-variant hidden sm:inline">Urutkan:</span>
                        <select class="rounded-lg border-outline-variant/50 focus:border-primary focus:ring-primary text-sm py-2 pl-3 pr-10 bg-transparent cursor-pointer font-body-md">
                            <option>Paling Sesuai</option>
                            <option>Terbaru</option>
                            <option>Harga Tertinggi</option>
                            <option>Harga Terendah</option>
                            <option>Ulasan Terbanyak</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Grid -->
            <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
                <!-- Card 1 -->
                <div class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-md border border-outline-variant/30 hover:border-primary/50 transition-all duration-300 flex flex-col relative">
                    <div class="relative aspect-[4/3] overflow-hidden bg-surface-container">
                        <a href="{{ route('detail-product') }}" wire:navigate>
                            <img alt="Buku Kalkulus" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCZvxGBZT_nl6ckK5UIkacreBQWQ0eeOLSO_epnsGAxZgbwMO81rAt1C7zLEYYa4DuTqQ1dh_W96-TOpEyXk5FZ9p7YceM5O69F69vzWCgaw39VzdCnE84XpOw9dQ2k0m7E5MPZj6yfCqVUFsuFsi_qCqpVa1XlkjlbyoACPAcH6BeiAQbxaZiwN5oZCigVG-oP0lh5XiHBO4KKWRPunF-9FkCk3I2KF_quOXXU7GQX9vKjiolCzvnRRwU_v1kj0Sp_xRs214lx0ak"/>
                        </a>
                        <button class="absolute top-2 right-2 w-8 h-8 rounded-full bg-surface-container-lowest/90 backdrop-blur-md flex items-center justify-center text-outline hover:text-error hover:bg-error-container transition-colors duration-200 z-10 shadow-sm">
                            <span class="material-symbols-outlined text-[20px]">favorite</span>
                        </button>
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-3 pt-8">
                            <div class="inline-flex items-center gap-1 bg-white px-2 py-0.5 rounded shadow-sm text-xs font-bold text-black">
                                <span class="material-symbols-outlined text-[14px] text-yellow-400" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span>4.8</span>
                                <span class="text-gray-300">|</span>
                                <span class="text-gray-600 font-medium">Terjual 12</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 sm:p-4 flex flex-col flex-grow">
                        <h4 class="font-body-md text-sm sm:text-base leading-tight text-on-surface mb-1 group-hover:text-primary transition-colors line-clamp-2 min-h-[40px]">
                            <a href="{{ route('detail-product') }}" wire:navigate>Buku Kalkulus Purcell Edisi 9 (Bekas Sangat Bagus)</a>
                        </h4>
                        <div class="font-headline-md text-lg sm:text-xl text-primary font-bold mb-2">Rp 120.000</div>
                        <div class="mt-auto flex flex-col gap-1.5">
                            <div class="flex items-center gap-1 text-on-surface-variant text-xs">
                                <span class="material-symbols-outlined text-[14px] text-primary">storefront</span>
                                <span class="truncate">Toko Mahasiswa MIPA</span>
                            </div>
                            <div class="flex items-center gap-1 text-outline text-xs">
                                <span class="material-symbols-outlined text-[14px]">location_on</span>
                                <span>FMIPA</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-md border border-outline-variant/30 hover:border-primary/50 transition-all duration-300 flex flex-col relative">
                    <div class="relative aspect-[4/3] overflow-hidden bg-surface-container">
                        <img alt="Jas Laboratorium" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBGue6mQZXFgJNs6jkPp3bxmjNCx1BCDhUZz-FSrxiCCzbgzRaGUCFRKd2LBHwExv1LvAu5FEhjqGvL0pXWSM4-sOKPYQZIfnEhUgiQTbP3IofQ3OCup6ea_oi-ras4g_o-SnQi8KPuNfdO8GzYARjdR0WQISvlc8m2JiacF39CiV68_75jFfyUWhastl22d8E7ae20dK2gvSbQSynlnp-T-f8VNxTNquzOdcI8kmCWf8fwpKEzLGr-9Xt0ETnQYEZDGuLmocaTkQA"/>
                        <button class="absolute top-2 right-2 w-8 h-8 rounded-full bg-surface-container-lowest/90 backdrop-blur-md flex items-center justify-center text-outline hover:text-error hover:bg-error-container transition-colors duration-200 z-10 shadow-sm">
                            <span class="material-symbols-outlined text-[20px]">favorite</span>
                        </button>
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-3 pt-8">
                            <div class="inline-flex items-center gap-1 bg-white px-2 py-0.5 rounded shadow-sm text-xs font-bold text-black">
                                <span class="material-symbols-outlined text-[14px] text-yellow-400" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span>5.0</span>
                                <span class="text-gray-300">|</span>
                                <span class="text-gray-600 font-medium">Terjual 45</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 sm:p-4 flex flex-col flex-grow">
                        <h4 class="font-body-md text-sm sm:text-base leading-tight text-on-surface mb-1 group-hover:text-primary transition-colors line-clamp-2 min-h-[40px]">Jas Laboratorium Praktikum Size L - Bahan Tebal</h4>
                        <div class="flex items-center gap-2 mb-2">
                            <div class="font-headline-md text-lg sm:text-xl text-primary font-bold">Rp 85.000</div>
                        </div>
                        <div class="mt-auto flex flex-col gap-1.5">
                            <div class="flex items-center gap-1 text-on-surface-variant text-xs">
                                <span class="material-symbols-outlined text-[14px] text-primary">storefront</span>
                                <span class="truncate">Teknik Apparel</span>
                            </div>
                            <div class="flex items-center gap-1 text-outline text-xs">
                                <span class="material-symbols-outlined text-[14px]">location_on</span>
                                <span>Fakultas Teknik</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-md border border-outline-variant/30 hover:border-primary/50 transition-all duration-300 flex flex-col relative">
                    <div class="relative aspect-[4/3] overflow-hidden bg-surface-container">
                        <img alt="Kamera DSLR" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC7o865oCn8o2Z01rxNoQfPz0JzDgr5MmONp2onY5BgE_CWOHmV0h6uRKaRUG0iAphSLHBKYPI6_QHEKECdciyFA11uK9k2ungk85Ejdh60gCiCSSSTHnEYy-8G6KgPR5jT13HH1YXeRA49fTNQnDRSFBH0-Cq3WHtaoccswSx4We7sLcGvGzgqBZuc7F-wkNtTtbht7t91FgzJ5YiClDcDjf-WK_CVDDU1InKq-vSmOOUS8MpgIA5nh6tzYSBNiUnewPd6vqPsgFI"/>
                        <button class="absolute top-2 right-2 w-8 h-8 rounded-full bg-surface-container-lowest/90 backdrop-blur-md flex items-center justify-center text-outline hover:text-error hover:bg-error-container transition-colors duration-200 z-10 shadow-sm">
                            <span class="material-symbols-outlined text-[20px]">favorite</span>
                        </button>
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-3 pt-8">
                            <div class="inline-flex items-center gap-1 bg-white px-2 py-0.5 rounded shadow-sm text-xs font-bold text-black">
                                <span class="material-symbols-outlined text-[14px] text-yellow-400" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span>4.9</span>
                                <span class="text-gray-300">|</span>
                                <span class="text-gray-600 font-medium">Terjual 3</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 sm:p-4 flex flex-col flex-grow">
                        <h4 class="font-body-md text-sm sm:text-base leading-tight text-on-surface mb-1 group-hover:text-primary transition-colors line-clamp-2 min-h-[40px]">Kamera Canon EOS 600D + Lensa Kit 18-55mm</h4>
                        <div class="font-headline-md text-lg sm:text-xl text-primary font-bold mb-2">Rp 2.500.000</div>
                        <div class="mt-auto flex flex-col gap-1.5">
                            <div class="flex items-center gap-1 text-on-surface-variant text-xs">
                                <span class="material-symbols-outlined text-[14px] text-primary">storefront</span>
                                <span class="truncate">Gudang Kamera Kampus</span>
                            </div>
                            <div class="flex items-center gap-1 text-outline text-xs">
                                <span class="material-symbols-outlined text-[14px]">location_on</span>
                                <span>Perpustakaan Pusat</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-md border border-outline-variant/30 hover:border-primary/50 transition-all duration-300 flex flex-col relative">
                    <div class="relative aspect-[4/3] overflow-hidden bg-surface-container">
                        <img alt="Kamera Polaroid" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAG2_Z94TmovbWrbkhohNPFnCvZ8Ny7wFcrTpIOBy9MnFi-qx5ynAxKGM7478x8Tnpf0OzIaqedJNKC13gJwu27rC5DpmAUvr2awKd1wBg3lkTa7O-xZ_kLuBSVRueALH-IHWOo8It_4xXDJBvibkA6NNVU6L_zMJ3RdKTClOBXxFGkKnj4rIUArEPuPsfRqWJQehQIRQsYpgr3F_uaU8b6FLd2m8WUohQkj5v1OE6dVWH06J9RwSBbraZ1EfWswNT7EPrkj_IcYHE"/>
                        <button class="absolute top-2 right-2 w-8 h-8 rounded-full bg-surface-container-lowest/90 backdrop-blur-md flex items-center justify-center text-outline hover:text-error hover:bg-error-container transition-colors duration-200 z-10 shadow-sm">
                            <span class="material-symbols-outlined text-[20px]">favorite</span>
                        </button>
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-3 pt-8">
                            <div class="inline-flex items-center gap-1 bg-white px-2 py-0.5 rounded shadow-sm text-xs font-bold text-black">
                                <span class="material-symbols-outlined text-[14px] text-yellow-400" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span>4.7</span>
                                <span class="text-gray-300">|</span>
                                <span class="text-gray-600 font-medium">Terjual 8</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 sm:p-4 flex flex-col flex-grow">
                        <h4 class="font-body-md text-sm sm:text-base leading-tight text-on-surface mb-1 group-hover:text-primary transition-colors line-clamp-2 min-h-[40px]">Polaroid Instax Mini 11 (Mulus 95%)</h4>
                        <div class="font-headline-md text-lg sm:text-xl text-primary font-bold mb-2">Rp 850.000</div>
                        <div class="mt-auto flex flex-col gap-1.5">
                            <div class="flex items-center gap-1 text-on-surface-variant text-xs">
                                <span class="material-symbols-outlined text-[14px] text-primary">storefront</span>
                                <span class="truncate">Anak Kos Jualan</span>
                            </div>
                            <div class="flex items-center gap-1 text-outline text-xs">
                                <span class="material-symbols-outlined text-[14px]">location_on</span>
                                <span>Gedung Rektorat</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-md border border-outline-variant/30 hover:border-primary/50 transition-all duration-300 flex flex-col relative">
                    <div class="relative aspect-[4/3] overflow-hidden bg-surface-container">
                        <img alt="Kacamata" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDhKg072DnXLQTzMfiDkpeeix8EIVBdjpOkvExJEB9FWA39MJmmy-UfQa6wFtza7maYpqOAKihGsqAtjHXeiA8pQLudStv8_zMBGVexLFTi15mKJrK1CeAISAVBJYtn03JqRldahHIW7BQU5gbLQPtbmEsHoeib0KIfjNaeSahxiXXAyCBLAXIvGf5andqZFRQhLkFBYuNkgWH-sK0TVWk5HdkOKMuHFj1N6coL6r3Pj6JK7wqM_EMfY1OGi6UhBg7qSAYyVOY6qYc"/>
                        <button class="absolute top-2 right-2 w-8 h-8 rounded-full bg-surface-container-lowest/90 backdrop-blur-md flex items-center justify-center text-outline hover:text-error hover:bg-error-container transition-colors duration-200 z-10 shadow-sm">
                            <span class="material-symbols-outlined text-[20px]">favorite</span>
                        </button>
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-3 pt-8">
                            <div class="inline-flex items-center gap-1 bg-white px-2 py-0.5 rounded shadow-sm text-xs font-bold text-black">
                                <span class="material-symbols-outlined text-[14px] text-yellow-400" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span>4.5</span>
                                <span class="text-gray-300">|</span>
                                <span class="text-gray-600 font-medium">Terjual 56</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 sm:p-4 flex flex-col flex-grow">
                        <h4 class="font-body-md text-sm sm:text-base leading-tight text-on-surface mb-1 group-hover:text-primary transition-colors line-clamp-2 min-h-[40px]">Kacamata Anti Radiasi (Frame Hitam Minimalis)</h4>
                        <div class="font-headline-md text-lg sm:text-xl text-primary font-bold mb-2">Rp 50.000</div>
                        <div class="mt-auto flex flex-col gap-1.5">
                            <div class="flex items-center gap-1 text-on-surface-variant text-xs">
                                <span class="material-symbols-outlined text-[14px] text-primary">storefront</span>
                                <span class="truncate">Optik Mahasiswa</span>
                            </div>
                            <div class="flex items-center gap-1 text-outline text-xs">
                                <span class="material-symbols-outlined text-[14px]">location_on</span>
                                <span>Kantin Utama</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-md border border-outline-variant/30 hover:border-primary/50 transition-all duration-300 flex flex-col relative">
                    <div class="relative aspect-[4/3] overflow-hidden bg-surface-container">
                        <img alt="Tas Ransel" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBPRlaMLKArLOekr3DGQsTSK0FEQQMIwBRQzBwwmBlMc7Jo-pCnMGiFZvuA-GlBEN6VJFctCnoMhhKRnR36FkjvjtmpP_Rgp-CM6e-Ft3u7aSVX99mXSGBClwbsbuTw8hkBGVTT7aG2b_-3QLhyoHrIWF6Uh965ji6-op6dWFff03F49I9IG3qKTNUZ0K5bJhQfmOfqkIqGaum7xOVpwWhlidyFdB2LwghgD8zAwFk7_aEynWSGlhDw6wYU5JBXJpjpAkky1WjVbR8"/>
                        <div class="absolute top-2 left-2 bg-primary-container text-on-primary-container px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider z-10 shadow-sm">Baru</div>
                        <button class="absolute top-2 right-2 w-8 h-8 rounded-full bg-surface-container-lowest/90 backdrop-blur-md flex items-center justify-center text-outline hover:text-error hover:bg-error-container transition-colors duration-200 z-10 shadow-sm">
                            <span class="material-symbols-outlined text-[20px]">favorite</span>
                        </button>
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-3 pt-8">
                            <div class="inline-flex items-center gap-1 bg-white px-2 py-0.5 rounded shadow-sm text-xs font-bold text-black">
                                <span class="material-symbols-outlined text-[14px] text-yellow-400" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span>4.8</span>
                                <span class="text-gray-300">|</span>
                                <span class="text-gray-600 font-medium">Terjual 28</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 sm:p-4 flex flex-col flex-grow">
                        <h4 class="font-body-md text-sm sm:text-base leading-tight text-on-surface mb-1 group-hover:text-primary transition-colors line-clamp-2 min-h-[40px]">Tas Ransel Kuliah Kapasitas Besar - Kanvas</h4>
                        <div class="font-headline-md text-lg sm:text-xl text-primary font-bold mb-2">Rp 150.000</div>
                        <div class="mt-auto flex flex-col gap-1.5">
                            <div class="flex items-center gap-1 text-on-surface-variant text-xs">
                                <span class="material-symbols-outlined text-[14px] text-primary">storefront</span>
                                <span class="truncate">Tas Kekinian ID</span>
                            </div>
                            <div class="flex items-center gap-1 text-outline text-xs">
                                <span class="material-symbols-outlined text-[14px]">location_on</span>
                                <span>Fakultas Ekonomi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination / Load More -->
            <div class="flex justify-center mt-10 mb-8">
                <div class="flex items-center gap-2">
                    <button class="w-10 h-10 rounded-full border border-outline-variant flex items-center justify-center text-outline hover:border-primary hover:text-primary transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </button>
                    <button class="w-10 h-10 rounded-full bg-primary text-slate-900 font-bold text-sm flex items-center justify-center shadow-sm">1</button>
                    <button class="w-10 h-10 rounded-full border border-outline-variant text-on-surface font-bold text-sm flex items-center justify-center hover:bg-surface-container transition-colors">2</button>
                    <button class="w-10 h-10 rounded-full border border-outline-variant text-on-surface font-bold text-sm flex items-center justify-center hover:bg-surface-container transition-colors">3</button>
                    <span class="text-outline">...</span>
                    <button class="w-10 h-10 rounded-full border border-outline-variant text-on-surface font-bold text-sm flex items-center justify-center hover:bg-surface-container transition-colors">6</button>
                    <button class="w-10 h-10 rounded-full border border-outline-variant flex items-center justify-center text-on-surface hover:border-primary hover:text-primary transition-colors">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </button>
                </div>
            </div>
        </div>
        
    </div> <!-- Tutup Content Split Area -->
    
</main>