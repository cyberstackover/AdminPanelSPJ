<?php
include '../../libraries/lib.php';
include '../model/backup.php';

$req = $_GET['req'];
switch($req){
	case save:
		extract($_POST);
	
		$foto = $_FILES['foto']['name'];
		$tmp_foto = $_FILES['foto']['tmp_name'];
		$path = "img/img_product/";
		
		product_save($product_name, $desc, $price, $foto, $tmp_foto, $path, $type_product);
	break;
	
	case edit:
		extract($_POST);
		
		$id_product = $_GET['id_product'];
		$foto = $_FILES['foto']['name'];
		$tmp_foto = $_FILES['foto']['tmp_name'];
		$path = "img/img_product/";
		product_edit($product_name, $desc, $price, $foto, $tmp_foto, $path, $id_product, $type_product);
	break;
	
	case delete:
		$id_product = $_GET['id_product'];
		delete($id_product);
		
	break;
}
?>