<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <meta name="author" content="Equipo de desarrollo FORA"/>
  <meta name="description" content="FORA. Soluciones de software eficientes e innovadores.">
  <title>Administración</title>

<!--CSS -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <nav class="white" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="index.html" class="brand-logo"><img src="img/logo_fora.png" alt="Logo fora" class="nav-img"></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="index.html#conocenos" class="blue-text">Página principal</a></li>
      </ul>  

      <ul id="nav-mobile" class="sidenav">
        <li><a href="index.html">Página principal</a></li>
      </ul>
      <a href="#" data-target="nav-mobile" class="sidenav-trigger blue-text"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  <div class="breadcr">
    <b>Módulo de administración</b>
  </div>

  <div class="container">
    <div class="row">
      <h5 class="header col s12 light center"><i class="material-icons blue-text big">admin_panel_settings</i><br>Te damos la bienvenida</h5>
      <p class="center">
        Para acceder al módulo de administración, debes inciar sesión
      </p>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <div class="col s12">
          <label for="email">Correo electrónico:</label>
          <input autofocus type="email" name="email" id="email" class="validate" maxlength="40" pattern="[A-Za-z]{4-40}" required>
        </div>
        <div class="col s12">
          <label for="clave">Contraseña:</label>
          <input type="password" name="clave" id="clave" class="validate" maxlength="40" pattern="{8-40}" required>
        </div>
        <div class="col s12 center">
          <p>
            <button type="submit" name="entrar" class="btn waves-effect waves-light blue lighten-1">Iniciar sesión</button>
          </p>
        </div>
        
      </form>
     
      <?php
          if(isset($_POST['entrar'])) {

            include('server/inc/conexion.php');
            include('server/inc/modal.php');

            $email = htmlspecialchars($_POST['email']);
            $clave = htmlspecialchars($_POST['clave']);

            $sql = "SELECT * FROM administrador WHERE email = '$email' AND clave = '$clave' ";

            $consulta = $conexion -> query($sql);

            if($resultado = mysqli_fetch_array($consulta)) {
              session_start();
              $_SESSION['tipoUsuario'] = $resultado[5];
              $_SESSION['email'] = $resultado[0];
              header('Location: moduloAdmin.php');
            } else {
              modal("No se pudo iniciar sesión", "Verifica el correo y/o la contraseña", "CERRAR", "#");
            }


          }
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