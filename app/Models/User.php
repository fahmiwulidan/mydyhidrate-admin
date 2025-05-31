<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * Atribut yang boleh diisi mass assignment
     */
    protected $fillable = [
        'name',
        'email',
        'username',      // tambahkan username
        'password',
        'berat_badan',   // berat badan (optional, sesuai kebutuhan)
        'tinggi_badan',  // tinggi badan (optional)
        'image_url',     // url gambar/profile (optional)
    ];

    /**
     * Atribut yang disembunyikan saat serialisasi JSON
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting atribut ke tipe data tertentu
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // jangan cast password karena sudah di-hash manual di controller
    ];
}
