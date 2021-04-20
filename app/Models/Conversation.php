<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public function participants()
    {
        return $this->belongsToMany(ConversationParticipant::class);
    }
}