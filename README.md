# PROYEK 3 - MODUL 4 - Cookies, Session, dan Local Storage
Nama: Rizky Yanuar Irawan
Kelas: 2A D3
NIM: 251511029

# MintonStore - Web Shopping Cart Application

MintonStore adalah aplikasi toko online berbasis web yang dikembangkan menggunakan **PHP (Laravel Framework)**, **Tailwind CSS**. Aplikasi ini menyediakan sistem autentikasi pengguna, manajemen katalog produk, keranjang belanja berbasis server (*server-side session*), pemrosesan transaksi *checkout* dengan transaksi database, serta riwayat pesanan pengguna.

## 🛠️ Tech Stack & Dependencies

* **Framework Backend:** Laravel
* **Templating Engine:** Blade UI
* **Styling & Interactivity:** Tailwind CSS
* **Database:** MySQL
* **Asset Bundler:** Vite

## 📂 Struktur Direktori Utama

```text
app/
├── Http/
│   └── Controllers/
│       ├── AuthController.php      # Mengatur registrasi, login, dan logout pengguna
│       ├── CartController.php      # Mengatur manajemen keranjang belanja (Session)
│       ├── OrderController.php     # Mengatur pemrosesan checkout & riwayat pesanan
│       └── ProductController.php   # Mengatur katalog & tampilan produk di beranda
├── Models/
│   ├── Order.php                   # Model Eloquent untuk data transaksi utama
│   ├── OrderDetail.php             # Model Eloquent untuk detail barang dalam transaksi
│   ├── Product.php                 # Model Eloquent untuk data produk/barang
│   └── User.php                    # Model Eloquent pengguna
database/
└── migrations/
    ├── create_users_table.php      # Tabel users (id_user, nama_lengkap, email, username, dll)
    ├── create_products_table.php   # Tabel products (id_barang, nama_barang, harga, stok, dll)
    ├── create_orders_table.php     # Tabel orders (id_order, id_user, total_harga, dll)
    └── create_order_details_table.php # Tabel order_details (Composite Key: id_order + id_barang)
resources/
└── views/
    ├── auth/
    │   ├── login.blade.php         # Tampilan form autentikasi login
    │   └── register.blade.php      # Tampilan form pendaftaran akun pengguna baru
    ├── cart/
    │   └── index.blade.php         # Tampilan keranjang belanja & form checkout
    ├── layouts/
    │   └── app.blade.php           # Layout utama aplikasi MintonStore (Navbar & Footer)
    ├── orders/
    │   └── index.blade.php         # Tampilan riwayat transaksi pesanan milik pengguna
    └── welcome.blade.php           # Tampilan halaman utama / katalog produk (Dashboard)
routes/
└── web.php                         # Pengaturan routing aplikasi & penerapan middleware
```

---

## FILE SQL UNTUK DATABASE
Untuk tugas-2-keranjang, file .sql bernama barang.sql dengan nama database barang


Untuk tugas-3-toko-online, file .sql bernama toko_online.ql dengan nama database toko_online

## Daftar Rute

### A. Rute Publik

Rute publik dapat diakses tanpa harus login.

| Method | URL | Controller | Fungsi |
|---|---|---|---|
| GET | `/` | `ProductController@dashboardView` | Menampilkan dashboard atau halaman produk |
| GET | `/register` | `AuthController@showRegisterForm` | Menampilkan formulir registrasi |
| POST | `/register` | `AuthController@register` | Memproses registrasi pengguna |
| GET | `/login` | `AuthController@showLoginForm` | Menampilkan formulir login |
| POST | `/login` | `AuthController@login` | Memproses autentikasi pengguna |


### B. Rute yang Membutuhkan Autentikasi

Rute berikut diletakkan di dalam middleware `auth`. Pengguna harus login terlebih dahulu sebelum mengaksesnya.

| Method | URL | Route Name | Fungsi |
|---|---|---|---|
| POST | `/logout` | `logout` | Keluar dari akun |
| GET | `/cart` | `cart.index` | Menampilkan keranjang belanja |
| POST | `/cart/add/{id_barang}` | `cart.add` | Menambahkan barang ke keranjang |
| PATCH | `/cart/update/{id_barang}` | `cart.update` | Memperbarui jumlah barang |
| DELETE | `/cart/remove/{id_barang}` | `cart.remove` | Menghapus barang dari keranjang |
| POST | `/checkout` | `checkout` | Memproses checkout pesanan |
| GET | `/orders` | `orders.index` | Menampilkan daftar pesanan pengguna |

## Cara Menjalankan Aplikasi

### Prasyarat

Pastikan perangkat sudah memiliki:

- PHP >= 8.3.
- Composer.
- Database MySQL.
- Node.js dan NPM.

### Langkah 1 — Clone repositori dan masuk ke direktori proyek

### Langkah 2 — Instal dependensi

```bash
composer install
npm install
```

### Langkah 3 — Konfigurasi environment

Jika file `.env` belum tersedia, buat dari file contoh:

```bash
cp .env.example .env
```

Buat application key:

```bash
php artisan key:generate
```

### Langkah 4 — Atur database

Buka file `.env`, kemudian sesuaikan konfigurasi database dengan lingkungan lokal.


Pastikan database sudah dibuat dan layanan database sedang berjalan.

### Langkah 5 — Jalankan migrasi

```bash
php artisan migrate
php artisan storage:link
php artisan db:seed --class=ProductSeeder
```

### Langkah 6 — Periksa daftar rute

Jalankan:

```bash
php artisan route:list
```

### Langkah 7 — Jalankan server Laravel

```bash
php artisan serve
npm run dev
```
