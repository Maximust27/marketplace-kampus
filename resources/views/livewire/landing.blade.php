<?php
use function Livewire\Volt\layout;
layout('components.layouts.app');
?>

<div class="w-full">
    <!-- Hero Section -->
    <section class="relative px-6 py-16 md:py-24">
        <div class="absolute inset-0 -z-10 bg-[radial-gradient(45%_45%_at_50%_50%,rgba(13,242,242,0.15)_0%,rgba(245,248,248,0)_100%)]"></div>
        <div class="mx-auto max-w-[800px] text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 dark:text-slate-100 md:text-6xl">
                Temukan Kebutuhanmu <br/><span class="text-primary">Langsung di Kampus</span>
            </h1>
            <p class="mt-6 text-lg text-slate-600 dark:text-slate-400">
                Cara teraman dan tercepat untuk bertransaksi buku, alat tulis, dan layanan dengan sesama mahasiswa.
            </p>
            <div class="mt-10 flex w-full justify-center">
                <div class="group relative flex w-full max-w-2xl items-center gap-2 rounded-xl border border-slate-200 bg-white p-2 shadow-xl transition-all focus-within:ring-2 focus-within:ring-primary dark:border-slate-800 dark:bg-slate-900">
                    <span class="material-symbols-outlined ml-3 text-slate-400">search</span>
                    <input class="w-full border-none bg-transparent px-2 py-3 text-lg focus:outline-none focus:ring-0 placeholder:text-slate-400" placeholder="Cari buku, elektronik, keperluan kost..." type="text"/>
                    <button class="h-full rounded-lg bg-primary px-8 py-3 text-base font-extrabold text-background-dark transition-all hover:scale-105 active:scale-95">
                        Cari
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="mx-auto max-w-[1200px] px-6 py-12">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <div class="group flex flex-col gap-4 rounded-xl border border-slate-200 bg-white p-8 shadow-sm transition-all hover:border-primary/50 dark:border-slate-800 dark:bg-slate-900/50">
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-primary/10 text-primary">
                    <span class="material-symbols-outlined text-3xl">bolt</span>
                </div>
                <div>
                    <h3 class="text-xl font-bold">Jual Cepat</h3>
                    <p class="mt-2 text-slate-600 dark:text-slate-400 leading-relaxed">Posting barangmu dalam hitungan menit. Terhubung langsung dengan pembeli di kampus yang sama.</p>
                </div>
            </div>
            <div class="group flex flex-col gap-4 rounded-xl border border-slate-200 bg-white p-8 shadow-sm transition-all hover:border-primary/50 dark:border-slate-800 dark:bg-slate-900/50">
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-primary/10 text-primary">
                    <span class="material-symbols-outlined text-3xl">shield_person</span>
                </div>
                <div>
                    <h3 class="text-xl font-bold">Belanja Aman</h3>
                    <p class="mt-2 text-slate-600 dark:text-slate-400 leading-relaxed">Hanya untuk akun mahasiswa terverifikasi. COD langsung di area kampus yang aman.</p>
                </div>
            </div>
            <div class="group flex flex-col gap-4 rounded-xl border border-slate-200 bg-white p-8 shadow-sm transition-all hover:border-primary/50 dark:border-slate-800 dark:bg-slate-900/50">
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-primary/10 text-primary">
                    <span class="material-symbols-outlined text-3xl">visibility</span>
                </div>
                <div>
                    <h3 class="text-xl font-bold">Transparan</h3>
                    <p class="mt-2 text-slate-600 dark:text-slate-400 leading-relaxed">Tanpa biaya admin tersembunyi. Sejarah komunikasi jelas dan foto produk asli.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Recommended Products -->
    <section class="mx-auto max-w-[1200px] px-6 py-16 mb-12">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-extrabold tracking-tight">Rekomendasi Hari Ini</h2>
                <p class="mt-2 text-slate-500">Berdasarkan aktivitas dan jurusanmu</p>
            </div>
            <button class="text-sm font-bold text-primary underline underline-offset-4 hover:text-primary/80">Lihat Semua</button>
        </div>
        
        <div class="grid grid-cols-2 gap-6 sm:grid-cols-3 md:grid-cols-4">
            <!-- Product Card 1 -->
            <div class="group flex flex-col gap-4">
                <div class="relative aspect-square overflow-hidden rounded-xl bg-slate-100 dark:bg-slate-800">
                    <a href="#">
                        <img class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCP3a9j2FqqP8MBvMVaGJsz8QqpjglbbDoMW_nf0SO4su87NPLUDmXR38CoOYMLZUOxQ5U0odZJ_TRppu4V5cfxCKBWd4wzg1bhFp8FvobxSce8PqdVC_ZDKP0i6GWhV7CnLgiiHPYacbSdxSUFnkt--h6MyWhWzWTpyCmSI-Tnh1KZ0ZWaBlhvpM_SHwZuL-kLdaFhewbboU1vu9dU_zcPiE4QdPgXZF1pplRlDvBvot8ojACG6soum0NxPRkFRywbxrfnL9dYq2U"/>
                    </a>
                    <button class="absolute bottom-3 right-3 flex h-10 w-10 items-center justify-center rounded-full bg-white/90 text-background-dark shadow-md backdrop-blur-sm transition-all hover:bg-primary">
                        <span class="material-symbols-outlined text-xl">add_shopping_cart</span>
                    </button>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 dark:text-slate-100 line-clamp-1"><a class="hover:text-primary transition-colors" href="#">Buku Biologi: Edisi Global</a></h4>
                    <p class="mt-1 text-lg font-extrabold text-primary">Rp 150.000</p>
                    <p class="mt-1 text-xs text-slate-500 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">location_on</span> Perpus Teknik
                    </p>
                </div>
            </div>

            <!-- Product Card 2 -->
            <div class="group flex flex-col gap-4">
                <div class="relative aspect-square overflow-hidden rounded-xl bg-slate-100 dark:bg-slate-800">
                    <a href="#">
                        <img class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCIVvbgYmJgZ_nuMjZl6U6_ElEcCiqBzd3_EiZq08H1Tlq597gKYx45cI6RJC6gikN1CoVG84ArFA9im85u6xFuXMpRmY7hwUjnzP0HNbulVtQLptjrEfkNQ1BwGn5MT4pbKqCoJfAiGkzuw3ETKmof6QIlxmKdss3unWIpPNISRsH70uuw_MeBSd4Mu8qPCJkSMAFyLbm24loXOMLQbZpGw1nkcGgjDRQJF-tbo6RWGpp16PDu4rFuv4uS-C7KE8T2mVX4ccVD38U"/>
                    </a>
                    <button class="absolute bottom-3 right-3 flex h-10 w-10 items-center justify-center rounded-full bg-white/90 text-background-dark shadow-md backdrop-blur-sm transition-all hover:bg-primary">
                        <span class="material-symbols-outlined text-xl">add_shopping_cart</span>
                    </button>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 dark:text-slate-100 line-clamp-1"><a class="hover:text-primary transition-colors" href="#">Kalkulator Scientific Pro</a></h4>
                    <p class="mt-1 text-lg font-extrabold text-primary">Rp 250.000</p>
                    <p class="mt-1 text-xs text-slate-500 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">location_on</span> Student Center
                    </p>
                </div>
            </div>

            <!-- Product Card 3 -->
            <div class="group flex flex-col gap-4">
                <div class="relative aspect-square overflow-hidden rounded-xl bg-slate-100 dark:bg-slate-800">
                    <a href="#">
                        <img class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAZ3pLssrdMoN8q0zAOldmVRODypl63lLzyY7tmG-A2OV6gk6WHXniAlLMcmI8zxtbOoYocPdVly43QPVi9IPrQ6Jn-ICRH4OmnSXSNlazs_uEHJGE5rNIVPJE2cnGYroBQHg8FrTwtuXiIana0tx7ZS9WgDGsiolfOIYuAzRR1HFaJZ6UHzBJqFE0xkCoXZw7Rf7Om8D0ckfrWvCxLGXAsDAmHdDX9FRxK8oBCWlPronsxJ41JbrfZ_fRA7voTKhQP4EwJtalwZz4"/>
                    </a>
                    <button class="absolute bottom-3 right-3 flex h-10 w-10 items-center justify-center rounded-full bg-white/90 text-background-dark shadow-md backdrop-blur-sm transition-all hover:bg-primary">
                        <span class="material-symbols-outlined text-xl">add_shopping_cart</span>
                    </button>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 dark:text-slate-100 line-clamp-1"><a class="hover:text-primary transition-colors" href="#">Lampu Belajar Kayu</a></h4>
                    <p class="mt-1 text-lg font-extrabold text-primary">Rp 85.000</p>
                    <p class="mt-1 text-xs text-slate-500 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">location_on</span> Kost Utara
                    </p>
                </div>
            </div>

            <!-- Product Card 4 -->
            <div class="group flex flex-col gap-4">
                <div class="relative aspect-square overflow-hidden rounded-xl bg-slate-100 dark:bg-slate-800">
                    <a href="#">
                        <img class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA7jbRgZeJ6TAB001yzRRfmA3LLKUCM30xsUyIC4e4PjKkXbKvojLNfOqCf963QtMdaJAePCaR8FKxF4719vGgOOBb3EhOrAwLAjllLMV2htGQ28ENcA7ujhhzhMdeRB-pyqi9i1XmM33JEfKvHXI6Xt813orzk7DuBLmZf0kElOAHYNsls8Qg5yCgslFDE0x04aBnieJjXSZToueD_xTEmhKc8WwtfsKNkNxAXDlNpqzVKe6XHUiaGIefZIBlKtQ_D-7S0mpuO5mg"/>
                    </a>
                    <button class="absolute bottom-3 right-3 flex h-10 w-10 items-center justify-center rounded-full bg-white/90 text-background-dark shadow-md backdrop-blur-sm transition-all hover:bg-primary">
                        <span class="material-symbols-outlined text-xl">add_shopping_cart</span>
                    </button>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 dark:text-slate-100 line-clamp-1"><a class="hover:text-primary transition-colors" href="#">Headphone Noise Cancelling</a></h4>
                    <p class="mt-1 text-lg font-extrabold text-primary">Rp 1.200.000</p>
                    <p class="mt-1 text-xs text-slate-500 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">location_on</span> Area Fak. Hukum
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>