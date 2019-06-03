<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            ['name' => 'Laptops', 'slug' => 'laptops'],
            ['name' => 'Desktops', 'slug' => 'desktop'],
            ['name' => 'Tablets', 'slug' => 'tablets'],
            ['name' => 'Phones', 'slug' => 'phones'],
        ]);
    }
}
