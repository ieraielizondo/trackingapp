<?php


require 'vendor/autoload.php';
Slim\Slim::registerAutoloader();



$app= new \Slim\Slim();
$app->config(array(
	'debug' =>true ,
	'templates.path' =>'Vista',));

$app-> get('/',function() use ($app){
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

	$app->get('/registro',function() use($app){
		$app->render('tmp_login.php');
	});

	$app->post('/registro',function() use($app){
		//require_once 'Modelo/user_class.php';
		
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

		$result=Usuario::registrarUsuario($id_usuario,$pass,$nombre,$ape1,$ape2,$email);
		if($result){
			$app->flash('message','Usuario insertado correctamente');
		}else{
			$app->flash('error','Inserción fallida');
		}
		$app->redirect('');*/
	});

	$app->post('/nuevo/posicion',function(){
		require_once 'Modelo/posUser_class.php';

	});

function DbConnect(){
	require_once 'Control/BD/BD.php';

	//capturar la conexion a BBDD
	$bd=Conexion::getInstance()->getDb();
	return $bd;
}

$app->run();



?>