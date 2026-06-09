<?php

namespace App\Models;

use App\Enums\ConversationRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConversationParticipant extends Model
{
    use HasFactory;

    protected $table = 'conversation_participants';
    const UPDATED_AT = null;

    protected $fillable = [
        'conversation_id',
        'user_id',
        'role',
        'last_read_at',
    ];

    protected $casts = [
        'role' => ConversationRole::class,
        'last_read_at' => 'datetime',
    ];

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
