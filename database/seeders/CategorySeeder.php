<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Infrastruktur',
            'description' => 'Deskripsi tentang kategori Infrastuktur di indonesia'
        ]);

        Category::create([
            'name' => 'Kesehatan',
            'description' => 'Deskripsi tentang kategori Kesehatan di indonesia'
        ]);

        Category::create([
            'name' => 'Lingkungan',
            'description' => 'Deskripsi tentang kategori Lingkungan di indonesia'
        ]);

        Category::create([
            'name' => 'Keresahan',
            'description' => 'Deskripsi tentang kategori Keresahan di indonesia'
        ]);
    }
}