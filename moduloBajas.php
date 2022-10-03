<?php
  session_start();
  include('server/inc/priv.php');
  include('server/inc/conexion.php');


  if(permitirAcceso($_SESSION['tipoUsuario'], 'moduloBajas')) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <meta name="author" content="Equipo de desarrollo FORA"/>
  <meta name="description" content="FORA. Soluciones de software eficientes e innovadores.">
  <title>Suscriptores dados de baja</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <!-- SECCIÓN DE NAVEGACIÓN -->

  <nav class="white" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="#" class="brand-logo"><img src="img/logo_fora.png" alt="Logo fora" class="nav-img"></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="moduloAdmin.php" class="blue-text">Ver suscriptores activos</a></li>
        <li><a href="moduloGestion.php" class="blue-text">Gestionar administradores</a></li>
        <li><a href="cierreSesion.php" class="btn waves-effect waves-light blue lighten-1">Cerrar sesión</a></li>
      </ul>

      <ul id="nav-mobile" class="sidenav">
        <li><a href="moduloAdmin.php">Ver suscriptores activos</a></li>
        <li><a href="moduloGestion.php">Gestionar administradores</a></li>
        <li><a href="cierreSesion.php" class="btn waves-effect waves-light blue lighten-1">Cerrar sesión</a></li>
      </ul>
      <a href="#" data-target="nav-mobile" class="sidenav-trigger blue-text"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  <div class="breadcr">
    <b><a href="moduloAdmin.php">< Volver</a></b>
  </div>
  

  <!-- SECCIÓN PRINCIPAL -->

  <div class="container">
    
       <h5 class="header col s12 light center"><i class="material-icons blue-text big">trending_down</i><br>Suscriptores dados de baja</h5>
      <p class="center">
        <?php
        $count = mysqli_query($conexion, "SELECT * FROM `baja`");

        if (mysqli_num_rows($count) == 1) {
          echo mysqli_num_rows($count) . " suscriptor registrado";
        }
        else if (mysqli_num_rows($count) == 0) {
          echo "Sin registro de bajas";
        }
        else {
          echo mysqli_num_rows($count) . " suscriptores registrados";
        }
      ?>
      </p>

       <div class="row">
         <div class="col s12 m12">
            <ul class="collection">
              <?php

              $cuenta = 0;

              $sql = "SELECT * FROM `baja`";

              $consulta = $conexion -> query($sql);

              while($fila = mysqli_fetch_array($consulta)) {

                $cuenta++;

                echo "
                <li class='collection-item avatar'>
                <i class='material-icons circle light-blue darken-4'>person_remove</i>
                <span class='title blue-text'>".$cuenta.". ".$fila[1]."</span>
                <p>Motivo: ".$fila[2]."</p>
                <p>Fecha de baja: ".$fila[3]."
                </p>
                <div class='btArea'>
                   <a class='modal-trigger blue-text' href='methods.php?id=".$fila[0]."&opt=2'>Borrar registro</a>
                </div>
                </li>
                ";

              }
              ?>
            </ul>
         </div>
       </div>
    
  </div>


<!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script>
    M.AutoInit();
  </script>
</body>
</html>
<?php
  }

  else {
    header('Location: admin.php');
  }
?>