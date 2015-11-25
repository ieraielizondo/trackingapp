<!DOCTYPE html>
<html lang="es">
<head>
  <title>Inicio trackingapp</title>
  <link rel="stylesheet" type="text/css" href="./Vista/css/estilos.css">
  <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0,minimum-scale=1.0">
  <script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="./js/bootstrap.min.js"></script>
  <script type="text/javascript" src="./js/angular.min.js"></script>
  
</head>
<body>    
  <nav id="cabecera" class="navbar navbar-default">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a id="titulo" href="#">
          <span class="site-name">TrackingApp</span>
          <span class="site-desc">Web de tracking.</span>
        </a>
      </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <!--<li><audio src="./Vista/audio.mp3" preload="auto" controls autoplay></audio></li>-->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['nombre']." ".$_SESSION['apellido'] ?><span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#"><span class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span> Perfil</a></li>
                <li><a href="#"><span class="pull-right hidden-xs showopacity glyphicon glyphicon-off"></span> Cerrar sesi&oacute;n</a></li>                  
              </ul>
            </li>     
            </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
  </nav>
  <div id="cont-fluid" class="container-fluid">
    <div id="panel-izda" class="panel-izda">
      <p>papa</p>
    </div>
    <div id="mapa" class="mapa">
    </div>
  </div>

  <script type="text/javascript" src="./Vista/js/maps.js"></script>
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPdLysu0hRqWIOnzLhQXua1POAn7dEFd0&callback=initMap">
  </script>

</body>
</html>
