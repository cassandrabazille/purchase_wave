<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'T-shirts',
            'Jeans',
            'Dresses',
            'Hoodies',
            'Leggings',
            'Blazers',
            'Shirts',
            'Skirts',
            'Shorts',
            'Cardigans',
            'Jackets',
            'Accessories',
            'Footwear',
        ];

        foreach ($categories as $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }
    }
}

