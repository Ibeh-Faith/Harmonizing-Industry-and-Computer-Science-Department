<?php
define('DB_NAME','sch_db');
define('DB_USER', 'root');
define('DB_PASSWORD','');
define('DB_HOST', 'localhost');

$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

if (!$con)
  {
  echo "We Are Experiencing Down Time Error";
  exit();
  }

?>

