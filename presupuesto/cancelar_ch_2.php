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

$sql_ch = ("select ch.cta_b, ch.cheque, ch.fecha, benef.benef, ch.monto, ch.proy, ch.cta from tbl_cheques ch, tbl_benef benef where ch.benef_id=benef.benef_id and ch.cta_b='$cta_b' and ch.cheque='$cheque'");
$qry_ch = mysql_query($sql_ch);
$i=0;//Contador de Registros
echo ("<table border='1'><thead><tr> <th>Cta Bancaria</th> <th>Cheque</th> <th>Fecha</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta</th> </tr></thead><tbody>");
while ($arr_ch = mysql_fetch_array($qry_ch)){
	echo ("<tr> <td align='center'>".$arr_ch['cta_b']."</td> <td align='center'>".$arr_ch['cheque']."</td> <td>".$arr_ch['fecha']."</td> <td>".$arr_ch['benef']."</td> <td align='right'>".number_format($arr_ch['monto'],2)."</td> <td>".$arr_ch['proy']."</td> <td>".$arr_ch['cta']."</td> </tr>");
	$sum_monto += $arr_ch['monto'];
	$i+=1;
	}
echo ("<tr><td></td><td></td><td></td><td></td><td>".number_format($sum_monto,2)."</td></tr>");
echo ("</tbody></table>");

echo ("<p align='center'><table><tr><td>¿Esta seguro que desea Cancelar este Cheque?</td>");
echo ("<td><a a target='_self' href='./admin.html'>NO (Menú Principal)</a></td>");
echo ("<td><form action='cancelar_ch_1.php' method='post'><input type='hidden' name='cta_b' value='$cta_b' /><button type='submit' name='cambiar'>Cambiar de Cheque</button></form></td>");
echo ("<td><form action='cancelar_ch_3.php' method='post'><input type='hidden' name='cta_b' value='$cta_b' /><input type='hidden' name='cheque' value='$cheque' /><input type='hidden' name='i' value='$i' /><button type='submit'>SI CANCELAR</button></form></td></tr></table></p>");
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./presupuesto.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./cancelar_ch_0.php">Cambiar Cuenta Bancaria</a></p>
</body>
</html>