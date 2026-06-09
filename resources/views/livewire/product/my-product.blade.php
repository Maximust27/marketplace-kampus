<div class="w-full max-w-7xl mx-auto px-6 py-8">
    <!-- Bagian Atas: Judul dan Tombol Tambah -->
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <h1 class="tracking-light text-[32px] font-bold leading-tight">Produk Saya</h1>
        <a class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-6 bg-primary text-slate-900 text-sm font-bold leading-normal hover:opacity-90 transition-opacity" href="{{ route('add-product') }}" wire:navigate>
            <span class="material-symbols-outlined mr-2 text-[20px]">add</span>
            <span class="truncate">Tambah Produk</span>
        </a>
    </div>

    <!-- Container Tabel -->
    <div class="@container">
        <div class="flex overflow-hidden rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">
            <div class="overflow-x-auto w-full">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-700">
                            <th class="px-6 py-4 text-sm font-semibold leading-normal w-20 text-slate-900 dark:text-white">Gambar</th>
                            <th class="px-6 py-4 text-sm font-semibold leading-normal min-w-[200px] text-slate-900 dark:text-white">Nama Produk</th>
                            <th class="px-6 py-4 text-sm font-semibold leading-normal text-slate-900 dark:text-white">Harga</th>
                            <th class="px-6 py-4 text-sm font-semibold leading-normal text-slate-900 dark:text-white">Stok</th>
                            <th class="px-6 py-4 text-sm font-semibold leading-normal text-slate-900 dark:text-white">Status</th>
                            <th class="px-6 py-4 text-sm font-semibold leading-normal text-right w-24 text-slate-900 dark:text-white">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        <!-- Baris Produk 1 -->
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-lg w-12 h-12 shadow-sm border border-slate-100 dark:border-slate-700" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuA6hgFYOxYOFquxL7iVC5hvZ2k7XS6g8oWxMqFq0VQedQVzVZpACDtPCTQZbaRC-XkihI0ny1MB93PT_ixg6hlWOaR76aEXl54uQg3c3jax6wZza8iUjVYSMd2wR7ze98kZxYR3SudYUNP3y4SRwgWBLRXG6H1Ee0AWCorTzR513AVWAN0WV53093HcWIfjMUs_ZtOt5Y61qvmLRu-S19JUwb9qVVJI2z7y-fRYNLDmEbeXI3Xvru1YeEDuK0zntaEjGGFNMzKDVxY");'></div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium leading-normal text-slate-900 dark:text-white">Sepatu Kets Casual Pria</td>
                            <td class="px-6 py-4 text-sm font-normal leading-normal text-slate-600 dark:text-slate-300">Rp 250.000</td>
                            <td class="px-6 py-4 text-sm font-normal leading-normal text-slate-600 dark:text-slate-300">45</td>
                            <td class="px-6 py-4 text-sm font-normal leading-normal">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">Aktif</span>
                            </td>
                            <td class="px-6 py-4 text-sm font-bold leading-normal text-right">
                                <a href="{{ route('add-product') }}" class="text-primary hover:text-primary/80 transition-colors">
                                    <span class="material-symbols-outlined">edit</span>
                                </a>
                            </td>
                        </tr>
                        <!-- Baris Produk 2 -->
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-lg w-12 h-12 shadow-sm border border-slate-100 dark:border-slate-700" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCI7D2t3eHEWAurH6VJxunpPay12sVDO7NFLowP0M9j4KYdyus-Sy_57J-ST6rlm0TfCuv-OS22STErpC5BhyOUOgC4sCKOK1Ff17g8K0bVTHtPZwFo0nXnHtc73VZaMfPTMu_mHY_bXnGeL7kiCkrO4KYE9CJoALyCKSaT7aiiAFUYTXtt3RozEIt1_rLHgaBwvRky6miv16_KEkCHl7LQE_D_KsiOoj5eYURKTAEYyZ2x5ulygcdwOlaMOUNo480qfSUuGatWdOU");'></div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium leading-normal text-slate-900 dark:text-white">Kaos Katun Premium</td>
                            <td class="px-6 py-4 text-sm font-normal leading-normal text-slate-600 dark:text-slate-300">Rp 50.000</td>
                            <td class="px-6 py-4 text-sm font-normal leading-normal text-slate-600 dark:text-slate-300">120</td>
                            <td class="px-6 py-4 text-sm font-normal leading-normal">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">Aktif</span>
                            </td>
                            <td class="px-6 py-4 text-sm font-bold leading-normal text-right">
                                <a href="{{ route('add-product') }}" class="text-primary hover:text-primary/80 transition-colors">
                                    <span class="material-symbols-outlined">edit</span>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>