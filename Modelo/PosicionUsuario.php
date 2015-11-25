<?php
include_once 'Control/BD/BD.php';
require_once 'Utils.php';
	class PosicionUsuario{
		private $idPosicion;
	    private $id_usuario;
		private $latitud;
	    private $longitud;
	    private $fecha;

	    public function __construct($idPos,$idUsu,$lat,$long,$fecha){

	    	$this->idPosicion=$idPos;
		    $this->id_usuario=$idUsu;
			$this->latitud=$lat;
		    $this->longitud=$long;
		    $this->fecha=$fecha;
	    }

	    //************************
		//SECCION GETTER Y SETTERS
		//************************

		//ID_POSICIÓN
		public function setIdPosicion($idPos)
		{
			$this->id_usuario=$idusu;
		}
		public function getIdPosicion()
		{
			return $this->id_usuario;
		}

		//ID_USUARIO
		public function setIdUsuario($idPos)
		{
			$this->id_usuario=$idusu;
		}
		public function getIdUsuario()
		{
			return $this->id_usuario;
		}

		//LATITUD
		public function setLatitud($Lat)
		{
			$this->latitud=$Lat;
		}	
		public function getLatitud()
		{
			return $this->latitud;
		}

		//LONGITUD
		public function setLongitud($Long)
		{
			$this->longitud=$Long;
		}	
		public function getIdLongitud()
		{
			return $this->longitud;
		}

		//FECHA
		public function setFecha($Fecha)
		{
			$this->fecha=$Fecha;
		}	
		public function getFecha()
		{
			return $this->fecha;
		}

		public static function nuevaPosicion($id_usuario,$latitud,$longitud){
			var $retVal=true;

			try{
				//si la cuenta da 0 insertar
				$sql="INSERT INTO posicion(id_usuario,latitud,longitud)VALUES(:id,:lat,:long)";			
				$comando=Conexion::getInstance()->getDb()->prepare($sql);
				$comando->execute(array(":id"=>$id_usuario,
					":lat"=>$latitud),
					":long"=>$longitud));

			}catch(PDOException $e){
				Utils::escribeLog("Error: ".$e->getMessage()." | Fichero: ".$e->getFile()." | Línea: ".$e->getLine()." [Error al insertar posicion]","debug");
				$retVal=0;
				return $retVal;
			}
			
			$cuenta=$comando->rowCount();

			if($cuenta==0)//si no ha afectado a ninguna línea...
			{
				$retVal=0;
				return $retVal;
			}
			return $retVal;

		}
	} 
?>