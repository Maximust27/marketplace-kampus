<?php

namespace App\Services;

use App\Models\Conversation;
use App\Models\ConversationParticipant;
use App\Models\Message;
use App\Models\User;
use App\Enums\ConversationRole;
use App\Notifications\OrderNotification;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class MessageService
{
    /**
     * Get user's conversations with last message, other participant, and unread counts.
     */
    public function getConversations(int $userId, string $filter = 'all'): Collection
    {
        $query = Conversation::query()
            ->whereHas('participants', function ($q) use ($userId, $filter) {
                $q->where('conversation_participants.user_id', $userId);
                if ($filter === 'buyer') {
                    $q->where('conversation_participants.role', ConversationRole::Buyer);
                } elseif ($filter === 'seller') {
                    $q->where('conversation_participants.role', ConversationRole::Seller);
                }
            })
            ->with(['product', 'participants', 'messages' => fn($q) => $q->latest()->limit(1)])
            ->orderByDesc('last_message_at');

        $conversations = $query->get();

        // Attach dynamic attributes
        foreach ($conversations as $conv) {
            $myParticipant = $conv->participants->first(fn($p) => $p->id === $userId);
            $lastReadAt = $myParticipant ? $myParticipant->pivot->last_read_at : null;

            // Count unread messages
            $conv->unread_count = Message::where('conversation_id', $conv->id)
                ->where('sender_id', '!=', $userId)
                ->when($lastReadAt, fn($q) => $q->where('created_at', '>', $lastReadAt))
                ->count();

            // Set other participant
            $conv->other_participant = $conv->getOtherParticipant($userId);
            $conv->last_message = $conv->messages->first();
        }

        return $conversations;
    }

    /**
     * Get or create a conversation between buyer and seller.
     */
    public function getOrCreateConversation(int $buyerId, int $sellerId, ?int $productId = null): Conversation
    {
        if ($buyerId === $sellerId) {
            throw new RuntimeException('Tidak bisa memulai percakapan dengan diri sendiri.');
        }

        return DB::transaction(function () use ($buyerId, $sellerId, $productId) {
            // Find existing conversation
            $conversation = Conversation::where('product_id', $productId)
                ->whereHas('participants', function($q) use ($buyerId) {
                    $q->where('conversation_participants.user_id', $buyerId)->where('conversation_participants.role', ConversationRole::Buyer);
                })
                ->whereHas('participants', function($q) use ($sellerId) {
                    $q->where('conversation_participants.user_id', $sellerId)->where('conversation_participants.role', ConversationRole::Seller);
                })
                ->first();

            if ($conversation) {
                return $conversation;
            }

            // Create new conversation
            $conversation = Conversation::create([
                'product_id' => $productId,
                'last_message_at' => now(),
            ]);

            // Add buyer
            ConversationParticipant::create([
                'conversation_id' => $conversation->id,
                'user_id' => $buyerId,
                'role' => ConversationRole::Buyer,
                'last_read_at' => now(),
            ]);

            // Add seller
            ConversationParticipant::create([
                'conversation_id' => $conversation->id,
                'user_id' => $sellerId,
                'role' => ConversationRole::Seller,
                'last_read_at' => null,
            ]);

            return $conversation;
        });
    }

    /**
     * Get messages in a conversation and mark as read.
     */
    public function getMessages(int $conversationId, int $userId, int $perPage = 50): LengthAwarePaginator
    {
        // Check participation
        $participant = ConversationParticipant::where('conversation_id', $conversationId)
            ->where('user_id', $userId)
            ->firstOrFail();

        // Mark as read
        $participant->update(['last_read_at' => now()]);

        return Message::with('sender')
            ->where('conversation_id', $conversationId)
            ->oldest() // Paginate oldest first for chat flow
            ->paginate($perPage);
    }

    /**
     * Send a new message.
     */
    public function sendMessage(int $conversationId, int $senderId, string $body, ?UploadedFile $image = null): Message
    {
        return DB::transaction(function () use ($conversationId, $senderId, $body, $image) {
            // Check participation
            ConversationParticipant::where('conversation_id', $conversationId)
                ->where('user_id', $senderId)
                ->firstOrFail();

            $imagePath = null;
            if ($image) {
                $imagePath = $image->store('messages', 'public');
            }

            $message = Message::create([
                'conversation_id' => $conversationId,
                'sender_id' => $senderId,
                'body' => $body,
                'image_path' => $imagePath,
            ]);

            // Update conversation last message timestamp
            Conversation::where('id', $conversationId)->update([
                'last_message_at' => now(),
            ]);

            // Mark last read for the sender
            ConversationParticipant::where('conversation_id', $conversationId)
                ->where('user_id', $senderId)
                ->update(['last_read_at' => now()]);

            return $message;
        });
    }

    /**
     * Get total unread message count across all conversations.
     */
    public function getUnreadCount(int $userId): int
    {
        $participants = ConversationParticipant::where('user_id', $userId)->get();
        $total = 0;

        foreach ($participants as $p) {
            $total += Message::where('conversation_id', $p->conversation_id)
                ->where('sender_id', '!=', $userId)
                ->when($p->last_read_at, fn($q) => $q->where('created_at', '>', $p->last_read_at))
                ->count();
        }

        return $total;
    }

    /**
     * Mark a conversation as read.
     */
    public function markAsRead(int $conversationId, int $userId): void
    {
        ConversationParticipant::where('conversation_id', $conversationId)
            ->where('user_id', $userId)
            ->update(['last_read_at' => now()]);
    }
}
