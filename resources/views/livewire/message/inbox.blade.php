<main class="flex-1 flex overflow-hidden max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-6 gap-6 h-[calc(100vh-80px)]">
    <!-- Sidebar Navigation & Chat List -->
    <div class="w-80 flex flex-col shrink-0">
        <div class="flex-1 bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 flex flex-col overflow-hidden">
            <!-- Header Inbox -->
            <div class="p-4 border-b border-slate-100 dark:border-slate-800 flex flex-col gap-4">
                <div class="flex items-center justify-between">
                    <h3 class="font-bold text-lg text-slate-900 dark:text-white">Inbox</h3>
                    <span class="bg-primary/20 text-primary text-xs font-bold px-2 py-0.5 rounded-full">3 Baru</span>
                </div>
                <!-- Tabs Filter -->
                <div class="flex p-1 bg-slate-100 dark:bg-slate-800 rounded-xl">
                    <button class="flex-1 py-1.5 text-xs font-bold rounded-lg bg-white dark:bg-slate-700 shadow-sm transition-all">Semua</button>
                    <button class="flex-1 py-1.5 text-xs font-medium text-slate-500 hover:text-slate-700 dark:hover:text-slate-300 transition-colors">Beli</button>
                    <button class="flex-1 py-1.5 text-xs font-medium text-slate-500 hover:text-slate-700 dark:hover:text-slate-300 transition-colors">Jual</button>
                </div>
            </div>

            <!-- List Chat -->
            <div class="flex-1 overflow-y-auto divide-y divide-slate-100 dark:divide-slate-800 custom-scrollbar">
                <!-- Chat Item Active -->
                <div class="p-4 bg-primary/5 border-l-4 border-primary cursor-pointer hover:bg-primary/10 transition-colors">
                    <div class="flex gap-3">
                        <div class="relative shrink-0">
                            <img class="w-12 h-12 rounded-full object-cover" src="https://ui-avatars.com/api/?name=Alex+Rivera&background=0df2f2&color=102222&bold=true"/>
                            <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white dark:border-slate-900 rounded-full"></span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-baseline mb-0.5">
                                <h4 class="font-bold text-sm truncate text-slate-900 dark:text-white">Alex Rivera</h4>
                                <span class="text-[10px] text-slate-400">12:45 PM</span>
                            </div>
                            <p class="text-xs text-primary font-bold truncate">Apakah bukunya masih ada?</p>
                        </div>
                    </div>
                </div>

                <!-- Chat Item 2 -->
                <div class="p-4 cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors border-l-4 border-transparent">
                    <div class="flex gap-3">
                        <img class="w-12 h-12 rounded-full object-cover shrink-0" src="https://ui-avatars.com/api/?name=Sarah+Chen&background=cbd5e1&color=1e293b&bold=true"/>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-baseline mb-0.5">
                                <h4 class="font-bold text-sm truncate text-slate-900 dark:text-white">Sarah Chen</h4>
                                <span class="text-[10px] text-slate-400">Kemarin</span>
                            </div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 truncate text-slate-500">Terima kasih ya! Barangnya oke banget.</p>
                        </div>
                    </div>
                </div>

                <!-- Chat Item 3 -->
                <div class="p-4 cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors border-l-4 border-transparent">
                    <div class="flex gap-3">
                        <div class="w-12 h-12 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center shrink-0 text-slate-500">
                            <span class="material-symbols-outlined">store</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-baseline mb-0.5">
                                <h4 class="font-bold text-sm truncate text-slate-900 dark:text-white">Campus Tech Store</h4>
                                <span class="text-[10px] text-slate-400">Selasa</span>
                            </div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 truncate">Pesanan #1204 siap diambil.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Empty State / Conversation Area -->
    <div class="flex-1 bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 flex flex-col items-center justify-center text-center p-12 relative overflow-hidden">
        <!-- Decoration Background -->
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-primary/5 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-primary/5 rounded-full blur-3xl"></div>

        <div class="relative mb-8">
            <div class="absolute -inset-6 bg-primary/20 rounded-full blur-2xl"></div>
            <div class="relative w-48 h-48 bg-slate-50 dark:bg-slate-800 rounded-full flex items-center justify-center border-4 border-white dark:border-slate-900 shadow-xl overflow-hidden">
                <div class="flex flex-col items-center gap-2">
                    <span class="material-symbols-outlined text-6xl text-primary">chat_bubble_outline</span>
                    <div class="flex gap-1">
                        <span class="w-2 h-2 rounded-full bg-primary/40 animate-bounce" style="animation-delay: 0.1s"></span>
                        <span class="w-2 h-2 rounded-full bg-primary/60 animate-bounce" style="animation-delay: 0.2s"></span>
                        <span class="w-2 h-2 rounded-full bg-primary animate-bounce" style="animation-delay: 0.3s"></span>
                    </div>
                </div>
            </div>
            
            <!-- Floating Badges -->
            <div class="absolute top-0 -left-4 w-12 h-12 bg-white dark:bg-slate-800 rounded-xl shadow-lg flex items-center justify-center border border-slate-100 dark:border-slate-700 transform -rotate-12">
                <span class="material-symbols-outlined text-primary">local_offer</span>
            </div>
            <div class="absolute bottom-8 -right-8 w-14 h-14 bg-white dark:bg-slate-800 rounded-full shadow-lg flex items-center justify-center border border-slate-100 dark:border-slate-700 transform rotate-12">
                <span class="material-symbols-outlined text-primary text-2xl font-bold">payments</span>
            </div>
        </div>

        <h2 class="text-2xl font-bold mb-3 text-slate-900 dark:text-white">Pilih percakapan untuk memulai</h2>
        <p class="text-slate-500 dark:text-slate-400 max-w-sm mb-8 leading-relaxed">
            Klik salah satu pesan di samping untuk mulai tawar-menawar, janjian COD, atau tanya detail barang.
        </p>
        
        <div class="mt-16 grid grid-cols-3 gap-8 text-slate-400 dark:text-slate-500">
            <div class="flex flex-col items-center gap-2">
                <span class="material-symbols-outlined text-3xl">verified_user</span>
                <span class="text-[10px] font-bold uppercase tracking-widest">Chat Aman</span>
            </div>
            <div class="flex flex-col items-center gap-2">
                <span class="material-symbols-outlined text-3xl">bolt</span>
                <span class="text-[10px] font-bold uppercase tracking-widest">Respon Cepat</span>
            </div>
            <div class="flex flex-col items-center gap-2">
                <span class="material-symbols-outlined text-3xl">photo_library</span>
                <span class="text-[10px] font-bold uppercase tracking-widest">Kirim Foto</span>
            </div>
        </div>
    </div>
</main>