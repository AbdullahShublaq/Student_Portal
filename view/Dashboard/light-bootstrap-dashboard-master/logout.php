<?php
 /* Created by PhpStorm.
 * User: Abdullah Shublaq
 * Date: 12/05/2019
 * Time: 07:40 م
 */

session_start();

setcookie("id", $_SESSION["id"], time() - 1, "/");

session_unset();
session_destroy();

header("Location: http://localhost:63342/Student_Portal/view/Login");


 ?>