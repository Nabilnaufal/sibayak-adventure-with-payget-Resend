# Sibayak Adventure

Sibayak Adventure adalah aplikasi web rental perlengkapan outdoor untuk membantu pelanggan mencari, memasukkan produk ke keranjang, membuat booking, dan melakukan pembayaran sewa perlengkapan pendakian. Aplikasi ini juga menyediakan panel admin untuk mengelola katalog produk, stok, status booking, pendapatan bulanan, rental aktif, serta denda keterlambatan.

Proyek ini cocok untuk bisnis penyewaan alat camping/hiking seperti tenda, carrier, sleeping bag, sepatu hiking, headlamp, trekking pole, matras, kompor portable, dan perlengkapan outdoor lain.

## Stack

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Vite-8-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite">
  <img src="https://img.shields.io/badge/Tailwind_CSS-3-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/Alpine.js-3-8BC0D0?style=for-the-badge&logo=alpinedotjs&logoColor=white" alt="Alpine.js">
  <img src="https://img.shields.io/badge/Midtrans-Payment-00AAE7?style=for-the-badge" alt="Midtrans">
  <img src="https://img.shields.io/badge/Resend-Mail-000000?style=for-the-badge&logo=resend&logoColor=white" alt="Resend">
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Editor-Neovim-57A143?style=for-the-badge&logo=neovim&logoColor=white" alt="Neovim">
  <img src="https://img.shields.io/badge/Config-NvChad-5E81AC?style=for-the-badge&logo=neovim&logoColor=white" alt="NvChad">
  <img src="https://img.shields.io/badge/Terminal-Kitty-111111?style=for-the-badge&logo=gnometerminal&logoColor=white" alt="Kitty Terminal">
</p>

## Fitur Utama

- Katalog produk perlengkapan outdoor dengan detail harga sewa per hari, kategori, stok, dan gambar.
- Keranjang belanja berbasis session untuk menambah, mengurangi, dan menghapus produk.
- Booking multi-produk dengan tanggal mulai, tanggal selesai, data penyewa, dan total harga otomatis.
- Integrasi Midtrans Snap untuk pembayaran.
- Callback Midtrans untuk memperbarui status booking.
- Dashboard user untuk melihat aktivitas penyewaan.
- Panel admin untuk CRUD produk, upload gambar, pencarian, filter kategori, dan status stok.
- Manajemen booking admin dengan pencarian, filter status, filter tanggal, dan update status.
- Perhitungan denda saat rental aktif diselesaikan melewati tanggal pengembalian.

## Kebutuhan Sistem

- PHP 8.3 atau lebih baru
- Composer
- Node.js dan npm
- MySQL
- Akun Midtrans Sandbox untuk testing pembayaran

## Instalasi

Clone repository:

```bash
git clone <url-repository>
cd sibayak-laravel12
```

Install dependency PHP dan JavaScript:

```bash
composer install
npm install
```

Buat file environment:

```bash
cp .env.example .env
php artisan key:generate
```

Siapkan database MySQL, lalu sesuaikan konfigurasi database di `.env`:

```sql
CREATE DATABASE sibayak_adventure;
```

Setelah database siap, jalankan migrasi:

```bash
php artisan migrate
```

Opsional, isi data contoh:

```bash
php artisan db:seed --class=ProductSeeder
php artisan db:seed --class=UserSeeder
```

Jalankan storage link jika memakai storage Laravel:

```bash
php artisan storage:link
```

Jalankan aplikasi:

```bash
composer run dev
```

Atau jalankan server dan Vite secara terpisah:

```bash
php artisan serve
npm run dev
```

Aplikasi default berjalan di:

```text
http://127.0.0.1:8000
```

## Konfigurasi Environment

Contoh konfigurasi dasar:

```env
APP_NAME="Sibayak Adventure"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sibayak_adventure
DB_USERNAME=root
DB_PASSWORD=
```

Tambahkan konfigurasi Midtrans di `.env`:

```env
MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxxxxx
MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxxxxx
MIDTRANS_IS_PRODUCTION=false
```

Untuk email, proyek ini sudah menyiapkan konfigurasi Laravel mail dan package Resend. Saat development, `MAIL_MAILER=log` cukup aman agar email masuk ke log lokal.

## Alur Produk

1. Pengunjung membuka katalog produk.
2. User login atau register.
3. User menambahkan produk ke keranjang atau booking langsung dari detail produk.
4. User memilih tanggal sewa dan mengisi data penyewa.
5. Sistem menghitung total berdasarkan jumlah hari, harga per hari, dan kuantitas.
6. Booking dibuat dengan status `pending`.
7. Pembayaran diproses melalui Midtrans Snap.
8. Callback Midtrans mengubah status menjadi `aktif`, `pending`, atau `dibatalkan`.
9. Admin dapat menyelesaikan booking dan sistem menghitung denda jika terlambat.

## Route Penting

```text
/                    Halaman utama
/products            Daftar produk
/products/{product}  Detail produk
/cart                Keranjang
/booking             Form booking dari cart
/dashboard           Dashboard user
/admin/dashboard     Dashboard admin
/admin/products      Manajemen produk admin
/admin/bookings      Manajemen booking admin
/midtrans/callback   Callback pembayaran Midtrans
```

## Build Production

```bash
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Pastikan `.env`, database lokal, file log, cache, dan upload lokal tidak ikut masuk repository public.

## Editor & Terminal

Proyek ini nyaman dikembangkan dengan Neovim/NvChad dan Kitty Terminal. Contoh workflow:

```bash
kitty
nvim .
composer run dev
```

Gunakan split terminal untuk menjalankan server Laravel, queue/log, dan Vite jika tidak memakai `composer run dev`.

## Lisensi

Copyright (c) 2026 Naufal Nabil.

Proyek ini menggunakan fondasi Laravel yang berlisensi MIT. Sesuaikan lisensi repository sesuai kebutuhan sebelum dipublish.
