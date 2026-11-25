# Website Desa Trengguli

Website profil dan informasi Desa Trengguli. Dibangun dengan Laravel 10 dan MySQL.

## Fitur

**Halaman publik**
- Beranda: profil desa, visi/misi, layanan, potensi, berita terbaru, galeri, kontak
- Daftar berita + detail berita (dengan penghitung kunjungan)
- Galeri foto dengan lightbox
- Daftar potensi desa + detail potensi (termasuk peta Google Maps)

**Panel admin** (`/admin`)
- Login dengan rate limiting
- Dashboard ringkasan
- CRUD berita (draft/published, slug unik otomatis)
- CRUD galeri
- CRUD layanan
- CRUD potensi desa
- Edit profil desa & media sosial
- Ubah password

## Kebutuhan

- PHP 8.1 atau lebih baru dengan ekstensi `pdo_mysql`, `fileinfo`, `gd`
- Composer
- MySQL 8 / MariaDB
- Node.js + npm (opsional, hanya jika ingin memakai Vite)

> Jika `php` di terminal tidak punya `pdo_mysql`, gunakan PHP bawaan Laragon/XAMPP, misalnya:
> `D:\laragon\bin\php\php-8.3.11-nts-Win32-vs16-x64\php.exe artisan ...`

## Instalasi

```bash
# 1. Install dependency PHP
composer install

# 2. Salin konfigurasi environment
copy .env.example .env

# 3. Buat application key
php artisan key:generate

# 4. Buat database MySQL
#    Nama default: trengguli_id
mysql -u root -e "CREATE DATABASE trengguli_id CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# 5. Jalankan migration + seeder admin
php artisan migrate --seed

# 6. Buat symlink storage (wajib agar gambar tampil)
php artisan storage:link
```

Sesuaikan `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` di `.env` bila perlu.

### Aset frontend (opsional)

Halaman publik memakai `public/css/trengguli.css` dan panel admin memakai Tailwind via CDN, jadi build Vite tidak wajib. Jika ingin memakai Vite:

```bash
npm install
npm run build
```

## Akun Admin Default

| | |
|---|---|
| URL | `/admin/login` |
| Email | `admin@trengguli.id` |
| Password | `admin123` |

**Penting:** segera ganti password default melalui menu **Ubah Password** setelah login pertama.

## Pengujian

Test memakai database terpisah `trengguli_id_test` (lihat `phpunit.xml`).

```bash
mysql -u root -e "CREATE DATABASE trengguli_id_test CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
php artisan test
```

Test yang tersedia mencakup halaman publik, filter berita draft/published, autentikasi admin, slug unik, validasi URL Google Maps, dan ubah password.

## Struktur Singkat

```
app/Http/Controllers/          Controller publik & admin
app/Models/                    News, Gallery, Service, Potential, Profile, User
app/Rules/GoogleMapsUrl.php    Validasi tautan peta
database/migrations/           Skema database
resources/views/               Blade (publik & admin)
routes/web.php                 Route publik
routes/admin.php               Route admin + autentikasi
public/css/trengguli.css       Styling halaman publik
```

## Checklist Production

Sebelum deploy:

1. Set di `.env`:
   ```env
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://domain-anda.com
   ```
2. Ganti password admin default.
3. Jalankan:
   ```bash
   php artisan migrate --force
   php artisan storage:link
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
4. Pastikan folder `storage/` dan `bootstrap/cache/` dapat ditulis oleh web server.
5. Arahkan document root web server ke folder `public/`.
6. Backup database secara berkala.

## Catatan

- Upload gambar disimpan di `storage/app/public` dan diakses lewat symlink `public/storage`.
- Berita hanya tampil di halaman publik jika `status = published` dan `published_at` sudah lewat (atau kosong).
- Tabel potensi bernama `potentials` (migration lama sempat memakai nama `potential`).
