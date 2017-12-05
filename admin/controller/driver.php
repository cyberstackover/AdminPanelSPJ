<?php
include '../../libraries/lib.php';
include '../model/driver.php';

$req = $_GET['req'];
switch($req){
	case save:
	extract($_POST);
	$address = "admin.php?page=admin/view/".$name;
	save($name,$email);
	break;
	
	case edit:
	$uid = $_GET['uid'];
	extract($_POST);
	$name = $_POST['name'];
	$email = $_POST['email'];
	edit($uid,$email);
	
	break;
	
	case delete:
	$uid = $_GET['uid'];
	delete($uid);
	break;
	}
?>