<?php
  session_start();
  include('server/inc/priv.php');
  include('server/inc/conexion.php');
  include('server/inc/modal.php');


  if(permitirAcceso($_SESSION['tipoUsuario'], 'cambioContrasena') && isset($_REQUEST['email'])) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <meta name="author" content="Equipo de desarrollo FORA"/>
  <meta name="description" content="FORA. Soluciones de software eficientes e innovadores.">
  <title>Cambio de contraseña</title>

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
    </div>
  </nav>
  <div class="breadcr">
    <b><a href="moduloGestion.php">< Volver</a></b>
  </div>
  <div class="container">
    <h5 class="header col s12 light center"><i class="material-icons blue-text big">password</i><br>Cambio de contraseña</h5>
    <div class="row">
      <?php

          $email = $_REQUEST['email'];

          $sql = "SELECT * FROM `administrador` WHERE email = '$email'";

          $consulta = $conexion -> query($sql);

          if($fila = mysqli_fetch_array($consulta)) {
      ?>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <input type="hidden" name="email" value="<?php echo $_REQUEST['email'] ?>">
        <div class="col s12">
          <label for="nombre">Contraseña:</label>
          <input autofocus type="text" name="clave" id="clave" class="validate" maxlength="40" value="<?php echo $fila[1] ?>"pattern="[A-Za-z]{4-40}" required>
        </div>
        
        <div class="col s12 center">
          <p>
            <label>
              <input required type="checkbox" name="aceptar" id="aceptar"/>
              <span>Por seguridad se cerrará la sesión para que ingreses con tu nueva contraseña</span>
            </label>
            <br><br>
            <button type="submit" name="cambiar" class="btn waves-effect waves-light blue lighten-1">Cambiar</button>
            <a href="moduloGestion.php" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
          </p>
        </div>
        
      </form>

      <?php
      if(isset($_POST['cambiar'])) {

        $clave = $_POST['clave'];
        $email = $_POST['email'];

        $sql = "UPDATE `administrador` SET `clave`='$clave' WHERE email = '$email'";

        $consulta = $conexion -> query($sql);

        if($consulta > 0) {
          toast("Se realizó el cambio, cerrando sesión...");
          echo "
          <script>
          setTimeout(function(){
            window.location.href = 'cierreSesion.php';
          }, 2000);
          </script>
          ";
        } else {
          echo "Error al realizar el proceso. <a href='moduloGestion.php'>VOLVER</a>";
        }
      }
      ?>
      <?php
          } //Cierre del ciclo
      ?>
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
