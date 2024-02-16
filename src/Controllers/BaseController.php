<?php

namespace Uph22si1Web\Todo\Controllers;

use Uph22si1Web\Todo\Request;

// interface mendeklarasi kontrak terhadap method yang harus diimplementasikan
// pada class
// BaseController->handler akan menamppung implementasi logic yang
// menghandle request yang datang dari user dan mengirimkan kembali
// response
interface BaseController {
    /**
     * @return void
     * @param mixed $request
     */
    function handle(Request $request);
}
