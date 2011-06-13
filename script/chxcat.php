<?php
function ch_transito($seleccion){
$sql_transito = "select ch.cta_b, ch.cheque, ch.fecha, b.benef, ch.monto, ch.proy, ch.cta from tbl_cheques ch, tbl_proyectos p, tbl_benef b where ch.proy=p.proy and ch.benef_id=b.benef_id and (oficio is null or oficio = '') and (responsable is null or responsable = '')";
$qry_transito = mysql_query($sql_transito);

echo ("<table id='info' align='center' border='1'><thead><tr><th colspan='7'>Cheques en Tránsito</th></tr><tr> <th>Cta Bancaria</th> <th>Cheque</th> <th>Fecha</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta</th> </tr></thead><tbody>");
$renglon='non';//cambio de color en renglones
while ($arr_transito = mysql_fetch_array($qry_transito)){
	echo ("<tr id='$renglon'> <td>".$arr_transito['cta_b']."</td> <td>".$arr_transito['cheque']."</td> <td>".$arr_transito['fecha']."</td> <td id='benef'>".utf8_decode($arr_transito['benef'])."</td> <td id=='monto'>".number_format($arr_transito['monto'],2)."</td> <td>".$arr_transito['proy']."</td> <td>".$arr_transito['cta']."</td> </tr>");
	$sum_monto += $arr_transito['monto'];
	if ($renglon=='non'){$renglon='par';}else{$renglon='non';}//cambio de color en renglones
	}
echo ("<tr><td colspan='4'></td><td id='total'>".number_format($sum_monto,2)."</td><td colspan='2'></td></tr>");
echo ("</tbody></table>");
}
function ch_nclas ($seleccion){//Cheques no clasificados
$sql_nclas = "select ch.cta_b, ch.cheque, ch.fecha, b.benef, ch.monto, ch.proy, ch.cta, ch.estatus from tbl_cheques ch, tbl_proyectos p, tbl_benef b where ch.proy=p.proy and ch.benef_id=b.benef_id and p.ures $seleccion and (estatus is null or estatus = '') and responsable = 'Raul'";
$qry_nclas = mysql_query($sql_nclas);

echo ("<table id='info' align='center' border='1'><thead><tr> <th>Cta Bancaria</th> <th>Cheque</th> <th>Fecha</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta</th> <th>Estatus</th> </tr></thead><tbody>");
$renglon='non';//cambio de color en renglones
while ($arr_nclas = mysql_fetch_array($qry_nclas)){
	echo ("<tr id='$renglon'> <td>".$arr_nclas['cta_b']."</td> <td>".$arr_nclas['cheque']."</td> <td>".$arr_nclas['fecha']."</td> <td id='benef'>".utf8_decode($arr_nclas['benef'])."</td> <td id='monto'>".number_format($arr_nclas['monto'],2)."</td> <td>".$arr_nclas['proy']."</td> <td>".$arr_nclas['cta']."</td> <td>".$arr_nclas['estatus']."</td> </tr>");
	$sum_monto += $arr_nclas['monto'];
	if ($renglon=='non'){$renglon='par';}else{$renglon='non';}//cambio de color en renglones
	}
echo ("<tr><td colspan='4'></td><td id='total'>".number_format($sum_monto,2)."</td><td colspan='3'></td></tr>");
echo ("</tbody></table>");
}
function chxest($estatus, $seleccion){//Cheques x Estatus
$sql_est = "select ch.cta_b, ch.cheque, ch.fecha, ben.benef, ch.monto, ch.proy, ch.cta, ch.estatus, ch.seguimiento, ch.responsable from tbl_cheques ch, tbl_benef ben, tbl_proyectos p where ch.benef_id=ben.benef_id and ch.proy=p.proy and p.ures $seleccion and ch.estatus $estatus and (oficio='' or oficio is null) order by ch.cta_b, ch.cheque";
$qry_est = mysql_query($sql_est);

echo ("<table id='info' align='center' border='1'><thead><tr><th colspan='10'>Relación de Cheques con Estatus ".$estatus."</th></tr> <tr> <th>Cta Bancaria</th> <th>Cheque</th> <th>Fecha</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta</th> <th>Estatus</th> <th>Seguimiento</th> <th>Responsable</th> </tr></thead><tbody>");
$renglon='non';//cambio de color en renglones
while ($arr_est = mysql_fetch_array($qry_est)){
	echo ("<tr id='$renglon'> <td>".$arr_est['cta_b']."</td> <td>".$arr_est['cheque']."</td> <td>".$arr_est['fecha']."</td> <td id='benef'>".utf8_decode($arr_est['benef'])."</td> <td id='monto'>".number_format($arr_est['monto'],2)."</td> <td>".$arr_est['proy']."</td> <td>".$arr_est['cta']."</td> <td>".$arr_est['estatus']."</td> <td>".$arr_est['seguimiento']."</td> <td>".$arr_est['responsable']."</td></tr>");
	$sum_monto += $arr_est['monto'];
	if ($renglon=='non'){$renglon='par';}else{$renglon='non';}//cambio de color en renglones
}
echo ("<tr><td colspan='4'></td><td id='total'>".number_format($sum_monto,2)."</td><td colspan='5'></td></tr>");
echo ("</tbody></table>");
}
function ch_comp($res, $seleccion){//Cheques en proceso de comprobación
$sql_res = "select ch.cta_b, ch.cheque, ch.fecha, ben.benef, ch.monto, ch.proy, ch.cta, ch.estatus, ch.seguimiento, ch.responsable, ch.fecha_c from tbl_cheques ch, tbl_benef ben, tbl_proyectos p where ch.benef_id=ben.benef_id and ch.proy=p.proy and ch.estatus in ('Facturas','Comprobado') and (oficio='' or oficio is NULL) and p.ures $seleccion and ch.responsable='$res' order by ch.cta_b, ch.cheque";
$qry_res = mysql_query($sql_res);

echo ("<table id='info' align='center' border='1'><thead><tr><th colspan='11'>Cheques en Proceso de Comprobación</th></tr><tr> <th>Cta Bancaria</th> <th>Cheque</th> <th>Fecha</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta</th> <th>Estatus</th> <th>Seguimiento</th> <th>Responsable</th> <th>Fecha de Recibido</th> </tr></thead><tbody>");
$renglon='non';//cambio de color en renglones
while ($arr_res = mysql_fetch_array($qry_res)){
	echo ("<tr id='$renglon'> <td>".$arr_res['cta_b']."</td> <td>".$arr_res['cheque']."</td> <td>".$arr_res['fecha']."</td> <td id='benef'>".utf8_decode($arr_res['benef'])."</td> <td id='monto'>".number_format($arr_res['monto'],2)."</td> <td>".$arr_res['proy']."</td> <td>".$arr_res['cta']."</td> <td>".$arr_res['estatus']."</td> <td>".$arr_res['seguimiento']."</td> <td>".$arr_res['responsable']."</td> <td>".$arr_res['fecha_c']."</td> </tr>");
	$sum_monto += $arr_res['monto'];
	if ($renglon=='non'){$renglon='par';}else{$renglon='non';}//cambio de color en renglones
}
echo ("<tr><td colspan='4'></td><td id='total'>".number_format($sum_monto,2)."</td><td colspan='5'></td></tr>");
echo ("</tbody></table>");
}
function ch_dfin($seleccion){//Cheques enviados a Dir de Finanzas
$sql_fin = "select ch.cta_b, ch.cheque, ch.fecha, ben.benef, ch.monto, ch.proy, ch.cta, ch.oficio, ch.responsable from tbl_cheques ch, tbl_benef ben, tbl_proyectos p where ch.benef_id=ben.benef_id and ch.proy=p.proy and (oficio!='' and oficio is not null) and p.ures $seleccion order by ch.cta_b, ch.cheque";
$qry_fin = mysql_query($sql_fin);

echo ("<table id='info' border='1'><thead><tr> <th>Cta Bancaria</th> <th>Cheque</th> <th>Fecha</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta</th> <th>Oficio</th> <th>Responsable</th> </tr></thead><tbody>");
while ($arr_fin = mysql_fetch_array($qry_fin)){
	echo ("<tr> <td align='center'>".$arr_fin['cta_b']."</td> <td align='center'>".$arr_fin['cheque']."</td> <td>".$arr_fin['fecha']."</td> <td>".utf8_decode($arr_fin['benef'])."</td> <td align='right'>".number_format($arr_fin['monto'],2)."</td> <td>".$arr_fin['proy']."</td> <td>".$arr_fin['cta']."</td> <td>".$arr_fin['oficio']."</td> <td>".$arr_fin['responsable']."</td> </tr>");
	$sum_monto += $arr_fin['monto'];
}
echo ("<tr><td></td><td></td><td></td><td></td><td>".number_format($sum_monto,2)."</td></tr>");
echo ("</tbody></table>");
}
function ch_cancelados(){//Cheques Cancelados
$sql_c = "select ch.cta_b, ch.cheque, ch.fecha, ben.benef, ch.monto, ch.proy, ch.cta, ch.oficio, ch.responsable from tbl_cheques ch, tbl_benef ben where ch.benef_id=ben.benef_id and ch.benef_id=37 order by ch.cta_b, ch.cheque";
$qry_c = mysql_query($sql_c);

echo ("<table id='info' border='1'><thead><tr> <th>Cta Bancaria</th> <th>Cheque</th> <th>Fecha</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta</th> <th>Oficio</th> <th>Responsable</th> </tr></thead><tbody>");
while ($arr_c = mysql_fetch_array($qry_c)){
	echo ("<tr> <td align='center'>".$arr_c['cta_b']."</td> <td align='center'>".$arr_c['cheque']."</td> <td>".$arr_c['fecha']."</td> <td>".utf8_decode($arr_c['benef'])."</td> <td align='right'>".number_format($arr_c['monto'],2)."</td> <td>".$arr_c['proy']."</td> <td>".$arr_c['cta']."</td> <td>".$arr_c['oficio']."</td> <td>".$arr_c['responsable']."</td> </tr>");
	$sum_monto += $arr_fin['monto'];
}
echo ("</tbody></table>");
}
?>