<?php
session_start();
function logout($session){
		/*$t = count($session);
		for($i=0; $i<=$t; $i++){
			$r = $session[$i];
			unset($_SESSION[$r]);
		}*/
		session_destroy();
		$result = header('Location: ../../storing.php');
		return $result;
	}
?>