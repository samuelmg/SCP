<?php
/*
 * reqxp.php
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

function reqxp($proy){
$sql_req = "select n_req, monto, proy, cta, fecha, estado from tbl_req where proy = $proy and estado not in ('C') order by fecha";
$qry_req = mysql_query($sql_req);

echo ("<table border='1'><thead><tr> <th>No. Requisicion</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta (OG)</th> <th>Fecha de Aprobacion</th> <th>Estado</th> </tr></thead><tbody>");
while ($arr_req = mysql_fetch_array($qry_req)){
	echo ("<tr> <td align='center'>".$arr_req['n_req']."</td> <td>".number_format($arr_req['monto'],2)."</td> <td>".$arr_req['proy']."</td> <td>".$arr_req['cta']."</td> <td>".$arr_req['fecha']."</td> <td>".$arr_req['estado']."</td> </tr>");
	$sum_monto += $arr_req['monto'];
	}
echo ("<tr><td></td><td>".number_format($sum_monto,2)."</td></tr>");
echo ("</tbody></table>");
}

function reqxp_oxcta($proy){//Selecciona los Cheques del Proyecto y los ordena x Cuenta
echo ("<table border='1'><thead><tr> <th>No. Requisicion</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta (OG)</th> <th>Fecha de Aprobacion</th> <th>Estado</th> </tr></thead><tbody>");
//Obtiene todas las cuentas del proyecto
$sql_cta = "select cta from tbl_quincenas where proy = $proy group by cta";
$qry_cta = mysql_query($sql_cta);
while ($arr_cta = mysql_fetch_array($qry_cta)){
	$cta = $arr_cta['cta'];
	$sql_req = "select n_req, monto, proy, cta, fecha, estado from tbl_req where proy = $proy and cta = $cta and estado not in ('C')";
	$qry_req = mysql_query($sql_req);
	$sum_monto = 0;
	while ($arr_req = mysql_fetch_array($qry_req)){
		echo ("<tr> <td align='center'>".$arr_req['n_req']."</td> <td align='right'>".number_format($arr_req['monto'],2)."</td> <td>".$arr_req['proy']."</td> <td>".$arr_req['cta']."</td> <td>".$arr_req['fecha']."</td> <td>".$arr_req['estado']."</td> </tr>");
		$cta = $arr_req['cta'];
		$sum_monto += $arr_req['monto'];
	}
	if($sum_monto != 0){
		echo ("<tr><td></td><td>".number_format($sum_monto,2)."</td></tr><tr><td></td></tr>");
	}
}
echo ("</tbody></table>");
}

?>