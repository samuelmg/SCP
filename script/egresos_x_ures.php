<?php
function egresos($seleccion){
$sql_e = "select e.fecha, e.proy, e.cta, e.monto, e.cmt from tbl_egresos e, tbl_proyectos p where e.proy=p.proy and e.tipo='Cargo a Proyeco' and p.ures $seleccion order by e.fecha, e.proy";
$qry_e = mysql_query($sql_e);

echo ("<table id='info' border='1'><thead><tr> <th>Fecha</th> <th>Proyecto</th> <th>Cuenta</th> <th>Monto</th> <th>Comentarios</th> </tr></thead><tbody>");
while ($arr_e = mysql_fetch_array($qry_e)){
	echo ("<tr> <td>".$arr_e['fecha']."</td> <td>".$arr_e['proy']."</td> <td>".$arr_e['cta']."</td> <td align='right'>".number_format($arr_e['monto'],2)."</td> <td>".$arr_e['cmt']."</td> </tr>");
	$sum_e+=$arr_e['monto'];
	}
echo ("<tr><td></td><td></td><td></td><td>".number_format($sum_e,2)."</td></tr>");
echo ("</tbody></table>");
}

function egresos_sel($seleccion,$filtro){//Funcion para elegir egresos segun usuario y filtro. Agrega un checkbox para seleccionar el egreso --El filtro selecciona el responsable de la poliza
$sql_e = "select e.fecha, e.cta_b, e.no_t, b.benef, sum(e.monto), e.cmt, e.estatus, e.proy, e.responsable from tbl_egresos e, tbl_benef b, tbl_proyectos p where e.benef_id=b.benef_id and e.proy=p.proy and e.tipo='Cargo a Proyeco' $filtro group by e.fecha, e.cta_b, e.no_t, b.benef, e.cmt, e.estatus, e.proy, e.responsable order by e.cta_b, e.fecha";
$qry_e = mysql_query($sql_e);
echo ("<table id='info' align='center'><thead><tr> <th>Fecha</th> <th>Cuenta</th> <th>No. Transferencia</th> <th>Seleccionar</th> <th>Beneficiario</th> <th>Monto</th> <th>Comentario</th> <th>Proyecto</th> <th>Responsable</th> <th>Estatus</th> <th>Comprueba</th> </tr></thead><tbody>");
$renglon='non';//cambio de color en renglones
while ($arr_e = mysql_fetch_array($qry_e)){
	$proy = $arr_e['proy'];
	$res = res_comp($proy);//Determina el responsable de este proyecto
	echo ("<tr id='$renglon'> <td>".$arr_e['fecha']."</td> <td>".$arr_e['cta_b']."</td> <td>".$arr_e['no_t']."</td><td> <input type='checkbox' name='".$arr_e['no_t']."' value='".$arr_e['no_t']."'> </td> <td id='benef'>".utf8_decode($arr_e['benef'])."</td> <td id='monto'>".number_format($arr_e['sum(e.monto)'],2)."</td> <td id='benef'>".$arr_e['cmt']."</td> <td>".$arr_e['proy']."</td> <td>".$arr_e['responsable']."</td> <td>".$arr_e['estatus']."</td> <td>".$res."</td></tr>");
	if ($renglon=='non'){$renglon='par';}else{$renglon='non';}//cambio de color en renglones
	}
echo ("</tbody></table>");
}

function egresos_sel_oficio($seleccion,$filtro){//Funcion para elegir transferencias a las que se desea capturar el oficio
$sql_e = "select e.fecha, e.cta_b, e.no_t, b.benef, sum(e.monto), e.cmt, e.proy, e.estatus, e.oficio from tbl_egresos e, tbl_benef b, tbl_proyectos p where e.benef_id=b.benef_id and e.proy=p.proy and e.tipo='Cargo a Proyeco' and p.ures $seleccion $filtro and (e.oficio is null or e.oficio='') group by e.fecha, e.cta_b, e.no_t, b.benef, e.proy, e.oficio order by e.cta_b, e.no_t";
$qry_e = mysql_query($sql_e);
echo ("<table id='info'><thead><tr> <th>Fecha</th> <th>Cuenta</th> <th>No. Transferencia</th> <th>Seleccionar</th> <th>Beneficiario</th> <th>Monto</th> <th>Comentario</th> <th>Proyecto</th> <th>Estatus</th> <th>Oficio</th> <th>Responsable</th> </tr></thead><tbody>");
$renglon='non';//cambio de color en renglones
while ($arr_e = mysql_fetch_array($qry_e)){
	$proy = $arr_e['proy'];
	$res = res_comp($proy);
	echo ("<tr id='$renglon'> <td>".$arr_e['fecha']."</td> <td align='center'>".$arr_e['cta_b']."</td> <td align='center'>".$arr_e['no_t']."</td><td><input type='checkbox' name='".$arr_e['no_t']."' value='".$arr_e['no_t']."'></td> <td id='benef'>".utf8_decode($arr_e['benef'])."</td> <td id='monto'>".number_format($arr_e['sum(e.monto)'],2)."</td> <td>".$arr_e['cmt']."</td> <td>".$arr_e['proy']."</td> <td>".$arr_e['estatus']."</td> <td>".$arr_e['oficio']."</td> <td>".$res."</td></tr>");
	$sum_monto += $arr_e['sum(e.monto)'];
	if ($renglon=='non'){$renglon='par';}else{$renglon='non';}//cambio de color en renglones
	}
echo ("<tr><td colspan='5'></td> <td id='total'>".number_format($sum_monto,2)."</td></tr>");
echo ("</tbody></table>");
}
?>