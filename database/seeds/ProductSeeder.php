<?php

use App\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for ($i = 0; $i < 30; $i++) {
            $product = new Product();
            $product->name = $faker->sentence();
            $product->ingredients = $faker->paragraph();
            $product->restaurant_id = $faker->numberBetween(1, 10);
            $product->price = $faker->randomFloat(2, 1, 100);
            $product->visible = $faker->boolean(75);
            $product->save();
        }
    }
}