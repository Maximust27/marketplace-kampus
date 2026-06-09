<main wire:poll.2s class="flex-grow flex overflow-hidden max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-6 gap-6 h-[calc(100vh-80px)]">
    <!-- Sidebar Navigation & Chat List -->
    <div class="w-80 flex flex-col shrink-0">
        <div class="flex-1 bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 flex flex-col overflow-hidden">
            <!-- Header Inbox -->
            <div class="p-4 border-b border-slate-100 dark:border-slate-800 flex flex-col gap-4">
                <div class="flex items-center justify-between">
                    <h3 class="font-bold text-lg text-slate-900 dark:text-white font-bold">Inbox</h3>
                    @php
                        $totalUnread = app(App\Services\MessageService::class)->getUnreadCount(auth()->id());
                    @endphp
                    @if($totalUnread > 0)
                        <span class="bg-primary/20 text-primary text-xs font-bold px-2 py-0.5 rounded-full">{{ $totalUnread }} Baru</span>
                    @endif
                </div>
                <!-- Tabs Filter -->
                <div class="flex p-1 bg-slate-100 dark:bg-slate-800 rounded-xl">
                    <button wire:click="setFilter('all')" class="flex-1 py-1.5 text-xs font-bold rounded-lg transition-all {{ $filter === 'all' ? 'bg-white dark:bg-slate-700 shadow-sm text-slate-900 dark:text-white' : 'text-slate-500 hover:text-slate-700 dark:hover:text-slate-300' }}">Semua</button>
                    <button wire:click="setFilter('buyer')" class="flex-1 py-1.5 text-xs font-bold rounded-lg transition-all {{ $filter === 'buyer' ? 'bg-white dark:bg-slate-700 shadow-sm text-slate-900 dark:text-white' : 'text-slate-500 hover:text-slate-700 dark:hover:text-slate-300' }}">Beli</button>
                    <button wire:click="setFilter('seller')" class="flex-1 py-1.5 text-xs font-bold rounded-lg transition-all {{ $filter === 'seller' ? 'bg-white dark:bg-slate-700 shadow-sm text-slate-900 dark:text-white' : 'text-slate-500 hover:text-slate-700 dark:hover:text-slate-300' }}">Jual</button>
                </div>
            </div>

            <!-- List Chat -->
            <div class="flex-1 overflow-y-auto divide-y divide-slate-100 dark:divide-slate-800 custom-scrollbar">
                @forelse($conversations as $conv)
                    <div wire:click="selectConversation({{ $conv->id }})" class="p-4 cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-800 transition-all border-l-4 {{ $activeConversationId === $conv->id ? 'bg-primary/5 border-primary' : 'border-transparent' }}">
                        <div class="flex gap-3">
                            <div class="relative shrink-0">
                                <img class="w-12 h-12 rounded-full object-cover" src="{{ $conv->other_participant->avatar_url }}" alt="{{ $conv->other_participant->name }}"/>
                                @if($conv->other_participant->isOnline())
                                    <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white dark:border-slate-900 rounded-full"></span>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-baseline mb-0.5">
                                    <h4 class="font-bold text-sm truncate text-slate-900 dark:text-white">{{ $conv->other_participant->name }}</h4>
                                    <span class="text-[10px] text-slate-400">{{ $conv->last_message_at ? $conv->last_message_at->diffForHumans() : '' }}</span>
                                </div>
                                <div class="flex items-center justify-between gap-1">
                                    <p class="text-xs truncate {{ $conv->unread_count > 0 ? 'text-primary font-bold' : 'text-slate-500 dark:text-slate-400' }}">
                                        {{ $conv->last_message ? $conv->last_message->body : 'Mulai percakapan...' }}
                                    </p>
                                    @if($conv->unread_count > 0)
                                        <span class="bg-primary text-slate-900 font-bold text-[10px] px-1.5 py-0.5 rounded-full shrink-0">{{ $conv->unread_count }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-slate-500 dark:text-slate-400 text-sm">
                        <span class="material-symbols-outlined text-3xl mb-2 text-slate-400">forum</span>
                        <p>Tidak ada percakapan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Empty State / Conversation Area -->
    @if($activeConversationId && $activeConversation)
        <div class="flex-1 bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 flex flex-col overflow-hidden relative">
            <!-- Header Chat -->
            <div class="p-4 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between bg-slate-50/50 dark:bg-slate-900/50">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <img class="w-10 h-10 rounded-full object-cover" src="{{ $activeConversation->other_participant->avatar_url }}" alt="{{ $activeConversation->other_participant->name }}"/>
                        @if($activeConversation->other_participant->isOnline())
                            <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-500 border-2 border-white dark:border-slate-900 rounded-full"></span>
                        @endif
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-slate-900 dark:text-white">{{ $activeConversation->other_participant->name }}</h4>
                        <p class="text-[10px] text-slate-500">
                            {{ $activeConversation->other_participant->role->label() }} 
                            • {{ $activeConversation->other_participant->isOnline() ? 'Online' : 'Offline' }}
                        </p>
                    </div>
                </div>

                <!-- Product Attachment Badge in Header -->
                @if($activeConversation->product->id)
                    <a href="{{ route('detail-product', $activeConversation->product->slug) }}" wire:navigate class="flex items-center gap-2 max-w-[200px] bg-slate-100 dark:bg-slate-800 p-2 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors border border-slate-200/50 dark:border-slate-750">
                        <img src="{{ $activeConversation->product->image_path ? Storage::url($activeConversation->product->image_path) : 'https://via.placeholder.com/100' }}" alt="{{ $activeConversation->product->name }}" class="w-8 h-8 rounded object-cover flex-shrink-0">
                        <div class="min-w-0">
                            <p class="text-[10px] font-bold truncate text-slate-900 dark:text-white">{{ $activeConversation->product->name }}</p>
                            <p class="text-[9px] text-primary font-bold">Rp {{ number_format($activeConversation->product->price, 0, ',', '.') }}</p>
                        </div>
                    </a>
                @endif
            </div>

            <!-- Messages List -->
            <div class="flex-1 p-4 overflow-y-auto space-y-4 flex flex-col custom-scrollbar">
                @foreach($messages as $msg)
                    @php
                        $isMe = $msg->sender_id === auth()->id();
                    @endphp
                    <div class="flex flex-col {{ $isMe ? 'items-end' : 'items-start' }} w-full">
                        <div class="max-w-[70%] flex flex-col gap-1">
                            @if(!$isMe)
                                <span class="text-[9px] text-slate-400 font-bold ml-1">{{ $msg->sender->name }}</span>
                            @endif
                            <div class="p-3 rounded-2xl text-sm shadow-sm {{ $isMe ? 'bg-primary text-slate-900 rounded-tr-none' : 'bg-slate-100 dark:bg-slate-800 text-slate-900 dark:text-white rounded-tl-none border border-slate-200/30 dark:border-slate-750' }}">
                                @if($msg->image_path)
                                    <div class="mb-2 max-h-48 rounded-lg overflow-hidden border border-slate-200/20">
                                        <img src="{{ Storage::url($msg->image_path) }}" alt="attachment" class="w-full h-full object-cover">
                                    </div>
                                @endif
                                <p class="whitespace-pre-wrap">{{ $msg->body }}</p>
                            </div>
                            <span class="text-[9px] text-slate-400 px-1 {{ $isMe ? 'text-right' : 'text-left' }}">{{ $msg->created_at->format('H:i') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Message Form Input -->
            <div class="p-4 border-t border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
                <!-- Image Upload Preview -->
                @if($messageImage)
                    <div class="relative w-20 h-20 rounded-lg overflow-hidden border border-primary/40 mb-3 bg-slate-100">
                        <img src="{{ $messageImage->temporaryUrl() }}" alt="attachment preview" class="w-full h-full object-cover">
                        <button wire:click="$set('messageImage', null)" class="absolute top-1 right-1 bg-black/60 rounded-full p-1 text-white hover:bg-black transition-colors">
                            <span class="material-symbols-outlined text-xs">close</span>
                        </button>
                    </div>
                @endif

                <form wire:submit="sendMessage" class="flex items-center gap-3">
                    <!-- File input trigger -->
                    <label class="cursor-pointer text-slate-400 hover:text-primary transition-colors p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                        <span class="material-symbols-outlined">attach_file</span>
                        <input type="file" wire:model="messageImage" class="hidden" accept="image/*">
                    </label>

                    <!-- Message Body -->
                    <input wire:model="messageBody" class="flex-1 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-750 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary focus:border-transparent outline-none dark:text-white" placeholder="Ketik pesan..." type="text"/>

                    <!-- Submit -->
                    <button type="submit" class="bg-primary text-slate-900 p-3 rounded-xl hover:opacity-90 active:scale-95 transition-all shadow-md shadow-primary/20 flex items-center justify-center">
                        <span class="material-symbols-outlined">send</span>
                    </button>
                </form>
                @error('messageImage') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>
    @else
        <!-- Empty State -->
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

            <h2 class="text-2xl font-bold mb-3 text-slate-900 dark:text-white font-bold">Pilih percakapan untuk memulai</h2>
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
    @endif
</main>