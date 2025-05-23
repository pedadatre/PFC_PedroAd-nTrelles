<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Recipe $recipe)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = $recipe->comments()->create([
            'user_id' => Auth::id(),
            'content' => $validated['content']
        ]);

        // Otorgar monedas al usuario que comenta
        $commentReward = 2; // 2 monedas por comentar
        Auth::user()->increment('coins_balance', $commentReward);

        return back()->with('success', 'Comentario añadido correctamente');
    }

    public function destroy(Comment $comment)
    {
        // Verificar si el usuario actual es el dueño del comentario o de la receta
        if (Auth::id() === $comment->user_id || Auth::id() === $comment->recipe->user_id) {
            $comment->delete();
            return back()->with('success', 'Comentario eliminado correctamente');
        }

        return back()->with('error', 'No tienes permiso para eliminar este comentario');
    }
}