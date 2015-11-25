<?php


	session_start();

	require 'vendor/autoload.php';


	Slim\Slim::registerAutoloader();


	$app= new \Slim\Slim();
	$app->config(array(
		'debug' =>true ,
		'templates.path' =>'Vista'));

	$app-> map('/',function() use ($app){
		
		if(!isset($_SESSION['id_usuario']))
		{
			//render login
			$app->render('tmp_login.php');
		}
		else
		{
			//enviar al inicio
			$app->redirect($app->urlFor('PaginaInicio'));
			//$app->render(/*Página de inicio con el usuario*/,array('iduser' =>$_SESSION['idUser'] ));
		}	
	})->via('GET')->name('Inicio');

	 

	$app-> post('/login',function() use ($app){
		require_once 'Modelo/Usuario.php';
		
		$usr=$app->request->post('idUsuario');
		$pass=$app->request->post('pass');

		if(isset($usr) && isset($pass))
		{
			$result=Usuario::comprobarUsuario($usr,$pass);
			if($result){
				$app->redirect($app->urlFor('Inicio'));
			}else{
				$app->flash('message',"No existe el usuario");
				$app->redirect($app->urlFor('Inicio'));
			}
		}else
		{
			$app->flash('message',"Faltan datos por introducir.");
			$app->redirect($app->urlFor('Inicio'));
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
			$mensaje="Usuario validado, falló envío correo.";
		}
		$app->render('info.php',array('mensaje'=>$mensaje));

	})->name('resultado');

	$app->run();
?>