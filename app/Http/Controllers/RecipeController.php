<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Services\AchievementService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    protected $achievementService;

    public function __construct(AchievementService $achievementService)
    {
        $this->achievementService = $achievementService;
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|array|min:1',
            'ingredients.*' => 'required|string|max:255',
            'instructions' => 'required|string',
            'image' => 'required|image|max:2048',
            'prep_time' => 'required|integer|min:1',
            'difficulty' => 'required|string|in:facil,medio,dificil',
            'cuisine_type' => 'required|string',
        ]);

        $imagePath = $request->file('image')->store('recipes', 'public');
        $imageUrl = '/storage/' . $imagePath;

        $recipe = Auth::user()->recipes()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'ingredients' => $validated['ingredients'],
            'instructions' => $validated['instructions'],
            'image_url' => $imageUrl,
            'prep_time' => $validated['prep_time'],
            'difficulty' => $validated['difficulty'],
            'cuisine_type' => $validated['cuisine_type'],
        ]);

        $this->achievementService->checkUserAchievements(Auth::user());

        return redirect()->route('recipes.show', $recipe)
            ->with('success', '¡Receta creada exitosamente!');
    }

    public function show(Recipe $recipe)
{
    
    return view('recipes.show', compact('recipe'));
}


    public function like(Recipe $recipe)
    {
        $user = Auth::user();
        
        if ($recipe->likes()->where('user_id', $user->id)->exists()) {
            $recipe->likes()->where('user_id', $user->id)->delete();
            return back()->with('success', 'Se eliminó el me gusta');
        }

        $recipe->likes()->create(['user_id' => $user->id]);
        
        // Verificar logros del creador de la receta
        $this->achievementService->checkUserAchievements($recipe->user);

        return back()->with('success', '¡Me gusta añadido!');
    }
    public function edit(Recipe $recipe)
    {
        if ($recipe->user_id !== Auth::id()) {
            abort(403);
        }
        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        if ($recipe->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|array',
            'instructions' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior
            $oldPath = str_replace('/storage/', 'public/', $recipe->image_url);
            Storage::delete($oldPath);
            
            // Guardar nueva imagen
            $imagePath = $request->file('image')->store('recipes', 'public');
            $validated['image_url'] = Storage::url($imagePath);
        }

        $recipe->update($validated);

        return redirect()->route('recipes.show', $recipe)
            ->with('success', '¡Receta actualizada exitosamente!');
    }

    public function destroy(Recipe $recipe)
    {
        if ($recipe->user_id !== Auth::id()) {
            abort(403);
        }

        Storage::delete(str_replace('/storage/', 'public/', $recipe->image_url));
        $recipe->delete();

        return redirect()->route('home')
            ->with('success', '¡Receta eliminada exitosamente!');
    }
    public function search(Request $request)
    {
        $query = Recipe::with(['user', 'likes', 'comments']);
    
        // Búsqueda existente...
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('ingredients', 'like', "%{$searchTerm}%");
            });
        }
    
        // Filtro por tiempo de preparación
        if ($request->has('prep_time')) {
            switch ($request->prep_time) {
                case 'quick':
                    $query->where('prep_time', '<=', 30); // 30 minutos o menos
                    break;
                case 'medium':
                    $query->whereBetween('prep_time', [31, 60]); // 31-60 minutos
                    break;
                case 'long':
                    $query->where('prep_time', '>', 60); // más de 60 minutos
                    break;
            }
        }
    
        // Filtro por tipo de cocina
        if ($request->has('cuisine_type')) {
            $query->where('cuisine_type', $request->cuisine_type);
        }
    
        // Filtro por dificultad
        if ($request->has('difficulty')) {
            $query->where('difficulty', $request->difficulty);
        }
    
        // Filtro por ingredientes específicos
        if ($request->has('ingredients')) {
            $ingredients = explode(',', $request->ingredients);
            foreach ($ingredients as $ingredient) {
                $query->where('ingredients', 'like', '%' . trim($ingredient) . '%');
            }
        }
    
        // Filtros existentes de ordenamiento y fecha...
    
        $recipes = $query->paginate(12)->withQueryString();
        $cuisineTypes = Recipe::distinct()->pluck('cuisine_type');
    
        return view('recipes.search', compact('recipes', 'cuisineTypes'));
    }

}