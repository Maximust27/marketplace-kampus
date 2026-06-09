<main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 py-8">
    <div class="flex items-center gap-2 text-sm text-slate-500 mb-6">
        <a class="hover:text-primary transition-colors font-medium text-slate-500 dark:text-slate-400" href="{{ route('landing') }}" wire:navigate>Beranda</a>
        <span class="material-symbols-outlined text-xs">chevron_right</span>
        <span class="font-bold text-slate-900 dark:text-slate-100">Keranjang Belanja</span>
    </div>

    @if(session()->has('error'))
        <div class="mb-6 bg-rose-50 dark:bg-rose-950/20 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-300 p-4 rounded-xl flex items-center gap-3">
            <span class="material-symbols-outlined">error</span>
            <span class="text-sm font-semibold">{{ session('error') }}</span>
        </div>
    @endif
    @if(session()->has('success'))
        <div class="mb-6 bg-emerald-50 dark:bg-emerald-950/20 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 p-4 rounded-xl flex items-center gap-3">
            <span class="material-symbols-outlined">check_circle</span>
            <span class="text-sm font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    @if($this->cartItems->isEmpty())
        <!-- Empty State -->
        <div class="flex flex-col items-center justify-center text-center py-16">
            <div class="relative mb-8 w-64 h-64 flex items-center justify-center">
                <div class="absolute inset-0 bg-primary/10 rounded-full blur-3xl opacity-50"></div>
                <div class="relative z-10 flex flex-col items-center">
                    <div class="relative bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-xl border border-slate-100 dark:border-slate-700">
                        <span class="material-symbols-outlined text-primary scale-[4] mb-12">shopping_basket</span>
                        <div class="absolute -bottom-2 -right-2 bg-primary rounded-full p-2 shadow-lg">
                            <span class="material-symbols-outlined text-slate-900 text-lg font-bold">add</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <h1 class="text-3xl font-extrabold text-slate-900 dark:text-slate-100 tracking-tight">Wah, keranjangmu masih kosong!</h1>
                <p class="text-slate-600 dark:text-slate-400 text-lg max-w-md mx-auto leading-relaxed">
                    Sepertinya kamu belum menambahkan barang apapun. Yuk, jelajahi marketplace kampus dan temukan barang impianmu hari ini!
                </p>
            </div>

            <div class="mt-10">
                <a class="flex items-center justify-center gap-2 min-w-[200px] h-14 px-8 rounded-xl bg-primary text-slate-900 font-bold text-lg hover:brightness-110 active:scale-95 transition-all shadow-lg shadow-primary/20" href="{{ route('products') }}" wire:navigate>
                    <span class="material-symbols-outlined">storefront</span>
                    Mulai Belanja
                </a>
            </div>
        </div>
    @else
        <!-- Cart Details Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Cart Items List (Span 8) -->
            <div class="lg:col-span-8 space-y-4">
                <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">Daftar Belanja ({{ $this->cartItems->sum('quantity') }} barang)</h2>
                
                @foreach($this->cartItems as $item)
                    <div class="bg-white dark:bg-slate-900 rounded-xl p-4 sm:p-6 shadow-sm border border-slate-200 dark:border-slate-800 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <!-- Product Image -->
                            <a href="{{ route('detail-product', $item->product->slug) }}" wire:navigate class="w-20 h-20 rounded-lg overflow-hidden bg-slate-100 flex-shrink-0">
                                <img src="{{ $item->product->image_path ? Storage::url($item->product->image_path) : 'https://via.placeholder.com/400' }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                            </a>

                            <!-- Product Description -->
                            <div>
                                <h3 class="font-bold text-slate-900 dark:text-white text-base hover:text-primary transition-colors">
                                    <a href="{{ route('detail-product', $item->product->slug) }}" wire:navigate>{{ $item->product->name }}</a>
                                </h3>
                                <p class="text-xs text-slate-500 mt-1 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm text-primary">storefront</span>
                                    <span>Penjual: {{ $item->product->seller->name }}</span>
                                </p>
                                <p class="text-sm font-bold text-primary mt-2">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <!-- Quantity Actions & Subtotal -->
                        <div class="flex items-center justify-between sm:justify-end gap-6 w-full sm:w-auto border-t sm:border-t-0 pt-4 sm:pt-0">
                            <!-- Quantity Controls -->
                            <div class="flex items-center border border-slate-200 dark:border-slate-700 rounded-lg overflow-hidden">
                                <button wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})" class="px-2.5 py-1 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-300">-</button>
                                <span class="w-8 text-center font-bold text-sm">{{ $item->quantity }}</span>
                                <button wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})" class="px-2.5 py-1 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-300" {{ $item->quantity >= $item->product->stock ? 'disabled' : '' }}>+</button>
                            </div>

                            <!-- Item Subtotal -->
                            <div class="text-right">
                                <p class="text-xs text-slate-400">Subtotal</p>
                                <p class="text-base font-bold text-slate-900 dark:text-white">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                            </div>

                            <!-- Remove Button -->
                            <button wire:click="removeItem({{ $item->id }})" class="text-slate-400 hover:text-rose-500 transition-colors p-1" title="Hapus dari keranjang">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Summary Column (Span 4) -->
            <div class="lg:col-span-4 sticky top-24 bg-white dark:bg-slate-900 rounded-xl p-6 shadow-md border border-slate-200 dark:border-slate-800">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-5 font-bold">Ringkasan Belanja</h3>
                
                <div class="space-y-3 mb-6 pb-6 border-b border-slate-100 dark:border-slate-800">
                    <div class="flex justify-between text-sm text-slate-500">
                        <span>Total Barang</span>
                        <span>{{ $this->cartItems->sum('quantity') }} unit</span>
                    </div>
                    <div class="flex justify-between text-sm text-slate-500">
                        <span>Biaya Penyerahan (COD)</span>
                        <span class="text-emerald-500 font-bold uppercase">Gratis</span>
                    </div>
                </div>

                <!-- Meeting Notes / Catatan COD -->
                <div class="mb-6 space-y-2">
                    <label for="notes" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Catatan Pertemuan COD</label>
                    <textarea id="notes" wire:model="notes" rows="3" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all placeholder:text-slate-400 dark:text-white text-sm" placeholder="Tulis rencana lokasi COD atau pesan tambahan untuk penjual..."></textarea>
                </div>

                <div class="flex justify-between items-center mb-6 pt-4 border-t border-slate-100 dark:border-slate-800">
                    <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">Total Harga</span>
                    <span class="text-2xl font-black text-primary font-bold">Rp {{ number_format($this->cartTotal, 0, ',', '.') }}</span>
                </div>

                <button wire:click="checkout" class="w-full bg-primary text-slate-900 font-bold py-4 rounded-xl shadow-lg shadow-primary/20 hover:brightness-110 active:scale-95 transition-all text-center">
                    Buat Pesanan (Checkout)
                </button>

                <div class="mt-6 space-y-3 pt-6 border-t border-slate-100 dark:border-slate-800">
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
    @endif
</main>