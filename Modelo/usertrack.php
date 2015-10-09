<?php
class usertrack()
{
	var $id_posicionamiento;
	var $id_usuario;
	var $latitud;
	var $longitud;
	var $fecha;
	

	function __construct($idusu,$lat,$long,$time)
	{
		$this->id_usuario=$idusu;
		$this->latitud=$lat;
		$this->longitud=$long;
		$this->fecha=$time;

	}

	function insertar()
	{
		//consulta
		var $sql="insert into posicionamiento(id_posicionamiento,id_usuario,latitud,longitud,fecha)";
		$sql.="values ()"
		

	}
	function leerDatos($idUsuario)
	{
		

	}
}



?>