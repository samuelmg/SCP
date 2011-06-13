<?php
function t_transito($seleccion){
$sql_transito = "select e.fecha, e.cta_b, e.no_t, b.benef, e.monto, e.proy, e.cmt from tbl_egresos e, tbl_proyectos p, tbl_benef b where e.proy=p.proy and e.benef_id=b.benef_id and (oficio is null or oficio = '') and (responsable is null or responsable = '')";
$qry_transito = mysql_query($sql_transito);

echo ("<table id='info' align='center' border='1'><thead><tr><th colspan='7'>Transferencias en Tránsito</th></tr><tr> <th>Fecha</th> <th>Cta Bancaria</th> <th>No. Transferencia</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Comentarios</th> </tr></thead><tbody>");
$renglon='non';//cambio de color en renglones
while ($arr_transito = mysql_fetch_array($qry_transito)){
	echo ("<tr id='$renglon'> <td>".$arr_transito['fecha']."</td> <td>".$arr_transito['cta_b']."</td> <td>".$arr_transito['no_t']."</td> <td id='benef'>".utf8_decode($arr_transito['benef'])."</td> <td id=='monto'>".number_format($arr_transito['monto'],2)."</td> <td>".$arr_transito['proy']."</td> <td>".$arr_transito['cmt']."</td> </tr>");
	$sum_monto += $arr_transito['monto'];
	if ($renglon=='non'){$renglon='par';}else{$renglon='non';}//cambio de color en renglones
	}
echo ("<tr><td colspan='4'></td><td id='total'>".number_format($sum_monto,2)."</td><td colspan='2'></td></tr>");
echo ("</tbody></table>");
}
function t_nclas ($seleccion){//Transferencias no clasificados
$sql_nclas = "select e.fecha, e.cta_b, e.no_t, b.benef, e.monto, e.proy, e.cmt, e.estatus from tbl_egresos e, tbl_proyectos p, tbl_benef b where e.proy=p.proy and e.benef_id=b.benef_id and p.ures $seleccion and (estatus is null or estatus = '') and responsable = 'Raul'";
$qry_nclas = mysql_query($sql_nclas);

echo ("<table id='info' align='center' border='1'><thead><tr><th colspan='7'>Transferencias Sin Clasificar</th></tr><tr> <th>Fecha</th> <th>Cta Bancaria</th> <th>No. Transferencia</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Comentarios</th> <th>Estatus</th> </tr></thead><tbody>");
$renglon='non';//cambio de color en renglones
while ($arr_nclas = mysql_fetch_array($qry_nclas)){
	echo ("<tr id='$renglon'> <td>".$arr_nclas['fecha']."</td> <td>".$arr_nclas['no_t']."</td> <td>".$arr_nclas['cheque']."</td> <td id='benef'>".utf8_decode($arr_nclas['benef'])."</td> <td id='monto'>".number_format($arr_nclas['monto'],2)."</td> <td>".$arr_nclas['proy']."</td> <td>".$arr_nclas['cmt']."</td> <td>".$arr_nclas['estatus']."</td> </tr>");
	$sum_monto += $arr_nclas['monto'];
	if ($renglon=='non'){$renglon='par';}else{$renglon='non';}//cambio de color en renglones
	}
echo ("<tr><td colspan='4'></td><td id='total'>".number_format($sum_monto,2)."</td><td colspan='3'></td></tr>");
echo ("</tbody></table>");
}
function t_x_est($estatus, $seleccion){//Transferencias x Estatus
$sql_est = "select e.fecha, e.cta_b, e.no_t, b.benef, e.monto, e.proy, e.cmt, e.estatus, e.seguimiento, e.responsable from tbl_egresos e, tbl_benef b, tbl_proyectos p where e.benef_id=e.benef_id and e.proy=p.proy and p.ures $seleccion and e.estatus $estatus and (oficio='' or oficio is null) order by ch.cta_b, ch.cheque";
$qry_est = mysql_query($sql_est);

echo ("<table id='info' align='center' border='1'><thead><tr><th colspan='10'>Relación de Cheques con Estatus ".$estatus."</th></tr> <tr> <th>Fecha</th> <th>Cta Bancaria</th> <th>Transferencia</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Comentarios</th> <th>Estatus</th> <th>Seguimiento</th> <th>Responsable</th> </tr></thead><tbody>");
$renglon='non';//cambio de color en renglones
while ($arr_est = mysql_fetch_array($qry_est)){
	echo ("<tr id='$renglon'> <td>".$arr_est['fecha']."</td> <td>".$arr_est['cta_b']."</td> <td>".$arr_est['no_t']."</td> <td id='benef'>".utf8_decode($arr_est['benef'])."</td> <td id='monto'>".number_format($arr_est['monto'],2)."</td> <td>".$arr_est['proy']."</td> <td>".$arr_est['cmt']."</td> <td>".$arr_est['estatus']."</td> <td>".$arr_est['seguimiento']."</td> <td>".$arr_est['responsable']."</td></tr>");
	$sum_monto += $arr_est['monto'];
	if ($renglon=='non'){$renglon='par';}else{$renglon='non';}//cambio de color en renglones
}
echo ("<tr><td colspan='4'></td><td id='total'>".number_format($sum_monto,2)."</td><td colspan='5'></td></tr>");
echo ("</tbody></table>");
}
function t_comp($res, $seleccion){//Transferencias en proceso de comprobación
$sql_res = "select e.fecha, e.cta_b, e.no_t, b.benef, e.monto, e.proy, e.cmt, e.responsable, e.estatus, e.fecha_c from tbl_egresos e, tbl_benef b, tbl_proyectos p where e.benef_id=b.benef_id and e.proy=p.proy and e.estatus in ('Facturas','Comprobado') and (oficio='' or oficio is NULL) and p.ures $seleccion and e.responsable='$res' order by e.cta_b, e.fecha";
$qry_res = mysql_query($sql_res);

echo ("<table id='info' align='center' border='1'><thead><tr><th colspan='10'>Cheques en Proceso de Comprobación</th></tr><tr> <th>Fecha</th> <th>Cta Bancaria</th> <th>No. Transferencia</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Comentarios</th> <th>Responsable</th> <th>Estatus</th> <th>Fecha de Recibido</th> </tr></thead><tbody>");
$renglon='non';//cambio de color en renglones
while ($arr_res = mysql_fetch_array($qry_res)){
	echo ("<tr id='$renglon'> <td>".$arr_res['fecha']."</td> <td>".$arr_res['cta_b']."</td> <td>".$arr_res['no_t']."</td> <td id='benef'>".utf8_decode($arr_res['benef'])."</td> <td id='monto'>".number_format($arr_res['monto'],2)."</td> <td>".$arr_res['proy']."</td> <td>".$arr_res['cmt']."</td> <td>".$arr_res['responsable']."</td> <td>".$arr_res['estatus']."</td> <td>".$arr_res['fecha_c']."</td> </tr>");
	$sum_monto += $arr_res['monto'];
	if ($renglon=='non'){$renglon='par';}else{$renglon='non';}//cambio de color en renglones
}
echo ("<tr><td colspan='4'></td><td id='total'>".number_format($sum_monto,2)."</td><td colspan='4'></td></tr>");
echo ("</tbody></table>");
}
function t_dfin($seleccion){//Transferencias enviadas a Dir de Finanzas
$sql_fin = "select e.fecha, e.cta_b, e.no_t, b.benef, e.monto, e.proy, e.cmt, e.oficio, e.responsable from tbl_egresos e, tbl_benef b, tbl_proyectos p where e.benef_id=b.benef_id and e.proy=p.proy and (oficio!='' and oficio is not null) and p.ures $seleccion order by e.cta_b, e.fecha";
$qry_fin = mysql_query($sql_fin);

echo ("<table id='info' border='1'><thead><tr><th colspan='10'>Cheques Comprobados a Dir. de Finanzas</th></tr><tr> <th>Fecha</th>  <th>Cta Bancaria</th> <th>No. Transferencia</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Comentarios</th> <th>Oficio</th> <th>Responsable</th> </tr></thead><tbody>");
while ($arr_fin = mysql_fetch_array($qry_fin)){
	echo ("<tr> <td>".$arr_fin['fecha']."</td> <td align='center'>".$arr_fin['cta_b']."</td> <td align='center'>".$arr_fin['no_t']."</td> <td>".utf8_decode($arr_fin['benef'])."</td> <td align='right'>".number_format($arr_fin['monto'],2)."</td> <td>".$arr_fin['proy']."</td> <td>".$arr_fin['cmt']."</td> <td>".$arr_fin['oficio']."</td> <td>".$arr_fin['responsable']."</td> </tr>");
	$sum_monto += $arr_fin['monto'];
}
echo ("<tr><td></td><td></td><td></td><td></td><td>".number_format($sum_monto,2)."</td></tr>");
echo ("</tbody></table>");
}
?>