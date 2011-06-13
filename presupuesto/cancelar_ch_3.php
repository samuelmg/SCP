<html>
<head><TITLE>Cancelar Cheque</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_nav.php");
conect_nav();
$cta_b = $_POST['cta_b'];	//Obtiene el Número de Cuenta Bancaria
$cheque = $_POST['cheque'];	//Obtiene el Número de Cheque
$i = $_POST['i'];	//Contador de Registros


if($i=='1'){
	if(mysql_query("update tbl_cheques set proy=0, cta=0, monto=0, benef_id=37, cmt='' where cta_b=$cta_b and cheque=$cheque")) {
		echo ("<p><h3>Cancelación Realizada con Exito</h3>");
		consulta($cta_b,$cheque);
	}
	else{
		echo ("<h3>Error al Cancelar Cheque</h3><h4>Favor de Reportar este Error al Administrador del Sistema</h4><form align='center' action='cancelar_ch_2.php' method='post'><input type='hidden' name='cta_b' value='$cta_b' /><input type='hidden' name='cheque' value='$cheque' /><button type='submit' name='aceptar'>Aceptar</button></form>");
	}
	//Menú de Navegación
	echo ("<hr /><p><a id='btn_h' target='_self' href='./presupuesto.html'>Menú Principal</a>");
	echo ("<a id='btn_h' target='_self' href='./cancelar_ch_0.php'>Cancelar Otro Cheque</a></p>");
}
else{
	mysql_query("update tbl_cheques set proy=0, cta=0, monto=0, benef_id=37, cmt='', id='', responsable='' where cta_b=$cta_b and cheque=$cheque");
	echo ("<p><h3>Cancelación Realizada con Exito</h3>");
	if(mysql_query("delete from tbl_cheques where cta_b=$cta_b and cheque=$cheque and cta!=0")){
		echo ("<p><h3>Eliminación de Registros Realizada con Exito</h3>");
		consulta($cta_b,$cheque);
	}else{echo ("<p><h3>Error al Eliminar Registros</h3>");}
	//Menú de Navegación
	echo ("<hr /><p><a id='btn_h' target='_self' href='./presupuesto.html'>Menú Principal</a>");
	echo ("<a id='btn_h' target='_self' href='./cancelar_ch_0.php'>Cancelar Otro Cheque</a></p>");
}

function consulta($cta_b,$cheque){
$sql_ch = ("select ch.cta_b, ch.cheque, ch.fecha, benef.benef, ch.monto, ch.proy, ch.cta from tbl_cheques ch, tbl_benef benef where ch.benef_id=benef.benef_id and ch.cta_b='$cta_b' and ch.cheque='$cheque'");
$qry_ch = mysql_query($sql_ch);
echo ("<table border='1'><thead><tr> <th>Cta Bancaria</th> <th>Cheque</th> <th>Fecha</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta</th> </tr></thead><tbody>");
while ($arr_ch = mysql_fetch_array($qry_ch)){
	echo ("<tr> <td align='center'>".$arr_ch['cta_b']."</td> <td align='center'>".$arr_ch['cheque']."</td> <td>".$arr_ch['fecha']."</td> <td>".$arr_ch['benef']."</td> <td align='right'>".number_format($arr_ch['monto'],2)."</td> <td>".$arr_ch['proy']."</td> <td>".$arr_ch['cta']."</td> </tr>");
}
echo ("</tbody></table>");
}

?>
</body>
</html>