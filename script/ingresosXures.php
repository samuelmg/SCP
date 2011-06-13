<?php
/*
 * ingresosXures.php
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

function ingresos($seleccion){
$sql_i = "select i.fecha, i.proy, i.cta, i.monto, i.cmt from tbl_ingresos i, tbl_proyectos p where i.proy=p.proy and p.ures $seleccion order by i.proy, i.fecha";
$qry_i = mysql_query($sql_i);

echo ("<table id='info' border='1'><thead><tr> <th>Fecha</th> <th>Proyecto</th> <th>Cuenta</th> <th>Monto</th> <th>Comentarios</th> </tr></thead><tbody>");
while ($arr_i = mysql_fetch_array($qry_i)){
	echo ("<tr> <td>".$arr_i['fecha']."</td> <td>".$arr_i['proy']."</td> <td>".$arr_i['cta']."</td> <td align='right'>".number_format($arr_i['monto'],2)."</td> <td>".$arr_i['cmt']."</td> </tr>");
	$sum_i+=$arr_i['monto'];
	}
echo ("<tr><td></td><td></td><td></td><td>".number_format($sum_i,2)."</td></tr>");
echo ("</tbody></table>");
}
?>