<?php
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
	} 
?>