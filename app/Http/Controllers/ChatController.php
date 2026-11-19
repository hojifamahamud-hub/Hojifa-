<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Services\AiMarketingAssistant;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'message' => ['required', 'string', 'max:2000'],
            'name' => ['nullable', 'string', 'max:120'],
            'email' => ['nullable', 'email', 'max:190'],
            'conversation_id' => ['nullable', 'integer'],
        ]);

        $conversation = Conversation::query()
            ->where('id', $data['conversation_id'] ?? 0)
            ->latest('id')
            ->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'user_id' => $request->user()?->id,
                'name' => $data['name'] ?? $request->user()?->name,
                'email' => $data['email'] ?? $request->user()?->email,
                'type' => 'ai',
            ]);
        }

        Message::create(['conversation_id' => $conversation->id, 'sender' => 'visitor', 'body' => $data['message']]);

        $history = $conversation->messages()->latest('id')->take(8)->get()->reverse()
            ->map(fn ($m) => ['role' => $m->sender === 'visitor' ? 'user' : 'assistant', 'content' => $m->body])
            ->all();

        $assistant = new AiMarketingAssistant();
        $reply = $assistant->respond($data['message'], $history);

        Message::create(['conversation_id' => $conversation->id, 'sender' => $assistant->answering() ? 'ai' : 'admin', 'body' => $reply]);

        return response()->json([
            'conversation_id' => $conversation->id,
            'reply' => $reply,
        ]);
    }
}
