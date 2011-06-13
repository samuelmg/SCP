<?php
/*
 * sxp_ord.php
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

function sxp_ord($proy){//Muestra el Saldo x Proyecto para el Fondo 1101
global $cta;
global $reg;
$sql_proy = "select tbl_ures.ures, tbl_ures.d_ures, tbl_proyectos.proy, tbl_proyectos.d_proy, tbl_proyectos.monto, tbl_proyectos.quin from tbl_ures, tbl_proyectos where tbl_ures.ures=tbl_proyectos.ures and tbl_proyectos.proy = '$proy'"; //Sentencia SQL donde se filtra el proyecto
$qry_proy = mysql_query($sql_proy);
$arr_proy = mysql_fetch_array($qry_proy);

echo("<table id='info' border ='1'><thead><tr><th>U Res</th><th>Descripci�n URes</th><th>Proyecto</th><th>Nombre del Proyecto</th><th>Monto Autorizado</th> <th>Quincena Disponible</th></tr></thead> <tbody align='center'><tr><td>".$arr_proy['ures']."</td> <td>".utf8_decode($arr_proy['d_ures'])."</td> <td>".$arr_proy['proy']."</td> <td>".utf8_decode($arr_proy['d_proy'])."</td> <td>".number_format($arr_proy['monto'],2)."</td> <td>".$arr_proy['quin']."</td> </tr></tbody></table>");

$quin = $fila['quin'];//Toma el valor de la quincena disponible

$sql_ctas_proy = "select cta from tbl_quincenas where proy = '$proy' group by cta"; //Relaciona todas las cuentas (OG) del Proyecto
$qry_ctas_proy = mysql_query($sql_ctas_proy);

$reg = mysql_num_rows($qry_ctas_proy);//Cuenta el numero de registos para controlar el contador

//Captura la informacion de las tablas
for ($i=0; $i<$reg; $i++){
	$f_ctas_proy = mysql_fetch_array($qry_ctas_proy);
	$cta[$i] = $f_ctas_proy['cta'];

	$sql_pendiente = "select sum(monto) from tbl_quincenas where proy = '$proy' and cta = '$cta[$i]' and quin > (select quin from tbl_proyectos where proy = '$proy') group by cta";//monto pendiente por recibir
	$qry_pendiente = mysql_query($sql_pendiente);
	$arr_pendiente = mysql_fetch_array($qry_pendiente);
	$pendiente[$i] = $arr_pendiente['sum(monto)'];

	$sql_disp = "select sum(monto) from tbl_quincenas where proy = '$proy' and cta = '$cta[$i]' and quin <= (select quin from tbl_proyectos where proy = '$proy') group by cta";//monto disponible por cta
	$qry_disp = mysql_query($sql_disp);
	$arr_disp = mysql_fetch_array($qry_disp);
	$disp[$i] = $arr_disp['sum(monto)'];

	$sql_ch = "select sum(monto) from tbl_cheques where proy = '$proy' and cta = '$cta[$i]' group by cta";//monto ejercido en cheque por cuenta
	$qry_ch = mysql_query($sql_ch);
	$arr_ch = mysql_fetch_array($qry_ch);
	$ch[$i] = $arr_ch['sum(monto)'];

	$sql_req = "select sum(monto) from tbl_req where proy = '$proy' and cta = '$cta[$i]' and estado not in ('P','C') group by cta";//monto comprometido en requisiciones por cuenta
	$qry_req = mysql_query($sql_req);
	$arr_req = mysql_fetch_array($qry_req);
	$req[$i] = $arr_req['sum(monto)'];

	$sql_ing = "select sum(monto) from tbl_ingresos where proy = '$proy' and cta = '$cta[$i]' group by cta";//monto reembolsado por cuenta
	$qry_ing = mysql_query($sql_ing);
	$arr_ing = mysql_fetch_array($qry_ing);
	$ing[$i] = $arr_ing['sum(monto)'];

	$sql_egreso = "select sum(monto) from tbl_egresos where proy = '$proy' and cta = '$cta[$i]' group by cta";//monto egresos por cuenta
	$qry_egreso = mysql_query($sql_egreso);
	$arr_egreso = mysql_fetch_array($qry_egreso);
	$egreso[$i] = $arr_egreso['sum(monto)'];
}
//--Imprime los resultados en una tabla--
echo ("<p><table id='info' border='1'><thead><tr> <th>Cuenta (OG)</th> <th>X Recibir</th> <th>Recibido</th> <th>Ejercido</th> <th>Requisiciones</th> <th>Reembolsos</th> <th>Egresos</th> <th>Saldo</th> </tr></thead><tbody align='right'>");
for ($j=0; $j<$reg; $j++){
	$saldo[$j] = $disp[$j]-$ch[$j]-$req[$j]+$ing[$j]-$egreso[$j];
	$sum_pendiente+=$pendiente[$j];
	$sum_disp+=$disp[$j];
	$sum_ch+=$ch[$j];
	$sum_req+=$req[$j];
	$sum_ing+=$ing[$j];
	$sum_egreso+=$egreso[$j];
	$sum_saldo+=$saldo[$j];
	echo ("<tr> <td align='center'>".$cta[$j]."</td> <td>".number_format($pendiente[$j],2)."</td> <td>".number_format($disp[$j],2)."</td> <td>".number_format($ch[$j],2)."</td> <td>".number_format($req[$j],2)."</td> <td>".number_format($ing[$j],2)."</td> <td>".number_format($egreso[$j],2)."</td> <td>".number_format($saldo[$j],2)."</td> </tr>");
}
echo ("<tr><td></td></tr><tr> <td align='center'>Total</td> <td>".number_format($sum_pendiente,2)."</td> <td>".number_format($sum_disp,2)."</td> <td>".number_format($sum_ch,2)."</td> <td>".number_format($sum_req,2)."</td> <td>".number_format($sum_ing,2)."</td> <td>".number_format($sum_egreso,2)."</td> <td>".number_format($sum_saldo,2)."</td> </tr>");
echo ("</tbody></table></p>");
}
?>