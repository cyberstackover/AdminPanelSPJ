<?php
include '../../libraries/lib.php';
include '../model/login.php';

$username = $_POST['username'];
$password = $_POST['password'];

login($username, $password);

?>