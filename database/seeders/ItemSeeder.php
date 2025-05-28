<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name' => 'Chef Estrella',
                'description' => 'Un distintivo especial para chefs destacados',
                'icon' => '⭐️',
                'price' => 1000,
                'type' => 'badge'
            ],
            [
                'name' => 'Gorro de Chef',
                'description' => 'Avatar exclusivo de chef profesional',
                'icon' => '👨‍🍳',
                'price' => 2000,
                'type' => 'avatar'
            ],
            [
                'name' => 'Maestro Culinario',
                'description' => 'Insignia de maestría en la cocina',
                'icon' => '🏆',
                'price' => 3000,
                'type' => 'badge'
            ],
            [
                'name' => 'Chef Innovador',
                'description' => 'Reconocimiento a la creatividad culinaria',
                'icon' => '💫',
                'price' => 2,
                'type' => 'badge'
            ],
            [
                'name' => 'Cocinero Experto',
                'description' => 'Avatar premium para chefs experimentados',
                'icon' => '👩‍🍳',
                'price' => 2500,
                'type' => 'avatar'
            ],
            [
                'name' => 'Medalla Gastronómica',
                'description' => 'Símbolo de excelencia culinaria',
                'icon' => '🎖️',
                'price' => 5000,
                'type' => 'badge'
            ]
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}