<?php

// deklarasi namespace file harus disimpan di src/Server.php
// karena namespace Uph22si1Web\Todo disimpan pada directory src
// (baca di composer.json)
namespace Uph22si1Web\Todo;

// import menggunakan namespace
use Throwable;
use Uph22si1Web\Todo\Controllers\BaseController;
use Uph22si1Web\Todo\Exceptions\NotFoundException;
use Uph22si1Web\Todo\Exceptions\PageExpiredException;

// definisi class
class Server
{
  // property private
  private Router $router;

  // constructor
  function __construct(Router $router)
  {
    $this->router = $router;

    // register exception handler untuk menangani exception yang belum dihandle
    // tujuannya supaya aplikasi web memiliki default handler apabila ada code
    // yang lupa menghandle exception yang terjadi
    set_exception_handler(function(Throwable $exception) {
      // handle exception apabila resource yang direquest tidak ditemukan
      // kita dapat memanfaatkan sistem exception PHP untuk menghandle situasi khusus
      // seperti 404 not found, handler/controller cukup meng-throw exception NotFoundException
      if ($exception instanceof NotFoundException) {
        http_response_code(404);
        echo "Not Found";
        return;
      }

      if ($exception instanceof PageExpiredException) {
        http_response_code(419);
        echo "Page Expired";
        return;
      }

      // default handler exception handler
      error_log("Unhandled Exception: {$exception->getMessage()}\n{$exception->getTraceAsString()}");
      http_response_code(500);
      echo "Internal Server Error";
    });
  }

  // serving http request
  // method ini membaca data request, dan mengirimkan request ke handler
  // yang terdaftar di router
  function serve(): void
  {
    $uri = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];
    $request = new Request($uri, $method, $_REQUEST, $_GET, $_COOKIE);

    $this->validate_csrf_token($request);

    // cari handler/controller untuk path yang di-request
    $handler = $this->router->getHandlerFor($request);
    if ($handler) {
      // handler ditemukan, karena handler adalah sebuah callable, kita
      // dapat memanggil variable $handler seperti memanggil fungsi
      if ($handler instanceof BaseController) {
        $handler->handle($request);
      } else {
        $handler($request);
      }
      return;
    }

    // jika handler tidak ditemukan throw exception not found
    throw new NotFoundException();
  }

  private function validate_csrf_token(Request $request): void {
    if ($request->getMethod() != 'POST') {
      return;
    }

    $token = $request->input('csrf_token');
    if (is_null($token)) {
      throw new PageExpiredException;
    }

    if ($token !== $_SESSION['CSRF_TOKEN']) {
      throw new PageExpiredException;
    }
  }
}
