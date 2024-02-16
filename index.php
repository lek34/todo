<?php
function csrf_token() {
  if (!isset($_SESSION['CSRF_TOKEN'])) {
    // https://www.php.net/manual/en/function.sha1.php
    // https://www.php.net/manual/en/function.rand.php
    $_SESSION['CSRF_TOKEN'] = sha1(rand());
  }

  return $_SESSION['CSRF_TOKEN'];
}

session_start();
csrf_token();

// Lakukan autoload  PSR-4
require __DIR__ . '/vendor/autoload.php';

// mengimport class dari namespace
// use Uph22si1Web\Todo\Controllers\HelloController;
// use Uph22si1Web\Todo\Controllers\HelloFormController;
use Uph22si1Web\Todo\Controllers\HomeController;
use Uph22si1Web\Todo\Controllers\CreateController;
// use Uph22si1Web\Todo\Controllers\DeleteController;
// use Uph22si1Web\Todo\Controllers\UpdateController;
use Uph22si1Web\Todo\Router;
use Uph22si1Web\Todo\Server;

// buat instance router baru, mount ke path '/todo'
$router = new Router('/todo');

// buat instance server baru untuk menghandle request http
// baca source-nya di src/Server.php
// inject instance $router ke server
$server = new Server($router);

// daftarkan sebuah router untuk menghandle request
// baca source-nya di src/Router.php
// parameter kedua Router::get adalah sebuah anonymous function
// (https://www.php.net/manual/en/functions.anonymous.php)
// yang akan dipanggil ketika ada request get ke `/`
//
// PHP mengdukung dua cara penulisan callable:
// 1. anonymous function/closure https://www.php.net/manual/en/functions.anonymous.php
// 2. arrow function https://www.php.net/manual/en/functions.arrow.php
// $router->get('/', function($request) {
//   echo "Hello Todo";
// });

// $router->get('/', function($request) {
//   // Ke halaman home.view.php
//   include('views/home.view.php');
// });


// contoh menggunakan controller untuk request post dan request get
// $helloController = new HelloController;
  $homeController = new HomeController;
// $router->get('/hello', $helloController);
// $router->post('/hello', $helloController);
// $router->get('/hello-form', new HelloFormController);
  $router->get('/', $homeController);
// $router->get('/home', new HomeController);
// $router->get('/create', new CreateController);
// $router->get('/update', new UpdateController);
// $router->get('/delete',new DeleteController);


// jalankan logic untuk menerima request dan memanggil handler
// yang tepat sesuai router di-atas
$server->serve();
