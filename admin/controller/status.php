<?php
include '../../libraries/lib.php';
include '../model/status.php';

$req = $_GET['req'];
switch($req){
	case save:
	extract($_POST);
	save($status_name);
	break;
	
	case edit:
	$id_status = $_GET['id_status'];
	extract($_POST);
	$status_name = $_POST['status_name'];
	edit($id_status,$status_name);
	
	break;
	
	case delete:
	$id_status = $_GET['id_status'];
	delete($id_status);
	break;
	}
?>