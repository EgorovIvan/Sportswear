<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('carts')->insert($this->getData());
    }

    public function getData(): array
    {
        $response = [];
            $response[] = [
                'product_id' => fake()->numberBetween(1, 35),
                'quantity' => fake()->numberBetween(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ];

        return $response;
    }
}
