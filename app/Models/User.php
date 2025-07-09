<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Order;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids;

    // Clé primaire en UUID, non auto-incrémentée
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',  // À retirer une fois la migration faite
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role' => UserRole::class, // À retirer après migration
    ];

    // Relations avec d'autres modèles
    public function products()
    {
        return $this->hasMany(Product::class, 'user_id', 'user_id');
    }

    public function suppliers()
    {
        return $this->hasMany(Supplier::class, 'user_id', 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'user_id');
    }

    // Relations vers les rôles séparés
    public function admin()
    {
        return $this->hasOne(Admin::class, 'user_id', 'user_id');
    }

    public function purchaser()
    {
        return $this->hasOne(Purchaser::class, 'user_id', 'user_id');
    }

    // Méthodes de vérification de rôle basées sur les relations
    public function isAdmin(): bool
    {
        return $this->admin !== null;
    }

    public function isPurchaser(): bool
    {
        return $this->purchaser !== null;
    }

}
