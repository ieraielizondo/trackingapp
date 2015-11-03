<!DOCTYPE html>
<html lang="es">
<head>
	<title>Usuarios</title>
	<link rel="stylesheet" type="text/css" href="http://localhost/workspace/Servidor/PHP/trackingapp/Vista/css/estilos.css">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0,minimum-scale=1.0">
	<style type="text/css">
		table, th, tr, td {
			border: 1px solid black;
			border-collapse: collapse;		}
	</style>
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
			<h2>Todos los usuarios</h2>
		</header>
		<div class="contenido">
			<?php
				echo '<table>';
				echo '<tr>';
					echo '<th> Id usuario</th>';
					echo '<th> Nombre</th>';
					echo '<th> Apellido1</th>';
					echo '<th> Apellido2</th>';
				echo '</tr>';
				foreach ($usuarios as $fila ) {
					echo '<tr>';
						echo '<td> '.$fila['id_usuario'].'</td>';
						echo '<td>'.$fila['nombre'].'</td>';
						echo '<td> '.$fila['ape1'].'</td>';
						echo '<td> '.$fila['ape2'].'</td>';
					echo '</tr>';					
				}
				echo '</table>'
			?>
			
		</div> 
	</section>			
</body>
</html>