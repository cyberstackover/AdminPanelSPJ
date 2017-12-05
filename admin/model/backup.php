<?php
session_start();
function product_save($product_name, $desc, $price, $foto, $tmp_foto, $path, $type_product){
		
		
				$q = mysql_query("insert into products values('','$product_name','$desc','$price','$path$foto','$type_product')");
				move_uploaded_file($tmp_foto, "../../".$path.$foto);
			
			$result = header('Location: ../../admin.php?page=admin/view/backup');
			
	
		return $result;
	}
function product_edit($product_name, $desc, $price, $foto, $tmp_foto, $path, $id_product, $type_product){

		
		if($foto==""){
			mysql_query("UPDATE  `products` SET  `product_name` =  '$product_name',
`desc` =  '$desc',
`price` =  '$price', `type_product` = '$type_product' WHERE  `id_product` = '$id_product' ");
		}else{
			$a = mysql_query("select * from products where id_product='$id_product'");
				$b = mysql_fetch_object($a);
				if(file_exists("../../".$b->img)){
					unlink("../../".$b->img);
				}
		mysql_query("UPDATE  `products` SET  `product_name` =  '$product_name',
`desc` =  '$desc',
`price` =  '$price', `img` = '$path$foto', `type_product` = '$type_product' WHERE  `id_product` = '$id_product'");
			move_uploaded_file($tmp_foto, "../../".$path.$foto);
		}
							
		$result = header("Location: ../../admin.php?page=admin/view/backup");

		return $result;
	}

function delete($id_product){
				$a = mysql_query("select * from products where id_product='$id_product'");
				$b = mysql_fetch_object($a);
				if(file_exists("../../".$b->img)){
					unlink("../../".$b->img);
				}
	mysql_query("delete from products where id_product = $id_product");
	$result = header("Location: ../../admin.php?page=admin/view/backup");
	
	return $result;
}	

?>