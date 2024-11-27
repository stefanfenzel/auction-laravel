<?php

namespace Database\Factories\Domain\Offers;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Gurulabs\Domain\Offers\Offer>
 */
class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'auction_id' => 1,
            'user_id' => 1,
            'bid_amount' => $this->faker->randomFloat(2, 1, 100),
            'bid_time' => now(),
        ];
    }
}
