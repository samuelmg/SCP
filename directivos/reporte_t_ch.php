<html>
<head><TITLE>Reporte Transferencias - Cheques</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include ("../script/conect_usr.php");
conect_usr();
echo ("<h3>Reporte de Transferencias - Cheques</h3>");

$sql_proy = "select proy from tbl_proyectos where proy > 0";
$qry_proy = mysql_query($sql_proy);

while ($arr_proy = mysql_fetch_array($qry_proy)){
	$proy = $arr_proy['proy'];
	echo ("$proy <br>");

	echo ("<table id='info' border='1' width='90%'><thead><tr> <th>Transferencia</th> <th>Invoice</th> <th>Fecha</th> <th>Monto</th> <th>Descripción</th> <th>Proyecto</th> <th>Desc Invoice</th> <th>Cta Bancaria</th> </tr></thead> <tbody>");
	$sql_t = "select t, invoice, fecha, monto, d_t, proy, d_inv, cta_b from tbl_transferencias where proy = '$proy' and fecha < '2007-07-01'";
	$qry_t = mysql_query($sql_t);
	$total_t = 0;
	while ($arr_t = mysql_fetch_array($qry_t)){
		echo ("<tr> <td>".$arr_t['t']."</td> <td>".$arr_t['invoice']."</td> <td>".$arr_t['fecha']."</td> <td id='monto'>".number_format($arr_t['monto'],2)."</td> <td>".$arr_t['d_t']."</td> <td>".$arr_t['proy']."</td> <td>".$arr_t['d_inv']."</td> <td>".$arr_t['cta_b']."</td> </tr>");
		$monto_t = $arr_t['monto'];
		$total_t += $monto_t;
	}
	echo ("<tr><td colspan='3'></td><td id='total'>".number_format($total_t,2)."</td><td colspan='4'</tr></tbody></table>");

	echo ("<table id='info' border='1'><thead><tr> <th>Fecha</th> <th>Cta Bancaria</th> <th>Cheque</th> <th>Proyecto</th> <th>Cuenta</th> <th>Beneficiario</th> <th>Monto</th> <th>Observaciones</th> <th>ID</th> <th>Estatus</th> <th>Oficio Comp</th> <th>Responsable</th> </tr></thead> <tbody>");
	$sql_ch = "select c.fecha, c.cta_b, c.cheque, c.proy, c.cta, b.benef, c.monto, c.obs, c.id, c.estatus, c.oficio, c.responsable from tbl_cheques c, tbl_benef b where c.benef_id=b.benef_id and c.proy = '$proy'";
	$qry_ch = mysql_query($sql_ch);
	$total_ch = 0;
	while ($arr_ch = mysql_fetch_array($qry_ch)){
		echo ("<tr> <td>".$arr_ch['fecha']."</td> <td>".$arr_ch['cta_b']."</td> <td>".$arr_ch['cheque']."</td> <td>".$arr_ch['proy']."</td> <td>".$arr_ch['cta']."</td> <td>".$arr_ch['benef']."</td> <td>".number_format($arr_ch['monto'],2)."</td> <td>".$arr_ch['obs']."</td> <td>".$arr_ch['id']."</td> <td>".$arr_ch['estatus']."</td> <td>".$arr_ch['oficio']."</td> <td>".$arr_ch['responsable']."</td> </tr>");
		$monto_ch = $arr_ch['monto'];
		$total_ch += $monto_ch;
	}
		echo ("<tr><td colspan='6'></td><td id='total'>".number_format($total_ch,2)."</td><td colspan='5'</tr></tbody></table>");
	echo ("<hr><br />");
}
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./directivos.html">Menú Principal</a></p>
</body>
</html>