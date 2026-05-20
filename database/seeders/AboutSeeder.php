<?php

namespace Database\Seeders;
use App\Models\About;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     About::create(
        [
        'image'=>'about.jpg',
        'name'=>'Shoppers E-Commerce',
        'content'=>'About us article is here',
        'text_1_icon'=>'icon-truck',
        'text_1'=>'Free Shipping',
        'text_1_content'=>' We deliver your products with free shipping.',
        'text_2_icon'=>'icon-refresh2',
        'text_2'=> 'Free Returns',
        'text_2_content'=> 'We offer returns within 30 days.',
        'text_3_icon'=> 'icon-help',
        'text_3'=> 'Customer Support',
        'text_3_content'=> 'You can reach us 24/7.',
        ]
        );
    }
}
