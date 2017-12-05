<?php
include 'libraries/edit_lib.php';
?>

<form name="form1" method="post" action="<?php if($halw[0] !="" && $halw[1]!=""){ echo "admin/controller/admin.php?req=edit&$halw[0]=$halw[1]"; }else{ echo "admin/controller/admin.php?req=save"; } ?>" class="form">
  <table width="800" border="0" cellspacing="0" cellpadding="4">
    <tr>
      <td width="25%">Admin Name</td>
      <td><input name="name" type="text" id="name" value="<?php echo $go->name ?>" class="field" /></td>
    </tr>
    <tr>
      <td width="25%">Username</td>
      <td><input name="username" type="text" id="username" value="<?php echo $go->username ?>" class="field" /></td>
    </tr>
    <tr>
      <td width="25%">Password</td>
      <td><input name="password" type="text" id="password" value="<?php echo $go->password ?>" class="field" /></td>
    </tr>
    <tr>
      <td width="25%">Email</td>
      <td><input name="email" type="text" id="email" value="<?php echo $go->email ?>" class="field" /></td>
    </tr>
    <tr>
      <td valign="top">  <?php
	  if($halw[0] !="" && $halw[1]!=""){ ?>
        <br />
	  <?php } ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <?php if($halw[0] !="" && $halw[1]!=""){ ?>
    <tr>
     <td colspan="2" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="4">
         <tr>
           <td width="69%"><input type="submit" name="button" id="button" value="  Edit  " ></td>           
           <td width="31%"><?php $p = $_GET['page']; ?><a href="admin.php?page=<?php echo $p ?>"><span class="backtoinput">Back To Input</span></a></td>
          </tr>
    </table>    </tr>
    <?php }else{ ?>
    <tr>
      <td colspan="2" align="left"><input type="submit" name="button" id="button" value="Submit" >
      <input type="reset" name="button2" id="button2" value="Reset" ></td>
    </tr>
    <?php } ?>
  </table>
  
</form><br />
<table width="100%" border="0" cellspacing="2" cellpadding="4" class="table">
    <tr>
      <td width="6%">Id</td>
      <td width="29%">Nama Admin </td>
      <td width="16%">Username</td>
      <td width="25%">Email</td>
      <td width="14%">Config</td>
    </tr>
    <?php
	$key="";
	 if($_POST['hidden_key']){
  $key = "and name like '%".$_POST['keyword']."%'"; 
  }
    $a = mysql_query("select * from admin_web where id_member ".$key."");
	$i = 1;
	while($b=mysql_fetch_array($a)){
		if($i%2==1){
	?>
    <tr class="tr">   
      <td class="td"><?php echo $b['id_member'] ?></td>
      <td class="td"><?php echo $b['name'] ?></td>
      <td class="td"><?php echo $b['username'] ?></td>
 	  <td class="td"><?php echo $b ['email'] ?></td>
      <td class="td">
    <a href="javascript:void(0)" onClick="confirm_delete(<?php echo $b['id_member'] ?>,'admin/controller/admin.php?req=delete&id_member=')"><div class="trash"></div></a>
       </td>
  </tr>
<?php
		}else{
	?>
      <tr class="tr2">
      <td class="td"><?php echo $b['id_member'] ?></td>
      <td class="td"><?php echo $b['name'] ?></td>
      <td class="td"><?php echo $b ['username'] ?></td>
      <td class="td"><?php echo $b ['email'] ?></td>
      <td class="td">
       <a href="javascript:void(0)" onClick="confirm_delete(<?php echo $b['id_member'] ?>,'admin/controller/admin.php?req=delete&id_member=')"><div class="trash"></div></a>
        </td>
    </tr>
    <?php
		} $i++;
	}
	?>
  </table>
