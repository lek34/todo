<?php

namespace Uph22si1Web\Todo\Controllers;

use PDO;

use Uph22si1Web\Todo\Request;
use Uph22si1Web\Todo\View;
use Uph22si1Web\Todo\Model\dbc;

class HomeController implements BaseController {
  public function handle(Request $request): void {
    // $db = new dbc();
    // $pdo = $db->getConn();
    // $q = $pdo->query("select * from todos");

    // $data_from_database = [];

    // while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
    //     $data_from_database[] = $row;
    // }

    View::render('home', [
        'title' => 'Todo List'
    ]);
  }
}
?>