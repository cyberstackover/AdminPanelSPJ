<?php
include '../../libraries/lib.php';
include '../model/admin.php';

$req = $_GET['req'];
switch($req){
	case save:
	extract($_POST);
	$foto = $_FILES['foto']['name'];
		$tmp_foto = $_FILES['foto']['tmp_name'];
		$path = "img/img_member/";
	
	save($name,$username,$password,$email,$foto, $tmp_foto, $path);
	break;
	
	case edit:
	$id = $_GET['id_member'];
	extract($_POST);
	$name = $_POST['name'];
	$password = $_POST ['password'];
	edit($id_user,$name,$username,$password,$email,$foto);
	
	break;
	
	case delete:
	$id_member = $_GET['id_member'];
	delete($id_member);
	break;
	}
?>