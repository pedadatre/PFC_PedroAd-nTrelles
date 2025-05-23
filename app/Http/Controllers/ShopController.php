<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        $items = Item::all();
        $userCoins = Auth::user()->coins;
        
        return view('shop.index', compact('items', 'userCoins'));
    }

    public function purchase(Item $item)
    {
        $user = Auth::user();

        if ($user->coins < $item->price) {
            return back()->with('error', 'No tienes suficientes monedas');
        }

        $user->items()->attach($item->id);
        $user->decrement('coins', $item->price);

        return back()->with('success', '¡Item comprado exitosamente!');
    }

    public function inventory()
    {
        $items = Auth::user()->items;
        return view('shop.inventory', compact('items'));
    }
}