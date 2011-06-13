<html>
<head><TITLE>Cancelar Cheques 4448</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_nav.php");
conect_nav();
$cheque = $_POST['cheque'];	//Obtiene el Número de Cheque
if(mysql_query("update tbl_cheques_4448 set benef_id=37, monto=0, concepto='', descripcion='', destino='' where cheque=$cheque")) {
	echo ("<p><h3>Cancelación Realizada con Exito</h3>");

	$sql_ch = ("select ch.cheque, ch.fecha, benef.benef, ch.monto, ch.concepto, ch.descripcion, ch.destino from tbl_cheques_4448 ch, tbl_benef benef where ch.benef_id=benef.benef_id and ch.cheque='$cheque'");
	$qry_ch = mysql_query($sql_ch);

//Muestra el Cheque Cancelado
	echo ("<table border='1'><thead><tr> <th>Cheque</th> <th>Fecha</th> <th>Beneficiario</th> <th>Monto</th> <th>Concepto</th> <th>Descripción</th> <th>Destino</th> </tr></thead><tbody>");
	while ($arr_ch = mysql_fetch_array($qry_ch)){
	echo ("<tr> <td align='center'>".$arr_ch['cheque']."</td> <td>".$arr_ch['fecha']."</td> <td>".$arr_ch['benef']."</td> <td align='right'>".number_format($arr_ch['monto'],2)."</td> <td>".$arr_ch['concepto']."</td> <td>".$arr_ch['descripcion']."</td> <td>".$arr_ch['destino']."</td> </tr>");
	}
echo ("</tbody></table>");

	//Menú de Navegación
	echo ("<hr /><p><a id='btn_h' target='_self' href='./presupuesto.html'>Menú Principal</a>");
	echo ("<a id='btn_h' target='_self' href='./cancelar_ch_4448_0.php'>Cancelar Otro Cheque</a></p>");

}else{echo ("<h3>Error al Cancelar Cheque</h3><h4>Favor de Reportar este Error al Administrador del Sistema</h4><form align='center' action='cancelar_ch_4448_1.php' method='post'><input type='hidden' name='cheque' value='$cheque' /><button type='submit'>Aceptar</button></form>");}
?>
</body>
</html>