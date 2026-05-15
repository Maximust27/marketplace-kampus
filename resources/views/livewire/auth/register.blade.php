<div class="w-full max-w-md">
    <div class="bg-white dark:bg-slate-900 rounded-[12px] shadow-xl shadow-primary/5 border border-slate-100 dark:border-slate-800 p-8">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Buat Akun Baru</h2>
            <p class="text-slate-500 dark:text-slate-400 text-sm">Bergabunglah dengan komunitas marketplace kampus kami.</p>
        </div>

        <form wire:submit="registerUser" class="space-y-5">
            <!-- Name Field -->
            <div class="space-y-2">
                <label class="text-sm font-semibold text-slate-700 dark:text-slate-300 ml-1">Nama Lengkap</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl">person</span>
                    <input wire:model="name" class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-[12px] focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all placeholder:text-slate-400 dark:text-white" placeholder="John Doe" type="text"/>
                </div>
                @error('name') <span class="text-red-500 text-xs ml-1">{{ $message }}</span> @enderror
            </div>

            <!-- Email Field -->
            <div class="space-y-2">
                <label class="text-sm font-semibold text-slate-700 dark:text-slate-300 ml-1">Email Kampus</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl">mail</span>
                    <input wire:model="email" class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-[12px] focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all placeholder:text-slate-400 dark:text-white" placeholder="nama@kampus.ac.id" type="email"/>
                </div>
                @error('email') <span class="text-red-500 text-xs ml-1">{{ $message }}</span> @enderror
            </div>

            <!-- Role Selection -->
            <div class="space-y-2">
                <label class="text-sm font-semibold text-slate-700 dark:text-slate-300 ml-1">Peran di Kampus</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl">badge</span>
                    <select wire:model.live="role" class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-[12px] focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all appearance-none dark:text-white">
                        <option value="" disabled>Pilih peran Anda</option>
                        <option value="mahasiswa">Mahasiswa</option>
                        <option value="dosen">Dosen</option>
                        <option value="staf">Staf Kampus</option>
                    </select>
                    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">expand_more</span>
                </div>
                @error('role') <span class="text-red-500 text-xs ml-1">{{ $message }}</span> @enderror
            </div>

            <!-- Password Field -->
            <div class="space-y-2" x-data="{ show: false }">
                <label class="text-sm font-semibold text-slate-700 dark:text-slate-300 ml-1">Kata Sandi</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl">lock</span>
                    <input wire:model="password" :type="show ? 'text' : 'password'" class="w-full pl-10 pr-10 py-3 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-[12px] focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all placeholder:text-slate-400 dark:text-white" placeholder="Min. 8 karakter"/>
                    <button @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-primary transition-colors" type="button">
                        <span class="material-symbols-outlined" x-text="show ? 'visibility_off' : 'visibility'"></span>
                    </button>
                </div>
                @error('password') <span class="text-red-500 text-xs ml-1">{{ $message }}</span> @enderror
            </div>

            <button class="w-full py-4 bg-primary text-slate-900 font-bold rounded-[12px] hover:shadow-lg hover:shadow-primary/25 active:scale-[0.98] transition-all mt-4" type="submit">
                Daftar Sekarang
            </button>

            <div class="text-center mt-6">
                <p class="text-sm text-slate-500 dark:text-slate-400">
                    Sudah punya akun? <a href="{{ route('login') }}" wire:navigate class="text-primary font-semibold hover:underline">Masuk di sini</a>
                </p>
            </div>
        </form>
    </div>
</div>