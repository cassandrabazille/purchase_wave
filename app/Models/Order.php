<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier;
use App\Models\User;
use App\Models\OrderItem;
class Order extends Model
{
<<<<<<< HEAD
    protected $fillable = ['reference', 'order_date', 'expected_delivery_date', 'confirmed_delivery_date', 'status', 'order_amount', 'user_id', 'supplier_id'];
=======
    protected $fillable = ['reference', 'order_date', 'expected_delivery_date', 'confirmed_delivery_date', 'status', 'order_amount','user_id','supplier_id'];
>>>>>>> US5

    protected $casts = [
        'order_date' => 'datetime',
        'expected_delivery_date' => 'datetime',
    ];
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
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();
        static::created(function ($order) {
            if (!$order->reference) {
                $prefixNumber = 1000;
                $order->reference = 'ORD-' . ($prefixNumber + $order->id);
                $order->save();
            }
        });
    }
}



