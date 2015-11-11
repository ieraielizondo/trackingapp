<?php
include 'Control/BD/BD.php';
include 'CorreoUser.php';
require_once 'Utils.php';
 class Usuario{
	
	private $mId_Usuario;
	private $mNombre;
	private $mApellido1;
	private $mApellido2;
	private $mEmail;
	private $mPass;
	private $mValidado;
	private $mFecha;
		
	//Constructor de la clase
	public function __construct()
	{
		$this->mId_Usuario="";
		$this->mNombre="";
		$this->mApellido1="";
		$this->mApellido2="";
		$this->mEmail="";
		$this->mPass="";
		$this->mValidado="";
	}

	//************************
	//SECCION GETTER Y SETTERS
	//************************

	//ID_USUARIO
	public function setIdUsuario($idUsu)
	{
		$this->mId_Usuario=$idUsu;
	}
	public function getIdUsuario()
	{
		return $this->mId_Usuario;
	}

	//NOMBRE
	public function setNombreUsuario($nom)
	{
		$this->mNombre=$nom;
	}
	public function getNombreUsuario()
	{
		return $this->mNombre;
	}

	//APELLIDO 1
	public function setApellido1($ape1)
	{
		$this->mApellido1=$ape1;
	}
	public function getApellido1()
	{
		return $this->mApellido1;
	}

	//APELLIDO 2
	public function setApellido2($ape2)
	{
		$this->mApellido2=$ape2;
	}
	public function getApellido2()
	{
		return $this->mApellido2;
	}

	//EMAIL
	public function setEmail($email)
	{
		$this->mEmail=$email;
	}
	public function getEmail()
	{
		return $this->mEmail;
	}	

	//PASSWORD
	public function setPass($Pass)
	{
		$this->mPass=$Pass;
	}	
	public function getPass()
	{
		return $this->mPass;
	}

	//VALIDADO
	public function setValidado($vali)
	{
		$this->mValidado=$vali;
	}	
	public function getValidado()
	{
		return $this->mValidado;
	}

	//FECHA
	public function getFecha()
	{
		return $this->mFecha;
	}

	//******************************
	//SECCION INTERACCIÓN CON BBDD *
	//******************************
	public static function nuevoUsuario($id,$pass,$nombre,$ape1,$ape2="",$email){

		//return $this->getIdUsuario();
		$retVal=1;//0->KO / 1->OK / 2->Existe el usuario/3-> Usuario insertado correo KO
		Utils::escribeLog("Inicio nuevoUsuario","debug");

		try{
			//Antes de insertar comprobar que no exista el mismo id_usuario y correo
			$sql="SELECT id_usuario FROM usuario WHERE id_usuario=:id or email=:email";
			$comando=Conexion::getInstance()->getDb()->prepare($sql);
			$comando->execute(array(":id"=>$id,":email"=>$email));

		}catch(PDOException $e){
			Utils::escribeLog("Error: ".$e->getMessage()." | Fichero: ".$e->getFile()." | Línea: ".$e->getLine()." [Usuario o email existentes]","debug");
			$retVal=0;
			return $retVal;
		}		

		$cuenta=$comando->rowCount();

		if($cuenta!=0)
		{
			Utils::escribeLog("IdUsuario y/o correo  existentes en la BBDD -> KO","debug");
			$retVal=2;
			return $retVal;
		}		
		Utils::escribeLog("IdUsuario y/o correo no existentes en la BBDD -> OK","debug");
		try{
			//si la cuenta da 0 insertar
			$sql="INSERT INTO usuario(id_usuario,pass,nombre,apellido1,apellido2,email,key_usuario)VALUES
			(:id,:pass,:nombre,:ape1,:ape2,:email,:key)";
			$key=Utils::random_string(50);
			$comando=null;
			$comando=Conexion::getInstance()->getDb()->prepare($sql);
			$comando->execute(array(":id"=>$id,
				":pass"=>md5($pass),
				":nombre"=>$nombre,
				":ape1"=>$ape1,
				":ape2"=>$ape2,
				":email"=>$email,
				":key"=>$key));

		}catch(PDOException $e){
			Utils::escribeLog("Error: ".$e->getMessage()." | Fichero: ".$e->getFile()." | Línea: ".$e->getLine()." [Error al insertar usuario]","debug");
			$retVal=0;
			return $retVal;
		}
		
		$cuenta=$comando->rowCount();

		if($cuenta==0)//si no ha afectado a ninguna línea...
		{
			$retVal=0;
			return $retVal;
		}
		Utils::escribeLog("Usuario insertado en la BBDD -> OK","debug");
		Utils::escribeLog("Pre-envio correo","debug");
		//Enviar correo
		$result=CorreoUser::enviarCorreoRegistro($id,$nombre,$ape1,$ape2,$email,$key);

		if(!$result){
			//Utils::escribeLog("Error: ".$e->getMessage()." | Fichero: ".$e->getFile()." | Línea: ".$e->getLine()." [Error al enviar correo]","debug");
			$retVal=3;
			return $retVal;
		}
		Utils::escribeLog("Correo enviado OK","debug");			
		return $retVal;	//si todo va OK deveria devolver 1		
		
	}

	public static function validarUsuario($correo,$key){
		$retVal=1;//0-> Fail , 1->OK, 2->Ya validado 
		
		try{
			//Comprobar que el usuario no este validado.
			$sql="SELECT ";

		}catch(PDOException $ex){
			Utils::escribeLog("Error: ".$e->getMessage()." | Fichero: ".$e->getFile()." | Línea: ".$e->getLine()." [Error al insertar usuario]","debug");
			$retVal=false;
			return $retVal;
		}

	}
}



?>