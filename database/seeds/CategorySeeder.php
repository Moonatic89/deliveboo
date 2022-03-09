<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Italiano',
            'Cinese',
            'Giapponese',
            'Messicano',
            'Pesce',
            'Carne',
            'Pizza',
        ];
        $cat_images = [
            'cat_italiano.jpg',
            'cat_cinese.jpg',
            'cat_giapponese.jpg',
            'cat_messicano.jpg',
            'cat_pesce.jpg',
            'cat_carne.jpg',
            'cat_pizza.jpg',
        ];

        foreach ($categories as $id => $category) {
            $cat = new Category();
            $cat->name = $category;
            $cat->category_image = $cat_images[$id];
            $cat->save();
        }
    }
}