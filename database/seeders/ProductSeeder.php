<?php

namespace Database\Seeders;
use App\Models\Product;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
     'name'=>'Product 1',
    'category_id'=> 1,
    'short_text'=> 'Shortinfo',
    'price'=>100,
    'size'=>'Small',
    'color'=>'White',
    'qty'=>10,
    'status'=>'1',
    'content'=> '<p>Good product</p>',
    'image'=>'images/shoe_1.jpg'
        ]);

        Product::create([
     'name'=>'Product 2',
    'category_id'=> 2,
    'short_text'=> 'Shortinfo 2',
    'price'=>100,
    'size'=>'Large',
    'color'=>'Pink',
    'qty'=>12,
    'status'=>'1',
    'content'=> '<p>Good product</p>',
     'image'=>'images/cloth_2.jpg'
        ]);
    }
}
