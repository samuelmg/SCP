<?php
//Se extrae el POST y se llama a la funcion que hace el update
function captura_oficio($_POST){
$cta_b = substr(current($_POST),0,4);
$cheque = substr(current($_POST),5,4);
$oficio = $_POST['oficio'];
sql_update($cta_b, $cheque, $oficio);
$reg = count($_POST)-2; //Numero de Registros por evaluar
for($i=$reg; $i>1; $i--){
	next($_POST);
	$cta_b = substr(current($_POST),0,4);
	$cheque = substr(current($_POST),5,4);
	$oficio = $_POST['oficio'];
	sql_update($cta_b, $cheque, $oficio);
	}
}

function sql_update($cta_b, $cheque, $oficio){
$fecha=getdate();
$d=$fecha['mday'];
$m=$fecha['mon'];
$a=$fecha['year'];
$fecha=$a."-".$m."-".$d;

if($oficio!=null){
	$sql_update = "update tbl_cheques set oficio = '$oficio', fecha_c = '$fecha' where cta_b = $cta_b and cheque = $cheque";
	if(mysql_query($sql_update)){
	}else{echo ("<h3>Error al actualizar</h3> <h4><a href='./captura_oficio_0.php'>Volver a Seleccionar Cheques</a></h4>");}
}else{echo ("<h3>Error al actualizar - Campos Vacio</h3> <h4><a href='./captura_oficio_0.php'>Volver a Seleccionar</a></h4>");}
}

//********************************************************************************************************************************************
//Actualiza el Responsable de una Transferencia
function captura_oficio_t($_POST){
$no_t = current($_POST);
$oficio = $_POST['oficio'];

sql_update_of($no_t, $oficio);
$reg = count($_POST)-1; //Numero de Registros por evaluar

for($i=$reg; $i>1; $i--){
	next($_POST);
	$no_t = current($_POST);
	$oficio = $_POST['oficio'];
	sql_update_of($no_t, $oficio);
	}
}

function sql_update_of($no_t, $oficio){
$fecha=getdate();
$d=$fecha['mday'];
$m=$fecha['mon'];
$a=$fecha['year'];
$fecha=$a."-".$m."-".$d;

$sql_of = "update tbl_egresos set oficio = '$oficio', fecha_c = '$fecha' where no_t = $no_t";
if($oficio!=null){
	if(mysql_query($sql_of)){//Realiza la actulización y verifica si se efectua correctamente
		}else{echo ("<h3>Error al actualizar</h3> <h4><a href='./cambio_res_t0.php'>Volver a Seleccionar</a></h4>");}
	}else{echo ("<h3>Error al actualizar - Campo Vacio</h3> <h4><a href='./cambio_res_t0.php'>Volver a Seleccionar</a></h4>");}
}
?>