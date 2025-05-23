<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserItemController;

// Rutas públicas
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [RecipeController::class, 'search'])->name('recipes.search');
Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');

// Rutas que requieren autenticación
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'own'])->name('profile.own');
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Interacciones con recetas
    Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
    Route::post('/recipes/{recipe}/like', [RecipeController::class, 'like'])->name('recipes.like');
    Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
    Route::put('/recipes/{recipe}', [RecipeController::class, 'update'])->name('recipes.update');
    Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('recipes.destroy');
      // Comentarios
      Route::post('/recipes/{recipe}/comments', [CommentController::class, 'store'])->name('comments.store');
      Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
         // Búsqueda y filtros
    

   // Tienda
   Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
   Route::post('/shop/{item}/purchase', [ShopController::class, 'purchase'])->name('shop.purchase');
   Route::get('/shop/inventory', [ShopController::class, 'inventory'])->name('shop.inventory');

    // Chat
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{user}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{user}', [ChatController::class, 'store'])->name('chat.store');

    // Items del usuario
    Route::post('/user/items/{item}/equip', [UserItemController::class, 'equipItem'])->name('user.items.equip');
    Route::post('/user/items/{type}/unequip', [UserItemController::class, 'unequipItem'])->name('user.items.unequip');
});

// Rutas de autenticación
require __DIR__.'/auth.php';