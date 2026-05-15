<main class="w-full max-w-7xl mx-auto px-6 py-8">
    <!-- Breadcrumbs -->
    <nav class="flex items-center gap-2 text-sm text-slate-500 mb-6">
        <a class="hover:text-primary transition-colors font-medium text-slate-500 dark:text-slate-400" href="{{ route('landing') }}" wire:navigate>Beranda</a>
        <span class="material-symbols-outlined text-xs">chevron_right</span>
        <a class="hover:text-primary transition-colors font-medium text-slate-500 dark:text-slate-400" href="{{ route('my-products') }}" wire:navigate>Produk Saya</a>
        <span class="material-symbols-outlined text-xs">chevron_right</span>
        <span class="font-bold text-slate-900 dark:text-slate-100">Tambah Produk</span>
    </nav>

    <div class="bg-white dark:bg-slate-900/50 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
        <div class="p-6 sm:p-8">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Informasi Produk</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Lengkapi detail produk yang ingin Anda jual ke sesama mahasiswa.</p>
            </div>

            <form wire:submit="saveProduct" class="space-y-6">
                <!-- Image Upload Area -->
                <div class="space-y-2">
    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Foto Produk</label>

    <label for="photo-upload"
        class="flex flex-col items-center justify-center border-2 border-dashed {{ $photo ? 'border-primary' : 'border-slate-300 dark:border-slate-700' }} rounded-xl bg-slate-50 dark:bg-slate-800/50 p-8 group hover:border-primary transition-colors cursor-pointer relative overflow-hidden h-64"
    >
        @if ($photo)
            <div class="absolute inset-0 w-full h-full bg-slate-100 dark:bg-slate-900 flex items-center justify-center pointer-events-none">
                <img 
                    src="{{ $photo->temporaryUrl() }}" 
                    class="max-w-full max-h-full w-auto h-auto object-contain p-3 transition-transform duration-300 group-hover:scale-[1.02]"
                    alt="Preview Foto Produk"
                >
                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                    <span class="text-white font-bold flex items-center gap-2">
                        <span class="material-symbols-outlined">sync</span> Ganti Foto
                    </span>
                </div>
            </div>
        @else
            <div class="bg-primary/10 p-4 rounded-full mb-4 group-hover:scale-110 transition-transform">
                <span class="material-symbols-outlined text-primary text-3xl">cloud_upload</span>
            </div>
            <div class="text-center">
                <p class="font-medium text-slate-900 dark:text-white">Klik untuk unggah foto</p>
                <p class="text-xs text-slate-500 mt-1">PNG, JPG atau WEBP (Maks. 5MB)</p>
            </div>
        @endif

        <input id="photo-upload" class="hidden" type="file" wire:model="photo" accept="image/*"/>
    </label>

    @error('photo') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
</div>

                <!-- Product Name -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300" for="product-name">Nama Produk</label>
                    <input wire:model="name" class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all placeholder:text-slate-400 dark:text-white text-sm" id="product-name" placeholder="Contoh: Buku Kalkulus Purcell Edisi 9" type="text"/>
                    @error('name') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <!-- Description -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300" for="description">Deskripsi</label>
                    <textarea wire:model="description" class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all placeholder:text-slate-400 dark:text-white text-sm" id="description" placeholder="Jelaskan detail produk, kelengkapan, dan minus jika ada..." rows="4"></textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <!-- Price & Stock Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300" for="price">Harga (Rp)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 font-bold text-slate-400">Rp</span>
                            <input wire:model="price" class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-xl pl-12 pr-4 py-3 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all placeholder:text-slate-400 dark:text-white text-sm" id="price" placeholder="0" type="number"/>
                        </div>
                        @error('price') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300" for="stock">Stok</label>
                        <input wire:model="stock" class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all placeholder:text-slate-400 dark:text-white text-sm" id="stock" placeholder="1" type="number"/>
                        @error('stock') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Condition & Category Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300" for="condition">Kondisi</label>
                        <select wire:model="condition" class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all appearance-none dark:text-white text-sm" id="condition">
                            <option value="new">Baru</option>
                            <option value="used_good">Bekas (Masih Bagus)</option>
                            <option value="used_normal">Bekas (Wajar Pakai)</option>
                        </select>
                        @error('condition') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300" for="category">Kategori</label>
                        <div class="relative">
                            <select wire:model="category" class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all appearance-none dark:text-white text-sm" id="category">
                                <option value="">Pilih Kategori</option>
                                <option value="books">Buku Kuliah</option>
                                <option value="electronics">Elektronik</option>
                                <option value="stationery">Alat Tulis</option>
                                <option value="others">Lainnya</option>
                            </select>
                            <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">expand_more</span>
                        </div>
                        @error('category') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-end gap-4 pt-6 border-t border-slate-100 dark:border-slate-800">
                    <a class="flex items-center gap-2 px-6 py-3 rounded-xl font-semibold text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-100 transition-colors text-sm" href="{{ route('my-products') }}" wire:navigate>
                        <span class="material-symbols-outlined text-sm">arrow_back</span>
                        Kembali ke Produk Saya
                    </a>
                    <button class="w-full sm:w-auto px-8 py-3 rounded-xl font-bold bg-primary text-slate-900 hover:opacity-90 active:scale-[0.98] transition-all flex items-center justify-center gap-2 shadow-lg shadow-primary/20" type="submit">
                        <span wire:loading.remove wire:target="photo" class="material-symbols-outlined text-[20px]">save</span>
                        <span wire:loading wire:target="photo" class="animate-spin material-symbols-outlined text-[20px]">progress_activity</span>
                        <span>Simpan Produk</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>