<?php
class Conexion{
	var $userDB="trackingapp";
	var	$passDB="trackingapp";
	var	$hostDB="localhost";
	var	$DBname="trackingapp";
	function __construct()
	{
				
	}
	public function conectar()
	{				
		try
		{
			$conexion=new PDO("mysql:host=$this->hostDB;dbname=$this->DBname",$this->userDB,$this->passDB,array(PDO::MYSQL_ATTR_FOUND_ROWS => true));
			return ($conexion);
		}
		catch(PDOException $e)
		{
			echo '<script> alert("¡Error!: ' . $e->getMessage() . ')</script>';
			return;
		}	
	}
}
?>