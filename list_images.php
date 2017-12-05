<?php
    $conn = mysql_connect("localhost", "root", "");
    mysql_select_db("bismillah");
    $sql = "SELECT id FROM no_spj ORDER BY id DESC"; 
    $result = mysql_query($sql);
?>
<HTML>
<HEAD>
<TITLE>List BLOB Images</TITLE>

</HEAD>
<BODY>
   <br><br><br><br><br><br><br><br><br><br><br>
<?php
	while($row = mysql_fetch_array($result)) {
	?>          
                
		<img src="file_display.php?id=<?php 
                echo $row["id"]; 
                ?>" />
	
<?php		
	}
    mysql_close($conn);
?>
</BODY>
</HTML>