<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "bismillah";
$conn = mysql_connect ($host,$user,$pass);
mysql_select_db ($dbname,$conn);
?>

<html>
<body>
<table width="800" border="1" cellspacing="0" cellpadding="0">
<tr>
<th width="101"> id spj </th>
<th width="138"> no spj </th>
<th width="101"> nama toko </th>
<th width="138"> nama driver </th>
<th width="101"> gambar </th>
<th width="138"> status </th>
<th width="138"> waktu </th>
<?php
$sql = mysql_query("SELECT spj.id_spj, spj.no_spj, toko.name AS toko_name, driver.name, spj.img, status.status_name, spj.waktu
FROM spj, toko, driver, 
STATUS WHERE spj.driver_uid = driver.uid
AND spj.toko_uid = toko.uid
AND spj.status_id_status = status.id_status");

while ($result = mysql_fetch_array($sql)) {
	?>
<tr>
<td><?php echo $result["id_spj"] ?></td>
<td><?php echo $result["no_spj"] ?></td>
<td><?php echo $result["toko_name"] ?></td>
<td><?php echo $result["name"] ?></td>
<td><?php echo $result["img"] ?></td>
<td><?php echo $result["status_name"] ?></td>
<td><?php echo $result["waktu"] ?></td>
</tr>
<?php
}
?>
</table>
<body>
</html>