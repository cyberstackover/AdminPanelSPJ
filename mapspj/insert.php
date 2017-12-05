<html>
<body bgcolor="#dbe8f0" >
<link rel="icon" type="image/x-icon" href="../img/logo.ico" />
<img  src="img/succes.png" width="232" height="225" > 
<h4>
<?php 


mysql_connect("localhost", "root", "") or die("Connection Failed"); 
mysql_select_db("bismillah")or die("Connection Failed"); 

$unique_id = $_POST['unique_id']; 
$name = mysql_real_escape_string ($_POST['name']); 
$address = mysql_real_escape_string ($_POST['address']); 
$lat = $_POST['lat']; 
$lng = $_POST['lng']; 
$email = $_POST['email']; 
$encrypted_password = $_POST['encrypted_password'];
$salt = $_POST['salt']; 
$created_at = $_POST['created_at']; 
$updated_at = $_POST['updated_at'];  

$query = "INSERT INTO toko(unique_id,name,address,lat,lng,email,encrypted_password,salt,created_at,updated_at)
VALUES('','$name','$address','$lat','$lng','','','','','')"; 


if(mysql_query($query)){ 
	echo "Success to insert";
	echo "<a href=\"javascript:history.go(-1)\"><br>Back</a>";
	} 
else{ echo "fail" . mysql_error();
	echo "<a href=\"javascript:history.go(-1)\"><br>Back</a>";
} 


?>

</body>
</html>