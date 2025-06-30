<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\User;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Récupère Jane Doe
        $jane = User::where('email', 'jane.doe@example.com')->first();

        if (!$jane) {
            $this->command->warn('User Jane Doe not found. Run UserSeeder first.');
            return;
        }

        // Récupère catégories (name => id)
        $categories = Category::pluck('id', 'name')->toArray();

        // Récupère les fournisseurs liés à Jane (name => id)
        $suppliers = Supplier::where('user_id', $jane->user_id)->pluck('id', 'name')->toArray();

        if (empty($suppliers)) {
            $this->command->warn('No suppliers found for Jane Doe. Run SupplierSeeder first.');
            return;
        }

        $products = [
            [
                'reference' => 'WT001',
                'name' => 'Classic Women T-Shirt',
                'category_name' => 'T-Shirts',
                'supplier_name' => 'GlobalTextiles Co.', 
                'slug' => 'classic-women-tshirt',
                'description' => 'Soft cotton classic women\'s t-shirt, perfect for casual wear.',
                'price' => 19.99,
                'image' => 'https://example.com/images/womens-tshirt.jpg',
            ],
            [
                'reference' => 'WT002',
                'name' => 'High-Waist Skinny Jeans',
                'category_name' => 'Jeans',
                'supplier_name' => 'TexWorld Imports',
                'slug' => 'high-waist-skinny-jeans',
                'description' => 'Stylish high-waist skinny jeans for a flattering fit.',
                'price' => 49.99,
                'image' => 'https://example.com/images/skinny-jeans.jpg',
            ],
            [
                'reference' => 'WT003',
                'name' => 'Floral Summer Dress',
                'category_name' => 'Dresses',
                'supplier_name' => 'ModaTessile SRL', 
                'slug' => 'floral-summer-dress',
                'description' => 'Light and breezy floral summer dress for warm days.',
                'price' => 59.99,
                'image' => 'https://example.com/images/summer-dress.jpg',
            ],
            [
                'reference' => 'WT004',
                'name' => 'Casual Hoodie',
                'category_name' => 'Hoodies',
                'supplier_name' => 'FabricNation Ltd.', 
                'slug' => 'casual-hoodie',
                'description' => 'Comfortable casual hoodie for everyday wear.',
                'price' => 39.99,
                'image' => 'https://example.com/images/casual-hoodie.jpg',
            ],
            [
                'reference' => 'WT005',
                'name' => 'Classic Black Leggings',
                'category_name' => 'Leggings',
                'supplier_name' => 'GlobalTextiles Co.',
                'slug' => 'classic-black-leggings',
                'description' => 'Stretchy and comfortable black leggings for daily use.',
                'price' => 24.99,
                'image' => 'https://example.com/images/black-leggings.jpg',
            ],
            [
                'reference' => 'WT006',
                'name' => 'Elegant Blazer',
                'category_name' => 'Blazers',
                'supplier_name' => 'ModaTessile SRL',
                'slug' => 'elegant-blazer',
                'description' => 'Tailored elegant blazer for office or formal occasions.',
                'price' => 89.99,
                'image' => 'https://example.com/images/elegant-blazer.jpg',
            ],
            [
                'reference' => 'WT007',
                'name' => 'Striped Long Sleeve Shirt',
                'category_name' => 'Shirts',
                'supplier_name' => 'FabricNation Ltd.',
                'slug' => 'striped-long-sleeve-shirt',
                'description' => 'Classic striped shirt with long sleeves for versatile style.',
                'price' => 29.99,
                'image' => 'https://example.com/images/striped-shirt.jpg',
            ],
            [
                'reference' => 'WT008',
                'name' => 'Denim Skirt',
                'category_name' => 'Skirts',
                'supplier_name' => 'TexWorld Imports',
                'slug' => 'denim-skirt',
                'description' => 'Trendy denim skirt with a comfortable fit.',
                'price' => 34.99,
                'image' => 'https://example.com/images/denim-skirt.jpg',
            ],
            [
                'reference' => 'WT009',
                'name' => 'Summer Shorts',
                'category_name' => 'Shorts',
                'supplier_name' => 'GlobalTextiles Co.',
                'slug' => 'summer-shorts',
                'description' => 'Lightweight shorts ideal for summer days.',
                'price' => 22.99,
                'image' => 'https://example.com/images/summer-shorts.jpg',
            ],
            [
                'reference' => 'WT010',
                'name' => 'Woolen Cardigan',
                'category_name' => 'Cardigans',
                'supplier_name' => 'ModaTessile SRL',
                'slug' => 'woolen-cardigan',
                'description' => 'Warm woolen cardigan for chilly weather.',
                'price' => 54.99,
                'image' => 'https://example.com/images/woolen-cardigan.jpg',
            ],
            [
                'reference' => 'WT011',
                'name' => 'Leather Jacket',
                'category_name' => 'Jackets',
                'supplier_name' => 'FabricNation Ltd.',
                'slug' => 'leather-jacket',
                'description' => 'Stylish leather jacket for a bold look.',
                'price' => 129.99,
                'image' => 'https://example.com/images/leather-jacket.jpg',
            ],
            [
                'reference' => 'WT012',
                'name' => 'Silk Scarf',
                'category_name' => 'Accessories',
                'supplier_name' => 'ModaTessile SRL',
                'slug' => 'silk-scarf',
                'description' => 'Luxurious silk scarf to complete your outfit.',
                'price' => 19.99,
                'image' => 'https://example.com/images/silk-scarf.jpg',
            ],
            [
                'reference' => 'WT013',
                'name' => 'Wool Hat',
                'category_name' => 'Accessories',
                'supplier_name' => 'Andes Weavers',
                'slug' => 'wool-hat',
                'description' => 'Warm wool hat for winter days.',
                'price' => 24.99,
                'image' => 'https://example.com/images/wool-hat.jpg',
            ],
            [
                'reference' => 'WT014',
                'name' => 'Cotton Socks Pack',
                'category_name' => 'Accessories',
                'supplier_name' => 'GlobalTextiles Co.',
                'slug' => 'cotton-socks-pack',
                'description' => 'Pack of 5 comfortable cotton socks.',
                'price' => 9.99,
                'image' => 'https://example.com/images/cotton-socks.jpg',
            ],
            [
                'reference' => 'WT015',
                'name' => 'Summer Sandals',
                'category_name' => 'Footwear',
                'supplier_name' => 'FabricNation Ltd.',
                'slug' => 'summer-sandals',
                'description' => 'Comfortable summer sandals with a soft sole.',
                'price' => 29.99,
                'image' => 'https://example.com/images/summer-sandals.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::create([
                'reference' => $product['reference'],
                'slug' => $product['slug'],
                'description' => $product['description'],
                'price' => $product['price'],
                'image' => $product['image'],
                'category_id' => $categories[$product['category_name']] ?? null,
                'supplier_id' => $suppliers[$product['supplier_name']] ?? null,
                'user_id' => $jane->user_id,
            ]);
        }
    }
}
