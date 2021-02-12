<?php

namespace App\Http\Controllers\Conversations;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\ConversationParticipant;
use App\Models\User;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        return view('conversations.index', [
            'conversations' => $user->participiedConversations
        ]);
    }

    public function show(Request $request, $id)
    {
        $user = $request->user();
        $conversation = Conversation::where('id', $id)->with(['participants', 'messages'])->first();

        if (!$conversation or !ConversationParticipant::where([
            'conversation_id', $conversation->id,
            'user_id' => $user->id
        ])->exists()) {
            return redirect()->route('conversations.index');
        }

        return view('conversations.show', [
            'conversation' => $conversation
        ]);
    }
}