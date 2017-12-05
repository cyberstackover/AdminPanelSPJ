<?php
session_start();
function save($name,$username,$password,$email){
		$date=date("Y-m-d H:m:s");
		
		$q = mysql_query("insert into admin_web values('','1','$name','$date','$email','$username','$password')");
		$result = header('Location: ../../admin.php?page=admin/view/admin');				
		return $result;
	}
	
	
	
	function edit($name, $username, $password, $email) {
	
			
		if($foto==""){
		mysql_query("UPDATE  `admin` SET  `name` =  '$name' , `username` = 'username' `password` = '$password' WHERE id_user='$id_user'");
		}else{
			$a = mysql_query("select * from admin_web where id_user='$id_user'");
				$b = mysql_fetch_object($a);
				if(file_exists("../../".$b->img)){
					unlink("../../".$b->img);
				}
		mysql_query("UPDATE  `admin_web` SET  `name` =  '$name' `username` = 'username' `password` = '$password' WHERE id_user = '$id_user' `img` = '$path$foto' WHERE  `id_user` = '$id_user'");
		}
				
		$result = header('Location: ../../admin.php?page=admin/view/admin');

		return $result;
	}

function delete($id_member){
			
	mysql_query("delete from admin_web where id_member = $id_member");
	$result = header("Location: ../../admin.php?page=admin/view/admin");
	
	return $result;
}	

	?>