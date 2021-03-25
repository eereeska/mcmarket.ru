<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ConversationMessage
 *
 * @property int $id
 * @property int $conversation_id
 * @property int $participant_id
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Conversation $conversation
 * @property-read \App\Models\User $participant
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationMessage whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationMessage whereConversationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationMessage whereParticipantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationMessage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ConversationMessage extends Model
{
    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
    
    public function participant()
    {
        return $this->belongsTo(User::class);
    }
}