<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show(User $user): View
    {
        $user->load(['recipes.likes', 'recipes.comments', 'achievements']);
        $totalLikes = $user->recipes->sum(function($recipe) {
            return $recipe->likes->count();
        });
        return view('profile.show', compact('user', 'totalLikes'));
    }

    public function own(): View
    {
        $user = Auth::user();
        $user->load(['recipes.likes', 'recipes.comments', 'achievements']);
        $totalLikes = $user->recipes->sum(function($recipe) {
            return $recipe->likes->count();
        });
        return view('profile.show', compact('user', 'totalLikes'));
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($request->hasFile('avatar')) {
            // Eliminar la foto anterior (si existe) para no acumular archivos
            if ($user->avatar_url) {
                $oldPath = str_replace('/storage/', 'public/', $user->avatar_url);
                Storage::delete($oldPath);
            }
            // Guardar la nueva foto en public/avatars (o en la carpeta que prefieras)
            $avatarPath = $request->file('avatar')->store('public/avatars');
            $user->avatar_url = Storage::url($avatarPath);
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}