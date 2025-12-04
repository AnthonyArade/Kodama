<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commande>
 */
class CommandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => null, // set in seeder
            'total' => 0,      // will update later based on ligne de commande
            'shipped' => false, // set in seeder
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
