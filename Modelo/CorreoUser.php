 <?php

	require 'class.phpmailer.php';
	include 'class.smtp.php';
	
	require_once 'Utils.php';
	//require '../vendor/phpmailer/PHPMailerAutoLoad.php';
	date_default_timezone_set('Etc/UTC');

	class CorreoUser {


		public function __construct(){

		}

		public static function enviarCorreoRegistro($idUsuario,$Nombre,$ape1,$ape2="",$correo,$key){
			$retVal=true;
			Utils::escribeLog("Inicio PHPMailer","debug");
			$URLValidar=self::getURLValidar($correo,$key);
			try{
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
				$mail->addReplyTo('\Correo/@gmail.com','Administrador de TrackingApp');
				$mail->Subject = "Bienvenido a trackingApp";
				$mail->AltBody = "Mensaje de prueba";
				$mail->WordWrap= 50;

				//$urlValidar=getURLValidar($correo,$key);			

				$mensaje="<h1>Bienvenido/a ".$Nombre." ".$ape1;
				if($ape2!="")
				{
					$mensaje.=" ".$ape2;
				}
				$mensaje.=' a trackingApp</h1><br/><br/><p>Gracias por incribirse en la app <b>App Tracking</b></p><br/>
					<p>Su nombre de usuario: '.$idUsuario.'</p>Su correo: '.$correo.'
					<p>Ha sido inscrito correctamente, para poder acceder a la aplicación debe validar su usuario. Para validar, pulse en el siguiente enlace para validar:</p> 
					<p><a href="'.$URLValidar.'">'.$URLValidar.'</a></p>';
				$mail->msgHTML($mensaje);
				
				$mail->isHTML(true);

				$mail->send();
			}catch(phpmailerException $me){
				Utils::escribeLog("Error: ".$me->getMessage()." | Fichero: ".$me->getFile()." | Línea: ".$me->getLine()." [Error al enviar correo]","debug");
				return false;
			}catch(Exception $e){
				Utils::escribeLog("Error: ".$e->getMessage()." | Fichero: ".$e->getFile()." | Línea: ".$e->getLine()." [Error al enviar correo]","debug");
			}
			
			return $retVal;
		}

		static function getURLValidar($correo,$key){
			require_once 'Control/BD/mysql_login.php';
			$strURL="http://localhost:".PUERTO;
			
			if(PUERTO=="80")//clase
			{
				$strURL.="/workspace/Servidor/PHP";
			}
			
			$strURL.="/trackingapp/usuario/validar?email=".$correo."&key=".$key;

			return $strURL;
		}

		
	}

	


?>