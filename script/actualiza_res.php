<?php
//Actualiza el Responsable de un Cheque
function update_res($_POST){
$cta_b = substr(current($_POST),0,4);
$cheque = substr(current($_POST),5,4);
$res = $_POST['res'];
sql_update($cta_b, $cheque, $res);
$reg = count($_POST)-2; //Numero de Registros por evaluar
for($i=$reg; $i>1; $i--){
	next($_POST);
	$cta_b = substr(current($_POST),0,4);
	$cheque = substr(current($_POST),5,4);
	$res = $_POST['res'];
	sql_update($cta_b, $cheque, $res);
	}
}
function sql_update($cta_b, $cheque, $res){
$fecha=getdate();
$d=$fecha['mday'];
$m=$fecha['mon'];
$a=$fecha['year'];
$fecha=$a."-".$m."-".$d;

$sql_res = "update tbl_cheques set responsable = '$res', fecha_c = '$fecha' where cta_b = $cta_b and cheque = $cheque";
if($res!=null){
	if(mysql_query($sql_res)){//Realiza la actulización y verifica si se efectua correctamente
	}else{echo ("<h3>Error al actualizar</h3> <h4><a href='./cambio_res_0.php'>Volver a Seleccionar</a></h4>");}
}else{echo ("<h3>Error al actualizar - Campo Vacio</h3> <h4><a href='./cambio_res_0.php'>Volver a Seleccionar</a></h4>");}
}

//********************************************************************************************************************************************
//Actualiza el Responsable de una Transferencia
function update_res_t($_POST){
$no_t = current($_POST);
$res = $_POST['res'];

sql_update_t($no_t, $res);
$reg = count($_POST)-1; //Numero de Registros por evaluar

for($i=$reg; $i>1; $i--){
	next($_POST);
	$no_t = current($_POST);
	$res = $_POST['res'];
	sql_update_t($no_t, $res);
	}
}

function sql_update_t($no_t, $res){
$fecha=getdate();
$d=$fecha['mday'];
$m=$fecha['mon'];
$a=$fecha['year'];
$fecha=$a."-".$m."-".$d;

$sql_res = "update tbl_egresos set responsable = '$res', fecha_c = '$fecha' where no_t = $no_t";
if($res!=null){
	if(mysql_query($sql_res)){//Realiza la actulización y verifica si se efectua correctamente
		}else{echo ("<h3>Error al actualizar</h3> <h4><a href='./cambio_res_t0.php'>Volver a Seleccionar</a></h4>");}
	}else{echo ("<h3>Error al actualizar - Campo Vacio</h3> <h4><a href='./cambio_res_t0.php'>Volver a Seleccionar</a></h4>");}
}
?>