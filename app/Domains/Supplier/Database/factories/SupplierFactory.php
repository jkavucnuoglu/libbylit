<?php

namespace Database\Factories;

use App\Domains\Inventory\Enum\SupplierEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tenant_id' => $this->faker->numberBetween(1, 100),
            'name' => $this->faker->word(),
            'sku' => $this->faker->unique()->bothify('SKU-####'),
            'description' => $this->faker->sentence(),
            'type' => $this->faker->randomElement(array_map(fn($type) => $type->value(), SupplierEnum::cases())),
            'quantity' => $this->faker->numberBetween(0, 1000),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'image' => $this->faker->imageUrl(),
            'category' => $this->faker->word(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'stripe_product_id' => $this->faker->optional()->uuid(),
        ];
    }
}
