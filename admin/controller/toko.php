<?php
include '../../libraries/lib.php';
include '../model/toko.php';

$req = $_GET['req'];
switch($req){
	case save:
	extract($_POST);
	$address = $_POST['address'];
	save($name,$address,$email);
	break;
	
	case edit:
	$uid = $_GET['uid'];
	extract($_POST);
	$name = $_POST['name'];
	$address = $_POST['address'];
	$email = $_POST['email'];
	edit($uid,$name,$address,$email);
	
	break;
	
	case delete:
	$uid = $_GET['uid'];
	delete($uid);
	break;
	}
?>