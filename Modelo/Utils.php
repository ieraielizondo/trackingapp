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

		
	}
?>