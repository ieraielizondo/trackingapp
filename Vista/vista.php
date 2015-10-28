<?php
 /**
 * 
 */
 class Vista
 {
 	private $modelo;
 	private $controlador;
 	private $titulo;
 	
 	function __construct($modelo,$controlador)
 	{
 		$this->modelo=$modelo;
 		$this->controlador=$controlador; 		
 	}

 	public function setTitulo($title)
 	{
 		$this->titulo=$title;
 	}
 	//generar cabecera HTML
 	public function cabecera(){
 		//<HTML>
 		$html="<html lang="es">\n";

 		//<HEAD>
 		$html.="<head>\n";
 			//<TITLE>
 			$html.="<title>".$this->title;."</title>\n";
 		$html.="</head>\n";
 		
 		return $html;
 	}
 }

?>