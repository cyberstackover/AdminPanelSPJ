

<div class="isi_tab">
<div class="judul_tab">Menu</div>
<div id="lpanela">
	<?php
    $u = mysql_query("select * from sidebar order by nama ASC");
	while($v = mysql_fetch_array($u)){
	?>
    <div class="fpanela" ><a href="<?php echo $v['link']; ?>"><?php
	$x = explode("_",$v['nama']); 
	$y = count($x);
	for($i=0; $i<=$y; $i++){
	echo $x[$i]." ";
	}  
	?></a></div>
<?php
	}
?>
</div>  
</div>


