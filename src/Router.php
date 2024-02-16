<?php

namespace Uph22si1Web\Todo;

use Uph22si1Web\Todo\Controllers\BaseController;


// Class router berfungsi sebagai API bagi developer
// untuk mendaftarkan mapping antara alamat URL request dengan handler
class Router
{
  // property object
  private string $base;
  private array $getHandlers;
  private array $postHandlers;

  function __construct(string $base) {
    $this->base = $base;

    $this->getHandlers = [];
    $this->postHandlers = [];
  }

  public function getBase(): string {
    return $this->base;
  }

  // Request get
  // callable (https://www.php.net/manual/en/language.types.callable.php) adalah type yang
  // mengacu ke code yang bisa dipanggil/dijalankan
  // method get menerima sebuah string path misalnya `/hello` dan fungsi yang akan
  // dijalankan atau dipanggil
  // baca cara penggunaannya di index.php
  // dan baca cara memanggil handler di Server.php
  /**
    * @return void
    * @param callable(): mixed $handler
    */
  public function get(string $path, callable|BaseController $handler): void
  {
    $this->getHandlers[$this->normalizedPath($path)] = $handler;
  }

  // Request post
  /**
    * @return void
    * @param callable(): mixed $handler
    */
  public function post(string $path, callable|BaseController $handler): void
  {
    $this->postHandlers[$this->normalizedPath($path)] = $handler;
  }

  // kembalikan handler sesuai dengan path dan method yang diinginkan
  // ?callable di signature method ini merupakan return type
  // method ini mengembalikan object callable (fungsi yang dapat dipanggil/dijalankan)
  // dengan menambahkan modifier ? di depan artinya bisa saja callable tidak ditemukan
  // dan dikembalikan nilai null
  // konsep disebut dengan nullable type (https://en.wikipedia.org/wiki/Nullable_type)
  public function getHandlerFor(Request $request): callable|BaseController|null
  {
    $path = $this->requestURIPath($request->getUri());
    $method = $request->getMethod();

    if ($method === 'GET') {
      // ?? Null Coalescing Operator, nilai fallback apabila ekspresi disebelah kiri bernilai null
      return $this->getHandlers[$path] ?? null;
    }

    if ($method === 'POST') {
      return $this->postHandlers[$path] ?? null;
    }

    return null;
  }

  // normalisasi path yang akan di register.
  // misalnya router dikonfigurasikan dengan base path '/todo'
  // ketika user meng-register path '' maka yang diregister ke list path adalah `/todo`
  // jika yang diregister adalah '/show' maka yang diregister adalah '/todo/show'
  private function normalizedPath(string $path): string {
    // ternary operator untuk menentukan apakah path delimiter perlu ditambahkan atau tidak
    $pathDelimiter = str_starts_with($path, '/') || str_ends_with($this->base, '/') ? '' : '/';

    $fullPath = $this->stripSlashInTheEndOfPath($this->base . $pathDelimiter . $path);

    return $fullPath;
  }

  // kembalikan path tanpa query parameter
  // e.g. /todo?nama=budi menjadi /todo
  private function requestURIPath(string $uri): string {
    $requestPath = $this->stripSlashInTheEndOfPath(strtok($uri, '?'));

    return $requestPath;
  }

  // Hilangkan / diakhir path jika ada
  // e.g. /todo/ menjadi /todo
  private function stripSlashInTheEndOfPath(string $path): string {
    if (str_ends_with($path, '/')) {
      return substr($path, 0, strlen($path)-1);
    }

    return $path;
  }
}
