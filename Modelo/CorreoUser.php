<?php

	require 'class.phpmailer.php';
	include 'class.smtp.php';
	require_once '../Control/BD/mysql_login.php';
	include 'Utils.php';
	//require '../vendor/phpmailer/PHPMailerAutoLoad.php';
	date_default_timezone_set('Etc/UTC');

	class CorreoUser {

		public function __construct(){

		}

		public static function enviarCorreoRegistro($idUsuario,$Nombre,$ape1,$ape2="",$correo,$key){
			$retVal=true;

			$mail = new PHPMailer();
			$mail->isSMTP();
			
			$mail->SMTPSecure = 'tls';
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = 587;

			$mail->SMTPAuth = true;
			$mail->Username = "\Correo/@gmail.com";
			$mail->Password = "\Pass/";

			$mail->SMTPDebug=0;
			//$mail->Debugoutput = 'html';

			$mail->addAddress($correo,$Nombre);			
			
			$mail->From='\Correo/@gmail.com';
			$mail->FromName='Administrador TrackingApp';
			$mail->addReplyTo('\Correo/@gmail.com','Administrador TrackingApp');
			$mail->Subject = "Bienvenido a trackingApp";
			$mail->AltBody = "Mensaje de prueba";
			$mail->WordWrap= 50;

			$urlValidar=getURLValidar($idUsuario,$key);
			

			$mensaje="<h1>Bienvenido/a ".$Nombre." ".$ape1;
			if($ape2!="")
			{
				$mensaje.=" ".$ape2;
			}
			$mensaje.=" a trackingApp</h1><br/><br/><p>Gracias por incribirse en la app <b>App Tracking</b></p><br/>
				<p>Su nombre de usuario: ".$idUsuario."</p>Su correo: ".$correo."<p>Ha sido inscrito correctamente, pulse en el siguiente enlace para validar:</p> <p><a href='".$urlValidar."'>".$urlValidar."</a></p>";
			$mail->msgHTML($mensaje);
			
			$mail->isHTML(true);

			//var_dump($mail->send());
			if (!$mail->send()) {
				//echo "Error: ".$mail->ErrorInfo;
				$retVal=false;				
			}
			
			return $retVal;
		}

		function getURLValidar($id,$key){
			$strURL="localhost:".PUERTO
			$strUsrEncript=Utils::encrypt($id,$key);
			if(PUERTO=="80")//clase
			{
				$strURL.="/Servidor/PHP";
			}
			
			$strURL.="/trackingapp/usuario/validar?usr=".$strUsrEncript."&key=".$key;

			return $strURL;
		}

		
	}

	


?>