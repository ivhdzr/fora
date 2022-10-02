<?php

  $dir = "localhost";
  $user = "root";
  $password = "";
  $dbname = "fora";

  $conexion = new mysqli($dir, $user, $password, $dbname);

  if ($conexion->connect_errno) {
    echo "Falló al conectar a MYSQL: (" .$conexion->connect_errno. ") " . $conexion->connect_error;
  }
  
?>