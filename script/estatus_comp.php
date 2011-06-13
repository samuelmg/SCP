<?php
//Realiza la actaulización del estatus de un cheque
function captura_estatus($_POST){
$cta_b = substr(current($_POST),0,4);
$cheque = substr(current($_POST),5,4);
$estatus = $_POST['estatus'];
$seg = $_POST['seg'];
sql_update($cta_b, $cheque, $estatus, $seg);
$reg = count($_POST)-2; //Numero de Registros por evaluar
for($i=$reg; $i>1; $i--){
	next($_POST);
	$cta_b = substr(current($_POST),0,4);
	$cheque = substr(current($_POST),5,4);
	$estatus = $_POST['estatus'];
	$seg = $_POST['seg'];
	sql_update($cta_b, $cheque, $estatus, $seg);
	}
}
function sql_update($cta_b, $cheque, $estatus, $seg){
if($estatus!=null){
	$sql_update = "update tbl_cheques set estatus='$estatus', seguimiento='$seg' where cta_b='$cta_b' and cheque='$cheque'";
	if(mysql_query($sql_update)){
	}else{echo ("<h3>Error al actualizar</h3> <h4><a href='./estatus_comp_0.php'>Volver a Seleccionar</a></h4>");}
}else{echo ("<h3>Error al actualizar - Campo Vacio</h3> <h4><a href='./estatus_comp_0.php'>Volver a Seleccionar</a></h4>");}
}
//********************************************************************************************************************************************
//Realiza la actaulización del estatus de una transferencia
function captura_estatus_t($_POST){
$no_t = current($_POST);
$estatus = $_POST['estatus'];
$seg = $_POST['seg'];
sql_update_t($no_t, $estatus, $seg);
$reg = count($_POST)-2; //Numero de Registros por evaluar
for($i=$reg; $i>1; $i--){
	next($_POST);
	$no_t = current($_POST);
	$estatus = $_POST['estatus'];
	$seg = $_POST['seg'];
	sql_update_t($no_t, $estatus, $seg);
	}
}
function sql_update_t($no_t, $estatus, $seg){
if($estatus!=null){
	$sql_update = "update tbl_egresos set estatus='$estatus', seguimiento='$seg' where no_t='$no_t'";
	if(mysql_query($sql_update)){
	}else{echo ("<h3>Error al actualizar</h3> <h4><a href='./estatus_comp_t0.php'>Volver a Seleccionar</a></h4>");}
}else{echo ("<h3>Error al actualizar - Campo Vacio</h3> <h4><a href='./estatus_comp_t0.php'>Volver a Seleccionar</a></h4>");}
}
?>