<?php

namespace App\Models;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    protected $fillable = ['email', 'name', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts =  [
        'email_verified_at' => 'datetime',
    ];

}

