<?php

namespace Uph22si1Web\Todo\Controllers;

use Uph22si1Web\Todo\Request;
use Uph22si1Web\Todo\View;

// HelloController mengimplementasikan BaseController
class HelloController implements BaseController {
  public function handle(Request $request): void {
    // kita mengakses informasi data yang kirim oleh user
    // melalui object request
    $name = $request->input('name') ?? 'World';

    // render output menggunakan template/view
    View::render('hello', [
      'title' => 'Todo Hello View Example',
      'name' => $name,
      'xss' => '<script>alert("hello");</script>', // XSS: inject script Javascript di HTML untuk dieksekusi oleh browser
    ]);
  }
}
