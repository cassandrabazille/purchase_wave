<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $descriptions = [
            'T-shirts'     => 'Cotton t-shirts, short or long sleeves.',
            'Jeans'        => 'Classic or skinny jeans for all styles.',
            'Dresses'      => 'Formal, casual, or evening dresses.',
            'Hoodies'      => 'Comfortable hooded sweatshirts.',
            'Leggings'     => 'Sporty or stylish leggings.',
            'Blazers'      => 'Blazers for formal or professional outfits.',
            'Shirts'       => 'Men’s and women’s shirts.',
            'Skirts'       => 'Long, short, or mid-length skirts.',
            'Shorts'       => 'Summer or sport shorts.',
            'Cardigans'    => 'Warm and elegant cardigans.',
            'Jackets'      => 'Lightweight or winter jackets.',
            'Accessories'  => 'Fashion accessories: bags, jewelry, hats.',
            'Footwear'     => 'Shoes for all seasons and purposes.'
        ];

        foreach ($descriptions as $name => $description) {
            Category::where('name', $name)->update(['description' => $description]);
        }
    
    }
}
