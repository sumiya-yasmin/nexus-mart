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
            // CATEGORY: Gaming Mouse (ID: 1)
            [
                'category_id' => 1,
                'name' => 'Logitech G Pro X Superlight',
                'slug' => 'logitech-g-pro-x',
                'description' => 'Ultra-lightweight wireless gaming mouse, 63g.',
                'price' => 13500,
                'old_price' => 15500,
                'is_flash_sale' => true,
                'rating' => 4.9,
                'image' => 'mouse-gpro.jpg'
            ],
            [
                'category_id' => 1,
                'name' => 'Razer DeathAdder V3 Pro',
                'slug' => 'razer-deathadder-v3',
                'description' => '30K DPI Optical Sensor, Ergonomic Wireless.',
                'price' => 14500,
                'old_price' => null,
                'is_flash_sale' => false,
                'rating' => 4.8,
                'image' => 'mouse-razer.jpg'
            ],
            [
                'category_id' => 1,
                'name' => 'SteelSeries Rival 3',
                'slug' => 'steelseries-rival-3',
                'description' => 'Budget-friendly performance wired mouse.',
                'price' => 3500,
                'old_price' => 4200,
                'is_flash_sale' => false,
                'rating' => 4.5,
                'image' => 'mouse-ss.jpg'
            ],

            // CATEGORY: Keyboards (ID: 2)
            [
                'category_id' => 2,
                'name' => 'Keychron K2 V2',
                'slug' => 'keychron-k2-v2',
                'description' => '75% Layout Bluetooth Mechanical Keyboard.',
                'price' => 8500,
                'old_price' => 9500,
                'is_flash_sale' => true,
                'rating' => 4.7,
                'image' => 'kb-k2.jpg'
            ],
            [
                'category_id' => 2,
                'name' => 'Ducky One 3 Mini',
                'slug' => 'ducky-one-3-mini',
                'description' => '60% Hot-swappable Daybreak edition.',
                'price' => 11500,
                'old_price' => null,
                'is_flash_sale' => false,
                'rating' => 4.9,
                'image' => 'kb-ducky.jpg'
            ],
            [
                'category_id' => 2,
                'name' => 'Corsair K70 RGB TKL',
                'slug' => 'corsair-k70-tkl',
                'description' => 'Champion Series with 8000Hz polling rate.',
                'price' => 15000,
                'old_price' => 17000,
                'is_flash_sale' => false,
                'rating' => 4.6,
                'image' => 'kb-corsair.jpg'
            ],

            // CATEGORY: Audio (ID: 3)
            [
                'category_id' => 3,
                'name' => 'HyperX Cloud II Wireless',
                'slug' => 'hyperx-cloud-ii',
                'description' => 'Legendary comfort and 300-hour battery life.',
                'price' => 12000,
                'old_price' => 14000,
                'is_flash_sale' => true,
                'rating' => 4.8,
                'image' => 'audio-hyperx.jpg'
            ],
            [
                'category_id' => 3,
                'name' => 'SteelSeries Arctis Nova 7',
                'slug' => 'arctis-nova-7',
                'description' => 'Simultaneous Wireless (2.4GHz & Bluetooth).',
                'price' => 18500,
                'old_price' => null,
                'is_flash_sale' => false,
                'rating' => 4.7,
                'image' => 'audio-ss.jpg'
            ],

            // CATEGORY: Monitors (ID: 4)
            [
                'category_id' => 4,
                'name' => 'ASUS ROG Swift 27"',
                'slug' => 'asus-rog-27',
                'description' => '1440p 240Hz IPS Gaming Monitor.',
                'price' => 65000,
                'old_price' => 72000,
                'is_flash_sale' => false,
                'rating' => 4.9,
                'image' => 'mon-asus.jpg'
            ],
            [
                'category_id' => 4,
                'name' => 'LG UltraGear 24"',
                'slug' => 'lg-ultragear-24',
                'description' => '1080p 144Hz 1ms response time.',
                'price' => 22000,
                'old_price' => 25000,
                'is_flash_sale' => true,
                'rating' => 4.5,
                'image' => 'mon-lg.jpg'
            ],
        ];
        foreach ($products as $prod) {
            \App\Models\Product::create($prod);
        }
    }
}
