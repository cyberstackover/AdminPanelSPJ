<?php
session_start();
$con = mysql_connect("localhost","root","");
mysql_select_db("bismillah",$con);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link type='text/css' href='css/style_admin.css' rel='stylesheet' media='all' />
<link type="text/css" href="css/form.css" rel="stylesheet" media="all" />
<link rel="icon" type="image/x-icon" href="img/logo.ico" />
<script type="text/javascript" src="js/validasi_admin.js"></script> 
<script type="text/javascript" src="js/function.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
 if($_SESSION['id_login_a']==""){ include 'admin/view/login.php';
 ?>
 <link rel="stylesheet" media="all" href="css/style_admin.css" />

<title>Login Page</title>
 <?php
 }else{
 ?>
<title>.:: Administrator Page ::.</title>
<style type="text/css">
<!--
body {
	background-color: #e7e5e4;
	background:url(img/bg.jpg);
	background-repeat: repeat;
	background-position: left top;
	margin:0;
}
-->
</style>


</head>
	
<body leftmargin="0" rightmargin="0">
<table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>

    <td valign="top" width="500"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td>
          <div class="menu">
        <?php
		$id = $_SESSION['id_login_a'];
		$ax = mysql_query("select * from admin_web where id_member='$id'");
		$bx = mysql_fetch_object($ax);
		?>
		
	
          <div class="welcome">Welcome <?php if($_SESSION['id_login_a']!=""){ echo ucfirst($bx->name).", You are Admin"; }?> </div>
          <div class="logout"><span class="putih"><a href="<?php echo "admin/controller/logout.php" ?>">Logout</a></span></div>
        </div></td>
        </tr>
      <tr>
        <td height="490" valign="top" class="tengah">
			
		 
        <div class="judul_hal">
            <?php
        $a_hal = $_GET['page'];
		if($a_hal){
			$q_hal = explode("/",$a_hal);
			$b_hal = explode("_",$q_hal[2]);
			echo strtoupper($b_hal[0]." ".$b_hal[1]." ".$b_hal[2]);
		}else{
			echo strtoupper("BACKUP");
		}
		?>
        </div>
        <div class="tengah2">
            <?php
      function MyInclude($file) {
        if(file_exists($file)) {
           require_once($file);
        } else {
            throw(new Exception('Halaman tidak ditemukan'));
        }
    }
          

						   $page = $_GET['page'];
						  if($page){
							  try{
						  	MyInclude($page.".php");
										  		}
									catch(Exception $e){
										echo "<div class=\"judul\">".$e->getMessage()."</div>";
										
										}
						  } else {
						  	require_once("admin/view/backup.php");
						  }
						?>
       <br />  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="right"><a href="javascript:history.back();"><span class="button">Back</span></a>
<br /></td>
  </tr>
</table><br /><br /> <table width="100%" border="0" cellspacing="0" cellpadding="2">
            <tr>
              <td width="85%"><?php include 'admin/view/search.php'; ?>
           </td>
              <td width="15%" align="right"><input type="hidden" name="hidden_key" id="hidden_key" value="ok" />
                <a href="admin.php?page=<?php $p = $_GET['page']; echo $p ?>"><span class="refresh">Refresh</span></a></td>
            </tr>
        </table>
        </div></td>
      </tr>
      <tr>
        <td height="20" align="center" class="footer">Copyright Teknik Komputer @ 2014</td>
      </tr>
      <tr>
        <td height="20" align="center" class="footer">&nbsp;</td>
      </tr>
    </table></td>
        <td valign="top"><table width="200" height="115" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><div class="banner"></div>
  </tr>
</table>
<?php    
	include 'admin/view/menu2.php';
	?></td>
  </tr>
</table>


</body>
</html>
<?php
}
?>
