<html>
<head><TITLE>Cancelar Cheque 4448</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_nav.php");
conect_nav();
$cheque = $_POST['cheque'];	//Obtiene el Número de Cheque

$sql_ch = ("select ch.cheque, ch.fecha, benef.benef, ch.monto, ch.concepto, ch.descripcion, ch.destino from tbl_cheques_4448 ch, tbl_benef benef where ch.benef_id=benef.benef_id and ch.cheque='$cheque'");
$qry_ch = mysql_query($sql_ch);

echo ("<table border='1'><thead><tr> <th>Cheque</th> <th>Fecha</th> <th>Beneficiario</th> <th>Monto</th> <th>Concepto</th> <th>Descripción</th> <th>Destino</th> </tr></thead><tbody>");
while ($arr_ch = mysql_fetch_array($qry_ch)){
	echo ("<tr> <td align='center'>".$arr_ch['cheque']."</td> <td>".$arr_ch['fecha']."</td> <td>".$arr_ch['benef']."</td> <td align='right'>".number_format($arr_ch['monto'],2)."</td> <td>".$arr_ch['concepto']."</td> <td>".$arr_ch['descripcion']."</td> <td>".$arr_ch['destino']."</td> </tr>");
	$sum_monto += $arr_ch['monto'];
	}
echo ("<tr><td></td><td></td><td></td><td>".number_format($sum_monto,2)."</td></tr>");
echo ("</tbody></table>");

echo ("<p align='center'><table><tr><td>¿Esta seguro que desea Cancelar este Cheque?</td>");
echo ("<td><a a target='_self' href='./presupuesto.html'>NO (Menú Principal)</a></td>");
echo ("<td><form action='cancelar_ch_4448_2.php' method='post'><input type='hidden' name='cheque' value='$cheque' /><button type='submit'>CANCELAR</button></form></td></tr></table></p>");
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./presupuesto.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./cancelar_ch_4448_0.php">Elegir Otro Cheque</a></p>
</body>
</html>