
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
	<div class="container-fluid">
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
				<li><a href="logout"><span class="pull-right hidden-xs showopacity glyphicon glyphicon-off"></span> Cerrar sesi&oacute;n</a></li>                  
				</ul>
			</li>     
			</ul>
		</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>

	<div id="cont-fluid" class="row">
		<div id="panel-izda" class="col-xs-12 col-md-3">
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingOne">
							<h4 class="panel-title">
								<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								Agregar punto
								</a>
							</h4>
					 	</div>
						<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">
								<form id="formNuevo">
									<div class="form-group">
										<label for="txtTitulo">Titulo</label>
										<input type="text" class="form-control" id="txtTitulo" name="titulo" placeholder="Título">
									</div>
									<div class="form-group">
										<label for="inputLat">Latitud</label>
										<input type="text" class="form-control" id="inputLat" name="lat" readonly placeholder="Latitud">
									</div>
									<div class="form-group">
										<label for="inputLong">Longitud</label>
										<input type="text" class="form-control" id="inputLong" name="long" readonly placeholder="Longitud">
										<span id="lblEstado" class="label"></span>
									</div>							
									<button id="btnGuardar" type="button" class="btn btn-success">Guardar</button>
								</form>
							</div>
						</div>
					</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingTwo">
						<h4 class="panel-title">
							<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								Buscar por fecha
							</a>
						</h4>
					</div>
					<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
						<div class="panel-body">
							Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingThree">
						<h4 class="panel-title">
							<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
								Collapsible Group Item #3
							</a>
						</h4>
					</div>
					<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
						<div class="panel-body">
							Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="mapa" class="col-xs-12 col-md-9">
		</div>
	</div>
	<div class="navbar navbar-default navbar-fixed-bottom">
		<div class="container">
			<p class="navbar-text pull-left">Created by <strong>Ierai Elizondo</strong></p>
			<a href="https://github.com/ieraielizondo">
				<button class="navbar-btn btn btn-primary">
					<img id="logobt" src="img/GH_bt.png">See GitHub profile
				</button>
			</a>
		</div>		
	</div>

	<script type="text/javascript" src="./Vista/js/maps.js"></script>
	<script async defer
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPdLysu0hRqWIOnzLhQXua1POAn7dEFd0&callback=initMap">
	</script>

</body>
</html>
