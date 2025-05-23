<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $conversations = Message::where('sender_id', Auth::id())
            ->orWhere('receiver_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($message) {
                return $message->sender_id === Auth::id() 
                    ? $message->receiver_id 
                    : $message->sender_id;
            });

        return view('chat.index', compact('conversations'));
    }

    public function show(User $user)
    {
        $messages = Message::where(function ($query) use ($user) {
            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('sender_id', $user->id)
                  ->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')
          ->get();

        return view('chat.show', compact('user', 'messages'));
    }

    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $user->id,
            'content' => $validated['content']
        ]);

        return back();
    }
}