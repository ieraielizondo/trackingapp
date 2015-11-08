<?php
include 'Control/BD/BD.php';
include 'CorreoUser.php';
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
	public function registrarUsuario(){


		//return $this->getIdUsuario();
		$retVal=1;//0->KO / 1->OK / 2->Existe el usuario
		
		//Antes de insertar comprobar que no exista el mismo id_usuario
		$sql="SELECT id_usuario FROM usuario WHERE id_usuario=:id";
		$comando=Conexion::getInstance()->getDb()->prepare($sql);
		$comando->execute(array(":id"=>$this->getIdUsuario()));

		$cuenta=$comando->rowCount();

		if($cuenta!=0)
		{
			$retVal=2;
			return $retVal;
		}
		else{
			//si la cuenta da 0 insertar
			$sql="INSERT INTO usuario(id_usuario,pass,nombre,apellido1,apellido2,email)VALUES
			(:id,:pass,:nombre,:ape1,:ape2,:email)";
			$comando=null;
			$comando=Conexion::getInstance()->getDb()->prepare($sql);
			$comando->execute(array("id"=>$this->getIdUsuario(),"pass"=>md5($this->getPass()),"nombre"=>$this->getNombreUsuario(),
				"ape1"=>$this->getApellido1(),"ape2"=>$this->getApellido2(),"email"=>$this->getEmail()));
			$cuenta=$comando->rowCount();

			if($cuenta==0)//si no ha afectado a ninguna línea...
			{
				$retVal=0;
				return $retVal;
			}
			//Enviar correo
			$result=CorreoUser::enviarCorreoRegistro($this->getIdUsuario(),$this->getNombreUsuario(),$this->getApellido1(),$this->getApellido2(),$this->getEmail());


			return $retVal;			
		}
	}

	public function validarUsuario($idUsuario){

		//Comprobar que el usuario no este validado.
		

	}
}



?>