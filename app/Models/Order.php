<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier;
use App\Models\User;
use App\Models\OrderItem;
class Order extends Model
{
    //Attributs pouvant être assignés en masse
    protected $fillable = ['reference', 'order_date', 'expected_delivery_date', 'confirmed_delivery_date', 'status', 'order_amount', 'user_id', 'supplier_id'];
    
    //Attributs castés automatiquement en objets DateTime
    protected $casts = [
        'order_date' => 'datetime',
        'confirmed_delivery_date' => 'datetime',
        'expected_delivery_date' => 'datetime',
    ];

    //Relation : une commande appartient à un fournisseur
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
     //Relation : une commande appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
     //Relation : une commande a plusieurs lignes de commande
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
    // Génère automatiquement une référence après création d'une commande 
    protected static function boot()
    {
        parent::boot();
        static::created(function ($order) {
            if (empty($order->reference)) {
                $prefixNumber = 1000;
                $order->updateQuietly([
                    'reference' => 'ORD-' . ($prefixNumber + $order->id)
                ]);
            }
        });
    }
    // Recalcule le montant total de la commande à partir des lignes associées
    public function recalculateAmount()
    {
        $this->order_amount = $this->orderItems()->sum('line_total');
        $this->save();
    }
}



