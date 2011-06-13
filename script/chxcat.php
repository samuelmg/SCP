<?php
/*
 * chxcat.php
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

function ch_transito($seleccion){
$sql_transito = "select ch.cta_b, ch.cheque, ch.fecha, b.benef, ch.monto, ch.proy, ch.cta from tbl_cheques ch, tbl_proyectos p, tbl_benef b where ch.proy=p.proy and ch.benef_id=b.benef_id and (oficio is null or oficio = '') and (responsable is null or responsable = '')";
$qry_transito = mysql_query($sql_transito);

echo ("<table id='info' border='1'><thead><tr> <th>Cta Bancaria</th> <th>Cheque</th> <th>Fecha</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta</th> </tr></thead><tbody>");
while ($arr_transito = mysql_fetch_array($qry_transito)){
	echo ("<tr> <td align='center'>".$arr_transito['cta_b']."</td> <td align='center'>".$arr_transito['cheque']."</td> <td>".$arr_transito['fecha']."</td> <td>".utf8_decode($arr_transito['benef'])."</td> <td align='right'>".number_format($arr_transito['monto'],2)."</td> <td>".$arr_transito['proy']."</td> <td>".$arr_transito['cta']."</td> </tr>");
	$sum_monto += $arr_transito['monto'];
	}
echo ("<tr><td></td><td></td><td></td><td></td><td>".number_format($sum_monto,2)."</td></tr>");
echo ("</tbody></table>");
}
function ch_nclas ($seleccion){//Cheques no clasificados
$sql_nclas = "select ch.cta_b, ch.cheque, ch.fecha, b.benef, ch.monto, ch.proy, ch.cta, ch.estatus from tbl_cheques ch, tbl_proyectos p, tbl_benef b where ch.proy=p.proy and ch.benef_id=b.benef_id and p.ures $seleccion and (estatus is null or estatus = '') and responsable = 'Norma'";
$qry_nclas = mysql_query($sql_nclas);

echo ("<table id='info' border='1'><thead><tr> <th>Cta Bancaria</th> <th>Cheque</th> <th>Fecha</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta</th> <th>Estatus</th> </tr></thead><tbody>");
while ($arr_nclas = mysql_fetch_array($qry_nclas)){
	echo ("<tr> <td align='center'>".$arr_nclas['cta_b']."</td> <td align='center'>".$arr_nclas['cheque']."</td> <td>".$arr_nclas['fecha']."</td> <td>".utf8_decode($arr_nclas['benef'])."</td> <td align='right'>".number_format($arr_nclas['monto'],2)."</td> <td>".$arr_nclas['proy']."</td> <td>".$arr_nclas['cta']."</td> <td>".$arr_nclas['estatus']."</td> </tr>");
	$sum_monto += $arr_nclas['monto'];
	}
echo ("<tr><td></td><td></td><td></td><td></td><td>".number_format($sum_monto,2)."</td></tr>");
echo ("</tbody></table>");
}
function chxest($estatus, $seleccion){//Cheques x Estatus
$sql_est = "select ch.cta_b, ch.cheque, ch.fecha, ben.benef, ch.monto, ch.proy, ch.cta, ch.estatus, ch.responsable, ch.seguimiento from tbl_cheques ch, tbl_benef ben, tbl_proyectos p where ch.benef_id=ben.benef_id and ch.proy=p.proy and p.ures $seleccion and ch.estatus $estatus and (oficio='' or oficio is null) order by ch.cta_b, ch.cheque";
$qry_est = mysql_query($sql_est);

echo ("<table id='info' border='1'><thead><tr> <th>Cta Bancaria</th> <th>Cheque</th> <th>Fecha</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta</th> <th>Estatus</th> <th>Seguimiento</th> <th>Responsable</th> </tr></thead><tbody>");
while ($arr_est = mysql_fetch_array($qry_est)){
	echo ("<tr> <td align='center'>".$arr_est['cta_b']."</td> <td align='center'>".$arr_est['cheque']."</td> <td>".$arr_est['fecha']."</td> <td>".utf8_decode($arr_est['benef'])."</td> <td align='right'>".number_format($arr_est['monto'],2)."</td> <td>".$arr_est['proy']."</td> <td>".$arr_est['cta']."</td> <td>".$arr_est['estatus']."</td> <td>".$arr_est['seguimiento']."</td> <td>".$arr_est['responsable']."</td></tr>");
	$sum_monto += $arr_est['monto'];
}
echo ("<tr><td></td><td></td><td></td><td></td><td>".number_format($sum_monto,2)."</td></tr>");
echo ("</tbody></table>");
}
function ch_comp($res, $seleccion){//Cheques en proceso de comprobación
$sql_res = "select ch.cta_b, ch.cheque, ch.fecha, ben.benef, ch.monto, ch.proy, ch.cta, ch.responsable from tbl_cheques ch, tbl_benef ben, tbl_proyectos p where ch.benef_id=ben.benef_id and ch.proy=p.proy and ch.estatus in ('Facturas','Comprobado') and (oficio='' or oficio is NULL) and p.ures $seleccion and ch.responsable='$res' order by ch.cta_b, ch.cheque";
$qry_res = mysql_query($sql_res);

echo ("<table id='info' border='1'><thead><tr> <th>Cta Bancaria</th> <th>Cheque</th> <th>Fecha</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta</th> <th>Responsable</th> </tr></thead><tbody>");
while ($arr_res = mysql_fetch_array($qry_res)){
	echo ("<tr> <td align='center'>".$arr_res['cta_b']."</td> <td align='center'>".$arr_res['cheque']."</td> <td>".$arr_res['fecha']."</td> <td>".utf8_decode($arr_res['benef'])."</td> <td align='right'>".number_format($arr_res['monto'],2)."</td> <td>".$arr_res['proy']."</td> <td>".$arr_res['cta']."</td> <td>".$arr_res['responsable']."</td> </tr>");
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