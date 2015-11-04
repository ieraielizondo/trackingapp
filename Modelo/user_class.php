<?php
require '../Control/BD/BD.php'
 class Usuario{
	
	private $mid_usuario;
	private $mnombre;
	private $mapellido1;
	private $mapellido2;
	private $memail;
	private $mpass;
	private $mvalidado;
		
	//Constructor de la clase
	public function __construct($idusu,$nom,$ape1,$ape2,$email,$pass,$vali=null)
	{
		$this->mid_usuario=$idusu;
		$this->mnombre=$nom;
		$this->mapellido1=$ape1;
		$this->mapellido2=$ape2;
		$this->memail=$email;
		$this->mpass=$pass;
		$this->mvalidado=$vali;
	}

	//************************
	//SECCION GETTER Y SETTERS
	//************************

	//ID_USUARIO
	public function setIdUsuario($idUsu)
	{
		$this->mid_usuario=$idusu;
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
	public function getApellido1()
	{
		return $this->mapellido2;
	}

	//EMAIL
	public function getEmail()
	{
		return $this->memail;
	}
	public function setEmail($email)
	{
		$this->email=$memail;
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
	public static function registrarUsuario($id_usuario,$pass,$nombre,$ape1,$ape2=NULL,$email){
		$retVal=1;//0->KO / 1->OK / 2->Existe el usuario
		
		//Antes de insertar comprobar que no exista el mismo id_usuario
		$sql="SELECT id_usuario FROM usuarios WHERE id_usuario=:id";
		$comando=Conexion::getInstance()->getDb()->prepare($sql);
		$comando->execute(array("id"=>$id_usuario));

		$cuenta=$comando->rowCount();

		if($cuenta!=0)
		{
			$retVal=2;
			return $retVal;
		}else{
			//si la cuenta da 0 insertar
			$sql="INSERT INTO usuarios(id_usuario,pass,nombre,ape1,ape2,email)VALUES
			(:id,:pass,:nombre,:ape1,:ape2,:email)";
			$comando=null;
			$comando=Conexion::getInstance()->getDb()-prepare($sql);
			$comando->execute(array("id"=>$id_usuario,"pas"=>md5($pass),"nombre"=>$nombre,
				"ape1"=>$ape1,"ape2"=>$ape2,"email"=>$email));
			$cuenta=$comando->rowCount();
			if($cuenta==0)//si no ha afectado a ninguna línea...
			{
				$retVal=0;
				return $retVal;
			}
			
		}



	}
}



?>