# Membangun aplikasi Web menggunakan MVC

## Cara menjalankan

Jika menggunakan XAMPP/Apache:

- Clone repository di `DocumentRoot/todo` (biasanya di `c:\xampp\htdocs` kalau di windows).
- Pastikan apache server telah menyala dan kunjungi melalui browser ke `http://localhost/todo`

Menggunan web server _built-in_ PHP (`php -S`):

- Clone repository ini
- Jalankan perintah `php -S 127.0.0.1:8080` untuk menghidupkan web server PHP yang
  diakses di `http://localhost:8080` (sesuaikan IP dan port number jika dibutuhkan)

## MVC

[Model View Controller](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller)
merupakan pola pengembangan aplikasi dengan membagi code menjadi 3 komponen utama:

1. Model, komponen yang bertugas untuk mengelola data yang diolah di dalam aplikasi.
   Model berisikan struktur data untuk menampung data dan juga fungsi/method untuk
   melakukan operasi terhadap struktur data.

2. View, komponen yang bertugas untuk menampilkan informasi dan menyediakan
   _user interface_ supaya user dapat melakukan operasi terhadap aplikasi.

3. Controller, komponen yang berinteraksi dengan Model dan View. Controller menerima
   input dari user dan kemudian melakukan manipulasi data terhadap model melalui
   interface yang tersedia dan kemudian model mengirimkan update/perubahan ke View
   untuk ditampilkan kepada user.

## Composer

[Composer](https://getcomposer.org/), merupakan tools dependency management untuk
mengelola dependency pada project PHP.

Langkah-langkah untuk memulai project PHP menggunakan Composer:

1. Jika Composer belum terpasang, install mengikuti [panduan](https://getcomposer.org/doc/00-intro.md).

2. Buat directory baru untuk menampung project. Misalnya `mkdir todo`.
   Pindah ke dalam directory project `cd todo`.

3. Optional, inisialisasi repository git baru `git init`.

4. Inisialiasi project composer, `composer init`.
   Jawab pertanyaan panduan untuk menginisialisasi project composer.

Project PHP menggunakan composer memiliki struktur seperti berikut:

1. `src`, root directory untuk untuk source code project.

2. `composer.json`, file yang mendefinisikan informasi mengenai project composer
   beserta dependency.

3. `composer.lock`, menyimpan informasi mengenai versi dependency terakhir yang terpasang.

4. `vendor`, directory yang menampung dependency project yang telah di-_download_.

Seluruh source code project akan diletakkan di dalam directory `src`.

## Namespace

[Namespace](https://www.php.net/manual/en/language.namespaces.php) digunakan untuk
menyediakan struktur penamaan untuk code PHP.

Project composer menggunakan namespace untuk mengorganisasikan code project dan
mengikuti standard [PSR-4: Autoloader](https://www.php-fig.org/psr/psr-4/) untuk
meng-autoload file source dependency.

Contoh:

```php
namespace App\Http\Controller;

class HelloController {...}
```

Mengikuti standard PSR-4 source code di atas harus disimpan pada directory
`App\Http\Controller` dengan nama file `HelloController.php`.

File `composer.json` mendefinisikan directory root untuk melakukan autoloading.
Contoh:

```json
"autoload": {
  "psr-4": {
    "Uph22si1Web\\Todo\\": "src/"
  }
}
```

Menyatakan bahwa namespace `Uph22si1Web\Todo` dapat ditemukan di directory `src`.

[Panduan](https://getcomposer.org/doc/01-basic-usage.md) menampilkan contoh
code untuk melakukan autoloading.

```php
require __DIR__ . '/vendor/autoload.php';
```

## Web application entry point

Selama ini kita selalu mengakses script PHP dengan menuliskan path nya secara lengkap.
Misalnya `http://localhost/db.php` mengakses script `db.php` yang berada di
root directory web server.

Supaya web dapat diakses dengan URL yang lebih "bersih", misalnya `http://localhost/todo`,
kita dapat menggunakan satu script PHP yang berfungsi sebagai entry point untuk aplikasi
web PHP.
Script PHP entry point ini berfungsi menjadi router yang nantinya akan menjalankan
script sesuai dengan URL yang direquest oleh user.
Konfigurasi entry point ini mengikuti web server yang digunakan untuk
meng-host aplikasi PHP.
Ide sederhananya adalah web server dikonfigurasi untuk mengirimkan seluruh request
ke script entry point vs web server langsung mengakses file yang direquest oleh user.

Contoh membuat script router sederhana:
[How to Build a Routing System for a PHP App from Scratch](https://www.freecodecamp.org/news/how-to-build-a-routing-system-in-php/)
