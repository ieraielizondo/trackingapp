<!DOCTYPE html>
<html lang="es">
<head>
	<title>Test Slim</title>
	<link rel="stylesheet" type="text/css" href="../../Vista/css/estilos.css">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0,minimum-scale=1.0">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.js"></script>
	<script>
		$(document).ready(function () {
			$('.Registro').hide();

			$('#lbMostrar').click(function(){
				$('.Registro').slideToggle("slow");
			});
		});
	</script>
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

	<main>
		<section>
		<header>
			<h2>Usuarios</h2>
		</header>
		<div class="login">
			<form action="index.php/login" method="post">
				<table>
					<tr>
						<td><label>Id usuario</label></td>
						<td><input type="text" name="idUsuario"/></td>
					</tr>
					<tr>
						<td><label>Contrasena</label></td>
						<td><input type="password" name="pass"/></td>
					</tr>
				</table>
				<button type="submit">Iniciar sesion</button>
			</form>
			
		</div>
		<label style="font-size:12px" id="lbMostrar">Mostrar/ Ocultar</label>
		<hr>
		<div class="Registro">
			<form action="index.php/registro" method="post">
				<table>
					<tr>
						<td><label>Id usuario</label></td>
						<td><input type="text" name="idUsuario"/></td>
					</tr>
					<tr>
						<td><label>Contrasena</label></td>
						<td><input type="password" name="pass"/></td>
					</tr>
				</table>
				<button type="submit">Iniciar sesion</button>
			</form>
			
		</div>


			
	</section>


	</main>


				
</body>
</html>