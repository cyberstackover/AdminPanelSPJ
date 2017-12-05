<?php
session_start();
function save($status_name){
		
		
			$q = mysql_query("insert into status values('','$status_name')");

			$result = header('Location: ../../admin.php?page=admin/view/status');
			
	
		return $result;
	}
	
	function edit($id_status, $status_name) {
	
			
				
		mysql_query("UPDATE  `status` SET  `nama` =  '$status_name' where id_status='$id_status'");
				
		$result = header('Location: ../../admin.php?page=admin/view/status');

		return $result;
	}

function delete($id_status){
			
			
	mysql_query("delete from status where id_status = $id_status");
	$result = header("Location: ../../admin.php?page=admin/view/status");
	
	return $result;
}	
	
	?>