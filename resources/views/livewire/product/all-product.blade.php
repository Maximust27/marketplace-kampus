<main class="flex-grow w-full max-w-[1200px] mx-auto px-4 sm:px-6 py-8 flex flex-col gap-8 relative">
    
    <!-- Search Bar Area -->
    <div class="flex w-full justify-center">
        <div class="group relative flex w-full max-w-3xl items-center gap-2 rounded-xl border border-outline-variant/30 bg-surface-container-lowest p-2 shadow-sm hover:shadow-md transition-all focus-within:border-primary focus-within:ring-1 focus-within:ring-primary">
            <span class="material-symbols-outlined ml-3 text-on-surface-variant">search</span>
            <input wire:model.live.debounce.300ms="search" class="w-full border-none bg-transparent px-2 py-2.5 text-base text-on-surface focus:outline-none focus:ring-0 placeholder:text-outline font-body-md" placeholder="Cari buku, elektronik, keperluan kost..." type="text"/>
            @if($search)
                <button wire:click="$set('search', '')" class="text-slate-400 hover:text-slate-600 p-1 mr-1">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            @endif
        </div>
    </div>

    <!-- Content Split Area (Sidebar + Grid) -->
    <div class="flex flex-col lg:flex-row gap-8 w-full">
        
        <!-- Sidebar Filters -->
        <aside class="w-full lg:w-64 flex-shrink-0 hidden md:block">
            <div class="sticky top-28 bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-outline-variant/30 flex flex-col gap-6">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="font-headline-md text-xl text-on-surface font-bold">Filter</h2>
                    <button wire:click="resetFilters" class="text-primary font-label-md text-sm hover:underline font-bold">Reset</button>
                </div>
                
                <!-- Categories -->
                <div class="border-t border-outline-variant/30 pt-4">
                    <div class="flex items-center justify-between w-full text-left font-label-md text-base text-on-surface mb-3 group">
                        <span class="font-bold">Kategori</span>
                    </div>
                    <div class="flex flex-col gap-3">
                        @foreach($categories as $cat)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input value="{{ $cat->id }}" wire:model.live="selectedCategories" class="rounded text-primary focus:ring-primary border-outline-variant w-4 h-4" type="checkbox"/>
                                <span class="font-body-md text-sm text-on-surface-variant group-hover:text-primary transition-colors">{{ $cat->name }}</span>
                                <span class="ml-auto text-xs text-outline">({{ $cat->products_count }})</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Condition -->
                <div class="border-t border-outline-variant/30 pt-4">
                    <div class="flex items-center justify-between w-full text-left font-label-md text-base text-on-surface mb-3 group">
                        <span class="font-bold">Kondisi</span>
                    </div>
                    <div class="flex flex-col gap-3">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input value="" wire:model.live="condition" class="text-primary focus:ring-primary border-outline-variant w-4 h-4" name="condition" type="radio"/>
                            <span class="font-body-md text-sm text-on-surface-variant group-hover:text-primary transition-colors">Semua Kondisi</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input value="new" wire:model.live="condition" class="text-primary focus:ring-primary border-outline-variant w-4 h-4" name="condition" type="radio"/>
                            <span class="font-body-md text-sm text-on-surface-variant group-hover:text-primary transition-colors">Baru</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input value="used_good" wire:model.live="condition" class="text-primary focus:ring-primary border-outline-variant w-4 h-4" name="condition" type="radio"/>
                            <span class="font-body-md text-sm text-on-surface-variant group-hover:text-primary transition-colors">Bekas (Bagus)</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input value="used_normal" wire:model.live="condition" class="text-primary focus:ring-primary border-outline-variant w-4 h-4" name="condition" type="radio"/>
                            <span class="font-body-md text-sm text-on-surface-variant group-hover:text-primary transition-colors">Bekas (Wajar Pakai)</span>
                        </label>
                    </div>
                </div>

                <!-- Price -->
                <div class="border-t border-outline-variant/30 pt-4">
                    <div class="flex items-center justify-between w-full text-left font-label-md text-base text-on-surface mb-3 group">
                        <span class="font-bold">Harga</span>
                    </div>
                    <div class="flex flex-col gap-4">
                        <div class="flex gap-2 items-center">
                            <div class="relative w-full">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-outline-variant text-sm">Rp</span>
                                <input wire:model.live.debounce.500ms="priceMin" class="w-full rounded-lg border-outline-variant/50 focus:border-primary focus:ring-primary text-sm py-2 pl-8 pr-2" placeholder="MIN" type="number"/>
                            </div>
                            <span class="text-outline">-</span>
                            <div class="relative w-full">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-outline-variant text-sm">Rp</span>
                                <input wire:model.live.debounce.500ms="priceMax" class="w-full rounded-lg border-outline-variant/50 focus:border-primary focus:ring-primary text-sm py-2 pl-8 pr-2" placeholder="MAX" type="number"/>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rating -->
                <div class="border-t border-outline-variant/30 pt-4">
                    <div class="flex items-center justify-between w-full text-left font-label-md text-base text-on-surface mb-3 group">
                        <span class="font-bold">Penilaian Min.</span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input value="" wire:model.live="minRating" class="text-primary focus:ring-primary border-outline-variant w-4 h-4" name="minRating" type="radio"/>
                            <span class="font-body-md text-sm text-on-surface-variant group-hover:text-primary transition-colors">Semua Rating</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input value="4.5" wire:model.live="minRating" class="text-primary focus:ring-primary border-outline-variant w-4 h-4" name="minRating" type="radio"/>
                            <div class="flex items-center gap-1 text-yellow-400">
                                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="text-sm text-on-surface-variant ml-1 font-body-md">4.5 Ke atas</span>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input value="4.0" wire:model.live="minRating" class="text-primary focus:ring-primary border-outline-variant w-4 h-4" name="minRating" type="radio"/>
                            <div class="flex items-center gap-1 text-yellow-400">
                                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="text-sm text-on-surface-variant ml-1 font-body-md">4.0 Ke atas</span>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input value="3.0" wire:model.live="minRating" class="text-primary focus:ring-primary border-outline-variant w-4 h-4" name="minRating" type="radio"/>
                            <div class="flex items-center gap-1 text-yellow-400">
                                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="text-sm text-on-surface-variant ml-1 font-body-md">3.0 Ke atas</span>
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
                <h1 class="font-headline-md text-2xl text-on-surface font-bold">Semua Produk</h1>
            </div>

            <!-- Top Bar Actions -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center bg-surface-container-lowest p-3 sm:p-4 rounded-xl shadow-sm border border-outline-variant/30 gap-4">
                <span class="font-body-md text-sm text-on-surface-variant">Menampilkan <strong class="text-primary">{{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }}</strong> dari <strong>{{ $products->total() }}</strong> Produk</span>
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <div class="flex items-center gap-2 ml-auto sm:ml-0">
                        <span class="font-label-md text-sm text-on-surface-variant hidden sm:inline">Urutkan:</span>
                        <select wire:model.live="sortBy" class="rounded-lg border-outline-variant/50 focus:border-primary focus:ring-primary text-sm py-2 pl-3 pr-10 bg-transparent cursor-pointer font-body-md">
                            <option value="newest">Terbaru</option>
                            <option value="price_high">Harga Tertinggi</option>
                            <option value="price_low">Harga Terendah</option>
                            <option value="most_reviewed">Ulasan Terbanyak</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Grid -->
            <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
                @forelse($products as $product)
                    <div class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-md border border-outline-variant/30 hover:border-primary/50 transition-all duration-300 flex flex-col relative">
                        <div class="relative aspect-[4/3] overflow-hidden bg-surface-container">
                            <a href="{{ route('detail-product', $product->slug) }}" wire:navigate>
                                <img alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ $product->image_path ? Storage::url($product->image_path) : 'https://via.placeholder.com/400' }}"/>
                            </a>
                            
                            @if($product->condition->value === 'new')
                                <div class="absolute top-2 left-2 bg-primary text-slate-900 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider z-10 shadow-sm">Baru</div>
                            @endif

                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-3 pt-8">
                                <div class="inline-flex items-center gap-1 bg-white px-2 py-0.5 rounded shadow-sm text-xs font-bold text-black">
                                    <span class="material-symbols-outlined text-[14px] text-yellow-400" style="font-variation-settings: 'FILL' 1;">star</span>
                                    <span>{{ number_format($product->avg_rating, 1) }}</span>
                                    <span class="text-gray-300">|</span>
                                    <span class="text-gray-600 font-medium">Terjual {{ $product->sold_count }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 sm:p-4 flex flex-col flex-grow">
                            <h4 class="font-body-md text-sm sm:text-base leading-tight text-on-surface mb-1 group-hover:text-primary transition-colors line-clamp-2 min-h-[40px]">
                                <a href="{{ route('detail-product', $product->slug) }}" wire:navigate>{{ $product->name }}</a>
                            </h4>
                            <div class="font-headline-md text-lg sm:text-xl text-primary font-bold mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            <div class="mt-auto flex flex-col gap-1.5">
                                <div class="flex items-center gap-1 text-on-surface-variant text-xs">
                                    <span class="material-symbols-outlined text-[14px] text-primary">storefront</span>
                                    <span class="truncate">{{ $product->seller->name }}</span>
                                </div>
                                <div class="flex items-center gap-1 text-outline text-xs">
                                    <span class="material-symbols-outlined text-[14px]">location_on</span>
                                    <span class="truncate">{{ $product->location ?? 'Tidak ditentukan' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 flex flex-col items-center justify-center text-center gap-4 bg-slate-50 dark:bg-slate-800/20 rounded-xl border border-dashed border-slate-200 dark:border-slate-700">
                        <span class="material-symbols-outlined text-slate-400 text-6xl">search_off</span>
                        <div>
                            <h3 class="font-bold text-lg text-slate-700 dark:text-slate-300">Produk Tidak Ditemukan</h3>
                            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Cobalah menggunakan kata kunci pencarian lain atau ubah filter Anda.</p>
                        </div>
                        <button wire:click="resetFilters" class="px-6 py-2 bg-primary text-slate-900 font-bold rounded-xl text-sm hover:opacity-90 active:scale-95 transition-all">
                            Reset Semua Filter
                        </button>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-10 mb-8">
                {{ $products->links() }}
            </div>
        </div>
        
    </div> <!-- Tutup Content Split Area -->
    
</main>