<?php
include '../../libraries/lib.php';
include '../model/sidebar.php';

$req = $_GET['req'];
switch($req){
	case save:
	extract($_POST);
	$link = "admin.php?page=admin/view/".$nama;
	save($nama,$link);
	break;
	
	case edit:
	$id = $_GET['id'];
	extract($_POST);
	$nama = $_POST['nama'];
	$link = "admin.php?page=admin/view/".$nama;
	edit($id,$nama,$link);
	
	break;
	
	case delete:
	$id = $_GET['id'];
	delete($id);
	break;
	}
?>