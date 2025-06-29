<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Product;

class OrderItem extends Model

{
    protected $fillable = ['order_id', 'product_id', 'quantity', 'unit_price', 'line_total'];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
 
}