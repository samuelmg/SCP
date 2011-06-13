<?php
/*
 * ch_estatus.php
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

function chxestatus($proy){
$sql_est = "select ch.cta_b, ch.cheque, ch.fecha, ben.benef, ch.monto, ch.proy, ch.cta, ch.estatus, ch.seguimiento from tbl_cheques ch, tbl_benef ben where ch.benef_id=ben.benef_id and ch.estatus=$estatus order by ch.cta_b, ch.cheque";
$qry_est = mysql_query($sql_ch);

echo ("<table border='1'><thead><tr> <th>Cta Bancaria</th> <th>Cheque</th> <th>Fecha</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta</th> <th>Estatus</th> <th>Seguimiento</th> </tr></thead><tbody>");
while ($arr_est = mysql_fetch_array($qry_est)){
	echo ("<tr> <td align='center'>".$arr_est['cta_b']."</td> <td align='center'>".$arr_est['cheque']."</td> <td>".$arr_est['fecha']."</td> <td>".utf8_decode($arr_est['benef'])."</td> <td align='right'>".number_format($arr_est['monto'],2)."</td> <td>".$arr_est['proy']."</td> <td>".$arr_est['cta']."</td> <td>".$arr_est['estatus']."</td> <td>".$arr_est['seguimiento']."</td> </tr>");
	$sum_monto += $arr_est['monto'];
	}
echo ("<tr><td></td><td></td><td></td><td></td><td>".number_format($sum_monto,2)."</td></tr>");
echo ("</tbody></table>");
}

/*function chxp_oxcta($proy){//Selecciona los Cheques del Proyecto y los ordena x Cuenta
echo ("<table border='1'><thead><tr> <th>Cta Bancaria</th> <th>Cheque</th> <th>Fecha</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta</th> </tr></thead><tbody>");
//Obtiene todas las cuentas del proyecto
$sql_cta = "select cta from tbl_quincenas where proy = $proy group by cta";
$qry_cta = mysql_query($sql_cta);
while ($arr_cta = mysql_fetch_array($qry_cta)){
	$cta = $arr_cta['cta'];
	$sql_ch = "select ch.cta_b, ch.cheque, ch.fecha, ben.benef, ch.monto, ch.proy, ch.cta from tbl_cheques ch, tbl_benef ben where ch.benef_id = ben.benef_id and ch.proy = $proy and ch.cta = $cta order by ch.cta_b, ch.cheque";
	$qry_ch = mysql_query($sql_ch);
	$sum_monto = 0;
	while ($arr_ch = mysql_fetch_array($qry_ch)){
		echo ("<tr> <td align='center'>".$arr_ch['cta_b']."</td> <td align='center'>".$arr_ch['cheque']."</td> <td>".$arr_ch['fecha']."</td> <td>".utf8_decode($arr_ch['benef'])."</td> <td align='right'>".number_format($arr_ch['monto'],2)."</td> <td>".$arr_ch['proy']."</td> <td>".$arr_ch['cta']."</td> </tr>");
		$cta = $arr_ch['cta'];
		$sum_monto += $arr_ch['monto'];
	}
	if($sum_monto != 0){
		echo ("<tr><td></td><td></td><td></td><td></td><td align='right'>".number_format($sum_monto,2)."</td></tr><tr><td></td></tr>");
	}
}
echo ("</tbody></table>");
}*/

?>