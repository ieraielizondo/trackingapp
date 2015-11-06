<?php
include 'Control/BD/BD.php';
 class Usuario{
	
	private $mid_usuario;
	private $mnombre;
	private $mapellido1;
	private $mapellido2;
	private $memail;
	private $mpass;
	private $mvalidado;
		
	//Constructor de la clase
	public function __construct()
	{
		$this->mid_usuario="";
		$this->mnombre="";
		$this->mapellido1="";
		$this->mapellido2="";
		$this->memail="";
		$this->mpass="";
		$this->mvalidado="";
	}

	//************************
	//SECCION GETTER Y SETTERS
	//************************

	//ID_USUARIO
	public function setIdUsuario($idUsu)
	{
		$this->mid_usuario=$idUsu;
	}
	public function getIdUsuario()
	{
		return $this->mid_usuario;
	}

	//NOMBRE
	public function setNombreUsuario($nom)
	{
		$this->mnombre=$nom;
	}
	public function getNombreUsuario()
	{
		return $this->mnombre;
	}

	//APELLIDO 1
	public function setApellido1($ape1)
	{
		$this->mapellido1=$ape1;
	}
	public function getApellido1()
	{
		return $this->mapellido1;
	}

	//APELLIDO 2
	public function setApellido2($ape2)
	{
		$this->mapellido2=$ape2;
	}
	public function getApellido2()
	{
		return $this->mapellido2;
	}

	//EMAIL
	public function setEmail($email)
	{
		$this->memail=$email;
	}
	public function getEmail()
	{
		return $this->memail;
	}	

	//PASSWORD
	public function setPass($Pass)
	{
		$this->mpass=$Pass;
	}	
	public function getPass()
	{
		return $this->mpass;
	}

	//VALIDADO
	public function setValidado($vali)
	{
		$this->mvalidado=$vali;
	}	
	public function getValidado()
	{
		return $this->mvalidado;
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

			return $retVal;			
		}



	}
}



?>