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
        $categories = [
            [
                'name' => 'Smartphones',
                'slug' => 'smartphones',
                'image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=500&auto=format&fit=crop'
            ],
            [
                'name' => 'Laptops',
                'slug' => 'laptops',
                'image' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?q=80&w=500&auto=format&fit=crop'
            ],
            [
                'name' => 'Smartwatches',
                'slug' => 'smartwatches',
                'image' => 'https://images.unsplash.com/photo-1546868871-7041f2a55e12?q=80&w=500&auto=format&fit=crop'
            ],
            [
                'name' => 'Audio',
                'slug' => 'audio',
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=500&auto=format&fit=crop'
            ],
            [
                'name' => 'Gaming',
                'slug' => 'gaming',
                'image' => 'https://images.unsplash.com/photo-1600080972464-8e5f35f63d08?q=80&w=500&auto=format&fit=crop'
            ],
            [
                'name' => 'Accessories',
                'slug' => 'accessories',
                'image' => 'https://images.unsplash.com/photo-1528795259021-d8c86e14354c?q=80&w=500&auto=format&fit=crop'
            ],
        ];

        foreach ($categories as $cat) {
            \App\Models\Category::create($cat);
        }
    }
}
