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

	$app->post('/registro',function() use($app){
		//include '/Modelo/user_class.php';
		
		$req=$app->request();
		$id_usuario=$req->post('idUsuario');
		$pass=$req->post("pass");
		$nombre=$req->post("nombre");
		$ape1=$req->post("ape1");
		$ape2=$req->post("ape2");
		$email=$req->post("email");

		echo "Usuario->".$id_usuario;
		echo "<br>pass->".$pass;
		echo "<br>passMD5->".md5($pass);
		echo "<br>nombre->".$nombre;
		echo "<br>apellido1->".$ape1;
		echo "<br>apellido2->".$ape2;
		echo "<br>email->".$email;

		$result=nuevoUsuario($id_usuario,$pass,$nombre,$ape1,$ape2,$email);//Obtener la instancia de la clase Usuario

		
		//$app->redirect('');
	});

	$app->post('/nuevo/posicion',function(){
		

	});

	function DbConnect(){
		require_once 'Control/BD/BD.php';

		//capturar la conexion a BBDD
		$bd=Conexion::getInstance()->getDb();
		return $bd;
	}
	function nuevoUsuario($id_usuario,$pass,$nombre,$ape1,$ape2,$email){
		//require 'Modelo/posUser_class.php';
		require_once 'Modelo/user_class.php';

		$Usuario=new Usuario();
		//añadir valores al objeto
		$Usuario->setIdUsuario($id_usuario);
		$Usuario->setNombreUsuario($nombre);
		$Usuario->setApellido1($ape1);
		$Usuario->setApellido2($ape2);
		$Usuario->setPass($pass);
		$Usuario->setEmail($email);

		/*echo "id. " .$id_usuario;//$Usuario->getIdUsuario();
		echo "nom. " .$Usuario->getNombreUsuario();
		echo "ap1. " .$Usuario->getApellido1();
		echo "ap2. " .$Usuario->getApellido2();
		echo "pass. " .$Usuario->getPass();
		echo "email. " .$Usuario->getEmail();*/
		$result=$Usuario->registrarUsuario();
		if($result==1){//0->KO / 1->OK / 2->Existe el usuario
			$mensaje= "Usuario insertado correctamente";
			echo $mensaje;
			//$app->redirect('');
		}else if($result==0){
			$mensaje="Fallo la inserción";
			echo $mensaje;
		}
		else{
			$mensaje= "Ya existe el usuario";
			echo $mensaje;
		}
		return true;
	}

$app->run();



?>