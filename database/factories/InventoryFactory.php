<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_barang' => rand(1111111111,9999999999),
            'nama_barang' => $this->faker->sentence(2),
            'ukuran' => $this->faker->randomFloat(1, 0.8, 1) . ' Liter',
            'stok' => $this->faker->numberBetween(10, 90),
            'harga_beli' => $this->faker->numberBetween(1000, 99999),
            'harga_jual' => $this->faker->numberBetween(1000, 99999)
        ];
    }
}
