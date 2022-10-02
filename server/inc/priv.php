<?php

function permitirAcceso($tipo, $acceso) {

  include('conexion.php');

  $sql = "SELECT * FROM `privilegio` WHERE `tipoUsuario` = '$tipo' AND `acceso` = '$acceso'";

  $resultado = $conexion -> query($sql);

  if($resultado -> num_rows > 0) {
    return true;
  }
  else {
    return false;
  }
}

?>