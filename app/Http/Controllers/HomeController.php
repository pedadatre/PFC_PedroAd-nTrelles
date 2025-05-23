<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{public function index()
    {
        // Obtener las recetas más recientes
        $latestRecipes = Recipe::with(['user', 'likes', 'comments'])
            ->withCount(['likes', 'comments'])
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
    
        // Obtener las recetas más populares (con más likes)
        $popularRecipes = Recipe::withCount(['likes', 'comments'])
            ->with(['user', 'likes', 'comments'])
            ->orderBy('likes_count', 'desc')
            ->take(6)
            ->get();
    
        // Si el usuario está autenticado, obtener recetas recomendadas
        $recommendedRecipes = collect();
        if (Auth::check()) {
            $userLikes = Auth::user()->likes()->pluck('recipe_id');
            
            if ($userLikes->isNotEmpty()) {
                $recommendedRecipes = Recipe::whereHas('likes', function($query) use ($userLikes) {
                    $query->whereIn('recipe_id', $userLikes);
                })
                ->with(['user', 'likes', 'comments'])
                ->withCount(['likes', 'comments'])
                ->inRandomOrder()
                ->take(6)
                ->get();
            }
        }
    
        // Para la vista welcome necesitamos featured recipes
        $featuredRecipes = $popularRecipes;
    
        // Determinar qué vista mostrar basado en si el usuario está autenticado
        if (Auth::check()) {
            return view('home', compact('latestRecipes', 'popularRecipes', 'recommendedRecipes'));
        } else {
            return view('welcome', compact('featuredRecipes'));
        }
    }
}