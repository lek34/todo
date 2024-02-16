<?php
namespace Uph22si1Web\Todo\Controllers;

session_start();
session_destroy();
header("location:../index.php"); //sekarang masih di home blm ada login
?>