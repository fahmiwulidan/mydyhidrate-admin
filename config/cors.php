<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'http://127.0.0.1:8000', // Origin Laravel itu sendiri (jika diakses dari browser/Postman di mesin yang sama)

        // --- Tambahkan origin Flutter Anda di sini ---

        // SKENARIO 1: Untuk Flutter Web / Desktop / iOS Simulator
        // Periksa output terminal 'flutter run', biasanya ada "Serving flutter_app on http://localhost:XXXX/"
        // Ganti <PORT_FLUTTER_WEB_ANDA> dengan port aktual yang digunakan Flutter Web/Desktop Anda
        'http://localhost:5000', // Contoh: 'http://localhost:5000' atau 'http://localhost:random_port'
        // Jika Anda menggunakan IP loopback selain localhost (jarang untuk web/desktop)
        'http://127.0.0.1:5000', // Contoh: 'http://127.0.0.1:5000'

        // SKENARIO 2: Untuk Flutter iOS Perangkat Fisik (dan juga Android Perangkat Fisik jika nanti digunakan)
        // Ganti <IP_LOKAL_KOMPUTER_ANDA> dengan IP Address lokal komputer Anda yang menjalankan Laravel
        // Contoh: 'http://192.168.1.5:8000' (sesuaikan dengan IP Anda)
        // 'http://<IP_LOKAL_KOMPUTER_ANDA>:8000',

        // Jika Anda menggunakan IP 10.0.2.2 karena suatu alasan atau untuk emulator Android lainnya:
        'http://10.0.2.2:8000',
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
