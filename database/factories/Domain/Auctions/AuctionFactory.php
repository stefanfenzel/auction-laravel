<?php

namespace Database\Factories\Domain\Auctions;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Gurulabs\Domain\Auctions\Auction>
 */
class AuctionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'start_price' => $this->faker->randomFloat(2, 1, 1000),
            'end_date' => $this->faker->dateTimeBetween('now', '+1 month'),
        ];
    }
}
