<?php
function chxest($estatus, $seleccion){//Cheques no comprobados
$sql_est = "select ch.cta_b, ch.cheque, ch.fecha, ben.benef, ch.monto, ch.proy, ch.cta, ch.estatus, ch.seguimiento from tbl_cheques ch, tbl_benef ben, tbl_proyectos p where ch.benef_id=ben.benef_id and ch.proy=p.proy and p.ures $seleccion and ch.estatus='$estatus' order by ch.cta_b, ch.cheque";
$qry_est = mysql_query($sql_est);

echo ("<table id='info' border='1'><thead><tr> <th>Cta Bancaria</th> <th>Cheque</th> <th>Fecha</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta</th> <th>Estatus</th> <th>Seguimiento</th> </tr></thead><tbody>");
while ($arr_est = mysql_fetch_array($qry_est)){
	echo ("<tr> <td align='center'>".$arr_est['cta_b']."</td> <td align='center'>".$arr_est['cheque']."</td> <td>".$arr_est['fecha']."</td> <td>".utf8_decode($arr_est['benef'])."</td> <td align='right'>".number_format($arr_est['monto'],2)."</td> <td>".$arr_est['proy']."</td> <td>".$arr_est['cta']."</td> <td>".$arr_est['estatus']."</td> <td>".$arr_est['seguimiento']."</td> </tr>");
	$sum_monto += $arr_est['monto'];
}
echo ("<tr><td></td><td></td><td></td><td></td><td>".number_format($sum_monto,2)."</td></tr>");
echo ("</tbody></table>");
}
function ch_comp($res, $seleccion){//Cheques en proceso de comprobación
$sql_res = "select ch.cta_b, ch.cheque, ch.fecha, ben.benef, ch.monto, ch.proy, ch.cta, ch.responsable, ch.fecha_c from tbl_cheques ch, tbl_benef ben, tbl_proyectos p where ch.benef_id=ben.benef_id and ch.proy=p.proy and ch.estatus in ('Facturas','Comprobado') and (oficio='' or oficio is NULL) and p.ures $seleccion and ch.responsable='$res' order by ch.cta_b, ch.cheque";
$qry_res = mysql_query($sql_res);

echo ("<table id='info' border='1'><thead><tr> <th>Cta Bancaria</th> <th>Cheque</th> <th>Fecha</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta</th> <th>Responsable</th> <th>Fecha C</th> </tr></thead><tbody>");
while ($arr_res = mysql_fetch_array($qry_res)){
	echo ("<tr> <td align='center'>".$arr_res['cta_b']."</td> <td align='center'>".$arr_res['cheque']."</td> <td>".$arr_res['fecha']."</td> <td>".utf8_decode($arr_res['benef'])."</td> <td align='right'>".number_format($arr_res['monto'],2)."</td> <td>".$arr_res['proy']."</td> <td>".$arr_res['cta']."</td> <td>".$arr_res['responsable']."</td> <td>".$arr_res['fecha_c']."</td> </tr>");
	$sum_monto += $arr_res['monto'];
}
echo ("<tr><td></td><td></td><td></td><td></td><td>".number_format($sum_monto,2)."</td></tr>");
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
?>