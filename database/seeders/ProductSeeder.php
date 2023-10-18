<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert($this->getData());
    }

    public function getData(): array
    {
        $response = [];
        for($i = 1; $i < 7; $i++) {
            $arr = array('a' => '/img/kids/' . $i . '.webp', 'b' => 2, );
            $response[] = [
                'name' => 'Man# ' . $i,
                'chapter' => fake()->numberBetween(100, 999),
                'type' => 'Jacket# ' . $i,
                'code' => fake()->numberBetween(10000, 99999),
                'price' => fake()->randomFloat(0, 1000, 15000),
                'color' => fake()->hexColor(),
                'size' => fake()->numberBetween(32, 50),
                'description' => fake()->text(100),
                'specifications' => json_encode(fake()->sentences(4)),
                'images' => json_encode($arr),
                'rating' => fake()->randomFloat(1, 0, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        return $response;
    }
}
