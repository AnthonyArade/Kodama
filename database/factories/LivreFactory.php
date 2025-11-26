<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Livre>
 */
class LivreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => null, // set in seeder
            'nom' => $this->faker->sentence(3),
            'auteur' => $this->faker->name(),
            'description' => $this->faker->paragraph(5),
            'image' => "https://picsum.photos/seed/" . $this->faker->unique()->word . "/400/600",
            'prix' => $this->faker->randomFloat(2, 5, 50),
            'date_sortie' => $this->faker->date(),
            'stock' => $this->faker->numberBetween(0, 100),
            'like' => $this->faker->numberBetween(0, 1000),
            'unlike' => $this->faker->numberBetween(0, 300),
        ];
    }
}
