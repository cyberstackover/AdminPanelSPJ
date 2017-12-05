// JavaScript Document

function confirm_delete(id,control){
	var a = confirm("Anda yakin ingin menghapus record ini ?");
	if(a==true){
		window.location.href = control+id;
	}
}
function confirm_act(id,control){
	var a = confirm("Anda yakin ingin mengaktifkan data ini ?");
	if(a==true){
		window.location.href = control+id;
	}
}
function confirm_jam(id,control){
	var a = confirm("Anda yakin Data kredit macet?");
	if(a==true){
		window.location.href = control+id;
	}
}
function confirm_acc(id,control){
	var a = confirm("Anda yakin ingin ACC pengajuan ini ?");
	if(a==true){
		window.location.href = control+id;
	}
}

function confirm_delete_session(id,control){
	var a = confirm("Anda yakin ingin menghapus record ini ?");
	if(a==true){
		window.location.href = control+id;
	}
}
function vendor(opsi,field,req){
	if(req==1){
		window.location = "http://localhost/motorloan/admin/controller/proses.php?req=3&"+field +"="+opsi.value;
	}else if(req==2){
		window.location = "http://localhost/motorloan/index/controller/proses.php?req=1&"+field +"="+opsi.value;
	}else if(req==3){
		window.location = "http://localhost/motorloan/index/controller/proses.php?req=5&"+field +"="+opsi.value;
	}
}
function vendorx(opsi,field){
		window.location = "http://localhost/motorloan/index/controller/proses.php?req=5&"+field +"="+opsi.value;
}

function harga_motor(opsi,field,req){
	if(req==1){
		window.location = "http://localhost/motorloan/admin/controller/proses.php?req=2&"+field +"="+opsi.value;
	}else{
		window.location = "http://localhost/motorloan/index/controller/proses.php?req=2&"+field +"="+opsi.value;
	}
}
function angsur(opsi,field){
	window.location = "http://localhost/motorloan/admin/controller/payment.php?req=6&"+field +"="+opsi.value;
}
function submit_form(ff){
	r = document.getElementById(ff);
	r.submit();
	}
	
