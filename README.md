# nuPHP Framework v3.0.1 🚀

[![PHP Version](https://img.shields.io/badge/PHP-%5E8.1%20%7C%20%5E8.2%20%7C%20%5E8.3-blue.svg)](https://php.net)
[![Framework Version](https://img.shields.io/badge/nuPHP-v3.0.1-success.svg)](https://github.com/nufatID/nuPHP)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

**nuPHP** adalah PHP Framework MVC (dan NoMVC) yang ringan, super cepat, fleksibel, serta didesain untuk mempercepat pembuatan aplikasi web modern tanpa *overhead* berlebihan.

---

## 🌟 Fitur Utama (v3.0.1)

- ⚡ **Lightweight & Super Fast:** Beban runtime minimal dengan performa tinggi.
- 🗄️ **Multi-ORM Support:** Mendukung **Illuminate Eloquent ORM** (Laravel Database) dan **Medoo Database Wrapper** secara bawaan.
- 🎨 **Nutemplete & Blade View Engine:** Didukung oleh **Nutemplete v3.0.0** (dengan direktif `@auth`, `@guest`, `@json`, `@asset`, dan `<nu-component>`).
- 🛠️ **Built-in CLI Tool (`php nu` v3.0.0):** Generator controller/model, route inspector (`route:list`), konsol interaktif (`tinker`), serta scaffolding UI auth (`ui:auth`).
- 📊 **Mini Debugbar:** Floating Dev Toolbar otomatis saat `APP_DEBUG=true` (cek execution time, memory peak, & SQL query count).
- 🔄 **Smart Auto-Routing:** Routing dinamis berbasis struktur controller & view, serta opsi kustomisasi rute manual.
- 🛡️ **Environment & CSRF Protection:** Manajemen `.env` aman dengan perlindungan token CSRF.
- 📦 **PSR-4 Compliant:** Mengikuti standar autoloading modern PHP.

---

## 📋 Persyaratan System

- **PHP:** `^8.1`, `^8.2`, atau `^8.3`
- **Composer:** Versi 2.x
- **Ekstensi PHP:** `PDO`, `pdo_mysql` / `pdo_sqlite`, `mbstring`, `json`, `fileinfo`

---

## 🚀 Cara Instalasi

### 1. Menggunakan Composer

```bash
composer create-project nufat/nuphp nama-proyek
```

### 2. Menggunakan Git Clone

```bash
git clone https://github.com/nufatID/nuPHP.git nama-proyek
cd nama-proyek
composer install
```

---

## ⚙️ Konfigurasi Environment

Salin file `.env.example` menjadi `.env` lalu sesuaikan konfigurasi database dan aplikasi:

```bash
cp .env.example .env
```

Isi file `.env`:

```env
APP_ENV=development
APP_DEBUG=true
APP_KEY=base64:nuPHPSecretKey12345678901234567890

BASE_DIR=/
DB_DRIVER=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_USER=root
DB_PASS=secret
DB_NAME=nuphp

AUTH=false
```

---

## 💻 Penggunaan CLI (`php nu`)

Framework **nuPHP** dilengkapi skrip CLI interaktif untuk mempermudah alur kerja pengembangan:

```bash
# Menjalankan local development server (default port 8000)
php nu serve 8000

# Membuat Controller baru di app/Controllers/
php nu make:controller UserController

# Membuat Model Eloquent baru di app/Models/
php nu make:model User

# Menampilkan versi nuPHP Framework
php nu version
```

---

## 📁 Struktur Direktori

```text
nuPHP/
├── app/
│   ├── Controllers/     # Berkas Controller aplikasi
│   ├── Models/          # Berkas Model Eloquent / PDO
│   ├── Routes.php       # Konfigurasi Routing Aplikasi
│   └── index.php        # Helper aplikasi
├── assets/              # Static Assets (CSS, JS, Images)
├── cache/               # Cache compiled views
├── core/
│   ├── classes/         # Core helper classes (Database, Auth, CSRF, dll)
│   ├── config.php       # Inisialisasi konfigurasi & env
│   └── Connection.php   # Bootstrapper database connection
├── helper/              # Custom function helpers
├── resource/            # Components & elements
├── templates/           # Layout & template Blade
├── views/               # File tampilan view (.nu.php)
├── .env.example         # Template konfigurasi environment
├── composer.json        # Autoload & dependensi Composer
├── index.php            # Entry point aplikasi
└── nu                   # Executable CLI tool nuPHP
```

---

## 📖 Panduan Penggunaan

### 1. Membuat Model (Eloquent)

Buat model di `app/Models/User.php`:

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $guarded = [];
}
```

### 2. Membuat Controller

Buat controller di `app/Controllers/UserController.php`:

```php
use App\Models\User;

class UserController
{
    public function index()
    {
        $users = User::all();
        View('users/index', ['users' => $users]);
    }

    public function detail($id)
    {
        $user = User::find($id);
        if (!$user) {
            header('HTTP/1.0 404 Not Found');
            return View('404');
        }
        View('users/detail', ['user' => $user]);
    }
}
```

### 3. Konfigurasi Route Custom

Tambahkan rute kustom di `app/Routes.php`:

```php
use Steampixel\Route;

// Explicit Custom Route
Route::add('/dashboard', function () {
    View('dashboard');
});

// Route dengan controller & method
Route::add('/user/profile/([0-9]+)', function ($id) {
    $controller = new UserController();
    $controller->detail($id);
});
```

### 4. Helper Global & Fitur Terintegrasi

nuPHP v3.0.0 dilengkapi helper global dan fitur terintegrasi ala Laravel:

- `request($key = null, $default = null)` — Mengambil data input request GET/POST.
- `session($key = null, $default = null)` — Membaca/menyimpan data session secara instan.
- `session_flash($key, $val)` & `flash($key)` — Notifikasi flash message 1x baca (terintegrasi dengan direktif Nutemplete `@flash('success')`).
- `validator($data, $rules)` — Form request validation (`required`, `email`, `numeric`, `min`, `max`).
- `middleware($names)` — Pipeline middleware runner (`App\Core\Middleware`).
- `resource($data, $callback)` — API Resource JSON Transformer (`App\Core\Resource`).
- `redirect($url)` — Redirect URL dengan penanganan base URL otomatis.
- `response($data, $status = 200)` — Mengirimkan JSON response dengan header HTTP.
- `env($key, $default = null)` — Membaca nilai dari konfigurasi `.env`.
- `db()` — Mengakses kelas instans Eloquent DB Capsule.

---

## 🤝 Kontribusi

Pull request sangat diterima! Untuk perubahan besar, silakan buka *issue* terlebih dahulu untuk mendiskusikan apa yang ingin Anda ubah.

---

## 🌐 Informasi & Lisensi

- **Website:** [https://webdev.nufat.id/](https://webdev.nufat.id/)
- **Repository:** [https://github.com/nufatID/nuPHP](https://github.com/nufatID/nuPHP)
- **License:** [MIT License](LICENSE)
