<?php
function captura_oficio($_POST){
$cta_b = substr(current($_POST),0,4);
$cheque = substr(current($_POST),5,4);
$oficio = $_POST['oficio'];
$oficio = $_POST['d'];
$oficio = $_POST['m'];
$oficio = $_POST['a'];
$fecha=$a."-".$m."-".$d;
sql_update($cta_b, $cheque, $d, $m, $a);
$reg = count($_POST)-2; //Numero de Registros por evaluar
for($i=$reg; $i>1; $i--){
	next($_POST);
	$cta_b = substr(current($_POST),0,4);
	$cheque = substr(current($_POST),5,4);
	$oficio = $_POST['oficio'];
	$oficio = $_POST['d'];
	$oficio = $_POST['m'];
	$oficio = $_POST['a'];
	$fecha=$a."-".$m."-".$d;
	sql_update($cta_b, $cheque, $oficio);
	}
}

function sql_update($cta_b, $cheque, $fecha){
$sql_update = "update tbl_cheques set fecha_c = '$fecha' where cta_b = $cta_b and cheque = $cheque";
if(mysql_query($sql_update)){
}else{echo ("<h3>Error al actualizar</h3> <h4><a href='./captura_fecha_0.php'>Volver a Seleccionar</a></h4>");}
}
?>