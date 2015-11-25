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
					$('#lbMostrar').text("Mostrar/ Ocultar registro ↓");
				}
				else
				{
					oculto=0;
					$('#lbMostrar').text("Mostrar/ Ocultar registro ↑");
				}
			});
		});
	</script>
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
					<form class="form-horizontal" action="login" method="post">		
						<div class="form-group">
							<label for="txtLogIdUsuario" class="col-sm-3 control-label">Id usuario</label>
							<div class="col-sm-9">
								<input class="form-control" id="txtLogIdUsuario" type="text" name="idUsuario" placeholder="Id usuario" required>
							</div>
						</div>
						<div class="form-group">
							<label for="txtLogPass" class="col-sm-3 control-label">Contrase&ntilde;a</label>
							<div class="col-sm-9">
								<input class="form-control" id="txtLogPass" type="password" name="pass" placeholder="Introduce contraseña" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-0 col-sm-10">
								<div class="checkbox">
									<label>
										<input type="checkbox"> Recuérdame
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-2 col-sm-10">
								<button class="btn btn-primary" type="submit">Iniciar sesion</button>
							</div>
						</div>																			
					</form>					
				</div><!--div Login-->
				<label style="font-size:12px" id="lbMostrar">Mostrar/ Ocultar <b>registro</b> ↓</label>
				<hr>
				<div id="Registro" class="Registro">
					<h2>Registro</h2>
					<form class="form-horizontal" action="registro" method="post">
						<div class="form-group">
							<label for="txtRegIdUsuario" class="col-sm-3 control-label">Nombre de usuario</label>
							<div class="col-sm-9">
								<input class="form-control" id="txtRegIdUsuario" type="text" name="idUsuario" placeholder="Introduce el nombre el usuario" required>
							</div>
						</div>
						<div class="form-group">
							<label for="txtRegPass" class="col-sm-3 control-label">Contrase&ntilde;a</label>
							<div class="col-sm-9">
								<input class="form-control" id="txtRegPass" type="password" name="pass" placeholder="Introduce contraseña" required>
							</div>
						</div>
						<div class="form-group">
							<label for="txtLogPasss" class="col-sm-3 control-label">Repite contrase&ntilde;a</label>
							<div class="col-sm-9">
								<input class="form-control" id="txtRegPass" type="password" placeholder="Introduce de nuevo la contraseña" required>
							</div>
						</div>
						<div class="form-group">
							<label for="txtRegIdUsuario" class="col-sm-3 control-label">Nombre</label>
							<div class="col-sm-9">
								<input class="form-control" id="txtRegIdUsuario" type="text" name="nombre" placeholder="Introduce el nombre" required>
							</div>
						</div>
						<div class="form-group">
							<label for="txtRegApe1" class="col-sm-3 control-label">Primer apellido</label>
							<div class="col-sm-9">
								<input class="form-control" id="txtRegApe1" type="text" name="ape1" placeholder="Introduce primer apellido" required>
							</div>
						</div>
						<div class="form-group">
							<label for="txtRegApe2" class="col-sm-3 control-label">Segundo apellido</label>
							<div class="col-sm-9">
								<input class="form-control" id="txtRegApe2" type="text" name="ape2" placeholder="Introduce segundo apellido" >
							</div>
						</div>
						<div class="form-group">
							<label for="txtRegEmail" class="col-sm-3 control-label">Email</label>
							<div class="col-sm-9">
								<input class="form-control" id="txtRegEmail" type="text" name="email" placeholder="Introduce e-mail" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-2 col-sm-10">
								<button class="btn btn-primary" type="submit">Registrarme</button>
							</div>
						</div>													
					</form>				
				</div>	<!--div Registro-->			
			</div><!--div Formularios-->
		</div> <!--	div Container-->		
	</section>
	</main>


				
</body>
</html>