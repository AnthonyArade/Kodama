<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->unique()->randomElement([
                'Science Fiction',
                'Fantasy',
                'Romance',
                'Mystery',
                'Thriller',
                'Biography',
                'Self-Help',
                'History',
                'Philosophy',
                'Horror',
                'Adventure',
                'Classics',
            ]),
        ];
    }
}
