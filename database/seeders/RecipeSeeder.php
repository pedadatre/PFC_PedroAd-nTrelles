<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\User;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        // Se asume que existe un usuario con id 1 (por ejemplo, creado por el UserSeeder)
        $user = User::find(1);
        if (!$user) {
            User::where('email', 'test@example.com')->delete();
            $user = User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        $recipes = [
            [
                'title' => 'Paella de Mariscos',
                'description' => 'Una paella tradicional con gambas, mejillones y calamares, cocinada en paellera con arroz y azafrán.',
                'ingredients' => ['arroz', 'gambas', 'mejillones', 'calamares', 'azafrán', 'pimiento', 'tomate', 'aceite de oliva', 'agua', 'sal'],
                'instructions' => 'Calentar aceite en la paellera, sofreír el pimiento y el tomate. Añadir los mariscos y el arroz, cubrir con agua y azafrán. Cocinar a fuego medio hasta que el arroz esté listo.',
                'image_url' => 'https://www.brillante.es/wp-content/uploads/2018/06/paella-de-marisco.jpg',
                'prep_time' => 60,
                'difficulty' => 'medio',
                'cuisine_type' => 'Española',
            ],
            [
                'title' => 'Tiramisú',
                'description' => 'Postre italiano a base de bizcochos de soletilla, café, mascarpone y cacao en polvo.',
                'ingredients' => ['bizcochos de soletilla', 'café', 'mascarpone', 'huevos', 'azúcar', 'cacao en polvo'],
                'instructions' => 'Montar las claras a punto de nieve, mezclar las yemas con azúcar y mascarpone. Mojar los bizcochos en café y montar capas con la crema. Espolvorear cacao.',
                'image_url' => 'https://www.paulinacocina.net/wp-content/uploads/2020/01/receta-de-tiramisu-facil-y-economico-1740483918-800x800.jpg',
                'prep_time' => 30,
                'difficulty' => 'facil',
                'cuisine_type' => 'Italiana',
            ],
            [
                'title' => 'Ensalada César',
                'description' => 'Ensalada con lechuga romana, pollo a la parrilla, crutones, queso parmesano y aderezo César.',
                'ingredients' => ['lechuga romana', 'pollo', 'crutones', 'queso parmesano', 'aderezo César', 'aceite de oliva', 'sal', 'pimienta'],
                'instructions' => 'Cortar la lechuga, cocinar el pollo y cortarlo en tiras. Mezclar en un bol con crutones, queso rallado y aderezo César.',
                'image_url' => 'https://www.culinariamente.com/wp-content/uploads/2024/10/Receta-de-ensalada-Cesar-con-pollo.jpg',
                'prep_time' => 20,
                'difficulty' => 'facil',
                'cuisine_type' => 'Americana',
            ],
            [
                'title' => 'Curry de Pollo',
                'description' => 'Curry de pollo con leche de coco, curry en polvo, verduras y arroz basmati.',
                'ingredients' => ['pollo', 'leche de coco', 'curry en polvo', 'cebolla', 'zanahoria', 'arroz basmati', 'aceite', 'sal', 'pimienta'],
                'instructions' => 'Cortar el pollo y las verduras. Sofreír la cebolla, añadir el pollo y el curry. Agregar leche de coco y cocinar hasta que el pollo esté tierno. Servir con arroz basmati.',
                'image_url' => 'https://www.pequerecetas.com/wp-content/uploads/2023/12/pollo-al-curry-con-nata-receta-tradicional.jpg',
                'prep_time' => 45,
                'difficulty' => 'medio',
                'cuisine_type' => 'India',
            ],
            [
                'title' => 'Pizza Margherita',
                'description' => 'Pizza clásica con masa, salsa de tomate, mozzarella y albahaca.',
                'ingredients' => ['masa de pizza', 'salsa de tomate', 'mozzarella', 'albahaca', 'aceite de oliva', 'sal'],
                'instructions' => 'Estirar la masa, cubrir con salsa de tomate, mozzarella y albahaca. Hornear a 220°C hasta que la masa esté dorada.',
                'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/c/c8/Pizza_Margherita_stu_spivack.jpg',
                'prep_time' => 25,
                'difficulty' => 'facil',
                'cuisine_type' => 'Italiana',
            ],
            [
                'title' => 'Salmón a la Parrilla',
                'description' => 'Filete de salmón a la parrilla con limón, eneldo y verduras asadas.',
                'ingredients' => ['salmón', 'limón', 'eneldo', 'verduras (por ejemplo, espárragos, calabacín)', 'aceite de oliva', 'sal', 'pimienta'],
                'instructions' => 'Sazonar el salmón con limón, eneldo, sal y pimienta. Asar a la parrilla (o en sartén) hasta que esté cocido. Servir con verduras asadas.',
                'image_url' => 'https://asosalimar.com/wp-content/uploads/2024/01/Untitled-design-10.png',
                'prep_time' => 30,
                'difficulty' => 'facil',
                'cuisine_type' => 'Mediterránea',
            ],
            [
                'title' => 'Brownie de Chocolate',
                'description' => 'Brownie húmedo y denso con chocolate negro, mantequilla, azúcar, huevos y harina.',
                'ingredients' => ['chocolate negro', 'mantequilla', 'azúcar', 'huevos', 'harina', 'nueces (opcional)'],
                'instructions' => 'Derretir chocolate y mantequilla, mezclar con azúcar, huevos y harina. Opcionalmente, añadir nueces. Hornear a 180°C hasta que esté firme por fuera y húmedo por dentro.',
                'image_url' => 'https://www.annarecetasfaciles.com/files/brownie-img_5335.jpg',
                'prep_time' => 40,
                'difficulty' => 'facil',
                'cuisine_type' => 'Postre',
            ],
            [
                'title' => 'Sushi Roll',
                'description' => 'Roll de sushi con arroz, pescado (por ejemplo, salmón), aguacate, pepino y alga nori.',
                'ingredients' => ['arroz para sushi', 'salmón', 'aguacate', 'pepino', 'alga nori', 'vinagre de arroz', 'salsa de soja', 'wasabi (opcional)'],
                'instructions' => 'Cocer el arroz y mezclarlo con vinagre de arroz. Colocar el alga nori, extender el arroz, añadir el pescado, aguacate y pepino. Enrollar, cortar y servir con salsa de soja y wasabi.',
                'image_url' => 'https://www.kikkoman.es/fileadmin/_processed_/0/f/csm_1025-recipe-page-Spicy-tuna-and-salmon-rolls_desktop_b6172c0072.jpg',
                'prep_time' => 50,
                'difficulty' => 'dificil',
                'cuisine_type' => 'Japonesa',
            ],
            [
                'title' => 'Gazpacho',
                'description' => 'Sopa fría de tomate, pepino, pimiento, ajo, aceite de oliva y vinagre.',
                'ingredients' => ['tomates', 'pepino', 'pimiento', 'ajo', 'aceite de oliva', 'vinagre', 'agua', 'sal', 'pimienta'],
                'instructions' => 'Triturar todos los ingredientes hasta obtener una sopa líquida. Refrigerar y servir frío.',
                'image_url' => 'https://img2.rtve.es/i/?w=1600&i=1622113766371.jpg',
                'prep_time' => 15,
                'difficulty' => 'facil',
                'cuisine_type' => 'Española',
            ],
            [
                'title' => 'Pasta Alfredo',
                'description' => 'Pasta con salsa Alfredo (nata, mantequilla, queso parmesano) y pollo a la parrilla.',
                'ingredients' => ['pasta (por ejemplo, fettuccine)', 'nata', 'mantequilla', 'queso parmesano', 'pollo', 'ajo', 'sal', 'pimienta'],
                'instructions' => 'Cocer la pasta. En una sartén, derretir mantequilla, añadir ajo, nata y queso rallado. Mezclar con la pasta y el pollo cocinado. Sazonar con sal y pimienta.',
                'image_url' => 'https://assets.tmecosys.com/image/upload/t_web_rdp_recipe_584x480_1_5x/img/recipe/ras/Assets/66cef03a-bad8-4c37-aba8-769aa62ec076/Derivates/d5049f83-4843-4504-aa92-253f1e141650.jpg',
                'prep_time' => 30,
                'difficulty' => 'facil',
                'cuisine_type' => 'Italiana',
            ],
        ];

        foreach ($recipes as $recipeData) {
            Recipe::create(array_merge($recipeData, ['user_id' => $user->id]));
        }
    }
}
