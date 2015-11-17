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
	$usr=$app->request()->post('usuario');
	$pass=$app->request()->post('pass');
	if(isset($post->id_usuario) && isset($post->pass))
	{
		$result=Usuario::comprobarUsuario()
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
	/*Códigos de mensajes= 
	
	-err_reg_usr-->Error al registrar el usuario
	-usr_reg_OK-->Usuario registrado correctamente.
	-usr_em_exist-->Usuario o email existentes
	-usr_OK_em_F -->Usuario registrado, correo fallido
	*/
	if($result==0){
		//Utils::escribeLog("KO","debug");
		$mensaje= "err_reg_usr";
		$app->redirect($app->urlfor('resultado',array('mensaje'=>$mensaje)));
	}else if($result==1){
		//Utils::escribeLog("OK","debug");
		$mensaje="usr_reg_OK";
		$app->redirect($app->urlfor('resultado',array('mensaje'=>$mensaje)));
	}else if($result==2){
		//Utils::escribeLog("Existe","debug");
		$mensaje="usr_em_exist";
		$app->redirect($app->urlfor('resultado',array('mensaje'=>$mensaje)));
	}else{
		//Utils::escribeLog("Existe","debug");
		$mensaje="usr_OK_em_F";
		$app->redirect($app->urlfor('resultado',array('mensaje'=>$mensaje)));
	}	
	
});

$app->get('/usuario/validar/:correo/:key',function($correo,$key) use($app){
	require_once 'Modelo/Usuario.php';
	require_once 'Modelo/Utils.php';

	$result=Usuario::validarUsuario($correo,$key);
	//0-> Fail , 1->OK, 2->Ya validado,3-> OK pero correo Fail
	/*Códigos de mensajes= 
	*-error-->mensaje*
	-err_usr_val-->Error al validar usuario
	-val_OK-->Validación correcta. Inicia sesión para acceder..
	-usr_reg-->El usuario ya está registrado
	-usrv_OK_em_F -->Usuario validad, falló envío correo.
	*/
	if($result==0){
		//Utils::escribeLog("KO","debug");
		$mensaje= "err_usr_val";
		$app->redirect($app->urlfor('resultado',array('mensaje'=>$mensaje)));
	}else if($result==1){
		//Utils::escribeLog("OK","debug");
		$mensaje="val_OK";
		$app->redirect($app->urlfor('resultado',array('mensaje'=>$mensaje)));
	}	
	else if($result==2){
		//Utils::escribeLog("Existe","debug");
		$mensaje="usr_reg";
		$app->redirect($app->urlfor('resultado',array('mensaje'=>$mensaje)));
	}else{
		$mensaje="usrv_OK_em_F";
		$app->redirect($app->urlfor('resultado',array('mensaje'=>$mensaje)));
	}
	
 });



$app->get('/result/:mensaje',function($mensaje) use($app){
	/*
	-err_reg_usr-->Error al registrar el usuario
	-usr_reg_OK-->Usuario registrado correctamente.
	-usr_em_exist-->Usuario o email existentes
	-usr_OK_em_F -->Usuario registrado, correo fallido
	-err_usr_val-->Error al validar usuario
	-val_OK-->Validación correcta. Inicia sesión para acceder..
	-usr_reg-->El usuario ya está registrado
	-usrv_OK_em_F -->Usuario validad, falló envío correo.

	*/
	if($mensaje==='err_reg_usr'){
		$mensaje="Error al registrar el usuario.";
	}else if($mensaje==='usr_reg_OK'){
		$mensaje="Usuario registrado correctamente.";
	}else if($mensaje==='usr_em_exist'){
		$mensaje="Usuario o email existentes.";
	}else if($mensaje==='usr_OK_em_F'){
		$mensaje="Usuario registrado, correo fallido.";
	}else if($mensaje==='err_usr_val'){
		$mensaje="Error al validar usuario.";
	}else if($mensaje==='val_OK'){
		$mensaje="Validación correcta. Inicia sesión para acceder.";
	}else if($mensaje==='usr_reg'){
		$mensaje="El usuario ya está registrado.";
	}else {
		$mensaje="Usuario validad, falló envío correo.";
	}
	$app->render('info.php',array('mensaje'=>$mensaje));

})->name('resultado');
$app->run();



?>