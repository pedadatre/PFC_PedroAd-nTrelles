<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $categories = ['Pasta', 'Postres', 'Carnes', 'Ensaladas', 'Sopas'];
        
        foreach(range(1, 9) as $i) {
            Recipe::create([
                'user_id' => $user->id,
                'title' => "Receta de prueba $i",
                'description' => "Descripción de la receta de prueba $i",
                'ingredients' => ['ingrediente 1', 'ingrediente 2', 'ingrediente 3'],
                'instructions' => "Instrucciones para la receta $i",
                'image_url' => 'https://www.tuhogar.com/content/dam/cp-sites/home-care/tu-hogar-redesign/thumb-familia-desayunando-hot-cakes.jpg',
                'category' => $categories[array_rand($categories)]
            ]);

        }
    }
}
