<?php
function sxp_par($proy){ //Muestra Informacion del Proyecto Participables
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
echo ("<p><table id='info' border = '1'><thead><tr> <th>Invoice</th> <th>Fecha</th> <th>Descripcion</th> <th>Info</th> <th>Monto</th> </tr></thead><tbody align='center'>");

while($arr_t = mysql_fetch_array($qry_t)){
	$invoice = $arr_t['invoice'];//número de invoice
	$monto_t = $arr_t['monto'];
	echo ("<tr> <td>".$arr_t['invoice']."</td> <td>".$arr_t['fecha']."</td> <td align='left'>".utf8_decode($arr_t['d_t'])."</td> <td align = 'right'>".$arr_t['d_inv']."</td> <td id='monto'>".number_format($arr_t['monto'],2)."</td>");
	$sum_t += $monto_t;
}
echo ("<tr> <td colspan='4'></td> <td id='total'>".number_format($sum_t,2)."</td></tr>");
echo ("</tbody></table></p>");

//Muestra los Recursos Participables Recibidos por persona
$sql_par = "select par.id, b.benef, par.proy, par.monto, par.t, par.obs from tbl_participables par, tbl_benef b where proy = $proy and par.benef_id = b.benef_id and par.t != ''";
$qry_par = mysql_query($sql_par);
$sum_par = 0;
echo ("<p><table id='info' border = '1'><thead><tr> <th>Id</th> <th>Beneficiario</th> <th>Observaciones</th> <th>Monto</th> <th>(-) Cheques</th> <th>(-) Transferencias</th> <th>(-) Requisiciones</th> <th>(+) Reembolsos</th> <th>(=) Saldo</th> </tr></thead><tbody>");

while($arr_par = mysql_fetch_array($qry_par)){
	$id = $arr_par['id'];
	$benef = $arr_par['benef'];
	$obs = $arr_par['obs'];
	$monto_par = $arr_par['monto'];

	echo ("<tr> <td>".$id."</td> <td id='benef'>".utf8_decode($benef)."</td> <td>".$obs."</td> <td id='monto'>".number_format($monto_par,2)."</td>");

	//Obtiene la suma de los cheques de cada investigador
	$sql_ch = "select sum(monto) from tbl_cheques where proy='$proy' and id='$id'";
	$qry_ch = mysql_query($sql_ch);
	$arr_ch = mysql_fetch_array($qry_ch);
	$monto_ch = $arr_ch['sum(monto)'];
	echo ("<td id='monto'>".number_format($monto_ch,2)."</td>");

	//Obtiene la suma de los egresos de cada investigador
	$sql_egreso = "select sum(monto) from tbl_egresos where proy='$proy' and id='$id'";
	$qry_egreso = mysql_query($sql_egreso);
	$arr_egreso = mysql_fetch_array($qry_egreso);
	$monto_egreso = $arr_egreso['sum(monto)'];
	echo ("<td id='monto'>".number_format($monto_egreso,2)."</td>");

	//Obtiene la suma de las requisiciones de cada investigador
	$sql_req = "select sum(monto) from tbl_req where proy='$proy' and id='$id' and estado not in ('P','C')";
	$qry_req = mysql_query($sql_req);
	$arr_req = mysql_fetch_array($qry_req);
	$monto_req = $arr_req['sum(monto)'];
	echo ("<td id='monto'>".number_format($monto_req,2)."</td>");

	//Obtiene la suma de los reembolsos de cada investigador
	$sql_reem = "select sum(monto) from tbl_ingresos where proy='$proy' and id='$id'";
	$qry_reem = mysql_query($sql_reem);
	$arr_reem = mysql_fetch_array($qry_reem);
	$monto_reem = $arr_reem['sum(monto)'];
	echo ("<td id='monto'>".number_format($monto_reem,2)."</td>");

	$saldo = $monto_par - $monto_ch - $monto_egreso - $monto_req + $monto_reem;
	echo ("<td id='monto'>".number_format($saldo,2)."</td>");

	echo ("</tr>");
	$sum_par += $monto_par;
	$sum_ch += $monto_ch;
	$sum_req += $monto_req;
	$sum_reem += $monto_reem;
	$sum_egreso += $monto_egreso;
	$sum_saldo += $saldo;
}
echo ("<tr> <td colspan='3'></td> <td id='total'>".number_format($sum_par,2)."</td> <td id='total'>".number_format($sum_ch,2)."</td> <td id='total'>".number_format($sum_egreso,2)."</td> <td id='total'>".number_format($sum_req,2)."</td> <td id='total'>".number_format($sum_reem,2)."</td> <td id='total'>".number_format($sum_saldo,2)."</td></tr>");
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