<?php
include 'Modelo/user_class.php';
include 'Modelo/posUser_class.php';
require 'vendor/autoload.php';
Slim\Slim::registerAutoloader();



$app= new \Slim\Slim();
$app->config(array(
	'debug' =>true ,
	'templates.path' =>'Vista',));

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

	$app-> post('/login',function() use ($app){
		$post=(object)$app->request()->post();
		if(isset($post->id_usuario) && isset($post->pass))
		{
			$usuario=new Usuario();
		}
	});

	$app->get('/nuevo/usuario',function() use($app){
		$app->render('nuevoUsuario.php');
	});

	$app->post('nuevo/usuario',function() use($app){
		$post=(object)$app->request()->post();
		$id_usuario=$post->id_usuario;
		$pass=$post->pass;
		$nombre=$post->nombre;
		$ape1=$post->apellido1;
		$ape2=$post->apellido2;
		$email=$post->email;

		$result=Usuario::registrarUsuario($id_usuario,$pass,$nombre,$ape1,$ape2,$email);
		if($result){
			$app->flash('message','Usuario insertado correctamente');
		}else{
			$app->flash('error','Inserción fallida');
		}
		$app->redirect('');
	});

function DbConnect(){
	require_once 'Control/BD/BD.php';

	//capturar la conexion a BBDD
	$bd=Conexion::getInstance()->getDb();
	return $bd;
}

$app->run();



?>