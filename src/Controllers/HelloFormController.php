<?php

namespace Uph22si1Web\Todo\Controllers;

use Uph22si1Web\Todo\Request;
use Uph22si1Web\Todo\View;

class HelloFormController implements BaseController {
  public function handle(Request $request) {
    $name = '';
    View::render('hello-form', ['name' => $name]);
  }
}
