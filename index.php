<?php


require 'vendor/autoload.php';


Slim\Slim::registerAutoloader();



$app= new \Slim\Slim();
$app->config(array(
	'debug' =>true ,
	'templates.path' =>'Vista'));

$app-> map('/',function() use ($app){
	session_start();
	if(!isset($_SESSION['idUser']))
	{
		//echo 'No hay sesion iniciada. Logueate para seguir.';
		$app->render('tmp_login.php');
	}
	else
	{
		echo 'Hola, '.$_SESSION['idUser'];
		//$app->render(/*Página de inicio con el usuario*/,array('iduser' =>$_SESSION['idUser'] ));
	}	
})->via('GET')->name('Inicio');

 $app-> get('/pruebalog',function() use ($app){
 	require_once 'Modelo/Utils.php';
 	Utils::escribeLog("pre-echo","prueba");
 		echo "probando el log";
 	Utils::escribeLog("FIn de log","prueba");
 });

 $app->get('/pruebaBootstrap',function() use ($app){
 	$app->render('usuarioRegistrado.php');
 });

$app-> post('/login',function() use ($app){
	$post=(object)$app->request()->post();
	if(isset($post->id_usuario) && isset($post->pass))
	{
		$usuario=new Usuario();
	}
});

$app->post('/registro',function() use($app){
	require_once 'Modelo/Usuario.php';
	require_once 'Modelo/Utils.php';

	Utils::escribeLog("Inicio Registro","debug");
	
	$req=$app->request();
	$id_usuario=$req->post('idUsuario');
	$pass=$req->post("pass");
	$nombre=$req->post("nombre");
	$ape1=$req->post("ape1");
	$ape2=$req->post("ape2");
	$email=$req->post("email");

	/*echo "Usuario->".$id_usuario;
	echo "<br>pass->".$pass;
	echo "<br>passMD5->".md5($pass);
	echo "<br>nombre->".$nombre;
	echo "<br>apellido1->".$ape1;
	echo "<br>apellido2->".$ape2;
	echo "<br>email->".$email;*/

	$result=Usuario::nuevoUsuario($id_usuario,$pass,$nombre,$ape1,$ape2,$email);
	//0->KO / 1->OK / 2->Existe el usuario
	if($result==0){
		//Utils::escribeLog("KO","debug");
		$mensaje= "Error al registrar el usuario";
		$app->render('info.php',array('mensaje'=>$mensaje));
	}else if($result==1){
		//Utils::escribeLog("OK","debug");
		$mensaje="Usuario registrado correctamente.";
		$app->render('info.php',array('mensaje'=>$mensaje));
	}else if($result==2){
		//Utils::escribeLog("Existe","debug");
		$mensaje="Usuario o email existentes";
		$app->render('info.php',array('mensaje'=>$mensaje));
	}else{
		//Utils::escribeLog("Existe","debug");
		$mensaje="Usuario registrado, correo fallido";
		$app->render('info.php',array('mensaje'=>$mensaje));
	}	
	
});

$app->get('/usuario/validar/:correo/:key',function($correo,$key) use($app){
	require_once 'Modelo/Usuario.php';
	require_once 'Modelo/Utils.php';

	$result=Usuario::validarUsuario($correo,$key);
	//0-> Fail , 1->OK, 2->Ya validado,3-> OK pero correo Fail 
	if($result==0){
		//Utils::escribeLog("KO","debug");
		$mensaje= "Error al validar usuario.";
		$app->render('info.php',array('mensaje'=>$mensaje));
	}else if($result==1){
		//Utils::escribeLog("OK","debug");
		$mensaje="Validación correcta. Inicia sesión para acceder.";
		$app->render('info.php',array('mensaje'=>$mensaje));
	}	
	else if($result==2){
		//Utils::escribeLog("Existe","debug");
		$mensaje="El usuario ya está registrado";
		$app->render('info.php',array('mensaje'=>$mensaje));
	}else{
		$mensaje="Usuario validad, falló envío correo.";
		$app->render('info.php',array('mensaje'=>$mensaje));
	}
	
 });
$app->get('/usuarios', function() use($app){

});

$app->get('/nuevo',function() use ($app){
	$mensaje="pruebabbbaaa";
	$app->render('info.php',array('mensaje'=>$mensaje));
});

$app->get('/prueba/redirect/desde/aqui',function() use($app){
	$app->redirect('../')->render('info.php');

});

$app->run();



?>