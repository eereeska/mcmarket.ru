<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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