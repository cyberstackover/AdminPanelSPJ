<?php
session_start();
function login($username, $password){
	$a = mysql_query("select * from admin_web where username='$username' and password='$password'");
	$b = mysql_fetch_object($a);
	if($b->username == $username && $b->password == $password && $username != "" && $password !="" ){
		$result = array($_SESSION['id_login_a'] = $b->id_member, header('Location: ../../admin.php'));
	}else{
		$result = array($_SESSION['id_login_a'] = "",  header('Location: ../../admin.php?err=1'));
	}
	return $result;
}
?>