<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <meta name="author" content="Equipo de desarrollo FORA"/>
  <meta name="description" content="FORA. Soluciones de software eficientes e innovadores.">
  <title>Dar de baja mi suscripción al boletín</title>

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
    <a href="/fora">Inicio</a> / <a href="suscripcion.php">Suscripción al boletín</a> / <a href="#" class="under-text">Dar de baja</a>
  </div>

  <div class="container">
    <div class="row">
      <h4 class="header center">Dar de baja la suscripción al boletín</h4>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <div class="col s12 center">
         ¿Por qué quieres dar de baja tu suscripción?
          <p>
            <ul class="collection">
              <li class="collection-item">
                <label>
                  <input required class="with-gap" name="motivo" value="No solicité la inscripción" type="radio"  />
                  <span>No solicité la suscripción</span>
                </label>
              </li>
              <li class="collection-item">
                <label>
                  <input required class="with-gap" name="motivo" value="No me interesa la información" type="radio"  />
                  <span>No me interesa la información</span>
                </label>
              </li>
            </ul>
          
          </p>
        </div>
      
      <div class="col s12">
          <label for="nombre">Correo electrónico:</label>
          <input autofocus type="email" name="email" id="email" class="validate" maxlength="40" pattern="[A-Za-z]{4-40}" required>
        </div>
        <div class="col s12 center">
          <p>
            <button type="submit" name="dardebaja" class="btn waves-effect waves-light blue lighten-1">Darme de baja</button>
          </p>
        </div>
        
      </form>
    
    <?php
          if(isset($_POST['dardebaja'])) {

            include('server/inc/conexion.php');
            include('server/inc/modal.php');

            $motivo = htmlspecialchars($_POST['motivo']);
            $email = htmlspecialchars($_POST['email']);

            // Seguridad nivel esencial
            $verificarCorreo = mysqli_query($conexion, "SELECT * FROM suscriptor WHERE email = '$email' ");
            if (mysqli_num_rows($verificarCorreo) > 0) {

              $sql = "CALL dardebaja('$motivo', '$email', @res)";

              $consulta = mysqli_query($conexion, $sql);

              if($consulta > 0) {
                modal("Te diste de baja", "Ya no recibirás novedades en tu correo electrónico", "CERRAR", "/fora");
              } else {
               modal("Algo salió mal", "No hemos podido darte de baja", "CERRAR", "/fora");
             }
              
            } else {
              toast("El correo que ingresaste no está registrado");
              die();
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
