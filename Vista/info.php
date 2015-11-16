<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro correcto</title>
	<link rel="stylesheet" type="text/css" href="Vista/css/estilos.css">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0,minimum-scale=1.0">
	</head>
<body>
	<header id="main-header">
		<a id="titulo" href="#">
			<span class="site-name">TrackingApp</span>
			<span class="site-desc">Web de tracking.</span>
		</a>
		<nav>
			<ul>
				<li><a href="./">Inicio</a></li>
				<li><a href="#">Posiciones</a></li>				
			</ul>
		</nav>
	</header>

	<main>
		<h2><?php echo $mensaje ?></h2>
		<p><a href="./">Ir a inicio</a></p>
	</main>
</body>
</html>