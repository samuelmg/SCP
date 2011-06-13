<?php
/*
 * sxp_par.php
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

function sxp_par($proy){//Muestra Informacion del Proyecto Participables
global $cta;
global $reg;
$sql_proy = "select tbl_proyectos.proy, tbl_proyectos.d_proy from tbl_proyectos where tbl_proyectos.proy = '$proy'"; 
$qry_proy = mysql_query($sql_proy);
$arr_proy = mysql_fetch_array($qry_proy);

echo("<table id='info' border='1'><thead><tr><th>Proyecto</th><th>Nombre del Proyecto</th></tr></thead> <tbody align='center'><tr> <td>".$arr_proy['proy']."</td> <td>".utf8_decode($arr_proy['d_proy'])."</td> </tr></tbody></table>");

//Muestra las Transferencias del Proyecto
$sql_t = "select invoice, fecha, monto, d_t, d_inv, cta_b from tbl_transferencias where proy = $proy";
$qry_t = mysql_query($sql_t);
$sum_t = 0;
echo ("<p><table id='info' border = '1'><thead><tr> <th>Invoice</th> <th>Fecha</th> <th>Info</th> <th>Descripcion</th> <th>Cta Banco</th> <th>Monto</th> <th>Ejercido</th> <th>Req</th> <th>Reembolso</th> <th>Egresos</th> <th>Saldo</th> </tr></thead><tbody align='center'>");

while($arr_t = mysql_fetch_array($qry_t)){
	$invoice = $arr_t['invoice'];//número de invoice
	$monto_t = $arr_t['monto'];
	echo ("<tr> <td>".$arr_t['invoice']."</td> <td>".$arr_t['fecha']."</td> <td>".$arr_t['d_inv']."</td> <td align='left'>".utf8_decode($arr_t['d_t'])."</td> <td>".$arr_t['cta_b']."</td> <td align = 'right'>".number_format($arr_t['monto'],2)."</td>");

	//Obtiene la suma de los cheques de cada invoice
	$sql_ch = "select sum(monto) from tbl_cheques where d_inv = $invoice";
	$qry_ch = mysql_query($sql_ch);
	$arr_ch = mysql_fetch_array($qry_ch);
	$monto_ch = $arr_ch['sum(monto)'];
	echo ("<td>".number_format($monto_ch,2)."</td>");

	//Obtiene la suma de las requisiciones de cada invoice
	$sql_req = "select sum(monto) from tbl_req where d_inv = $invoice and estado not in ('P','C')";
	$qry_req = mysql_query($sql_req);
	$arr_req = mysql_fetch_array($qry_req);
	$monto_req = $arr_req['sum(monto)'];
	echo ("<td>".number_format($monto_req,2)."</td>");

	//Obtiene la suma de los reembolsos de cada invoice
	$sql_reem = "select sum(monto) from tbl_ingresos where d_inv = $invoice";
	$qry_reem = mysql_query($sql_reem);
	$arr_reem = mysql_fetch_array($qry_reem);
	$monto_reem = $arr_reem['sum(monto)'];
	echo ("<td>".number_format($monto_reem,2)."</td>");

	//Obtiene la suma de los egresos de cada invoice
	$sql_egreso = "select sum(monto) from tbl_egresos where d_inv = $invoice";
	$qry_egreso = mysql_query($sql_egreso);
	$arr_egreso = mysql_fetch_array($qry_egreso);
	$monto_egreso = $arr_egreso['sum(monto)'];
	echo ("<td>".number_format($monto_egreso,2)."</td>");

	$saldo = $monto_t - $monto_ch - $monto_req + $monto_reem - $monto_egreso;
	echo ("<td>".number_format($saldo,2)."</td>");

	echo ("</tr>");
	$sum_t += $monto_t;
	$sum_ch += $monto_ch;
	$sum_req += $monto_req;
	$sum_reem += $monto_reem;
	$sum_egreso += $monto_egreso;
	$sum_saldo += $saldo;
	}
echo ("<tr> <td></td> <td></td> <td></td> <td></td> <td></td> <td>".number_format($sum_t,2)."</td> <td>".number_format($sum_ch,2)."</td> <td>".number_format($sum_req,2)."</td> <td>".number_format($sum_reem,2)."</td> <td>".number_format($sum_egreso,2)."</td> <td>".number_format($sum_saldo,2)."</td></tr>");
echo ("</tbody></table></p>");

$sql_ctas_proy = "select cta from tbl_quincenas where proy = '$proy' group by cta"; //Relaciona todas las cuentas (OG) del Proyecto
$qry_ctas_proy = mysql_query($sql_ctas_proy);
$reg = mysql_num_rows($qry_ctas_proy);
//Captura la informacion de las tablas
for ($i=0; $i<$reg; $i++){
	$f_ctas_proy = mysql_fetch_array($qry_ctas_proy);
	$cta[$i] = $f_ctas_proy['cta'];
}
}
?>