<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier;
use App\Models\User;
use App\Models\OrderItem;
class Order extends Model
{
    protected $fillable = ['reference', 'order_date', 'expected_delivery_date', 'confirmed_delivery_date', 'status','order_amount'];
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
}
