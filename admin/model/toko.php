<?php
session_start();
function save($name, $address, $email){
		
		
			$q = mysql_query("insert into toko values('','','$name','$address','','','$email','','','','')");

			$result = header('Location: ../../admin.php?page=admin/view/toko');
			
	
		return $result;
	}
	
	function edit($uid, $name, $address ,$email) {
	
			
				
		mysql_query("UPDATE  `toko` SET  `name` =  '$name', `address`='$address',`email`='$email' where uid='$uid'");
				
		$result = header('Location: ../../admin.php?page=admin/view/toko');

		return $result;
	}

function delete($uid){
			
			
	mysql_query("delete from toko where uid = $uid");
	$result = header("Location: ../../admin.php?page=admin/view/toko");
	
	return $result;
}	
	
	?>