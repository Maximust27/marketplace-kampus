<?php

namespace App\Livewire\Message;

use App\Models\Conversation;
use App\Services\MessageService;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Exception;

#[Layout('components.layouts.app')]
class Inbox extends Component
{
    use WithFileUploads;

    public $filter = 'all'; // all, buyer, seller
    public $activeConversationId = null;
    public $messageBody = '';
    public $messageImage = null;

    public function mount()
    {
        $conversationId = request()->query('conversation_id');
        if ($conversationId) {
            $this->selectConversation((int)$conversationId);
        }
    }

    public function setFilter(string $filter)
    {
        $this->filter = $filter;
        $this->activeConversationId = null;
    }

    public function selectConversation(int $id)
    {
        $this->activeConversationId = $id;
        $this->messageBody = '';
        $this->messageImage = null;

        // Mark as read immediately
        app(MessageService::class)->markAsRead($id, auth()->id());
    }

    public function sendMessage(MessageService $messageService)
    {
        if (!$this->activeConversationId) return;

        $this->validate([
            'messageBody' => $this->messageImage ? 'nullable|string' : 'required|string',
            'messageImage' => 'nullable|image|max:5120',
        ], [
            'messageBody.required' => 'Tulis pesan terlebih dahulu.',
            'messageImage.image' => 'File harus berupa gambar.',
            'messageImage.max' => 'Ukuran gambar maksimal 5MB.',
        ]);

        try {
            $messageService->sendMessage(
                $this->activeConversationId,
                auth()->id(),
                $this->messageBody ?? '',
                $this->messageImage
            );

            $this->messageBody = '';
            $this->messageImage = null;
            $this->dispatch('message-sent');
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render(MessageService $messageService)
    {
        $conversations = $messageService->getConversations(auth()->id(), $this->filter);
        $messages = [];
        $activeConversation = null;

        if ($this->activeConversationId) {
            // This will also mark messages as read
            $messages = $messageService->getMessages($this->activeConversationId, auth()->id(), 100);
            $activeConversation = Conversation::with(['product', 'participants'])->find($this->activeConversationId);
            if ($activeConversation) {
                $activeConversation->other_participant = $activeConversation->getOtherParticipant(auth()->id());
            }
        }

        return view('livewire.message.inbox', [
            'conversations' => $conversations,
            'messages' => $messages,
            'activeConversation' => $activeConversation,
        ])->title('Pesan - CampusHub');
    }
}