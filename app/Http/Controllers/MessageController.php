<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewMessageNotification;

class MessageController extends Controller
{
    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $user->id,
            'content' => $validated['content']
        ]);

        // Usar el sistema de notificaciones de Laravel
        $user->notify(new NewMessageNotification($message));

        return back()->with('success', 'Mensaje enviado');
    }
    public function index()
    {
        $conversations = Auth::user()->conversations();
        return view('messages.index', compact('conversations'));
    }

    public function show(User $user)
    {
        $messages = Message::where(function($query) use ($user) {
            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $user->id);
        })->orWhere(function($query) use ($user) {
            $query->where('sender_id', $user->id)
                  ->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();

        return view('messages.show', compact('messages', 'user'));
    }

    
}