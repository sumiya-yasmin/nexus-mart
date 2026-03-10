<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // 1. Smartphones
       [
                'category_id' => 1,
                'name' => 'iPhone 15 Pro',
                'slug' => 'iphone-15-pro',
                'description' => 'A17 Pro chip with 6-core GPU, Titanium design, and Action button.',
                'price' => 145000,
                'old_price' => 155000,
                'quantity' => 50,
                'is_flash_sale' => true,
                'rating' => 4.9,
                'image' => 'https://images.unsplash.com/photo-1696446701796-da61225697cc?q=80&w=600'
            ],
            // 2. Laptops
            [
                'category_id' => 2,
                'name' => 'MacBook Air M2',
                'slug' => 'macbook-air-m2',
                'description' => 'Strikingly thin design, 13.6-inch Liquid Retina display, and 18-hour battery life.',
                'price' => 115000,
                'old_price' => 125000,
                'quantity' => 30,
                'is_flash_sale' => false,
                'rating' => 4.8,
                'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?q=80&w=600'
            ],
            // 3. Smartwatches
            [
                'category_id' => 3,
                'name' => 'Apple Watch Series 9',
                'slug' => 'apple-watch-9',
                'description' => 'S9 SiP chip, double tap gesture, and brighter Always-On Retina display.',
                'price' => 45000,
                'old_price' => 48000,
                'quantity' => 10,
                'is_flash_sale' => true,
                'rating' => 4.7,
                'image' => 'https://images.unsplash.com/photo-1544117518-30df57809b09?q=80&w=600'
            ],
            // 4. Audio
            [
                'category_id' => 4,
                'name' => 'AirPods Pro 2',
                'slug' => 'airpods-pro-2',
                'description' => 'MagSafe Charging Case (USB‑C) with Speaker and Lanyard Loop.',
                'price' => 28500,
                'old_price' => 32000,
                'quantity' => 40,
                'is_flash_sale' => false,
                'rating' => 4.9,
                'image' => 'https://images.unsplash.com/photo-1588423771073-b8903fbb85b5?q=80&w=600'
            ],
            // 5. Gaming
            [
                'category_id' => 5,
                'name' => 'PlayStation 5',
                'slug' => 'playstation-5',
                'description' => 'Lightning fast loading with an ultra-high speed SSD and deeper immersion.',
                'price' => 65000,
                'old_price' => 70000,
                'quantity' => 20,
                'is_flash_sale' => true,
                'rating' => 5.0,
                'image' => 'https://images.unsplash.com/photo-1606813907291-d86ebb9c74ad?q=80&w=600'
            ],
            // 6. Accessories
            [
                'category_id' => 6,
                'name' => 'Logitech MX Master 3S',
                'slug' => 'mx-master-3s',
                'description' => 'Performance wireless mouse with 8K DPI tracking on any surface.',
                'price' => 12500,
                'old_price' => 14000,
                'quantity' => 60,
                'is_flash_sale' => false,
                'rating' => 4.8,
                'image' => 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?q=80&w=600'
            ],
            // Gaming Mice
            [
                'category_id' => 5,
                'name' => 'Logitech G Pro X Superlight',
                'slug' => 'logitech-g-pro-x',
                'description' => 'Ultra-lightweight wireless gaming mouse, 63g.',
                'price' => 13500,
                'old_price' => 15500,
                'quantity' => 40,
                'is_flash_sale' => true,
                'rating' => 4.9,
                'image' => 'https://images.unsplash.com/photo-1615663245857-ac93bb7c39e7?q=80&w=600&auto=format&fit=crop'
            ],
            [
                'category_id' => 5,
                'name' => 'Razer DeathAdder V3 Pro',
                'slug' => 'razer-deathadder-v3',
                'description' => '30K DPI Optical Sensor, Ergonomic Wireless.',
                'price' => 14500,
                'old_price' => null,
                'quantity' => 40,
                'is_flash_sale' => false,
                'rating' => 4.8,
                'image' => 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?q=80&w=600&auto=format&fit=crop'
            ],
            [
                'category_id' => 5,
                'name' => 'SteelSeries Rival 3',
                'slug' => 'steelseries-rival-3',
                'description' => 'Precision tracking for competitive play.',
                'price' => 3500,
                'old_price' => 4500,
                'quantity' => 30,
                'is_flash_sale' => false,
                'rating' => 4.5,
                'image' => 'https://images.unsplash.com/photo-1613141411244-0e4ac259d217?q=80&w=600&auto=format&fit=crop'
            ],
            // Keyboards
            [
                'category_id' => 2,
                'name' => 'Keychron K2 V2',
                'slug' => 'keychron-k2-v2',
                'description' => '75% Layout Bluetooth Mechanical Keyboard.',
                'price' => 8500,
                'old_price' => 9500,
                'quantity' => 30,
                'is_flash_sale' => true,
                'rating' => 4.7,
                'image' => 'https://images.unsplash.com/photo-1511467687858-23d96c32e4ae?q=80&w=600&auto=format&fit=crop'
            ],
            [
                'category_id' => 2,
                'name' => 'Custom Mechanical Keyboard',
                'slug' => 'custom-kb-rgb',
                'description' => 'Hot-swappable switches with RGB lighting.',
                'price' => 12500,
                'old_price' => 15000,
                'quantity' => 50,
                'is_flash_sale' => false,
                'rating' => 4.9,
                'image' => 'https://images.unsplash.com/photo-1595225476474-87563907a212?q=80&w=600&auto=format&fit=crop'
            ],
            [
                'category_id' => 2,
                'name' => 'Ducky One 3 Mini',
                'slug' => 'ducky-one-3',
                'description' => '60% form factor for maximum desk space.',
                'price' => 10500,
                'old_price' => null,
                'quantity' => 50,
                'is_flash_sale' => false,
                'rating' => 4.8,
                'image' => 'https://images.unsplash.com/photo-1613141411244-0e4ac259d217?q=80&w=600&auto=format&fit=crop'
            ],
            // Audio
            [
                'category_id' => 3,
                'name' => 'HyperX Cloud II Wireless',
                'slug' => 'hyperx-cloud-ii',
                'description' => 'Legendary comfort and 300-hour battery life.',
                'price' => 12000,
                'old_price' => 14000,
                'quantity' => 50,
                'is_flash_sale' => true,
                'rating' => 4.8,
                'image' => 'https://images.unsplash.com/photo-1583394838336-acd977730f90?q=80&w=500&auto=format&fit=crop'
            ],
            [
                'category_id' => 3,
                'name' => 'Sony WH-1000XM5',
                'slug' => 'sony-xm5',
                'description' => 'Industry-leading noise cancellation.',
                'price' => 35000,
                'old_price' => 38000,
                'quantity' => 50,
                'is_flash_sale' => false,
                'rating' => 5.0,
                'image' => 'https://images.unsplash.com/photo-1644931235632-d30235650e92?q=80&w=600&auto=format&fit=crop'
            ],
            // Monitors
            [
                'category_id' => 4,
                'name' => 'ASUS ROG Swift 27"',
                'slug' => 'asus-rog-27',
                'description' => '1440p 240Hz IPS Gaming Monitor.',
                'price' => 65000,
                'old_price' => 72000,
                'quantity' => 50,
                'is_flash_sale' => false,
                'rating' => 4.9,
                'image' => 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?q=80&w=600&auto=format&fit=crop'
            ],
            [
                'category_id' => 4,
                'name' => 'Dell UltraSharp 32"',
                'slug' => 'dell-u32',
                'description' => '4K USB-C Hub Monitor for creators.',
                'price' => 85000,
                'old_price' => 90000,
                'quantity' => 50,
                'is_flash_sale' => false,
                'rating' => 4.8,
                'image' => 'https://images.unsplash.com/photo-1547119957-637f8679db1e?q=80&w=600&auto=format&fit=crop'
            ]
        ];
        foreach ($products as $prod) {
            \App\Models\Product::create($prod);
        }
    }
}
