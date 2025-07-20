<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class Supplier extends Model
{

    protected $fillable = ['name', 'email','telephone', 'address','user_id'];

    public function products()
    {
        return $this->hasMany(Product::class, 'supplier_id', 'id');
    }

     public function orders()
    {
        return $this->hasMany(Order::class, 'supplier_id', 'id');
    }

     public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}