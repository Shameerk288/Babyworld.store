<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Category::create([
            'name' => 'Clothing',
            'slug' => 'clothing',
            'description' => 'All kinds of baby clothes',
            'image' => 'clothing.png',
            'status' => '0',
            'popular' => '1'
        ]);
        Category::create([
            'name' => 'Accessories',
            'slug' => 'accessories',
            'description' => 'All kinds of baby accessories',
            'image' => 'accessories.jpg',
            'status' => '0',
            'popular' => '1'
        ]);
        Category::create([
            'name' => 'Footwear',
            'slug' => 'footwear',
            'description' => 'All kinds of baby footwears',
            'image' => 'footwear.jpeg',
            'status' => '0',
            'popular' => '1'
        ]);
        Category::create([
            'name' => 'Toys',
            'slug' => 'toys',
            'description' => 'All kinds of baby toys',
            'image' => 'toys.jpg',
            'status' => '0',
            'popular' => '1'
        ]);
        Category::create([
            'name' => 'Feeding',
            'slug' => 'feeding',
            'description' => 'All kinds of baby feeding equipments',
            'image' => 'feeding.jpg',
            'status' => '0',
            'popular' => '1'
        ]);
        Category::create([
            'name' => 'Bathing',
            'slug' => 'bathing',
            'description' => 'All kinds of baby bathing equipments',
            'image' => 'bathing.jpg',
            'status' => '0',
            'popular' => '1'
        ]);
    }
}
