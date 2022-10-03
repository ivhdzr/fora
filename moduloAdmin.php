<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <meta name="author" content="Equipo de desarrollo FORA"/>
  <meta name="description" content="FORA. Soluciones de software eficientes e innovadores.">
    <title>DModulo de administración</title>

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
        <li><a href="moduloBajas.php" class="blue-text">Ver bajas de suscriptores</a></li>
        <li><a href="moduloGestion.php" class="blue-text">Gestionar administradores</a></li>
        <li><a href="cierreSesion.php" class="btn waves-effect waves-light blue lighten-1">Cerrar sesión</a></li>
      </ul>

      <ul id="nav-mobile" class="sidenav">
        <li><a href="moduloBajas.php">Ver bajas de suscriptores</a></li>
        <li><a href="moduloGestion.php">Gestionar administradores</a></li>
        <li><a href="cierreSesion.php" class="btn waves-effect waves-light blue lighten-1">Cerrar sesión</a></li>
      </ul>
      <a href="#" data-target="nav-mobile" class="sidenav-trigger blue-text"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  <div class="breadcr">
    <b>Módulo de administración</b>
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