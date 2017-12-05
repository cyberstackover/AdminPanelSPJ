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

<form method="post" action="admin/view/simpandata.php">
<table>
<tr>
<td>Nomor SPJ</td><td> : </td><td><input type="text" name="no_spj" required/></td></tr>
<tr>
</table>

Pilih Toko : 
<select name="status">
    <option>--- Pilih Toko ---</option>
    <?php
  
    $sql = mysql_query("SELECT * FROM toko ORDER BY name ASC");
    if(mysql_num_rows($sql) != 0){
        while($row = mysql_fetch_assoc($sql)){
            echo '<option>'.$row['name'].'</option>';
        }
    }
    ?>
</select>
<br>
Pilih Driver   : 
<select name="status">
    <option>--- Pilih Driver ---</option>
    <?php
  
    $sql = mysql_query("SELECT * FROM driver ORDER BY name ASC");
    if(mysql_num_rows($sql) != 0){
        while($row = mysql_fetch_assoc($sql)){
            echo '<option>'.$row['name'].'</option>';
        }
    }
    ?>
</select>
</p>


<table>
<tr>
<td>Upload Gambar</td><td> : </td><td><input type="file" name="foto" required/></td></tr>
<tr>
</table>
 


Pilih Status : 
<select name="status">
    <option>--- Pilih Status ---</option>
    <?php
  
    $sql = mysql_query("SELECT * FROM status ORDER BY status_name ASC");
    if(mysql_num_rows($sql) != 0){
        while($row = mysql_fetch_assoc($sql)){
            echo '<option>'.$row['status_name'].'</option>';
        }
    }
    ?>
</select>

</p>
<br>
<input type="submit" value="Simpan" > 
</form>
<br>
<table width="677" border="1" cellspacing="0" cellpadding="0">
<tr>
<td width="5%" align="center"> id spj </td>
<td width="15%" align="center"> no spj </td>
<td width="29%" align="center"> nama toko </td>
<td width="11%" align="center"> nama driver </td>
<td width="9%" align="center"> gambar </td>
<td width="9%" align="center"> status </td>
<td width="14%" align="center"> waktu </td>
<td width="18%" align="center">Config</td>
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
<td class="td"><img src="<?php echo $result['img'] ?>" height="100" /></td>
<td><?php echo $result["status_name"] ?></td>
<td><?php echo $result["waktu"] ?></td>
 <td  class="td">  <a href="javascript:void(0)" title="hapus" onclick="confirm_delete(<?php echo $b['id_spj']; ?>,'admin/controller/backup.php?req=delete&id_spj=')"><div class="trash"></div></a>
  <a href="admin.php?page=admin/view/products&id_spj=<?php echo $b['id_spj'] ?>"><div class="edit"></div></a></td>
     </td>
</tr>
<?php
}
?>
</table>
</body>
</html>