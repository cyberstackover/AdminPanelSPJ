<html>
<body>
    <title> Report From Database </title>
<table border=1 align="left">
    <tr>
        <td bgcolor="#b0bbff" align="center">id
        <td bgcolor="#b0bbff" align="center">Nomor SPJ
        <td bgcolor="#b0bbff" align="center">Toko
        <td bgcolor="#b0bbff" align="center">Driver
        <td bgcolor="#b0bbff" align="center">QR Code
        <td bgcolor="#b0bbff" align="center">Verifikasi
        
    </tr>   
<tr>
   
<?php
mysql_connect("localhost","root","");
mysql_select_db("bismillah");

$kolom = 1;
$i = 0;
$sql = mysql_query("SELECT * FROM spj");
$test = "SELECT id FROM spj ORDER BY id_spj DESC"; 
$result = mysql_query($test);

while($data = mysql_fetch_array($sql)){
	$ab = mysql_query("select * from type_product where id = '".$data['type_product']."'");
	$bc = mysql_fetch_object ($ab);
	
    if ($i >= $kolom) {
        echo "<tr></tr>";
        $i = 0;
    }
    $i++;
?>
   <td><?php echo $data[id_spj]; ?> <br>
   <td><?php echo $data[no_spj]; ?> <br>
      <td class="td"><img src="<?php echo $data['img_qr'] ?>" height="100" /></td>
   <td><?php echo $bc->nama; ?> <br>
    
   
  
<?php
}
?>
</tr>
<br/>


  </body>              
</table>
</html>