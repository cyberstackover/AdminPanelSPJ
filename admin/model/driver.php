<?php
session_start();
function save($name, $email){
		
		
			$q = mysql_query("insert into driver values('','','$name','','','$email','','','','')");

			$result = header('Location: ../../admin.php?page=admin/view/driver');
			
	
		return $result;
	}
	
	function edit($uid, $name, $email) {
	
			
				
		mysql_query("UPDATE  `driver` SET  `name` =  '$name', `email`='$email' where uid='$uid'");
				
		$result = header('Location: ../../admin.php?page=admin/view/driver');

		return $result;
	}

function delete($uid){
			
			
	mysql_query("delete from driver where uid = $uid");
	$result = header("Location: ../../admin.php?page=admin/view/driver");
	
	return $result;
}	
	
	?>