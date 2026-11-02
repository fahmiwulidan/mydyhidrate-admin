<div align="center">

  <h1>MediHydrate Admin & Backend API</h1>
  <p><b>Platform Backend API & Panel Administrasi Aplikasi Pelacak Hidrasi Harian</b></p>

  [![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
  [![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
  [![Vite](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white)](https://vitejs.dev/)
  [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](./LICENSE)

  <br />

  [Laporkan Bug](https://github.com/fahmiwulidan/mydyhidrate-admin/issues) •
  [Minta Fitur](https://github.com/fahmiwulidan/mydyhidrate-admin/issues)

</div>

---

## Ringkasan Proyek

**MediHydrate Admin & Backend API (MyDihydrate Admin)** adalah pusat kendali administrator dan penyedia layanan RESTful API untuk ekosistem aplikasi **MediHydrate**. Platform ini berfungsi mengelola data pengguna, riwayat pencatatan konsumsi air harian, target cairan harian, serta menyediakan API endpoint yang terintegrasi dengan aplikasi *mobile* (`mydyhidrate-app`).

> [!NOTE]
> Aplikasi ini dikembangkan menggunakan framework **Laravel** dengan templating **Blade** dan bundler aset **Vite** untuk menjamin performa dashboard yang cepat dan responsif.

---

## Teknologi Utama

| Layer | Teknologi | Deskripsi |
| :--- | :--- | :--- |
| **Backend Framework** | Laravel (PHP) | Framework web utama pengolah logika bisnis & RESTful API service |
| **Frontend Admin** | Blade Templating & Vite | Dashboard administrasi web interaktif dan teroptimasi |
| **Asset Bundler** | Vite | Pemroses & pemaket aset statis (JavaScript & CSS) berkecepatan tinggi |
| **Database & ORM** | Eloquent ORM & MySQL | Pengelolaan data relasional pengguna & riwayat hidrasi |

---

## Fitur Unggulan

- **RESTful API Service** — Endpoint API terpusat untuk autentikasi, sinkronisasi data konsumsi air, dan pengaturan notifikasi aplikasi mobile.
- **Dashboard Administrasi** — Panel kendali terpusat untuk memantau aktivitas pengguna dan statistik hidrasi secara keseluruhan.
- **Manajemen Pengguna & Target** — Kemudahan dalam mengelola profil pengguna serta batas rekomendasi cairan harian.
- **Arsitektur Modular & Aman** — Dilengkapi middleware keamanan otentikasi sesi dan token API.

---

## Struktur Direktori

```text
mydyhidrate-admin/
├── app/              # Core aplikasi Laravel (Controllers, Models, Middleware)
├── bootstrap/        # Skrip inisialisasi framework & cache
├── config/           # Berkas konfigurasi sistem (app, database, auth, dll)
├── database/         # Migrasi, seeder, & pabrik data (factories)
├── public/           # Entry point aplikasi web (`index.php`) & aset publik
├── resources/        # Tampilan Blade, komponen UI, & aset mentah (CSS/JS)
├── routes/           # Penataan alur URL web (`web.php`) & API (`api.php`)
├── storage/          # Penyimpanan log sistem, berkas unggahan, & cache
├── tests/            # Pengujian otomatis (Unit & Feature Testing)
├── .editorconfig     # Pengaturan standar konfigurasi editor kode
├── .env.example      # Template konfigurasi lingkungan
├── .gitattributes    # Aturan bawaan repositori Git
├── .gitignore        # Berkas pengecualian versi Git
├── artisan           # Antarmuka baris perintah (CLI) Laravel
├── composer.json     # Manajer dependensi pustaka PHP
├── composer.lock     # Berkas kunci versi dependensi Composer
├── package.json      # Manajer dependensi pustaka Node.js / Vite
├── phpunit.xml       # Konfigurasi kerangka kerja pengujian PHPUnit
├── vite.config.js    # Konfigurasi bundler aset Vite
└── README.md         # Dokumentasi utama repositori
```

---

<div align="center">
  <sub>Dikembangkan dengan ❤️ oleh <a href="https://github.com/fahmiwulidan">Fahmi Wulidan</a></sub>
</div>
