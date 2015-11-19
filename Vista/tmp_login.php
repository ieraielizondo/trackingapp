<!DOCTYPE html>
<html lang="es">
<head>
	<title>Inicio trackingapp</title>
	<link rel="stylesheet" type="text/css" href="./Vista/css/estilos.css">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0,minimum-scale=1.0">
	<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="./js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function () {
			$('#Registro').hide();
			var oculto=1;

			$('#lbMostrar').click(function(){
				$('#Registro').slideToggle("slow");
				if(oculto==0)
				{
					oculto=1;
					$('#lbMostrar').text("Mostrar/ Ocultar ↓");
				}
				else
				{
					oculto=0;
					$('#lbMostrar').text("Mostrar/ Ocultar ↑");
				}
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
				<li><audio src="./Vista/audio.mp3" preload="auto" controls autoplay></audio></li>				
				<li><a href="#">Inicio</a></li>
				<li><a href="#">Posiciones</a></li>
				<li><a href="#">LogOut</a></li>
			</ul>
		</nav>
	</header>

	<main>
		<section>
			<div id="container">
			<?php if(isset($flash['message'])):?>
							<div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<strong>Atenci&oacute;n!</strong> <?php echo $flash['message']?>
							</div>
						<?php endif; ?>
				<div id="formularios">
					<div class="login">						
						<h2 style="margin-top:0px;">Iniciar sesion</h2>
						<form action="login" method="post">
							<table>
								<tr>
									<td><label>Id usuario</label></td>
									<td><input class="form-control" id="txtLogIdUsuario" type="text" name="idUsuario" required/></td>
								</tr>
								<tr>
									<td><label>Contrasena</label></td>
									<td><input class="form-control" id="txtLogPasss" type="password" name="pass" required/></td>
								</tr>
								<tr>
									<td><button class="btn btn-primary" type="submit">Iniciar sesion</button></td>
								</tr>
							</table>						
						</form>					
					</div><!--div Login-->
					<label style="font-size:12px" id="lbMostrar">Mostrar/ Ocultar ↓</label>
					<hr>
					<div id="Registro" class="Registro">
						<h2>Registro</h2>
						<form action="registro" method="post">
							<table>
								<tr>
									<td><label>Id usuario</label></td>
									<td><input class="form-control" id="txtRegIdUsuario" type="text" name="idUsuario" required/></td>
								</tr>
								<tr>
									<td><label>Contrasena</label></td>
									<td><input class="form-control" id="txtRegPass" type="password" name="pass" required/></td>
								</tr>
								<tr>
									<td><label>Repite contrasena</label></td>
									<td><input class="form-control" id="txtRegPass2" type="password" name="validpass" required/></td>
								</tr>
								<tr>
									<td><label>Nombre</label></td>
									<td><input class="form-control" id="txtRegNombre" type="text" name="nombre" required/></td>
								</tr>
								<tr>
									<td><label>Apellido1</label></td>
									<td><input class="form-control" id="txtRegApe1" type="text" name="ape1" required/></td>
								</tr>
								<tr>
									<td><label>Apellido2</label></td>
									<td><input class="form-control" id="txtRegApe2" type="text" name="ape2"/></td>
								</tr>
								<tr>
									<td><label>Email</label></td>
									<td><input class="form-control" id="" type="email" name="email" required/></td>
								</tr>
								<tr>
									<td><button class="btn btn-primary" type="submit">Registrarme</button></td>
								</tr>
							</table>							
						</form>				
					</div>	<!--div Registro-->			
				</div><!--div Formularios-->
			</div> <!--	div Container-->		
		</section>
	</main>


				
</body>
</html>