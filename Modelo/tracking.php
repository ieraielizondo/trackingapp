<?php
class track()
{
	var $id_usuario;
	var $latitud;
	var $longitud;
	var $fecha;
	var $datos=array();

	function __construct()
	{

	}

	function insertar($idusu,$lat,$long,$time)
	{
		//consulta
		$detalle=new track();
		$detalle->id_usuario=$idusu;
		$detalle->latitud=$lat;
		$detalle->longitud=$long;
		$detalle->fecha=$time;
		
		$datos[]=$detalle;

	}
	function leerDatos(idUsuario)
	{

	}
}



?>