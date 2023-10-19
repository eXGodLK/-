<?php

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "users");



$con = mysqli_connect(DB_SERVER,DB_USER, DB_PASS) or die(mysqli_error());
mysqli_select_db($con, 'users') or die("Cannot select DB");

?>