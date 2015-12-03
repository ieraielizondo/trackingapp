<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro correcto</title>
	<link rel="stylesheet" type="text/css" href="../Vista/css/estilos.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0,minimum-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html"; charset="utf-8"/>
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
      			</ul>
    		</div><!-- /.navbar-collapse -->
  		</div><!-- /.container-fluid -->
	</nav>

	<main>
		<h2><?php echo $mensaje ?></h2>
		<p><a href="../">Ir a inicio</a></p>
	</main>
</body>
</html>