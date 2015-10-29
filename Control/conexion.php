<?php
class Conexion{
	private $userDB="trackingapp";
	private	$passDB="trackingapp";
	private	$hostDB="localhost";
	private	$DBname="trackingapp";
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
			return (-1);
		}	
	}
	public function ejecutarConsulta($sql)
	{
		var $resultado =new array();
		
		
		
	}
}
?>