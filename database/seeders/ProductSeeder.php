<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Tenda Dome 4P Premium',
                'sku' => 'TND-001',
                'category' => 'Tenda',
                'description' => 'Tenda kapasitas 4 orang waterproof',
                'price_per_day' => 75000,
                'stock' => 8,
                'image' => 'hiking.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Carrier 60L',
                'sku' => 'CRR-001',
                'category' => 'Carrier',
                'description' => 'Carrier nyaman untuk hiking jauh',
                'price_per_day' => 50000,
                'stock' => 5,
                'image' => 'hiking.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sleeping Bag Polar',
                'sku' => 'SLP-001',
                'category' => 'Sleeping Bag',
                'description' => 'Hangat sampai 5°C',
                'price_per_day' => 35000,
                'stock' => 10,
                'image' => 'hiking.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sepatu Hiking Pro',
                'sku' => 'SPT-001',
                'category' => 'Sepatu',
                'description' => 'Anti slip dan tahan air',
                'price_per_day' => 45000,
                'stock' => 3,
                'image' => 'hiking.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Headlamp LED',
                'sku' => 'AKS-001',
                'category' => 'Aksesoris',
                'description' => 'Lampu terang untuk malam hari',
                'price_per_day' => 15000,
                'stock' => 20,
                'image' => 'hiking.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Trekking Pole',
                'sku' => 'AKS-002',
                'category' => 'Aksesoris',
                'description' => 'Ringan dan kuat',
                'price_per_day' => 25000,
                'stock' => 7,
                'image' => 'hiking.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Matras Foam',
                'sku' => 'AKS-003',
                'category' => 'Aksesoris',
                'description' => 'Nyaman untuk tidur',
                'price_per_day' => 20000,
                'stock' => 15,
                'image' => 'hiking.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tenda Ultralight 2P',
                'sku' => 'TND-002',
                'category' => 'Tenda',
                'description' => 'Ringan untuk backpacker',
                'price_per_day' => 85000,
                'stock' => 2,
                'image' => 'hiking.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kompor Portable',
                'sku' => 'AKS-004',
                'category' => 'Aksesoris',
                'description' => 'Kompor gas praktis',
                'price_per_day' => 30000,
                'stock' => 6,
                'image' => 'hiking.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jaket Gunung',
                'sku' => 'AKS-005',
                'category' => 'Aksesoris',
                'description' => 'Tahan angin dan dingin',
                'price_per_day' => 40000,
                'stock' => 4,
                'image' => 'hiking.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
