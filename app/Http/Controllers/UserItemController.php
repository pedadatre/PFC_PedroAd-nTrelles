<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserItemController extends Controller
{
    public function equipItem(Item $item)
    {
        $user = Auth::user();

        // Verificar si el usuario tiene el item
        if (!$user->items->contains($item->id)) {
            return back()->with('error', 'No posees este item');
        }

        // Equipar según el tipo
        switch ($item->type) {
            case 'avatar':
                $user->active_avatar_id = $item->id;
                break;
            case 'badge':
                $user->active_badge_id = $item->id;
                break;
            default:
                return back()->with('error', 'Tipo de item no válido');
        }

        $user->save();

        return back()->with('success', 'Item equipado exitosamente');
    }

    public function unequipItem($type)
    {
        $user = Auth::user();

        switch ($type) {
            case 'avatar':
                $user->active_avatar_id = null;
                break;
            case 'badge':
                $user->active_badge_id = null;
                break;
            default:
                return back()->with('error', 'Tipo de item no válido');
        }

        $user->save();

        return back()->with('success', 'Item desequipado exitosamente');
    }
}