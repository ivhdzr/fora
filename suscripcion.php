<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <meta name="author" content="Equipo de desarrollo FORA"/>
  <meta name="description" content="FORA. Soluciones de software eficientes e innovadores.">
  <title>Suscripción al boletín</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  </head>
<body>
  <nav class="white" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="index.html" class="brand-logo"><img src="img/logo_fora.png" alt="Logo fora" class="nav-img"></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="index.html#conocenos" class="blue-text">Conócenos</a></li>
        <li><a href="index.html#productos" class="blue-text">Productos</a></li>
        <li><a href="index.html#contactanos" class="blue-text">Contáctanos</a></li>
      </ul>

      <ul id="nav-mobile" class="sidenav">
        <li><a href="index.html#conocenos">Conócenos</a></li>
        <li><a href="index.html#productos">Productos</a></li>
        <li><a href="index.html#contactanos">Contáctanos</a></li>
      </ul>
      <a href="#" data-target="nav-mobile" class="sidenav-trigger blue-text"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  <div class="breadcr">
    <a href="/fora">Inicio</a> / <a href="#" class="under-text">Suscripción al boletín</a>
  </div>
  
    <div class="container">
    <div class="row">
      <h4 class="header center">Suscripción al boletín</h4>
      <p class="center">
        Entérate primero de las novedades, recompensas y noticias que Fora tiene preparado para ti. ¡Es gratis!
      </p>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <div class="col s6">
          <label for="nombre">Nombre:</label>
          <input autofocus type="text" name="nombre" id="nombre" class="validate" maxlength="40" pattern="[A-Za-z]{4-40}" required>
        </div>
        <div class="col s6">
          <label for="apellidos">Apellidos:</label>
          <input type="text" name="apellidos" id="apellidos" class="validate" maxlength="40" pattern="[A-Za-z]{4-40}" required>
        </div>
        <div class="col s12">
          <label for="email">Correo electrónico:</label>
          <input type="email" name="email" id="email" class="validate" maxlength="40" pattern="[A-Za-z]{4-40}" required>
        </div>
        <div class="col s12 center">
          <p>
            <label>
              <input required type="checkbox" name="aceptar" id="aceptar"/>
              <span>He leído y comprendido los <a href="#" class="blue-text">términos y condiciones</a> que están descritos de forma explícita en <a href="#" class="blue-text">este enlace</a></span>
            </label>
            <br><br>
            <button type="submit" name="suscribirme" class="btn waves-effect waves-light blue lighten-1">Suscribirme</button>
            <p><a href="bajaSuscripcion.php" class="red-text">DAR DE BAJA MI SUSCRIPCIÓN</a></p>
          </p>
        </div>
      
      </form>
     
      <?php
          if(isset($_POST['suscribirme'])) {

            include('server/inc/conexion.php');
            include('server/inc/modal.php');

            $nombre = htmlspecialchars($_POST['nombre']);
            $apellidos = htmlspecialchars($_POST['apellidos']);
            $email = htmlspecialchars($_POST['email']);

            // Seguridad nivel esencial
            $verificarCorreo = mysqli_query($conexion, "SELECT * FROM suscriptor WHERE email = '$email' ");
            if (mysqli_num_rows($verificarCorreo) > 0) {
              toast("El correo que ingresaste ya está registrado");
              die();
            }

            $sql = "INSERT INTO `suscriptor`(`email`, `nombre`, `apellidos`, `fecha_registro`) VALUES ('$email','$nombre','$apellidos',NOW())";

            $consulta = mysqli_query($conexion, $sql);

            if($consulta > 0) {
              modal("¡Te suscribiste a nuestro boletín!", "Recibirás en tu correo electrónico las novedades, recompensas y noticias que Fora tiene preparado para ti.", "CERRAR", "/fora");
            } else {
               modal("Algo salió mal", "No hemos podido registrarte", "CERRAR", "/fora");
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
