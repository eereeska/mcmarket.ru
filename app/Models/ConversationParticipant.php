<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ConversationParticipant
 *
 * @property int $id
 * @property int $conversation_id
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Conversation $conversation
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationParticipant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationParticipant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationParticipant query()
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationParticipant whereConversationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationParticipant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationParticipant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationParticipant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConversationParticipant whereUserId($value)
 * @mixin \Eloquent
 */
class ConversationParticipant extends Model
{
    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}