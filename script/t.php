<?php
/*
 * t.php
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

function t($proy){//Muestra las transferencias del Proyecto
$sql_t = "select * from tbl_transferencias where proy = $proy";
$qry_t = mysql_query($sql_t);
$sum_t = 0;
echo ("<p><table border = '1'><thead><tr> <th>Transferencia</th> <th>Invoice</th> <th>Fecha</th> <th>Monto</th> <th>Descripcion</th> <th>Proyecto</th> <th>Cuenta Bancaria</th></tr></thead><tbody align='center'>");
while($arr_t = mysql_fetch_array($qry_t)){
	echo ("<tr> <td>".$arr_t['t']."</td> <td>".$arr_t['invoice']."</td> <td>".$arr_t['fecha']."</td> <td align = 'right'>".number_format($arr_t['monto'],2)."</td> <td align='left'>".$arr_t['d_t']."</td> <td>".$arr_t['proy']."</td> <td>".$arr_t['cta_b']."</td> </tr>");
	$sum_t += $arr_t['monto'];
}
echo ("<tr> <td></td> <td></td> <td></td> <td>".number_format($sum_t,2)."</td> </tr>");
echo ("</tbody></table></p>");
}
?>