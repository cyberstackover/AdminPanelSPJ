<?php
session_start();
$con = mysql_connect("localhost","root","");
mysql_select_db("bismillah",$con);

$title 			= "  Semen Indonesia ";
$path 			= "index/view/";
$nav_atas 		= $path.'nav_atas.php';
$header 		= $path.'header.php';
$menu 			= $path.'menu.php';
$content 		= $path.'content.php';
$event	 		= $path.'event.php';
$footer 		= $path.'footer.php';
$layout_bawah 	= $path.'layout_bawah.php';
$copyright 		= $path.'copyright.php';
$bawah 			= $path.'bawah.php';

$l = "index/controller/";
?>