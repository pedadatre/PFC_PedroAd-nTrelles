<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::with(['user', 'likes', 'comments'])
                      ->withCount(['likes', 'comments']);

        // Aplicar filtros de búsqueda
        if ($request->filled('search')) {
            $searchTerms = explode(' ', $request->search);
            $query->where(function($q) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $q->where(function($subQ) use ($term) {
                        $subQ->where('title', 'like', "%{$term}%")
                            ->orWhere('description', 'like', "%{$term}%")
                            ->orWhereJsonContains('ingredients', $term);
                    });
                }
            });
        }

        // Filtro de tiempo de preparación
        if ($request->filled('prep_time') && is_numeric($request->prep_time)) {
            $prepTime = (int) $request->prep_time;
            if ($prepTime > 0) {
                $query->where(function($q) use ($prepTime) {
                    $q->where('prep_time', '<=', $prepTime)
                      ->whereNotNull('prep_time');
                });
            }
        }

        // Filtro de tipo de cocina
        if ($request->filled('cuisine_type')) {
            $query->where(function($q) use ($request) {
                $q->where('cuisine_type', 'like', "%{$request->cuisine_type}%")
                  ->whereNotNull('cuisine_type');
            });
        }

        // Filtro de dificultad
        if ($request->filled('difficulty')) {
            $query->where(function($q) use ($request) {
                $q->where('difficulty', $request->difficulty)
                  ->whereNotNull('difficulty');
            });
        }

        // Si hay búsqueda activa, paginar los resultados
        if ($request->hasAny(['search', 'prep_time', 'cuisine_type', 'difficulty'])) {
            $recipes = $query->latest()->paginate(9)->withQueryString();
            $latestRecipes = collect();
            $popularRecipes = collect();
        } else {
            // Si no hay búsqueda, mostrar las secciones normales
            $recipes = collect();
            $latestRecipes = Recipe::with(['user', 'likes', 'comments'])
                                 ->withCount(['likes', 'comments'])
                                 ->latest()
                                 ->take(6)
                                 ->get();
            
            $popularRecipes = Recipe::with(['user', 'likes', 'comments'])
                                  ->withCount(['likes', 'comments'])
                                  ->orderByDesc('likes_count')
                                  ->take(6)
                                  ->get();
        }

        // Recetas recomendadas para usuarios autenticados
        $recommendedRecipes = collect();
        if (Auth::check()) {
            $recommendedRecipes = Recipe::whereHas('likes', function($query) {
                $query->where('user_id', Auth::id());
            })
            ->with(['user', 'likes', 'comments'])
            ->withCount(['likes', 'comments'])
            ->take(6)
            ->get();
        }

        // Obtener tipos de cocina únicos para el filtro
        $cuisineTypes = Recipe::distinct()->pluck('cuisine_type')->filter();

        return view('home', compact(
            'recipes',
            'latestRecipes',
            'popularRecipes',
            'recommendedRecipes',
            'cuisineTypes'
        ));
    }
}