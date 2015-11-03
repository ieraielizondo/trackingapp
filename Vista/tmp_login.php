<!DOCTYPE html>
<html lang="es">
<head>
	<title>Test Slim</title>
	<link rel="stylesheet" type="text/css" href="http://localhost/workspace/Servidor/PHP/trackingapp/Vista/css/estilos.css">
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
				<li><a href="#">Inicio</a></li>
				<li><a href="#">Posiciones</a></li>
				<li><a href="#">LogOut</a></li>
			</ul>
		</nav>
	</header>


	<section>
		<header>
			<h2>Usuarios</h2>
		</header>
		<div class="contenido">
			<?php
				echo '<pre>';
				print_r($usuarios);
			?>
			
		</div>
			
	</section>			
</body>
</html>