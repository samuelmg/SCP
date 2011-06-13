<?php
function chxp($proy){
include ("fecha.php");
$sql_ch = "select ch.cta_b, ch.cheque, ch.fecha, ben.benef, ch.monto, ch.proy, ch.cta, ch.obs, ch.estatus from tbl_cheques ch, tbl_benef ben where ch.benef_id = ben.benef_id and ch.proy = $proy order by ch.cta_b, ch.cheque";
$qry_ch = mysql_query($sql_ch);

echo ("<table align='center' id='info'><thead><tr> <th>Cta Bancaria</th> <th>Cheque</th> <th>Fecha</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta</th> <th>Observaciones</th> <th>Estatus</th> </tr></thead><tbody>");
$renglon='non';//cambio de color en renglones
while ($arr_ch = mysql_fetch_array($qry_ch)){
	$fecha=$arr_ch['fecha'];
	fecha_info(&$fecha);
	echo ("<tr id='$renglon'> <td>".$arr_ch['cta_b']."</td> <td>".$arr_ch['cheque']."</td> <td>".$fecha."</td> <td id='benef'>".utf8_decode($arr_ch['benef'])."</td> <td id='monto'>".number_format($arr_ch['monto'],2)."</td> <td>".$arr_ch['proy']."</td> <td>".$arr_ch['cta']."</td> <td id='benef'>".$arr_ch['obs']."</td> <td>".$arr_ch['estatus']."</td> </tr>");
	$sum_monto += $arr_ch['monto'];
	if ($renglon=='non'){$renglon='par';}else{$renglon='non';}//cambio de color en renglones
	}
echo ("<tr><td colspan='4'></td><td id='total'>".number_format($sum_monto,2)."</td></tr>");
echo ("</tbody></table>");
}
function chxp_oxcta($proy){//Selecciona los Cheques del Proyecto y los ordena x Cuenta
include ("fecha.php");
echo ("<table align='center' id='info'><thead><tr> <th>Cta Bancaria</th> <th>Cheque</th> <th>Fecha</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta</th> <th>Observaciones</th> <th>Estatus</th> </tr></thead><tbody>");
//Obtiene todas las cuentas del proyecto
$sql_cta = "select cta from tbl_quincenas where proy = $proy group by cta";
$qry_cta = mysql_query($sql_cta);
while ($arr_cta = mysql_fetch_array($qry_cta)){
	$cta = $arr_cta['cta'];
	$sql_ch = "select ch.cta_b, ch.cheque, ch.fecha, ben.benef, ch.monto, ch.proy, ch.cta, ch.obs, ch.estatus from tbl_cheques ch, tbl_benef ben where ch.benef_id = ben.benef_id and ch.proy = $proy and ch.cta = $cta order by ch.cta_b, ch.cheque";
	$qry_ch = mysql_query($sql_ch);
	$sum_monto = 0;
	$renglon='non';//cambio de color en renglones
	while ($arr_ch = mysql_fetch_array($qry_ch)){
		$fecha=$arr_ch['fecha'];
		fecha_info(&$fecha);
		echo ("<tr id='$renglon'> <td>".$arr_ch['cta_b']."</td> <td>".$arr_ch['cheque']."</td> <td>".$fecha."</td> <td id='benef'>".utf8_decode($arr_ch['benef'])."</td> <td id='monto'>".number_format($arr_ch['monto'],2)."</td> <td>".$arr_ch['proy']."</td> <td>".$arr_ch['cta']."</td> <td id='benef'>".$arr_ch['obs']."</td> <td>".$arr_ch['estatus']."</td> </tr>");
		$cta = $arr_ch['cta'];
		$sum_monto += $arr_ch['monto'];
		if ($renglon=='non'){$renglon='par';}else{$renglon='non';}//cambio de color en renglones
	}
	if($sum_monto != 0){
		echo ("<tr><td colspan='4'></td><td id='total'>".number_format($sum_monto,2)."</td></tr><tr><td></td></tr>");
	}
}
echo ("</tbody></table>");
}
function chxp_detalle($proy){
include ("fecha.php");
$sql_ch = "select ch.cta_b, ch.cheque, ch.fecha, ben.benef, ch.monto, ch.proy, ch.cta, ch.obs, ch.estatus, ch.responsable from tbl_cheques ch, tbl_benef ben where ch.benef_id = ben.benef_id and ch.proy = '$proy' order by ch.cta_b, ch.cheque";
$qry_ch = mysql_query($sql_ch);

echo ("<table align='center' id='info'><thead><tr> <th>Cta Bancaria</th> <th>Cheque</th> <th>Fecha</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta</th> <th>Observaciones</th> <th>Estatus</th> <th>Responsable</th> </tr></thead><tbody>");
$renglon='non';//cambio de color en renglones
while ($arr_ch = mysql_fetch_array($qry_ch)){
	$fecha=$arr_ch['fecha'];
	fecha_info(&$fecha);
	echo ("<tr id='$renglon'> <td>".$arr_ch['cta_b']."</td> <td>".$arr_ch['cheque']."</td> <td>".$fecha."</td> <td id='benef'>".utf8_decode($arr_ch['benef'])."</td> <td id='monto'>".number_format($arr_ch['monto'],2)."</td> <td>".$arr_ch['proy']."</td> <td>".$arr_ch['cta']."</td> <td id='benef'>".$arr_ch['obs']."</td> <td>".$arr_ch['estatus']."</td> <td>".$arr_ch['responsable']."</td></tr>");
	$sum_monto += $arr_ch['monto'];
	if ($renglon=='non'){$renglon='par';}else{$renglon='non';}//cambio de color en renglones
	}
echo ("<tr><td colspan='4'></td><td id='total'>".number_format($sum_monto,2)."</td></tr>");
echo ("</tbody></table>");
}
?>