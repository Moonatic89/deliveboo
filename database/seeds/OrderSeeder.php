<?php

use App\Models\Order;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $order = new Order();
            $order->name = $faker->sentence();
            $order->last_name = $faker->sentence();
            $order->phone = $faker->phoneNumber();
            $order->email = $faker->sentence();
            $order->address = $faker->streetAddress();
            $order->notes = $faker->paragraph();
            $order->amount = $faker->randomFloat(2, 0, 10000);
            $order->status = $faker->boolean();
            $order->save();
        }
    }
}
