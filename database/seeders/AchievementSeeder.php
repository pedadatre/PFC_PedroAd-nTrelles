<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        $achievements = [
            [
                'name' => 'Chef Novato',
                'description' => 'Crea tu primera receta',
                'icon_url' => '👨‍🍳',
                'coins_reward' => 100,
                'type' => 'recipes_created',
                'requirement_count' => 1
            ],
            [
                'name' => 'Chef Experimentado',
                'description' => 'Crea 10 recetas',
                'icon_url' => '👨‍🍳⭐',
                'coins_reward' => 500,
                'type' => 'recipes_created',
                'requirement_count' => 10
            ],
            [
                'name' => 'Chef Maestro',
                'description' => 'Crea 50 recetas',
                'icon_url' => '👨‍🍳🌟',
                'coins_reward' => 2000,
                'type' => 'recipes_created',
                'requirement_count' => 50
            ],
            [
                'name' => 'Receta Popular',
                'description' => 'Recibe 10 likes en una receta',
                'icon_url' => '❤️',
                'coins_reward' => 200,
                'type' => 'likes_received',
                'requirement_count' => 10
            ],
            [
                'name' => 'Receta Viral',
                'description' => 'Recibe 50 likes en una receta',
                'icon_url' => '❤️⭐',
                'coins_reward' => 1000,
                'type' => 'likes_received',
                'requirement_count' => 50
            ],
            [
                'name' => 'Comentarista',
                'description' => 'Realiza 10 comentarios',
                'icon_url' => '💬',
                'coins_reward' => 150,
                'type' => 'comments_made',
                'requirement_count' => 10
            ],
            [
                'name' => 'Crítico Culinario',
                'description' => 'Realiza 50 comentarios',
                'icon_url' => '💬⭐',
                'coins_reward' => 750,
                'type' => 'comments_made',
                'requirement_count' => 50
            ]
        ];

        foreach ($achievements as $achievement) {
            Achievement::create($achievement);
        }
    }
}