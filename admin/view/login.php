
<link href="../../css/style_admin.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style7 {color: #FFFFFF; font-family: "Courier New", Courier, monospace; font-weight: bold; }
.style11 {color: #FFFFFF; font-family: "Courier New", Courier, monospace; }
.style12 {
	font-family: Arial, Helvetica, sans-serif;
	color:#CCCCCC;
}
-->
</style>
<td class="login">
<form name="form1" method="post" action="admin/controller/login.php">
  <center>
</center> 
  <table width="101" border="0" align="center" cellpadding="4" cellspacing="0" class="tabel_login">
  <?php
  if(isset($_GET['err']) && $_GET['err']=1){ ?>
    <tr>
    <td colspan="2" class="err_log" style="color:#FFF">Username atau Pasword Salah</td>
    <td colspan="2" height="30">&nbsp;</td>
    </tr>
    <tr><td>&nbsp;</td></tr>
      <?php } ?>
    <tr>
      <td>Username</td>
      <td><input type="text" name="username" id="username" class="field"></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><input type="password" name="password" id="password" class="field"></td>
    </tr>
    <tr height="10">
     
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Submit" class="button"><br /><br><a href="index.php">Back To Dashboard</a></td>
    </tr>
  </table>
</form>
