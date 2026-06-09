<div class="w-full max-w-md">
    <div class="bg-white rounded-[12px] shadow-xl overflow-hidden border border-slate-100">
        
        <div class="p-8">
            <div class="mb-8 text-center">
                <h2 class="text-2xl font-bold text-slate-900">Selamat Datang</h2>
                <p class="text-slate-500 mt-2">Masuk ke akun untuk mulai berbelanja di kampusmu</p>
            </div>
            
            <form wire:submit="authenticate" class="space-y-6">
                <!-- Input Email -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2" for="email">Email Kampus</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">mail</span>
                        <input wire:model="email" id="email" type="email" placeholder="nama@kampus.ac.id"
                            class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all rounded-[12px]"/>
                    </div>
                    @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Input Password -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-sm font-semibold text-slate-700" for="password">Kata Sandi</label>
                        <a href="#" class="text-xs font-medium text-primary hover:underline">Lupa Sandi?</a>
                    </div>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">lock</span>
                        <input wire:model="password" id="password" type="password" placeholder="••••••••"
                            class="w-full pl-10 pr-12 py-3 bg-slate-50 border border-slate-200 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all rounded-[12px]"/>
                    </div>
                </div>

                <!-- Checkbox Ingat Saya -->
                <div class="flex items-center">
                    <input wire:model="remember" id="remember" type="checkbox"
                        class="w-4 h-4 text-primary bg-slate-100 border-slate-300 focus:ring-primary rounded-[4px]"/>
                    <label class="ml-2 text-sm text-slate-500" for="remember">Ingat saya</label>
                </div>

                <!-- Tombol Masuk -->
                <button type="submit" class="w-full bg-primary hover:opacity-90 text-slate-900 font-bold py-3.5 transition-all shadow-lg shadow-primary/20 rounded-[12px]">
                    Masuk
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-sm text-slate-500">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" wire:navigate class="text-primary font-bold hover:underline ml-1">Daftar Sekarang</a>
                </p>
            </div>
        </div>


    </div>
</div>