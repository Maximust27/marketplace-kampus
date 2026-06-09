<main class="flex flex-1 flex-col items-center justify-center px-4 py-12 md:px-40">
    <div class="max-w-2xl w-full flex flex-col items-center text-center">
        <!-- Friendly Empty State Illustration -->
        <div class="relative mb-8 w-64 h-64 md:w-80 md:h-80 flex items-center justify-center">
            <div class="absolute inset-0 bg-primary/10 rounded-full blur-3xl opacity-50"></div>
            <div class="relative z-10 flex flex-col items-center">
                <!-- Custom CSS-based Friendly Cart Illustration -->
                <div class="relative bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-xl border border-slate-100 dark:border-slate-700">
                    <span class="material-symbols-outlined text-primary scale-[4] mb-12">shopping_basket</span>
                    <div class="absolute -bottom-2 -right-2 bg-primary rounded-full p-2 shadow-lg">
                        <span class="material-symbols-outlined text-background-dark text-lg font-bold">add</span>
                    </div>
                </div>
                <div class="mt-8 flex gap-2">
                    <div class="w-2 h-2 rounded-full bg-primary/40"></div>
                    <div class="w-8 h-2 rounded-full bg-primary/60"></div>
                    <div class="w-2 h-2 rounded-full bg-primary/40"></div>
                </div>
            </div>
        </div>

        <!-- Empty State Content -->
        <div class="space-y-4">
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-slate-100 tracking-tight">Wah, keranjangmu masih kosong!</h1>
            <p class="text-slate-600 dark:text-slate-400 text-lg max-w-md mx-auto leading-relaxed">
                Sepertinya kamu belum menambahkan barang apapun. Yuk, jelajahi marketplace kampus dan temukan barang impianmu hari ini!
            </p>
        </div>

        <!-- Action Button -->
        <div class="mt-10 flex flex-col sm:flex-row gap-4">
            <a class="flex items-center justify-center gap-2 min-w-[200px] h-14 px-8 rounded-xl bg-primary text-background-dark font-bold text-lg hover:brightness-110 active:scale-95 transition-all shadow-lg shadow-primary/20" href="{{ route('products') }}" wire:navigate>
                <span class="material-symbols-outlined">storefront</span>
                Mulai Belanja
            </a>
        </div>

        <!-- Quick Links/Promos -->
        <div class="mt-16 grid grid-cols-1 sm:grid-cols-3 gap-6 w-full opacity-60">
            <div class="flex flex-col items-center p-4 rounded-xl bg-slate-100/50 dark:bg-slate-800/50">
                <span class="material-symbols-outlined text-primary mb-2">local_shipping</span>
                <span class="text-sm font-medium">Gratis Ongkir Kampus</span>
            </div>
            <div class="flex flex-col items-center p-4 rounded-xl bg-slate-100/50 dark:bg-slate-800/50">
                <span class="material-symbols-outlined text-primary mb-2">verified</span>
                <span class="text-sm font-medium">Penjual Terverifikasi</span>
            </div>
            <div class="flex flex-col items-center p-4 rounded-xl bg-slate-100/50 dark:bg-slate-800/50">
                <span class="material-symbols-outlined text-primary mb-2">payments</span>
                <span class="text-sm font-medium">Bayar di Tempat (COD)</span>
            </div>
        </div>
    </div>
</main>