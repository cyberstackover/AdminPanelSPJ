<?php
include 'libraries/edit_lib.php';
include 'libraries/lib.php';
?>
<form name="form1" method="post" action="<?php if($halw[0] !="" && $halw[1]!=""){ echo "admin/controller/toko.php?req=edit&$halw[0]=$halw[1]"; }else{ echo "admin/controller/toko.php?req=save"; } ?>" class="form">
  <table width="800" border="0" cellspacing="0" cellpadding="4">
    <tr>
      <td width="25%">Nama Toko</td>
      <td><input name="name" type="text" id="name" value="<?php echo $go->name ?>" class="field" /></td>
    </tr>
	
	<tr>
      <td width="25%">Alamat</td>
      <td><input name="address" type="text" id="address" value="<?php echo $go->address ?>" class="field" /></td>
    </tr>
	
	<tr>
      <td width="25%">Email</td>
      <td><input name="email" type="text" id="email" value="<?php echo $go->email ?>" class="field" /></td>
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
      <td height="33">ID</td>
      <td>Nama Toko </td>
      <td>Alamat</td>
	   <td>Email</td>
      <td>Config</td>
    </tr>
    <?php
	$key="";
	 if($_POST['hidden_key']){
  $key = "where name like '%".$_POST['keyword']."%'"; 
  }
    $a = mysql_query("select * from toko ".$key." order by uid asc");
	$i = 1;
	while($b=mysql_fetch_array($a)){
		if($i%2==1){
	?>
    <tr class="tr">
      <td class="td"><?php echo $b['uid'] ?></td>
      <td class="td"><?php echo $b['name'] ?></td>
      <td class="td"><?php echo $b['address'] ?></td>
	  <td class="td"><?php echo $b['email'] ?></td>
      <td class="td">
    <a href="javascript:void(0)" onclick="confirm_delete(<?php echo $b['uid'] ?>,'admin/controller/toko.php?req=delete&uid=')"><div class="trash"></div></a>
      <a href="admin.php?page=admin/view/toko&uid=<?php echo $b['uid'] ?>"><div class="edit"></div></a>      </td>
    </tr>
    <?php
		}else{
	?>
       <tr class="tr2">
      <td class="td"><?php echo $b['uid'] ?></td>
      <td class="td"><?php echo $b['name'] ?></td>
      <td class="td"><?php echo $b['address'] ?></td>
	  <td class="td"><?php echo $b['email'] ?></td>
      <td class="td">
       <a href="javascript:void(0)" onclick="confirm_delete(<?php echo $b['uid'] ?>,'admin/controller/toko.php?req=delete&uid=')"><div class="trash"></div></a>
      <a href="admin.php?page=admin/view/toko&uid=<?php echo $b['uid'] ?>"><div class="edit"></div></a>      </td>
    </tr>
    <?php
		} $i++;
	}
	?>
  </table>
