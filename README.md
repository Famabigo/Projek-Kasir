ShopEase - Sistem Manajemen Penjualan
====================================

## Status: ✅ Siap Digunakan

Aplikasi Laravel 10 untuk manajemen penjualan dengan 3 role: Admin, Kasir, dan Pembeli.

## Fitur yang Sudah Diimplementasikan

### 🧑‍💼 Admin
- ✅ Kelola Pegawai/Kasir (CRUD)
- ✅ Kelola Stok Barang (CRUD dengan upload gambar)
- ✅ Kelola Pengaturan (Settings)
- Dashboard (siap dikembangkan untuk laporan)

### 💰 Kasir
- ✅ Buat Transaksi Penjualan
- ✅ Kelola Member (CRUD)
- ✅ Lihat Riwayat Transaksi
- Dashboard (siap dikembangkan)

### 🛒 Pembeli
- Dashboard (siap dikembangkan untuk pesan online)

## Akses Aplikasi

**URL:** http://127.0.0.1:8000

**Login Admin:**
- Email: `admin@example.test`
- Password: `password`

## Setup (Jika Clone Fresh)

```powershell
# 1. Install dependencies
composer install
npm install

# 2. Setup environment
copy .env.example .env
# Edit .env untuk konfigurasi database

# 3. Generate key & migrate
php artisan key:generate
php artisan migrate
php artisan db:seed

# 4. Build assets & link storage
npm run build
php artisan storage:link

# 5. Jalankan server
php artisan serve
```

## Teknologi
- Laravel 10
- Laravel Breeze (Authentication)
- Bootstrap 5 (Custom views)
- MySQL/MariaDB

## Routes Penting
- `/` - Redirect ke dashboard atau login
- `/login` - Halaman login
- `/register` - Halaman registrasi
- `/dashboard` - Auto-redirect berdasarkan role
- `/admin/*` - Area admin (role: admin)
- `/kasir/*` - Area kasir (role: kasir)
- `/pembeli/*` - Area pembeli (role: pembeli)

## Catatan Pengembangan
- Migrations dan models lengkap untuk semua tabel
- Role-based middleware sudah aktif
- Storage link untuk upload gambar barang
- Admin user otomatis dibuat via seeder

## Fitur Tambahan yang Sudah Diimplementasikan

### Admin
- ✅ Dashboard dengan statistik real-time (transaksi, omset, keuntungan)
- ✅ Alert stok menipis dan produk akan expired
- ✅ Laporan penjualan dengan filter tanggal
- ✅ Export laporan ke PDF dan Excel

### Kasir
- ✅ Cetak struk transaksi (PDF)
- ✅ Lihat stok barang real-time dengan info expired
- ✅ Auto-delete produk expired (via command & scheduled)

### Command Tersedia
```powershell
# Hapus manual produk expired
php artisan barang:hapus-expired

# Seed sample data (barang & members)
php artisan db:seed --class=SampleDataSeeder

# Schedule command (tambahkan ke cron/task scheduler)
php artisan schedule:work
```

## Next Steps (Opsional)
- QR Code untuk member card
- Keranjang belanja pembeli
- Responsive UI improvements
- Notification system
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
