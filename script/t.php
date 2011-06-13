<?php
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