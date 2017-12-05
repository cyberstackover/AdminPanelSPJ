<?php
$hal = $_SERVER['REQUEST_URI'];
$halx = explode("/",$hal);
$haly = explode("&",$halx[4]);
$halw = explode("=",$haly[1]);
if($halw[0]=="err"){
}elseif($halw[0] !="" && $halw[1]!=""){
$squery = mysql_query("select * from $haly[0] where $halw[0] = '$halw[1]'");
$go = mysql_fetch_object($squery);
}
?>