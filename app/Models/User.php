<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Kitölthető mezők
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',       // Cím
        'phone_number',  // Telefonszám
    ];

    // Rejtett mezők (pl. jelszó)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Típuskonverziók
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Termékek kapcsolat
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
