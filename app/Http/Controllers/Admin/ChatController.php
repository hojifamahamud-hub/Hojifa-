<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $conversations = Conversation::query()
            ->withCount('messages')
            ->orderByDesc('updated_at')
            ->paginate(30);

        return view('admin.chats.index', compact('conversations'));
    }

    public function show(Conversation $conversation)
    {
        $conversation->load(['messages', 'user']);
        $conversation->update(['unread' => false]);

        return view('admin.chats.show', compact('conversation'));
    }

    public function reply(Request $request, Conversation $conversation)
    {
        $data = $request->validate([
            'body' => ['required', 'string', 'max:4000'],
        ]);

        Message::create([
            'conversation_id' => $conversation->id,
            'sender' => 'admin',
            'body' => $data['body'],
        ]);

        $conversation->update(['unread' => false]);

        return redirect()->route('admin.chats.show', $conversation)->with('success', __('site.admin.sent'));
    }
}
