<?php
function chxures($seleccion){
$sql_ch = "select p.ures, ch.cta_b, ch.cheque, ch.fecha, b.benef, ch.monto, ch.proy, ch.cta, ch.estatus, ch.oficio from tbl_cheques ch, tbl_benef b, tbl_proyectos p where ch.benef_id=b.benef_id and ch.proy=p.proy and p.ures $seleccion order by ch.cta_b, ch.cheque";
$qry_ch = mysql_query($sql_ch);

echo ("<table id='info' border='1'><thead><tr> <th>URes</th> <th>Cta Bancaria</th> <th>Cheque</th> <th>Fecha</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta</th> <th>Estatus</th> <th>Oficio</th> </tr></thead><tbody>");
$renglon='non';//cambio de color en renglones
while ($arr_ch = mysql_fetch_array($qry_ch)){
	echo ("<tr id='$renglon'> <td>".$arr_ch['ures']."</td> <td align='center'>".$arr_ch['cta_b']."</td> <td align='center'>".$arr_ch['cheque']."</td> <td>".$arr_ch['fecha']."</td> <td id='benef'>".utf8_decode($arr_ch['benef'])."</td> <td id='monto'>".number_format($arr_ch['monto'],2)."</td> <td>".$arr_ch['proy']."</td> <td>".$arr_ch['cta']."</td> <td>".$arr_ch['estatus']."</td> <td>".$arr_ch['oficio']."</td></tr>");
	$sum_cheques+=$arr_ch['monto'];
	if ($renglon=='non'){$renglon='par';}else{$renglon='non';}//cambio de color en renglones
	}
echo ("<tr><td></td><td></td><td></td><td></td><td></td><td id='total'>".number_format($sum_cheques,2)."</td></tr>");
echo ("</tbody></table>");
}

function chxures_sel($seleccion,$filtro){//Funcion para elegir cheques segun usuario y filtro. Agrega un checkbox para seleccionar el cheque --El filtro selecciona el responsable de la poliza
$sql_ch = "select ch.fecha, ch.cta_b, ch.cheque, b.benef, sum(ch.monto), ch.proy, ch.responsable, ch.estatus from tbl_cheques ch, tbl_benef b, tbl_proyectos p where ch.benef_id=b.benef_id and ch.proy=p.proy $filtro group by ch.fecha, ch.cta_b, ch.cheque, b.benef, ch.proy, ch.responsable order by ch.cta_b, ch.cheque";
$qry_ch = mysql_query($sql_ch);
echo ("<table id='info' align='center'><thead><tr> <th>Fecha</th> <th>Cuenta</th> <th>Cheque</th> <th>Seleccionar</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Responsable</th> <th>Comprueba</th> <th>Estatus</th> </tr></thead><tbody>");
$renglon='non';//cambio de color en renglones
while ($arr_ch = mysql_fetch_array($qry_ch)){
	$proy = $arr_ch['proy'];
	$res = res_comp($proy);//Determina el responsable de este proyecto
	echo ("<tr id='$renglon'> <td>".$arr_ch['fecha']."</td> <td>".$arr_ch['cta_b']."</td> <td>".$arr_ch['cheque']."</td><td> <input type='checkbox' name='".$arr_ch['cta_b']."-".$arr_ch['cheque']."' value='".$arr_ch['cta_b']."-".$arr_ch['cheque']."'> </td> <td id='benef'>".utf8_decode($arr_ch['benef'])."</td> <td id='monto'>".number_format($arr_ch['sum(ch.monto)'],2)."</td> <td>".$arr_ch['proy']."</td> <td>".$arr_ch['responsable']."</td><td>".$res."</td> <td>".$arr_ch['estatus']."</td></tr>");
	if ($renglon=='non'){$renglon='par';}else{$renglon='non';}//cambio de color en renglones
	}
echo ("</tbody></table>");
}

function chxures_sel_oficio($seleccion,$filtro){//Funcion para elegir cheques a los que se desea capturar en oficio
$sql_ch = "select ch.fecha, ch.cta_b, ch.cheque, b.benef, sum(ch.monto), ch.proy, ch.oficio, ch.estatus from tbl_cheques ch, tbl_benef b, tbl_proyectos p where ch.benef_id=b.benef_id and ch.proy=p.proy and p.ures $seleccion $filtro and (oficio is null or oficio = '') group by ch.fecha, ch.cta_b, ch.cheque, b.benef, ch.proy, ch.oficio order by ch.cta_b, ch.cheque";
$qry_ch = mysql_query($sql_ch);
echo ("<table id='info'><thead><tr> <th>Fecha</th> <th>Cuenta</th> <th>Cheque</th> <th>Seleccionar</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Oficio</th> <th>Responsable</th> <th>Estatus</th></tr></thead><tbody>");
$renglon='non';//cambio de color en renglones
while ($arr_ch = mysql_fetch_array($qry_ch)){
	$proy = $arr_ch['proy'];
	$res = res_comp($proy);
	echo ("<tr id='$renglon'> <td>".$arr_ch['fecha']."</td> <td align='center'>".$arr_ch['cta_b']."</td> <td align='center'>".$arr_ch['cheque']."</td><td align='center'><input type='checkbox' name='".$arr_ch['cta_b']."-".$arr_ch['cheque']."' value='".$arr_ch['cta_b']."-".$arr_ch['cheque']."'></td> <td id='benef'>".utf8_decode($arr_ch['benef'])."</td> <td id='monto'>".number_format($arr_ch['sum(ch.monto)'],2)."</td> <td>".$arr_ch['proy']."</td> <td>".$arr_ch['oficio']."</td><td>".$res."</td><td>".$arr_ch['estatus']."</td></tr>");
	$sum_monto += $arr_ch['sum(ch.monto)'];
	if ($renglon=='non'){$renglon='par';}else{$renglon='non';}//cambio de color en renglones
	}
echo ("<tr><td></td> <td></td><td></td><td></td><td></td><td id='total'>".number_format($sum_monto,2)."</td></tr>");
echo ("</tbody></table>");
}
?>