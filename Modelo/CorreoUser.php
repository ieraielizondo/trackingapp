<?php

	//require 'class.phpmailer.php';
	//include 'class.smtp.php';
	require '../vendor/phpmailer/PHPMailerAutoLoad.php';
	date_default_timezone_set('Etc/UTC');

	class CorreoUser {

		public function __construct(){

		}

		public static function enviarCorreoRegistro($idUsuario,$Nombre,$ape1,$correo){
			$retVal=true;
			$mail = new PHPMailer();
			$mail->isSMTP();
			
			$mail->SMTPSecure = 'tls';
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = 587;

			$mail->SMTPAuth = true;
			$mail->Username = "//";
			$mail->Password = "//";

			$mail->SMTPDebug=1;
			//$mail->Debugoutput = 'html';

			$mail->addAddress($correo,$Nombre);			
			
			$mail->From='//';
			$mail->FromName='Administrador TrackingApp';
			$mail->addReplyTo('//','Administrador TrackingApp');
			$mail->Subject = "Bienvenido a trackingApp";
			$mail->AltBody = "Mensaje de prueba";
			$mail->WordWrap= 50;
			$mail->msgHTML("<h1>Bienvenido".$Nombre." ".$ape1." a trackingApp</h1><br/><br/><p>Gracias por incribirse en la app <b>App Tracking</b></p><br/>
				<p>Su nombre de usuario: ".$idUsuario."</p>Su correo: ".$correo."<p>Ha sido inscrito correctamente, pulse en el siguiente enlace para validar:</p>");
			
			$mail->isHTML(true);

			//var_dump($mail->send());
			if (!$mail->send()) {
				echo "Error: ".$mail->ErrorInfo;
				$retVal=false;
				return $retVal;
			}
			else{
				echo "Correo OK";

			}
			return $retVal;
		}

		
	}

	


?>