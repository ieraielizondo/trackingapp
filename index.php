<?php
	header ('Content-type: text/html; charset=utf-8');
	session_start();

	require 'vendor/autoload.php';


	Slim\Slim::registerAutoloader();


	$app= new \Slim\Slim();
	$app->config(array(
		'debug' =>true ,
		'templates.path' =>'Vista'));

	$app-> map('/',function() use ($app){
		
		if(!isset($_SESSION['id_usuario'])){
			//render login
			$app->render('tmp_login.php');
		}
		else{
			//enviar al inicio
			$app->redirect($app->urlFor('PaginaInicio'));			
		}	
	})->via('GET')->name('Inicio');
	 
	//Login
	$app-> post('/login',function() use ($app){
		require_once 'Modelo/Usuario.php';
		
		$usr=$app->request->post('idUsuario');
		$pass=$app->request->post('pass');

		if(isset($usr) && isset($pass))
		{
			$result=Usuario::comprobarUsuario($usr,$pass);
			if($result==1){
				$app->redirect($app->urlFor('Inicio'));
			}else if($result==0){
				$app->flash('message',"No existe el usuario");
				$app->redirect($app->urlFor('Inicio'));
			}else {
				$app->flash('message',"El usuario no est&aacute; validado, valida para poder acceder.");
				$app->redirect($app->urlFor('Inicio'));
			}
		}else
		{
			$app->flash('message',"Faltan datos por introducir.");
			$app->redirect($app->urlFor('Inicio'));
		}
	});

	//Registro usuario
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

		$result=Usuario::nuevoUsuario($id_usuario,$pass,$nombre,$ape1,$ape2,$email);
		//0->KO / 1->OK / 2->Existe el usuario / 3->registro OK correo KO
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
	
	//Validar usuario
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
	
	//Página de inicio
	$app->get('/inicio',function() use ($app){
		if(!isset($_SESSION['id_usuario']))
		{
			//render login
			$app->flash('message',"Debe iniciar sesión para acceder.");
			$app->redirect($app->urlFor('Inicio'));
		}
		else
		{
			//enviar al inicio
			$app->render('tmp_inicio.php');			
		}		
	})->name('PaginaInicio');

	//Añadir posicion
	$app->post('/addPos',function() use($app){
		require_once 'Modelo/PosicionUsuario.php';
		require_once 'Modelo/Utils.php';
		sleep(2);
		$req=$app->request();
		$id_usuario=$_SESSION['id_usuario'];
		$titulo=$req->post('titulo');
		$lat=$req->post('lat');
		$long=$req->post('long');
		$resp=array();

		if(!isset($titulo)&&!isset($lat)&&!isset($long)){
			$result=false;
			Utils::escribeLog("titulo,latitud y longitud sin valor!!!!","debug");
		}else{
			$result=PosicionUsuario::nuevaPosicion($id_usuario,$titulo,$lat,$long);
		}

		if($result){
			$resp['estado']="ok";
			$resp['mensaje']="Insertado correctamente";

		}else{
			$resp['estado']="ko";
			$resp['mensaje']="Fallo al insertar";
		}

		echo json_encode($resp);
	});

	//Traer posiciones del usuario
	$app->get('/getAllPos',function(){
		require_once 'Modelo/PosicionUsuario.php';
		require_once 'Modelo/Utils.php';
		$id_usuario=$_SESSION['id_usuario'];
		sleep(2);
		
		$resp=array();

		if(!isset($id_usuario)){
			$resultado=null;
			Utils::escribeLog("titulo sin valor!!!! [/getAllPos]","debug");
		}else{
			$resultado=PosicionUsuario::getPosicionesByUsuario($id_usuario);
		}

		if(!is_null($resultado)){
			$resp['estado']="ok";
			$resp['mensaje']=$resultado;

		}else{
			$resp['estado']="ko";
			$resp['mensaje']="No hay posiciones.";
		}

		echo json_encode($resp);

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
			$mensaje="Usuario registrado correctamente. Se le ha enviado un correo de verificación. Por favor, revise el correo.";
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
			$mensaje="Usuario validado, falló envío correo.";
		}
		$app->render('info.php',array('mensaje'=>$mensaje));
	})->name('resultado');

	$app->get('/logout',function()use ($app){
		session_destroy();
		$app->redirect($app->urlFor('Inicio'));
	});

	$app->run();
?>