<?php
function t_par($proy){//Muestra Informacion del Proyecto Participables
$sql_proy = "select tbl_proyectos.proy, tbl_proyectos.d_proy from tbl_proyectos where tbl_proyectos.proy = '$proy'"; 
$qry_proy = mysql_query($sql_proy);
$arr_proy = mysql_fetch_array($qry_proy);

echo("<table border='1'><thead><tr><th>Proyecto</th><th>Nombre del Proyecto</th></tr></thead> <tbody align='center'><tr> <td>".$arr_proy['proy']."</td> <td>".utf8_decode($arr_proy['d_proy'])."</td> </tr></tbody></table>");

//Muestra las Transferencias del Proyecto
$sql_t = "select * from tbl_transferencias where proy = $proy";
$qry_t = mysql_query($sql_t);
$sum_t = 0;
echo ("<p><table border = '1'><thead><tr> <th>Trans</th> <th>Invoice</th> <th>Fecha</th> <th>Proyecto</th> <th>Descripcion</th> <th>Monto</th> <th>Ejercido</th> <th>Requisiciones</th> </tr></thead><tbody align='center'>");
while($arr_t = mysql_fetch_array($qry_t)){
	$invoice = $arr_t['invoice'];//número de invoice
	echo ("<tr> <td>".$arr_t['t']."</td> <td>".$arr_t['invoice']."</td> <td>".$arr_t['fecha']."</td> <td>".$arr_t['proy']."</td> <td align='left'>".utf8_decode($arr_t['d_t'])."</td><td align = 'right'>".number_format($arr_t['monto'],2)."</td>");

	//Obtiene la suma de los cheques de cada invoice
	$sql_ch = "select sum(monto) from tbl_cheques where d_inv = $invoice";
	$qry_ch = mysql_query($sql_ch);
	$arr_ch = mysql_fetch_array($qry_ch);
	$monto_ch = $arr_ch['sum(monto)'];
	echo ("<td>".number_format($monto_ch)."</td>");

	//Obtiene la suma de las requisiciones de cada invoice
	$sql_req = "select sum(monto) from tbl_req where d_inv = $invoice";
	$qry_req = mysql_query($sql_req);
	$arr_req = mysql_fetch_array($qry_req);
	$monto_req = $arr_req['sum(monto)'];
	echo ("<td>".number_format($monto_req)."</td>");

	echo ("</tr>");
	$sum_t += $arr_t['monto'];
	$sum_ch += $monto_ch;
	$sum_req += $monto_req;
	}
echo ("<tr> <td></td> <td></td> <td></td> <td>".number_format($sum_t,2)."</td> </tr>");
echo ("</tbody></table></p>");
}
?>