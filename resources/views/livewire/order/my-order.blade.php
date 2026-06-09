<main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 py-8">
    <div class="flex flex-col gap-6">
        <!-- Header -->
        <div class="flex flex-col gap-2">
            <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">Pesanan Saya</h1>
            <p class="text-slate-500 dark:text-slate-400">Kelola dan pantau semua transaksi belanja kampusmu.</p>
        </div>

        <!-- Alert Notifications -->
        @if(session()->has('success'))
            <div class="bg-emerald-50 dark:bg-emerald-950/20 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 p-4 rounded-xl flex items-center gap-3">
                <span class="material-symbols-outlined">check_circle</span>
                <span class="text-sm font-semibold">{{ session('success') }}</span>
            </div>
        @endif
        @if(session()->has('error'))
            <div class="bg-rose-50 dark:bg-rose-950/20 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-300 p-4 rounded-xl flex items-center gap-3">
                <span class="material-symbols-outlined">error</span>
                <span class="text-sm font-semibold">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Role Toggle Tabs -->
        <div class="flex gap-4 border-b border-slate-200 dark:border-slate-800 pb-2">
            <button wire:click="setRole('buyer')" class="px-5 py-2.5 font-bold text-sm rounded-xl transition-all {{ $role === 'buyer' ? 'bg-primary text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200' }}">
                Pembelian Saya
            </button>
            <button wire:click="setRole('seller')" class="px-5 py-2.5 font-bold text-sm rounded-xl transition-all {{ $role === 'seller' ? 'bg-primary text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200' }}">
                Penjualan Saya
            </button>
        </div>

        <!-- Filter Status Tabs -->
        <div class="flex border-b border-slate-200 dark:border-slate-800 overflow-x-auto no-scrollbar gap-2">
            <button wire:click="setStatus('all')" class="px-6 py-3 text-sm font-bold transition-all whitespace-nowrap {{ $status === 'all' ? 'text-primary border-b-2 border-primary' : 'text-slate-500 hover:text-primary' }}">Semua</button>
            <button wire:click="setStatus('pending')" class="px-6 py-3 text-sm font-bold transition-all whitespace-nowrap {{ $status === 'pending' ? 'text-primary border-b-2 border-primary' : 'text-slate-500 hover:text-primary' }}">Menunggu Konfirmasi</button>
            <button wire:click="setStatus('confirmed')" class="px-6 py-3 text-sm font-bold transition-all whitespace-nowrap {{ $status === 'confirmed' ? 'text-primary border-b-2 border-primary' : 'text-slate-500 hover:text-primary' }}">Sedang Berlangsung</button>
            <button wire:click="setStatus('completed')" class="px-6 py-3 text-sm font-bold transition-all whitespace-nowrap {{ $status === 'completed' ? 'text-primary border-b-2 border-primary' : 'text-slate-500 hover:text-primary' }}">Selesai</button>
            <button wire:click="setStatus('cancelled')" class="px-6 py-3 text-sm font-bold transition-all whitespace-nowrap {{ $status === 'cancelled' ? 'text-primary border-b-2 border-primary' : 'text-slate-500 hover:text-primary' }}">Dibatalkan</button>
        </div>

        <!-- List Pesanan -->
        <div class="flex flex-col gap-4">
            @forelse($orders as $order)
                @php
                    $firstItem = $order->items->first();
                    $colorClass = match($order->status->value) {
                        'pending' => 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400',
                        'confirmed' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                        'completed' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                        'cancelled' => 'bg-rose-100 text-rose-800 dark:bg-rose-900/30 dark:text-rose-400',
                        default => 'bg-gray-100 text-gray-800'
                    };
                @endphp
                <div class="bg-white dark:bg-slate-900 rounded-xl p-5 shadow-sm border border-slate-200 dark:border-slate-800 flex flex-col md:flex-row gap-6 hover:border-primary/30 transition-all">
                    <!-- Image -->
                    <div class="h-24 w-24 rounded-xl bg-slate-100 dark:bg-slate-800 flex-shrink-0 overflow-hidden border border-slate-200 dark:border-slate-700">
                        <img class="h-full w-full object-cover" src="{{ $firstItem && $firstItem->product_image ? Storage::url($firstItem->product_image) : 'https://via.placeholder.com/400' }}" alt="{{ $firstItem->product_name ?? 'Produk' }}"/>
                    </div>

                    <!-- Details -->
                    <div class="flex-grow flex flex-col justify-between py-1">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                            <div class="flex flex-col">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">ID PESANAN: #{{ $order->order_number }}</span>
                                <h4 class="text-base font-bold text-slate-900 dark:text-slate-100">{{ $firstItem->product_name ?? 'Produk dihapus' }}</h4>
                                <p class="text-xs text-slate-500 dark:text-slate-400">
                                    {{ $order->created_at->format('d M Y') }} • {{ $order->items->sum('quantity') }} Item 
                                    • @if($role === 'buyer') Penjual: {{ $order->seller->name }} @else Pembeli: {{ $order->buyer->name }} @endif
                                </p>
                                
                                @if($order->notes)
                                    <div class="mt-2 text-xs text-slate-600 dark:text-slate-400 bg-slate-50 dark:bg-slate-800/40 p-2 rounded-lg border border-slate-100 dark:border-slate-800">
                                        <strong>Catatan Pertemuan COD:</strong> {{ $order->notes }}
                                    </div>
                                @endif

                                @if($order->status->value === 'cancelled' && $order->cancelled_reason)
                                    <div class="mt-2 text-xs text-rose-700 dark:text-rose-450 bg-rose-50 dark:bg-rose-950/10 p-2 rounded-lg border border-rose-100 dark:border-rose-900/30">
                                        <strong>Alasan Batal:</strong> {{ $order->cancelled_reason }}
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Status Badge -->
                            <div class="flex items-center gap-2 px-3 py-1 {{ $colorClass }} rounded-full w-fit">
                                <span class="text-xs font-bold">{{ $order->status->label() }}</span>
                            </div>
                        </div>

                        <!-- Price Summary & Action Triggers -->
                        <div class="flex flex-wrap items-center justify-between mt-4 border-t border-slate-50 dark:border-slate-800 pt-3 gap-4">
                            <div class="flex flex-col">
                                <span class="text-xs text-slate-500">Total Harga (COD)</span>
                                <span class="text-lg font-bold text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                            </div>

                            <!-- Actions -->
                            <div class="flex flex-wrap items-center gap-2">
                                @if($role === 'buyer')
                                    @if($order->status->value === 'confirmed')
                                        <button wire:click="completeOrder({{ $order->id }})" class="px-4 py-2 text-xs font-bold bg-primary text-slate-900 rounded-xl hover:brightness-110 active:scale-95 transition-all">
                                            Konfirmasi Terima Barang (COD Selesai)
                                        </button>
                                    @endif
                                @elseif($role === 'seller')
                                    @if($order->status->value === 'pending')
                                        <button wire:click="confirmOrder({{ $order->id }})" class="px-4 py-2 text-xs font-bold bg-primary text-slate-900 rounded-xl hover:brightness-110 active:scale-95 transition-all">
                                            Konfirmasi Pesanan
                                        </button>
                                    @endif
                                @endif

                                @if(in_array($order->status->value, ['pending', 'confirmed']) && $cancelOrderId !== $order->id)
                                    <button wire:click="initiateCancel({{ $order->id }})" class="px-4 py-2 text-xs font-bold border border-rose-200 dark:border-rose-800 text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-950/20 rounded-xl active:scale-95 transition-all">
                                        Batalkan Pesanan
                                    </button>
                                @endif
                            </div>
                        </div>

                        <!-- Cancellation Form -->
                        @if($cancelOrderId === $order->id)
                            <div class="mt-4 p-4 border border-rose-200 dark:border-rose-800 bg-rose-50/50 dark:bg-rose-950/10 rounded-xl space-y-3">
                                <label class="block text-sm font-semibold text-rose-900 dark:text-rose-350">Alasan Pembatalan:</label>
                                <input type="text" wire:model="cancelReason" class="w-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-rose-500 focus:border-transparent outline-none dark:text-white" placeholder="Tulis alasan pembatalan..."/>
                                <div class="flex justify-end gap-2 text-xs">
                                    <button wire:click="$set('cancelOrderId', null)" class="px-3 py-1.5 rounded-lg bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 font-bold text-slate-700 dark:text-slate-200">Kembali</button>
                                    <button wire:click="cancelOrder" class="px-3 py-1.5 rounded-lg bg-rose-600 hover:bg-rose-700 font-bold text-white">Batalkan Sekarang</button>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            @empty
                <div class="py-16 flex flex-col items-center justify-center text-center gap-4 bg-slate-50 dark:bg-slate-800/10 rounded-xl border border-dashed border-slate-200 dark:border-slate-700">
                    <span class="material-symbols-outlined text-slate-400 text-6xl">list_alt</span>
                    <div>
                        <h3 class="font-bold text-lg text-slate-700 dark:text-slate-300">Belum Ada Pesanan</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">
                            @if($role === 'buyer') Anda belum membeli barang apapun. Yuk temukan barang menarik di marketplace! @else Belum ada yang memesan produk Anda. @endif
                        </p>
                    </div>
                    @if($role === 'buyer')
                        <a href="{{ route('products') }}" wire:navigate class="px-6 py-2 bg-primary text-slate-900 font-bold rounded-xl text-sm hover:opacity-90 active:scale-95 transition-all">
                            Mulai Belanja
                        </a>
                    @endif
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    </div>
</main>