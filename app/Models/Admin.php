<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    protected $fillable = ['email', 'name', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts =  [
        'email_verified_at' => 'datetime',
    ];

}

