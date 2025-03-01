<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::factory()->createMany([
            [
                'name' => 'Fashion – Hidden Gems, Worth Every Penny',
                'slug' => 'fashion',
                'description' => 'Discover preloved treasures that blend style, quality, and value. From vintage finds to luxury steals, each piece is a worthy addition to your wardrobe—without the hefty price tag! 💎✨',
            ],
            [
                'name' => 'Beauty – Unlocked Secrets, Unbeatable Prices',
                'slug' => 'beauty',
                'description' => 'Unveil the best of the beauty world without breaking the bank. Find authentic, high-quality products from top brands and emerging labels, all at prices that will make you blush! 💄🔥',
            ],
            [
                'name' => 'Home & Living – One-of-a-Kind, Unbeatable Deals',
                'slug' => 'home',
                'description' => 'Step into a world of unique finds and unmissable deals. Explore our curated selection of preloved homeware, furniture, and decor—each with a story to tell and a price that will make you smile! 🏠🎉',
            ],
            [
                'name' => 'Tech Treasures – Smart Deals, Big Savings',
                'slug' => 'tech',
                'description' => 'Unlock preloved gadgets that deliver top performance without the premium price. From smartphones to must-have accessories, every find is a hidden gem—high quality, fully functional, and worth every penny! 🚀✨',
            ]
        ]);
    }
}
