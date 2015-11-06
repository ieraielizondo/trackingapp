<?php

	include 'class.phpmailer.php';
	include 'class.smtp.php';

	class CorreoUser {

		public function __construct(){

		}

		public static function enviarCorreoRegistro($idUsuario,$Nombre,$ape1,$correo){
			$retVal=true;
			$mail = new PHPMailer();
			$mail->isSMTP();
			$mail->SMTPAuth = true;
			//$mail->SMTPSecure = "ssl";
			$mail->Host = "smtp.live.com";
			$mail->Port = 587;
			$mail->Username = "";
			$mail->Password = "";
			$mail->From = "";
			$mail->FromName = "Administrador TrackingApp";
			$mail->Subject = "Bienvenido a trackingApp";
			$mail->AltBody = "Mensaje de prueba";
			$mail->msgHTML("<h1>Bienvenido".$Nombre." ".$ape1." a trackingApp</h1><br/><br/><p>Gracias por incribirse en la app <b>App Tracking</b></p><br/>
				<p>Su nombre de usuario: ".$idUsuario."</p>Su correo: ".$correo."<p>Ha sido inscrito correctamente, pulse en el siguiente enlace para validar:</p>");
			$mail->addAddress($correo,$Nombre);
			$mail->isHTML(true);
			if (!$mail->send()) {
				echo "Error: ".$mail->ErrorInfo;
				$retVal=false;
				return $retVal;
			}
			return $retVal;
		}

		
	}

	


?>