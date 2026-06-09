<main class="flex-grow w-full max-w-7xl mx-auto px-6 py-8">
    <!-- Breadcrumbs -->
    <nav aria-label="Breadcrumb" class="flex text-slate-500 text-sm mb-8 space-x-2 items-center">
        <a class="hover:text-primary transition-colors font-medium" href="{{ route('landing') }}" wire:navigate>Beranda</a>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <a class="hover:text-primary transition-colors font-medium" href="{{ route('products') }}" wire:navigate>Semua Produk</a>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <span class="text-primary font-bold">Detail Produk</span>
    </nav>

    <!-- Success/Error Messages -->
    @if(session()->has('success'))
        <div class="mb-6 bg-emerald-50 dark:bg-emerald-950/20 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 p-4 rounded-xl flex items-center gap-3">
            <span class="material-symbols-outlined">check_circle</span>
            <span class="text-sm font-semibold">{{ session('success') }}</span>
        </div>
    @endif
    @if(session()->has('error'))
        <div class="mb-6 bg-rose-50 dark:bg-rose-950/20 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-300 p-4 rounded-xl flex items-center gap-3">
            <span class="material-symbols-outlined">error</span>
            <span class="text-sm font-semibold">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 mb-16">
        
        <!-- Left Column: Image Gallery (Span 5) -->
        <div class="lg:col-span-5 flex flex-col gap-4">
            <!-- Main Image -->
            <div class="w-full aspect-square rounded-2xl overflow-hidden shadow-sm relative group bg-slate-100 dark:bg-slate-800">
                <img alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" 
                     src="{{ $product->image_path ? Storage::url($product->image_path) : 'https://via.placeholder.com/400' }}"/>
            </div>
        </div>

        <!-- Middle Column: Product Info (Span 4) -->
        <div class="lg:col-span-4 flex flex-col">
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white leading-tight mb-3">{{ $product->name }}</h1>
            
            <!-- Rating & Sold -->
            <div class="flex items-center gap-2 mb-5">
                <div class="flex text-amber-400">
                    @for ($i = 0; $i < 5; $i++)
                        <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' {{ $i < round($product->avg_rating) ? '1' : '0' }};">star</span>
                    @endfor
                </div>
                <span class="text-slate-500 text-sm font-medium">{{ number_format($product->avg_rating, 1) }} ({{ $product->review_count }} Ulasan)</span>
                <span class="text-slate-300 mx-1">•</span>
                <span class="text-slate-500 text-sm font-medium">{{ $product->sold_count }} Terjual</span>
            </div>

            <p class="text-3xl font-extrabold text-primary mb-6">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

            <div class="flex items-center gap-3 mb-6 border-b border-slate-100 dark:border-slate-800 pb-6">
                <span class="bg-primary/10 text-primary px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider">
                    {{ $product->condition->label() }}
                </span>
                <span class="text-slate-500 text-sm flex items-center">
                    <span class="material-symbols-outlined text-sm mr-1">schedule</span> {{ $product->created_at->diffForHumans() }}
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
                        Penjual
                    </button>
                </div>
                
                <div class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                    @if($activeTab === 'deskripsi')
                        <p class="whitespace-pre-line">{{ $product->description }}</p>
                    @elseif($activeTab === 'spesifikasi')
                        <ul class="space-y-2">
                            <li><span class="font-bold">Kondisi:</span> {{ $product->condition->label() }}</li>
                            <li><span class="font-bold">Kategori:</span> {{ $product->category->name }}</li>
                            <li><span class="font-bold">Lokasi COD:</span> {{ $product->location ?? 'Tidak ditentukan' }}</li>
                            <li><span class="font-bold">Terdaftar pada:</span> {{ $product->created_at->format('d M Y') }}</li>
                        </ul>
                    @elseif($activeTab === 'penjual')
                        <div class="flex items-center gap-4">
                            <img alt="{{ $product->seller->name }}" class="w-16 h-16 rounded-full object-cover border-2 border-white dark:border-slate-700" src="{{ $product->seller->avatar_url }}"/>
                            <div>
                                <h4 class="font-bold text-slate-900 dark:text-white">{{ $product->seller->name }}</h4>
                                <p class="text-sm text-slate-500">{{ $product->seller->role->label() }} • {{ $product->seller->location ?? 'Lokasi tidak diatur' }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">Aktif {{ $product->seller->last_seen_at ? $product->seller->last_seen_at->diffForHumans() : 'tidak diketahui' }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column: Buy Box (Span 3) -->
        <div class="lg:col-span-3">
            <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-800 sticky top-24">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-5 font-bold">Atur Pesanan</h3>
                
                @if($product->user_id === auth()->id())
                    <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-xl mb-6 text-center text-sm font-semibold text-slate-500">
                        Ini adalah produk Anda sendiri.
                    </div>
                @elseif($product->stock <= 0)
                    <div class="bg-rose-50 dark:bg-rose-950/20 p-4 rounded-xl mb-6 text-center text-sm font-semibold text-rose-500">
                        Produk ini sudah habis terjual.
                    </div>
                @else
                    <!-- Quantity Selector -->
                    <div class="flex items-center justify-between mb-6">
                        <span class="text-sm font-medium text-slate-600 dark:text-slate-400">Kuantitas</span>
                        <div class="flex items-center border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                            <button wire:click="decrement" class="px-3 py-1.5 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-300 disabled:opacity-30" {{ $quantity <= 1 ? 'disabled' : '' }}>-</button>
                            <span class="w-10 text-center font-bold text-sm">{{ $quantity }}</span>
                            <button wire:click="increment" class="px-3 py-1.5 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-300" {{ $quantity >= $product->stock ? 'disabled' : '' }}>+</button>
                        </div>
                    </div>
                    
                    <p class="text-xs text-slate-400 mb-6 text-right font-medium">Stok Tersedia: {{ $product->stock }}</p>

                    <!-- Total Price -->
                    <div class="flex justify-between items-center mb-6 pt-4 border-t border-slate-50 dark:border-slate-800">
                        <span class="text-sm text-slate-500">Subtotal</span>
                        <span class="text-xl font-black text-slate-900 dark:text-white font-bold">Rp {{ number_format($product->price * $quantity, 0, ',', '.') }}</span>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col gap-3">
                        <button wire:click="addToCart" class="w-full bg-primary text-slate-900 font-bold py-4 rounded-xl shadow-lg shadow-primary/20 hover:brightness-110 active:scale-95 transition-all">
                            Tambah ke Keranjang
                        </button>
                        <button wire:click="buyNow" class="w-full bg-slate-900 dark:bg-slate-800 text-white font-bold py-4 rounded-xl hover:brightness-110 active:scale-95 transition-all">
                            Beli Langsung
                        </button>
                        <button wire:click="chatSeller" class="w-full bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white border border-slate-200 dark:border-slate-700 font-bold py-4 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-700 transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">chat</span> Chat Penjual
                        </button>
                    </div>
                @endif

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
    @if($relatedProducts->isNotEmpty())
        <section class="mt-12 border-t border-slate-100 dark:border-slate-800 pt-12">
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Produk Serupa</h2>
                    <p class="text-slate-500 text-sm">Mungkin kamu juga butuh ini</p>
                </div>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                    <div class="group flex flex-col h-full bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-md border border-outline-variant/30 transition-all duration-300">
                        <div class="relative aspect-[4/3] bg-slate-100 dark:bg-slate-800 overflow-hidden mb-3">
                            <a href="{{ route('detail-product', $related->slug) }}" wire:navigate>
                                <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" src="{{ $related->image_path ? Storage::url($related->image_path) : 'https://via.placeholder.com/400' }}"/>
                            </a>
                            <div class="absolute bottom-2 left-2 bg-black/50 backdrop-blur-md text-white text-[10px] font-bold px-2 py-0.5 rounded">{{ $related->condition->label() }}</div>
                        </div>
                        <div class="p-3 flex flex-col flex-grow">
                            <h3 class="font-bold text-slate-900 dark:text-white text-sm line-clamp-2 min-h-[40px] group-hover:text-primary transition-colors">
                                <a href="{{ route('detail-product', $related->slug) }}" wire:navigate>{{ $related->name }}</a>
                            </h3>
                            <p class="text-primary font-bold mt-1">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                            <div class="mt-auto pt-2 flex items-center gap-1 text-slate-400 text-[10px] font-bold uppercase tracking-tight">
                                <span class="material-symbols-outlined text-[14px]">location_on</span> {{ $related->location ?? 'Tidak ditentukan' }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
</main>