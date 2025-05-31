<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        // Tambahkan rute login Anda di sini
        'login', // <<< Pastikan ini ada dan sesuai dengan nama rute Anda
        // ... rute lain yang ingin dikecualikan
    ];
}
