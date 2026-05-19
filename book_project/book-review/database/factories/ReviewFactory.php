<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "book_id"=> null, // This will be set when creating reviews for a specific book
            "review" => $this->faker->paragraph(),
            "rating" => $this->faker->numberBetween(1, 5),
            "created_at"=> $this->faker->dateTimeBetween('-2 year', 'now'),
            "updated_at"=> function (array $attributes) {
                return $this->faker->dateTimeBetween($attributes['created_at'], 'now');
            },
        ];
    }
    
    public function good() 
    {
        return $this->state(function (array $attributes) {
            return [
                "rating" => $this->faker->numberBetween(4,5),
            ];

        });
    }

        public function average() 
        {
            return $this->state(function (array $attributes) {
                return [
                    "rating" => $this->faker->numberBetween(3,4),
                ];

            });
        }

        public function bad() 
        {
            return $this->state(function (array $attributes) {
                return [
                    "rating" => $this->faker->numberBetween(1,2),
                ];
            });
        }
}
