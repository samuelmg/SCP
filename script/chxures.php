<?php
/*
 * chxures.php
 * 
 * Copyright (C) 2005 Samuel Mercado Garibay <samuel.mg@gmx.com>.
 * 
 * This file is part of SCP.
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http ://www.gnu.org/licenses/>.
 */

function chxures($seleccion){
$sql_ch = "select p.ures, ch.cta_b, ch.cheque, ch.fecha, b.benef, ch.monto, ch.proy, ch.cta, ch.estatus, ch.oficio from tbl_cheques ch, tbl_benef b, tbl_proyectos p where ch.benef_id=b.benef_id and ch.proy=p.proy and p.ures $seleccion order by ch.cta_b, ch.cheque";
$qry_ch = mysql_query($sql_ch);

echo ("<table id='info' border='1'><thead><tr> <th>URes</th> <th>Cta Bancaria</th> <th>Cheque</th> <th>Fecha</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta</th> <th>Estatus</th> <th>Oficio</th> </tr></thead><tbody>");
while ($arr_ch = mysql_fetch_array($qry_ch)){
	echo ("<tr> <td>".$arr_ch['ures']."</td> <td align='center'>".$arr_ch['cta_b']."</td> <td align='center'>".$arr_ch['cheque']."</td> <td>".$arr_ch['fecha']."</td> <td>".utf8_decode($arr_ch['benef'])."</td> <td align='right'>".number_format($arr_ch['monto'],2)."</td> <td>".$arr_ch['proy']."</td> <td>".$arr_ch['cta']."</td> <td>".$arr_ch['estatus']."</td> <td>".$arr_ch['oficio']."</td></tr>");
	$sum_cheques+=$arr_ch['monto'];
	}
echo ("<tr><td></td><td></td><td></td><td></td><td></td><td>".number_format($sum_cheques,2)."</td></tr>");
echo ("</tbody></table>");
}

function chxures_sel($seleccion,$filtro){
//and p.ures $seleccion
$sql_ch = "select ch.fecha, ch.cta_b, ch.cheque, b.benef, sum(ch.monto), ch.proy, ch.responsable from tbl_cheques ch, tbl_benef b, tbl_proyectos p where ch.benef_id=b.benef_id and ch.proy=p.proy $filtro group by ch.fecha, ch.cta_b, ch.cheque, b.benef, ch.proy, ch.responsable order by ch.cta_b, ch.cheque";
$qry_ch = mysql_query($sql_ch);
echo ("<table id='info' border='1'><thead><tr> <th>Fecha</th> <th>Cuenta</th> <th>Cheque</th> <th>Seleccionar</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Responsable</th> <th>Comprueba</th> </tr></thead><tbody>");
while ($arr_ch = mysql_fetch_array($qry_ch)){
$proy = $arr_ch['proy'];
$res = res_comp($proy);
echo ("<tr> <td>".$arr_ch['fecha']."</td> <td align='center'>".$arr_ch['cta_b']."</td> <td align='center'>".$arr_ch['cheque']."</td><td align='center'><input type='checkbox' name='".$arr_ch['cta_b']."-".$arr_ch['cheque']."' value='".$arr_ch['cta_b']."-".$arr_ch['cheque']."'></td> <td>".utf8_decode($arr_ch['benef'])."</td> <td align='right'>".number_format($arr_ch['sum(ch.monto)'],2)."</td> <td>".$arr_ch['proy']."</td> <td>".$arr_ch['responsable']."</td><td>".$res."</td></tr>");
	}
echo ("</tbody></table>");
}

function chxures_sel_oficio($seleccion,$filtro){//Funcion para elegir cheques a los que se desea capturar en oficio
$sql_ch = "select ch.fecha, ch.cta_b, ch.cheque, b.benef, sum(ch.monto), ch.proy, ch.oficio from tbl_cheques ch, tbl_benef b, tbl_proyectos p where ch.benef_id=b.benef_id and ch.proy=p.proy and p.ures $seleccion $filtro and (oficio is null or oficio = '') group by ch.fecha, ch.cta_b, ch.cheque, b.benef, ch.proy, ch.oficio order by ch.cta_b, ch.cheque";
$qry_ch = mysql_query($sql_ch);
echo ("<table id='info' border='1'><thead><tr> <th>Fecha</th> <th>Cuenta</th> <th>Cheque</th> <th>Seleccionar</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Oficio</th> <th>Responsable</th> </tr></thead><tbody>");
while ($arr_ch = mysql_fetch_array($qry_ch)){
$proy = $arr_ch['proy'];
$res = res_comp($proy);
echo ("<tr> <td>".$arr_ch['fecha']."</td> <td align='center'>".$arr_ch['cta_b']."</td> <td align='center'>".$arr_ch['cheque']."</td><td align='center'><input type='checkbox' name='".$arr_ch['cta_b']."-".$arr_ch['cheque']."' value='".$arr_ch['cta_b']."-".$arr_ch['cheque']."'></td> <td>".utf8_decode($arr_ch['benef'])."</td> <td align='right'>".number_format($arr_ch['sum(ch.monto)'],2)."</td> <td>".$arr_ch['proy']."</td> <td>".$arr_ch['oficio']."</td><td>".$res."</td></tr>");
$sum_monto += $arr_ch['sum(ch.monto)'];
	}
echo ("<tr><td></td> <td></td><td></td><td></td><td></td><td>".number_format($sum_monto,2)."</td></tr>");
echo ("</tbody></table>");
}
?>