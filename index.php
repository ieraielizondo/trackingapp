<?php

require 'vendor/autoload.php';
Slim\Slim::registerAutoloader();



$app= new \Slim\Slim();
$app->config(array(
	'debug' =>true ,
	'templates.path' =>'Vista',));

//$db=DbConnect();

$app-> get('/',function(){
	session_start();
	if(!isset($_SESSION['idUser']))
	{
		echo 'No hay sesion iniciada. Logueate para seguir.';
		//$app->render(/*Página de login*/);
	}
	else
	{
		echo 'Hola, '.$_SESSION['idUser'];
		//$app->render(/*Página de inicio con el usuario*/,array('iduser' =>$_SESSION['idUser'] ));
	}
	
});

 $app-> get('/usuario/:nombre',function($nombre) use ($app){

	$app->render('tmp_user.php',array('nombre'=>$nombre));
 });

$app-> get('/usuarios',function() use ($app){	

	//capturar la conexion a BBDD
	
	$db=DbConnect();
	$sql='SELECT id_usuario,nombre, ape1, ape2 FROM usuarios';
	$dbquery=$db->prepare($sql);
	$dbquery->execute();
	$data['usuarios']=$dbquery->fetchAll(PDO::FETCH_ASSOC);

	$app->render('tmp_usuarios.php',$data);
});

	$app-> post('/usuario/agregar',function() use ($app){

	});

function DbConnect(){
	require_once 'Control/BD/BD.php';

	//capturar la conexion a BBDD
	$bd=Conexion::getInstance()->getDb();
	return $bd;
}

$app->run();



?>