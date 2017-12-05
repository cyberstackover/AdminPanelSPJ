<?php
include '../../libraries/lib.php';
include '../model/logout.php';
$id = array($_SESSION["id_login"]);
logout($id);
?>