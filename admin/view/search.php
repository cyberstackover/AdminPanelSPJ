<form name="form1" method="post" action="admin.php?page=<?php echo $page; ?>" class="form">
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td height="23" colspan="2" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td height="28" align="center"><input type="text" name="keyword" id="keyword" class="field">
      <input type="hidden" name="hidden_key" id="hidden_key" value="ok" />
      <input type="submit" name="search" id="search" value=" Search " /></td>
     
    </tr>
  </table>
</form>
<?php
$x=mysql_connect("localhost","root","") or die('sory');
mysql_select_db("bismillah",$x);
?>
