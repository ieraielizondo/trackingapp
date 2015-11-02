<?php

require 'vendor/autoload.php';
Slim\Slim::registerAutoloader();

$app= new \Slim\Slim();
$app->config(array(
	'debug' =>true ,
	'templates.path' =>'Vista',));

$app-> get('/',function(){
	echo "Pagina inicio con SLIM";
});

$app-> get('/usuario/:nombre',function($nombre) use ($app){
	$app->render('tmp_inicio.php',array('nombre'=>$nombre));
});

$app->run();



?>