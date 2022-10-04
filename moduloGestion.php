<?php
  session_start();
  include('server/inc/priv.php');
  include('server/inc/conexion.php');


  if(permitirAcceso($_SESSION['tipoUsuario'], 'moduloGestion')) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <meta name="author" content="Equipo de desarrollo FORA"/>
  <meta name="description" content="FORA. Soluciones de software eficientes e innovadores.">
  <title>Administradores</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <!-- SECCIÓN DE NAVEGACIÓN -->

  <nav class="white" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="moduloAdmin.php" class="brand-logo"><img src="img/logo_fora.png" alt="Logo fora" class="nav-img"></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="moduloBajas.php" class="blue-text">Ver bajas de suscriptores</a></li>
        <li><a href="moduloAdmin.php" class="blue-text">Ver suscriptores activos</a></li>
        <li><a href="cierreSesion.php" class="btn waves-effect waves-light blue lighten-1">Cerrar sesión</a></li>
      </ul>

      <ul id="nav-mobile" class="sidenav">
        <li><a href="moduloBajas.php">Ver bajas de suscriptores</a></li>
        <li><a href="moduloAdmin.php">Ver suscriptores activos</a></li>
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
    
       <h5 class="header col s12 light center"><i class="material-icons blue-text big">admin_panel_settings</i><br>Administradores</h5>
      <p class="center">
        <?php
        $count = mysqli_query($conexion, "SELECT * FROM `administrador`");

        if (mysqli_num_rows($count) == 1) {
          echo mysqli_num_rows($count) . " administrador registrado";
        }
        else if (mysqli_num_rows($count) == 0) {
          echo "Sin suscriptores";
        }
        else {
          echo mysqli_num_rows($count) . " administradores registrados";
        }
      ?>
      <div class="right">
        <a class="modal-trigger btn waves-effect waves-light blue lighten-1" href="#agregar">Agregar</a>

        <div id="agregar" class="modal">
          <div class="modal-content" style="text-align: left">
            <h5>Agregar administrador</h5>
            <br>
            <div class="row">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
              <div class="col s6">
                <label for="nombre">Nombre:</label>
                <input autofocus type="text" name="nombre" id="nombre" class="validate" maxlength="40" pattern="[A-Za-z]{4-40}" required>
              </div>
              <div class="col s6">
                <label for="apellidos">Apellidos:</label>
                <input type="text" name="apellidos" id="apellidos" class="validate" maxlength="40" pattern="[A-Za-z]{4-40}" required>
              </div>
               <div class="col s6">
                <label for="genero">Género:</label>
                <select name="genero" id="genero" class="validate" required>
                  <option selected disabled>Seleccionar</option>
                  <option value="Hombre">Hombre</option>
                  <option value="Mujer">Mujer</option>
                  <option value="Otro">Otro</option>
                </select>
              </div>
               <div class="col s6">
                <label for="email">Correo:</label>
                <input autofocus type="email" name="email" id="email" class="validate" maxlength="40" pattern="[A-Za-z]{4-40}" required>
              </div>
              <div class="col s6">
                <label for="clave">Contraseña:</label>
                <input type="text" name="clave" id="clave" class="validate" maxlength="40" pattern="{8-40}" required>
              </div>
              <div class="col s12 center">
                <p>El administrador agregado deberá acceder para cambiar su contraseña</p>
                  <button type="submit" name="agregar" class="btn waves-effect waves-light blue lighten-1">Agregar</button>
                  <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
              </div>

            </form>
            <?php
            if(isset($_POST['agregar'])) {

              include('server/inc/modal.php');

              $nombre = htmlspecialchars($_POST['nombre']);
              $apellidos = htmlspecialchars($_POST['apellidos']);
              $genero = htmlspecialchars($_POST['genero']);
              $email = htmlspecialchars($_POST['email']);
              $clave = htmlspecialchars($_POST['clave']);

            // Seguridad nivel esencial
              $verificarCorreo = mysqli_query($conexion, "SELECT * FROM administrador WHERE email = '$email' ");
              if (mysqli_num_rows($verificarCorreo) > 0) {
                echo "
                  <script>
                    window.location.href = 'moduloGestion.php';
                  </script>
                ";
                die();
              }

              $sql = "INSERT INTO `administrador`(`email`, `clave`, `nombre`, `apellidos`, `genero`, `acceso`) VALUES ('$email','$clave','$nombre','$apellidos','genero','Admin')";

              $consulta = mysqli_query($conexion, $sql);

              if($consulta > 0) {
                echo "
                  <script>
                    window.location.href = 'moduloGestion.php';
                  </script>
                ";
              } else {
               modal("Algo salió mal", "No hemos podido registrarte", "CERRAR", "index.php");
             }

           }
           ?>
          </div>

          </div>
          
        </div>
      </div>

      </p>

       <div class="row">
         <div class="col s12 m12">
            <ul class="collection">
              <?php

              $cuenta = 0;

              $sql = "SELECT * FROM `administrador`";

              $consulta = $conexion -> query($sql);

              while($fila = mysqli_fetch_array($consulta)) {

                $cuenta++;

                echo "
                <li class='collection-item avatar'>
                <i class='material-icons circle light-blue darken-4'>person</i>
                <span class='title'>".$cuenta.". ".$fila[2]." ".$fila[3]."</span>
                <p class='blue-text'>".$fila[0]."</p>
                <p>Contraseña: ".$fila[1]."
                </p>
                <div class='btArea'>
                ";

                if($fila[0] == 'fora@admin' || $fila[0] == $_SESSION['email']) {
                  echo "
                   (Administrador base)<br><a class='modal-trigger blue-text' href='cambioContrasena.php?email=".$fila[0]."'>Cambiar contraseña</a>
                  ";
                } else {
                  echo "
                  <a class='modal-trigger blue-text' href='#modal".$cuenta."'>Borrar administrador</a>
          
                  <div id='modal".$cuenta."' class='modal'>
                    <div class='modal-content' style='text-align: left'>
                      <h5>¿Borrar al administrador ".$fila[2]."?</h5>
                      <p>Esta acción no se puede deshacer</p>
                    </div>
                    <div class='modal-footer'>
                      <a href='#!'' class='modal-close waves-effect waves-green btn-flat'>Cancelar</a>
                      <a href='methods.php?email=".$fila[0]."&opt=3' class='modal-close waves-effect waves-green btn-flat red-text'>Borrar</a>
                    </div>
                  </div>
                  ";
                }

                echo "
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