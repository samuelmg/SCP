<html>
<head><TITLE>Captura de Egresos</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_nav.php");
conect_nav();

$tipo=$_POST['tipo'];
$cta_b=$_POST['cta_b'];
$no_t=$_POST['no_t'];
settype($_POST['benef_id'],integer);
$benef_id=$_POST['benef_id'];
$monto=$_POST['monto'];
$proy=$_POST['proy'];
$cta=$_POST['cta'];
$id=$_POST['id'];
$cmt=$_POST['cmt'];
$d=$_POST['d'];
$m=$_POST['m'];
$a=$_POST['a'];
$fecha=$a."-".$m."-".$d;

//Validación para proyectos participables
$sql_proy = "select proy from tbl_proyectos p, tbl_fondos f where p.fondo=f.fondo and f.tipo='PAR'";
$qry_proy = mysql_query($sql_proy);
while ($arr_proy = mysql_fetch_array($qry_proy)){
	if ($proy == $arr_proy['proy']){
		$sql_par = "select id from tbl_participables where proy = '$proy' and id = '$id'";
		$qry_par = mysql_query($sql_par);
		$arr_par = (mysql_fetch_array($qry_par));
		if ($id != $arr_par['id'] || $id == ''){//Si el ID no está registrado cambia el valor del monto para generar un error
			$monto=0;
		}
	}
}

if ($monto!=0 && $no_t!=''){
if (checkdate($m,$d,$a)){ //Validación de Fecha
	if(valid_proy_cta()){//si la funcion devuelve TRUE llama a INSERT
		insert();
	}else{echo ("<h3>El Proyecto no Existe o no tiene la Cuenta</h3> <h4><a href='./captura_egresos.php'>Volver al Formulario</a></h4>");}
}else{echo ("<h3>Fecha Incorrecta</h3> <h4><a href='./captura_egresos.php'>Volver al Formulario</a></h4>");}
}else{echo ("<h3>Monto o Transferencia sin capturar</h3> <h4><a href='./captura_egresos.php'>Volver al Formulario</a></h4>");}

//Funcion que realiza el insert en la Base de Datos
function insert(){
global $fecha, $cta_b, $no_t, $benef_id, $monto, $proy, $cta, $id, $cmt;
if(mysql_query("insert into tbl_egresos values ('$fecha','$tipo','$monto','$no_t','$benef_id','$cta_b','$proy','$cta','$id','$cmt','','','','','')")){//Comprueba insert
	echo ("<p><h3>Captura realizada con Exito</h3>");
	echo ("<table cellspacing='4'><thead><tr><th>Fecha</th> <th>Cuenta Bancaria</th> <th>No. Transferencia</th> <th>Monto</th> <th>ID Beneficiario</th> <th>Proyecto</th> <th>Cuenta (OG)</th> <th>Comentario</th> <th>Invoice</th>  </tr></thead> <tbody align='center'><tr> <td>".$fecha."</td> <td>".$cta_b."</td> <td>".$no_t."</td> <td>".number_format($monto,2)."</td> <td>".$benef_id."</td> <td>".$proy."</td> <td>".$cta."</td> <td>".$cmt."</td> <td>".$d_inv."</td> </tr></tbody></table></p>");

	//Menú de Navegación
	echo ("<hr /><p><a id='btn_h' target='_self' href='./presupuesto.html'>Menú Principal</a>");
	echo ("<a id='btn_h' target='_self' href='./captura_egresos.php'>Capturar Otro Egreso</a></p>");
}else {echo ("<h3>Error de Captura</h3> <h4><a href='./captura_ingresos.php'>Volver al Formulario</a></h4>");}
}

//Funcion que valida un Proyecto y Cuenta (OG)
function valid_proy_cta(){
global $proy, $cta;
	$sql_proy_cta = "select proy, cta from tbl_quincenas where proy = '$proy' and cta = '$cta' group by cta";
	$qry_proy_cta = mysql_query($sql_proy_cta);
	$res_proy_cta = mysql_fetch_array($qry_proy_cta);
	if ($res_proy_cta['proy'] == $proy && $res_proy_cta['cta'] == $cta){//Validación de Proyecto y Cuenta
		return true;
	}else {return false;}
}
?>
</body>
</html>