<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

   
    public function run(): void
    {

        $men = Category::create([

            'image' => null,
            'name' => 'Men',
            'slug' => 'men',
            'thumbnail' => null,
            'cat_top' => null,
            'content' => "Men's Clothing",
            'status' => '1'
        ]);

        Category::create([

            'image' => null,
            'name' => 'Men Sweat',
            'slug' => 'men-sweat',
            'thumbnail' => null,
            'cat_top' => $men->id,
            'content' => "Men Sweats",
            'status' => '1'
        ]);

        Category::create([

            'image' => null,
            'name' => 'Men Jean',
            'slug' => 'men-jean',
            'thumbnail' => null,
            'cat_top' => $men->id,
            'content' => "Men Jeans",
            'status' => '1'
        ]);

        $women = Category::create([

            'image' => null,
            'name' => 'Women',
            'slug' => 'women',
            'thumbnail' => null,
            'cat_top' => null,
            'content' => "Women's Clothing",
            'status' => '1'
        ]);

        Category::create([

            'image' => null,
            'name' => 'Women Bag',
            'slug' => 'women-bag',
            'thumbnail' => null,
            'cat_top' => $women->id,
            'content' => "Women Bags",
            'status' => '1'
        ]);

        Category::create([

            'image' => null,
            'name' => 'Women Jean',
            'slug' => 'women-jean',
            'thumbnail' => null,
            'cat_top' => $women->id,
            'content' => "Women Jeans",
            'status' => '1'
        ]);

        $children = Category::create([

            'image' => null,
            'name' => 'Children',
            'slug' => 'children',
            'thumbnail' => null,
            'cat_top' => null,
            'content' => "Children's Clothing",
            'status' => '1'
        ]);

        Category::create([

            'image' => null,
            'name' => 'Children Toy',
            'slug' => 'children-toy',
            'thumbnail' => null,
            'cat_top' => $children->id,
            'content' => "Children Toys",
            'status' => '1'
        ]);

        Category::create([

            'image' => null,
            'name' => 'Children Jean',
            'slug' => 'children-jean',
            'thumbnail' => null,
            'cat_top' => $children->id,
            'content' => "Children Jeans",
            'status' => '1'
        ]);
    }
}
