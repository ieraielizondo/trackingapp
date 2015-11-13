<?php


require '../vendor/autoload.php';


Slim\Slim::registerAutoloader();



$app= new \Slim\Slim();
$app->config(array(
	'debug' =>true ,
	'templates.path' =>'Vista'));

$app->get('/', function() use($app) {
    $app->response->setStatus(200);
    echo "Welcome to Slim 3.0 based API";
}); 

$app->get('/usuarios', function() use($app) {
    $app->response->setStatus(200);
    $usuarios=array(
		    	'usuario'=>array('nombre'=>'Ierai',
								 'apellido1'=>'elizondo',
								 'apellido2'=>'fernandez'),
				'usuario2'=>array('nombre'=>'Chris',
								 'apellido1'=>'Kwiatkowski',
								 'apellido2'=>''));
	var_dump( json_encode($usuarios));
}); 
 
$app->run();