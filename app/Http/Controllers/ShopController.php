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
    $userCoins = Auth::user()->coins_balance;
    
    return view('shop.index', compact('items', 'userCoins'));
}

public function purchase(Item $item)
{
    $user = Auth::user();

    if ($user->coins_balance < $item->price) { 
        return back()->with('error', 'No tienes suficientes monedas');
    }

    // Evitar compra duplicada
    if ($user->items()->where('item_id', $item->id)->exists()) {
        return back()->with('error', 'Ya tienes este ítem en tu inventario');
    }

    $user->items()->attach($item->id);
    $user->decrement('coins_balance', $item->price); 

    return back()->with('success', '¡Item comprado exitosamente!');
}

    public function inventory()
    {
        $items = Auth::user()->items;
        return view('shop.inventory', compact('items'));
    }
}