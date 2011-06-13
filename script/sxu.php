<?php
/*
 * sxu.php
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

function sxu_ord($ures){
$sql_proy = "select proy, quin from tbl_proyectos where ures=$ures and fondo=1101"; //Relaciona los proyectos de la URes
$qry_proy = mysql_query($sql_proy);

$reg = mysql_num_rows($qry_proy);//Cuenta el numero de registos para controlar el contador

//Captura la informacion de las tablas
for ($i=0; $i<$reg; $i++){
	$arr_proy = mysql_fetch_array($qry_proy);
	$proy[$i] = $arr_proy['proy'];
	$quin = $arr_proy['quin'];

	$sql_disp = "select sum(monto) from tbl_quincenas where proy=$proy[$i] and quin <= $quin";//monto disponible por proy
	$qry_disp = mysql_query($sql_disp);
	$arr_disp = mysql_fetch_array($qry_disp);
	$disp[$i] = $arr_disp['sum(monto)'];

	$sql_ch = "select sum(monto) from tbl_cheques where proy=$proy[$i]";//monto ejercido en cheques
	$qry_ch = mysql_query($sql_ch);
	$arr_ch = mysql_fetch_array($qry_ch);
	$ch[$i] = $arr_ch['sum(monto)'];

	$sql_req = "select sum(monto) from tbl_req where proy=$proy[$i] and estado not in ('P','C')";//monto comprometido en requisiciones
	$qry_req = mysql_query($sql_req);
	$arr_req = mysql_fetch_array($qry_req);
	$req[$i] = $arr_req['sum(monto)'];

	$sql_ing = "select sum(monto) from tbl_ingresos where proy =$proy[$i]";//monto reembolsado
	$qry_ing = mysql_query($sql_ing);
	$arr_ing = mysql_fetch_array($qry_ing);
	$ing[$i] = $arr_ing['sum(monto)'];
}

//--Imprime los resultados en una tabla--
echo ("<p><table border='1'><thead><tr> <th>Proyecto</th> <th>Recibido</th> <th>Ejercido</th> <th>Requisiciones</th> <th>Reembolsos</th> <th>Saldo</th> </tr></thead><tbody align='right'>");
for ($j=0; $j<$reg; $j++){
	$saldo[$j] = $disp[$j]-$ch[$j]-$req[$j]+$ing[$j];
	$sum_disp+=$disp[$j];//Sumatoria Disponible
	$sum_ch+=$ch[$j];//Sumatoria Cheques
	$sum_req+=$req[$j];//Sumatoria Requisiciones
	$sum_ing+=$ing[$j];//Sumatoria Ingresos
	$sum_saldo+=$saldo[$j];//Sumatoria Saldos
	echo ("<tr> <td align='center'>".$proy[$j]."</td> <td>".number_format($disp[$j],2)."</td> <td>".number_format($ch[$j],2)."</td> <td>".number_format($req[$j],2)."</td> <td>".number_format($ing[$j],2)."</td> <td>".number_format($saldo[$j],2)."</td> </tr>");
}
echo ("<tr><td></td></tr><tr> <td align='center'>Total</td> <td>".number_format($sum_disp,2)."</td> <td>".number_format($sum_ch,2)."</td> <td>".number_format($sum_req,2)."</td> <td>".number_format($sum_ing,2)."</td> <td>".number_format($sum_saldo,2)."</td> </tr>");
echo ("</tbody></table></p>");
}

function sxu_ext($ures){
$sql_proy = "select proy, quin from tbl_proyectos where ures=$ures and fondo=1102"; //Relaciona los proyectos de la URes
$qry_proy = mysql_query($sql_proy);

$reg = mysql_num_rows($qry_proy);//Cuenta el numero de registos para controlar el contador

//Captura la informacion de las tablas
for ($i=0; $i<$reg; $i++){
	$arr_proy = mysql_fetch_array($qry_proy);
	$proy[$i] = $arr_proy['proy'];
	$quin = $arr_proy['quin'];

	$sql_disp = "select sum(monto) from tbl_quincenas where proy=$proy[$i] and quin <= $quin";//monto disponible por proy
	$qry_disp = mysql_query($sql_disp);
	$arr_disp = mysql_fetch_array($qry_disp);
	$disp[$i] = $arr_disp['sum(monto)'];

	$sql_ch = "select sum(monto) from tbl_cheques where proy=$proy[$i]";//monto ejercido en cheques
	$qry_ch = mysql_query($sql_ch);
	$arr_ch = mysql_fetch_array($qry_ch);
	$ch[$i] = $arr_ch['sum(monto)'];

	$sql_req = "select sum(monto) from tbl_req where proy=$proy[$i] and estado not in ('P','C')";//monto comprometido en requisiciones
	$qry_req = mysql_query($sql_req);
	$arr_req = mysql_fetch_array($qry_req);
	$req[$i] = $arr_req['sum(monto)'];

	$sql_ing = "select sum(monto) from tbl_ingresos where proy =$proy[$i]";//monto reembolsado
	$qry_ing = mysql_query($sql_ing);
	$arr_ing = mysql_fetch_array($qry_ing);
	$ing[$i] = $arr_ing['sum(monto)'];
}

//--Imprime los resultados en una tabla--
echo ("<p><table border='1'><thead><tr> <th>Proyecto</th> <th>Recibido</th> <th>Ejercido</th> <th>Requisiciones</th> <th>Reembolsos</th> <th>Saldo</th> </tr></thead><tbody align='right'>");
for ($j=0; $j<$reg; $j++){
	$saldo[$j] = $disp[$j]-$ch[$j]-$req[$j]+$ing[$j];
	$sum_disp+=$disp[$j];//Sumatoria Disponible
	$sum_ch+=$ch[$j];//Sumatoria Cheques
	$sum_req+=$req[$j];//Sumatoria Requisiciones
	$sum_ing+=$ing[$j];//Sumatoria Ingresos
	$sum_saldo+=$saldo[$j];//Sumatoria Saldos
	echo ("<tr> <td align='center'>".$proy[$j]."</td> <td>".number_format($disp[$j],2)."</td> <td>".number_format($ch[$j],2)."</td> <td>".number_format($req[$j],2)."</td> <td>".number_format($ing[$j],2)."</td> <td>".number_format($saldo[$j],2)."</td> </tr>");
}
echo ("<tr><td></td></tr><tr> <td align='center'>Total</td> <td>".number_format($sum_disp,2)."</td> <td>".number_format($sum_ch,2)."</td> <td>".number_format($sum_req,2)."</td> <td>".number_format($sum_ing,2)."</td> <td>".number_format($sum_saldo,2)."</td> </tr>");
echo ("</tbody></table></p>");
}
?>