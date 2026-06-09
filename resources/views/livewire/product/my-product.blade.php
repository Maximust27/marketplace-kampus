<div class="w-full max-w-7xl mx-auto px-6 py-8">
    <!-- Bagian Atas: Judul dan Tombol Tambah -->
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <h1 class="tracking-light text-[32px] font-bold leading-tight font-bold">Produk Saya</h1>
        <a class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-6 bg-primary text-slate-900 text-sm font-bold leading-normal hover:opacity-90 transition-opacity" href="{{ route('add-product') }}" wire:navigate>
            <span class="material-symbols-outlined mr-2 text-[20px]">add</span>
            <span class="truncate">Tambah Produk</span>
        </a>
    </div>

    <!-- Alert Notifications -->
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

    <!-- Container Tabel -->
    <div class="@container">
        <div class="flex flex-col overflow-hidden rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm mb-6">
            <div class="overflow-x-auto w-full">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-700">
                            <th class="px-6 py-4 text-sm font-semibold leading-normal w-20 text-slate-900 dark:text-white">Gambar</th>
                            <th class="px-6 py-4 text-sm font-semibold leading-normal min-w-[200px] text-slate-900 dark:text-white">Nama Produk</th>
                            <th class="px-6 py-4 text-sm font-semibold leading-normal text-slate-900 dark:text-white">Harga</th>
                            <th class="px-6 py-4 text-sm font-semibold leading-normal text-slate-900 dark:text-white">Stok</th>
                            <th class="px-6 py-4 text-sm font-semibold leading-normal text-slate-900 dark:text-white">Status</th>
                            <th class="px-6 py-4 text-sm font-semibold leading-normal text-right w-36 text-slate-900 dark:text-white">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @forelse($products as $product)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-lg w-12 h-12 shadow-sm border border-slate-100 dark:border-slate-700" 
                                         style="background-image: url('{{ $product->image_path ? Storage::url($product->image_path) : 'https://via.placeholder.com/400' }}');">
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium leading-normal text-slate-900 dark:text-white">
                                    <a class="hover:text-primary transition-colors font-bold" href="{{ route('detail-product', $product->slug) }}" wire:navigate>{{ $product->name }}</a>
                                </td>
                                <td class="px-6 py-4 text-sm font-normal leading-normal text-slate-600 dark:text-slate-300">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-sm font-normal leading-normal text-slate-600 dark:text-slate-300">
                                    {{ $product->stock }}
                                </td>
                                <td class="px-6 py-4 text-sm font-normal leading-normal">
                                    @if($product->status->value === 'active')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">Aktif</span>
                                    @elseif($product->status->value === 'inactive')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400">Nonaktif</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400">Terjual</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm font-bold leading-normal text-right">
                                    <div class="flex items-center justify-end gap-3">
                                        <button wire:click="toggleStatus({{ $product->id }})" class="text-amber-500 hover:text-amber-600 transition-colors" title="Aktif/Nonaktifkan">
                                            <span class="material-symbols-outlined text-[20px]">{{ $product->status->value === 'active' ? 'visibility_off' : 'visibility' }}</span>
                                        </button>
                                        <a href="{{ route('add-product', $product->slug) }}" wire:navigate class="text-blue-500 hover:text-blue-600 transition-colors" title="Edit">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                        </a>
                                        <button wire:click="deleteProduct({{ $product->id }})" wire:confirm="Apakah Anda yakin ingin menghapus produk ini?" class="text-rose-500 hover:text-rose-600 transition-colors" title="Hapus">
                                            <span class="material-symbols-outlined text-[20px]">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <span class="material-symbols-outlined text-5xl mb-1 text-slate-400">inventory_2</span>
                                        <p class="font-bold text-slate-700 dark:text-slate-300">Anda belum mengunggah produk apapun.</p>
                                        <p class="text-xs text-slate-400">Mulai jual barang bekas Anda yang masih layak pakai.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        <div>
            {{ $products->links() }}
        </div>
    </div>
</div>