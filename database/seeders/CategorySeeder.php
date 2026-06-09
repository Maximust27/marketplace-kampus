<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Buku & Catatan',
                'slug' => 'buku-catatan',
                'icon' => 'menu_book',
            ],
            [
                'name' => 'Elektronik',
                'slug' => 'elektronik',
                'icon' => 'devices',
            ],
            [
                'name' => 'Pakaian & Aksesoris',
                'slug' => 'pakaian-aksesoris',
                'icon' => 'checkroom',
            ],
            [
                'name' => 'Kebutuhan Kos',
                'slug' => 'kebutuhan-kos',
                'icon' => 'home',
            ],
            [
                'name' => 'Alat Tulis',
                'slug' => 'alat-tulis',
                'icon' => 'edit',
            ],
            [
                'name' => 'Lainnya',
                'slug' => 'lainnya',
                'icon' => 'category',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
