<?php

use App\Models\Restaurant;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            // Generate an array with 3 random categories

            $randArray = [];
            while (count($randArray) <= 2) {

                $randInt = rand(1, 7);

                if (!in_array($randInt, $randArray)) {
                    array_push($randArray, $randInt);
                }
            }


            $_restaurant = new Restaurant();

            // Assign restaurant to random user
            $_restaurant->user_id = $faker->numberBetween(1, 3);

            $_restaurant->name = $faker->sentence();
            $_restaurant->slug = Str::slug($_restaurant->name);
            $_restaurant->vat = $faker->numerify('###########');
            $_restaurant->phone = $faker->numerify('###-######');
            $_restaurant->address = $faker->streetAddress();
            $_restaurant->description = $faker->paragraph();
            $_restaurant->website = $faker->sentence();
            $_restaurant->save();

            //attach category array to restaurant pivot table
            $_restaurant->categories()->attach($randArray);
        }
    }
}