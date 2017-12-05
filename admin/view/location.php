<?php
/*
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "bismillah";
$conn = mysql_connect ($host,$user,$pass);
mysql_select_db ($dbname,$conn);
*/
include 'libraries/edit_lib.php';
include 'libraries/lib.php';

?>

<html>
<body>
<br>
<table width="649" border="1" cellspacing="0" cellpadding="0">
<tr>
<th width="32" align="center"> id spj </th>
<th width="93" align="center"> no spj </th>
<th width="155" align="center"> lokasi toko </th>
<th width="162" align="center"> lokasi driver </th>
<th width="44" align="center"> status </th>
<th width="99" align="center"> waktu </th>
<th width="48" align="center">Config</th>
<?php
$sql = mysql_query("SELECT spj.id_spj, spj.no_spj, toko.lat AS toko_lat,toko.lng AS toko_lng, driver.lat AS driver_lat, driver.lng AS driver_lng, spj.img, status.status_name, spj.waktu
FROM spj, toko, driver, 
STATUS WHERE spj.driver_uid = driver.uid
AND spj.toko_uid = toko.uid
AND spj.status_id_status = status.id_status");
while ($result = mysql_fetch_array($sql)) {
?>
<tr>
<td><?php echo $result["id_spj"] ?></td>
<td><?php echo $result["no_spj"] ?></td>
<td>Latitude   <?php echo $result["toko_lat"] ?><br> Longtitude   <?php echo $result["toko_lng"] ?></td>
<td>Latitude   <?php echo $result["driver_lat"] ?> <br> Longtitude <?php echo $result["driver_lng"] ?></td>
<td><?php echo $result["status_name"] ?></td>
<td><?php echo $result["waktu"] ?></td>
 <td  class="td">  <a href="javascript:void(0)" title="hapus" onClick="confirm_delete(<?php echo $b['id_spj']; ?>,'admin/controller/backup.php?req=delete&id_spj=')"><div class="trash"></div></a>
  <a href="admin.php?page=admin/view/products&id_spj=<?php echo $b['id_spj'] ?>"><div class="edit"></div></a></td>
    
</tr>
<?php
}
?>
</table>
</body>
</html>