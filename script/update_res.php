<?php
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
$sql_res = "update tbl_cheques set responsable = '$res' where cta_b = $cta_b and cheque = $cheque";
if(mysql_query($sql_res)){
}else{echo ("<h3>Error al actualizar</h3> <h4><a href='./cambio_res_0.php'>Volver a Seleccionar</a></h4>");}
}
?>