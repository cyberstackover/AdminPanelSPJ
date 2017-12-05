
<?php 
include 'libraries/edit_lib.php';
include 'libraries/lib.php';

if(isset($_GET['err']) && $_GET['err']==1){ 
?>
<div class="err">Username sudah ada. Isi dengan Username lain</div>
<br />
<?php 
}
?>
<form action="<?php if($halw[0] !="" && $halw[1]!=""){ echo "admin/controller/backup.php?req=edit&$halw[0]=$halw[1]"; }else{ echo "admin/controller/backup.php?req=save"; } ?>" method="post" enctype="multipart/form-data" name="form1" class="form">
  <table width="800" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td width="20%">Nomor SPJ</td>
      <td><input name="product_name" type="text" class="field" id="product_name" value="<?php echo $go->product_name ?>"></td>
    </tr>
    <tr>
      <td width="20%" valign="top">Gambar QR</td>
      <td valign="top">  <?php
	  if($halw[0] !="" && $halw[1]!=""){ ?>
      <img src="<?php echo $go->img; ?>" height="100" /><br />
	  <?php } ?><input type="file" name="foto" id="foto"></td>
    </tr>
    <tr>
      <td valign="top">Toko</td>
      <td valign="top"><textarea name="desc" id="desc" cols="45" rows="5" class="area"><?php echo $go->desc ?></textarea></td>
    </tr>
    <tr>
      <td>Driver</td>
      <td><input name="price" type="text" class="field" id="price" value="<?php echo $go->price ?>"></td>
    </tr>
     <tr>
      <td>Status Verifikasi</td>
      <td><select name="type_product" id="type_product">
      <?php 
	  if($halw[0] !="" && $halw[1]!=""){    
	  $af = mysql_query("select * from type_product where id='".$go->type_product."'");
	  $bf = mysql_fetch_object($af);
	  ?>
      
        <option value="<?php echo $bf->id; ?>"><?php echo $bf->nama; ?></option>
	  	<?php
	  }else{
	  }
	  ?>
      <?php
      $aa = mysql_query("select * from type_product");
	  while($bb = mysql_fetch_array($aa)){
	  ?>
      <option value="<?php echo $bb['id']; ?>"><?php echo $bb['nama']; ?></option>
      <?php
      }
	  ?>
      </select>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
     <?php if($halw[0] !="" && $halw[1]!=""){ ?>
    <tr>
     <td colspan="2" align="left">
       <table width="100%" border="0" cellspacing="0" cellpadding="4">
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
</form>
<br />
<table width="100%" border="0" cellspacing="2" cellpadding="0" class="table">
    <tr>
      <td width="4%" height="30">ID</td>
      <td width="15%">Nomor SPJ</td>
      <td width="29%">Toko</td>
      <td width="11%">Driver</td>
      <td width="9%">QR Code</td>
      <td width="14%" align="center">Status Verifikasi</td>
      <td width="18%" align="center">Config</td>
    </tr>
    <?php
	$key="";
	 if($_POST['hidden_key']){
  $key = "where product_name like '%".$_POST['keyword']."%'"; 
  }
    $a = mysql_query("select * from products ".$key."");
	$i = 1;

	while($b = mysql_fetch_array($a)){	
	$ab = mysql_query("select * from type_product where id = '".$b['type_product']."'");
	$bc = mysql_fetch_object ($ab);
	
	?>
     <?php
    if($i%2==1){ ?>
    <tr class="tr">
      <td height="28" class="td"><a href="admin.php"><?php echo $b['id_product'] ?></a></td>
      <td  class="td"><?php echo $b['product_name'] ?></td>
      <td  class="td"><?php echo $b['desc'] ?></td>
      <td class="td"><?php echo $b['price'] ?></td>
      <td class="td"><img src="<?php echo $b['img'] ?>" height="100" /></td>
      <td  class="td">    <?php echo $bc->nama; ?>     </td>
      <td  class="td">  <a href="javascript:void(0)" title="hapus" onclick="confirm_delete(<?php echo $b['id_product']; ?>,'admin/controller/backup.php?req=delete&id_product=')"><div class="trash"></div></a>
     </td>
    </tr>
    <?php
	}else{
	?>
    <tr class="tr2">
    <td height="28" class="td"><a href="admin.php"><?php echo $b['id_product'] ?></a></td>
      <td  class="td"><?php echo $b['product_name'] ?></td>
      <td  class="td"><?php echo $b['desc'] ?></td>
      <td class="td"><?php echo $b['price'] ?></td>
      <td class="td"><img src="<?php echo $b['img'] ?>" height="100" /></td>
      <td  class="td">      <?php echo $bc->nama; ?>     </td>
      <td  class="td"> <a href="javascript:void(0)" title="hapus" onclick="confirm_delete(<?php echo $b['id_product']; ?>,'admin/controller/backup.php?req=delete&id_product=')"><div class="trash"></div></a>
     </td>
    </tr>
    <?php
	}
	$i++;
	}
	?>
  </table>
