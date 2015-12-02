 <?php
	header('Content-Type: text/html; charset=ISO-8859-1');
	require_once 'class.phpmailer.php';
	include_once 'class.smtp.php';
	include_once 'keys.php';
		
	require_once 'Utils.php';
	//require '../vendor/phpmailer/PHPMailerAutoLoad.php';
	date_default_timezone_set('Etc/UTC');

	class CorreoUser {
		private $host;
		private $port;
		private $usernameFrom;
		private $pass;

		public function __construct(){
			$this->host='smtp.gmail.com';
			$this->port=587;
			$this->usernameFrom=CORREO;
			$this->pass=PASS;
		}

		public function enviarCorreoRegistro($idUsuario,$Nombre,$ape1,$ape2="",$correo,$key){
			$retVal=true;
			Utils::escribeLog("Inicio PHPMailer","debug");
			$URL="http://trackingapp-ieraielizondo.rhcloud.com/usuario/validar/".$correo."/".$key;
			//$URL="localhost/workspace/Servidor/PHP/trackingapp/usuario/validar/".$correo."/".$key;

			try{
				$mail = new PHPMailer();
				$mail->isSMTP();
				
				$mail->SMTPSecure = 'tls';
				$mail->Host = $this->host;
				$mail->Port = $this->port;

				$mail->SMTPAuth = true;
				$mail->Username = $this->usernameFrom;
				$mail->Password = $this->pass;

				$mail->SMTPDebug=0;
				//$mail->Debugoutput = 'html';

				$mail->addAddress($correo,$Nombre);			
				
				$mail->From=$this->usernameFrom;
				$mail->FromName='Administrador TrackingApp';
				$mail->addReplyTo($this->usernameFrom,'Administrador de TrackingApp');
				$mail->Subject = "Bienvenido a trackingApp";
				$mail->AltBody = "Mensaje de prueba";
				$mail->WordWrap= 50;

				//$urlValidar=getURLValidar($correo,$key);			

				$mensaje="<div><h1>Bienvenido/a ".$Nombre." ".$ape1;
				if($ape2!="")
				{
					$mensaje.=" ".$ape2;
				}
				$mensaje.=' a trackingApp</h1><br/><p>Gracias por incribirse en la app <b>TrackingApp</b></p><br/>
					<p>Su nombre de usuario: '.$idUsuario.'</p>Su correo: '.$correo.'
					<p>Ha sido inscrito correctamente, para poder acceder a la aplicación debe validar su usuario. Para validar, pulse en el siguiente enlace para validar:</p> 
					<p><a href="'.$URL.'">'.$URL.'</a></p></div>';
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

		public function enviarConfirmValidacion($Nombre,$ape1,$ape2="",$correo){
			$retVal=true;
			Utils::escribeLog("Inicio PHPMailer confirmValidar","debug");
			$URL="http://trackingapp-ieraielizondo.rhcloud.com";			
			try{
				$mail = new PHPMailer();
				$mail->isSMTP();
				
				$mail->SMTPSecure = 'tls';
				$mail->Host = $this->host;
				$mail->Port = $this->port;

				$mail->SMTPAuth = true;
				$mail->Username = $this->usernameFrom;
				$mail->Password = $this->pass;

				$mail->SMTPDebug=0;
				//$mail->Debugoutput = 'html';

				$mail->addAddress($correo,$Nombre);			
				
				$mail->From=$this->usernameFrom;
				$mail->FromName='Administrador TrackingApp';
				$mail->addReplyTo($this->usernameFrom,'Administrador de TrackingApp');
				$mail->Subject = "Validacion de usuario realizado correctamente";
				$mail->AltBody = "Validación correcta";
				$mail->WordWrap= 50;	

				$mensaje="<div><h2>Bienvenido/a ".$Nombre." ".$ape1;
				if($ape2!="")
				{
					$mensaje.=" ".$ape2;
				}
				$mensaje.=' a trackingApp</h2><p>Se ha confirmado correctamente su solicitud de validación de usuario en <b>TrackingApp</b></p>					
					<p>Puede iniciar sesión y acceder a la aplicación desde aquí:</p> 
					<p><a href="'.$URL.'">'.$URL.'</a></p></div>';
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
	}
?>