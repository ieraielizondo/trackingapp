<?php
class Usuario()
{
	
	private $id_usuario;
	private $nombre;
	private $pass;
	
	//Constructor de la clase
	public function __construct($idusu,$nom,$pass)
	{
		$this->id_usuario=$idusu;
		$this->nombre=$nom;
		$this->pass=$pass;
	}

	//************************
	//SECCION GETTER Y SETTERS
	//************************

	//ID_USUARIO
	public function setIdUsuario($idUsu)
	{
		$this->id_usuario=$idusu;
	}
	public function getIdUsuario()
	{
		return $this->id_usuario;
	}

	//NOMBRE
	public function setNombreUsuario($nom)
	{
		$this->nombre=$nom;
	}
	public function getNomUsuario()
	{
		return $this->nombre;
	}

	//PASSWORD
	public function setPass($Pass)
	{
		$this->nombre=$Pass;
	}	
	public function getIdUsuario()
	{
		return $this->pass;
	}
}



?>