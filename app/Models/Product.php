<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\User;
use App\Models\OrderItem;

class Product extends Model
{
    protected $fillable = ['reference', 'slug', 'description', 'price', 'image', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($product) {

            if (empty($product->slug)) {
                $words = explode(' ', $product->description);
                $slugBase = implode('-', array_slice($words, 0, 4));
                $slug = Str::slug($slugBase);

                $originalSlug = $slug;
                $count = 1;
                while (Product::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $count++;
                }
                $product->slug = $slug;
            }

            if (!$product->reference) {
                $product->reference = 'WT' . str_pad($product->id, 3, '0', STR_PAD_LEFT);
             
            }
               $product->save();
        });
    }
}