<?php
session_start();
function save($nama, $link){
		
		
			$q = mysql_query("insert into sidebar values('','$nama','$link')");

			$result = header('Location: ../../admin.php?page=admin/view/sidebar');
			
	
		return $result;
	}
	
	function edit($id, $nama, $link) {
	
			
				
		mysql_query("UPDATE  `sidebar` SET  `nama` =  '$nama', `link`='$link' where id='$id'");
				
		$result = header('Location: ../../admin.php?page=admin/view/sidebar');

		return $result;
	}

function delete($id){
			
			
	mysql_query("delete from sidebar where id = $id");
	$result = header("Location: ../../admin.php?page=admin/view/sidebar");
	
	return $result;
}	
	
	?>