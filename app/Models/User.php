<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Enums\UserRole;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Order;
use App\Models\Admin;
use App\Models\Purchaser;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids;

    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Champ utilisé temporairement
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role' => UserRole::class, // Cast vers enum UserRole
    ];

    // Relations
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

    public function admin()
    {
        return $this->hasOne(Admin::class, 'user_id', 'user_id');
    }

    public function purchaser()
    {
        return $this->hasOne(Purchaser::class, 'user_id', 'user_id');
    }

    // Vérifications de rôle basées sur la colonne role (temporaire)
    public function isAdmin(): bool
    {
        return $this->role === UserRole::Admin;
    }

    public function isPurchaser(): bool
    {
        return $this->role === UserRole::Purchaser;
    }
}
