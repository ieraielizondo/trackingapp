<?php

	class Utils{

		public static function random_string($length) {
		    $key = '';
		    $keys = array_merge(range(0, 9), range('a', 'z'),range('A','Z'));

		    for ($i = 0; $i < $length; $i++) {
		        $key .= $keys[array_rand($keys)];
		    }

		    return $key;
		}

		public static function escribeLog($cadena,$tipo) {
			$arch = fopen(realpath( '.' )."/logs/log_".date('Y-m-d').".txt", "a+");
			fwrite($arch, "[ Fecha:".date('Y-m-d H:i:s')." | Nav: ".$_SERVER['HTTP_USER_AGENT']." | IP: ".$_SERVER['REMOTE_ADDR']." | FILE: ".$_SERVER['PHP_SELF']." | Tipo: ". $tipo ."] Msg: ".$cadena ."\r\n");
			fclose($arch);
		}

		
	}
?>