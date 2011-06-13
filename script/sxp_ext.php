<?php
function sxp_ext($proy){//Muestra el Saldo x Proyecto para el Fondo 1102
global $cta;
global $reg;
$sql_proy = "select tbl_ures.ures, tbl_ures.d_ures, tbl_proyectos.proy, tbl_proyectos.d_proy, tbl_proyectos.monto from tbl_ures, tbl_proyectos where tbl_ures.ures=tbl_proyectos.ures and tbl_proyectos.proy = '$proy'"; 
$qry_proy = mysql_query($sql_proy);
$arr_proy = mysql_fetch_array($qry_proy);

echo("<table id='info'><thead><tr><th>U Res</th><th>Descripción URes</th><th>Proyecto</th><th>Nombre del Proyecto</th><th>Monto Autorizado</th></tr></thead> <tbody><tr id='par'> <td>".$arr_proy['ures']."</td> <td>".utf8_decode($arr_proy['d_ures'])."</td> <td>".$arr_proy['proy']."</td> <td>".utf8_decode($arr_proy['d_proy'])."</td> <td>".number_format($arr_proy['monto'],2)."</td> </tr></tbody></table>");

//Muestra las Transferencias del Proyecto
$sql_t = "select * from tbl_transferencias where proy = $proy order by fecha";
$qry_t = mysql_query($sql_t);
$sum_t = 0;
echo ("<p><table id='info'><thead> <tr><th>Transferencia</th> <th>Invoice</th> <th>Fecha</th> <th>Monto</th> <th>Descripcion</th> <th>Proyecto</th> <th>Cuenta Bancaria</th></tr></thead><tbody>");
while($arr_t = mysql_fetch_array($qry_t)){
	echo ("<tr id='par'> <td>".$arr_t['t']."</td> <td>".$arr_t['invoice']."</td> <td>".$arr_t['fecha']."</td> <td id='monto'>".number_format($arr_t['monto'],2)."</td> <td id='benef'>".utf8_decode($arr_t['d_t'])."</td> <td>".$arr_t['proy']."</td> <td>".$arr_t['cta_b']."</td> </tr>");
	$sum_t += $arr_t['monto'];
}
echo ("<tr> <td></td> <td></td> <td></td> <td id='total'>".number_format($sum_t,2)."<sup><small>1</small></sup></td> </tr>");
echo ("</tbody></table></p>");

$sql_ctas_proy = "select cta from tbl_quincenas where proy = '$proy' group by cta"; //Relaciona todas las cuentas (OG) del Proyecto
$qry_ctas_proy = mysql_query($sql_ctas_proy);
$reg = mysql_num_rows($qry_ctas_proy);

//Captura la informacion de las tablas
for ($i=0; $i<$reg; $i++){
	$arr_ctas_proy = mysql_fetch_array($qry_ctas_proy);
	$cta[$i] = $arr_ctas_proy['cta'];

	$sql_desc_cta = "select d_cta from tbl_cuentas where cta='$cta[$i]'";//Descripcion de Cuentas (OG)
	$qry_desc_cta = mysql_query($sql_desc_cta);
	$arr_desc_cta = mysql_fetch_array($qry_desc_cta);
	$d_cta[$i] = $arr_desc_cta['d_cta'];

	$sql_pres = "select sum(monto) from tbl_quincenas where proy = '$proy' and cta = '$cta[$i]' and quin <= (select quin from tbl_proyectos where proy = '$proy') group by cta";//monto presupuestado por cta
	$qry_pres = mysql_query($sql_pres);
	$arr_pres = mysql_fetch_array($qry_pres);
	$pres[$i] = $arr_pres['sum(monto)'];

	$sql_rec = "select sum(monto) from tbl_recursos where proy = '$proy' and cta = '$cta[$i]' group by cta";//monto presupuestado por cta
	$qry_rec = mysql_query($sql_rec);
	$arr_rec = mysql_fetch_array($qry_rec);
	$rec[$i] = $arr_rec['sum(monto)'];

	$sql_ch = "select sum(monto) from tbl_cheques where proy = '$proy' and cta = '$cta[$i]' group by cta";//monto ejercido en cheque por cuenta
	$qry_ch = mysql_query($sql_ch);
	$arr_ch = mysql_fetch_array($qry_ch);
	$ch[$i] = $arr_ch['sum(monto)'];

	$sql_egreso = "select sum(monto) from tbl_egresos where proy = '$proy' and cta = '$cta[$i]' group by cta";//monto egresos por cuenta
	$qry_egreso = mysql_query($sql_egreso);
	$arr_egreso = mysql_fetch_array($qry_egreso);
	$egreso[$i] = $arr_egreso['sum(monto)'];

	$sql_req = "select sum(monto) from tbl_req where proy = '$proy' and cta = '$cta[$i]' and estado not in ('P','C') group by cta";//monto comprometido en requisiciones por cuenta
	$qry_req = mysql_query($sql_req);
	$arr_req = mysql_fetch_array($qry_req);
	$req[$i] = $arr_req['sum(monto)'];

	$sql_ing = "select sum(monto) from tbl_ingresos where proy = '$proy' and cta = '$cta[$i]' group by cta";//monto reembolsado por cuenta
	$qry_ing = mysql_query($sql_ing);
	$arr_ing = mysql_fetch_array($qry_ing);
	$ing[$i] = $arr_ing['sum(monto)'];

}

//--Imprime los resultados en una tabla--
echo ("<p><table id='info' border = '1'><thead><tr> <th>Cuenta (OG)</th> <th>Descripción</th> <th>Presupuesto</th> <th>Recibido</th> <th>(-) Cheques</th> <th>(-) Transferencias</th> <th>(-) Requisiciones</th> <th>(+) Reembolsos</th> <th>(=) Saldo</th> </tr></thead><tbody>");
for ($j=0; $j<$reg; $j++){
	$gasto[$j] = $ch[$j]+$req[$j]-$ing[$j]+$egreso[$j];//Total GASTADO
	$sum_gasto+=$gasto[$j];
	$saldo[$j] = $rec[$j]-$ch[$j]-$req[$j]+$ing[$j]-$egreso[$j];//Saldo del Proyectado

//Subtotales
	$sum_pres+=$pres[$j];
	$sum_rec+=$rec[$j];
	$sum_ch+=$ch[$j];
	$sum_egreso+=$egreso[$j];
	$sum_req+=$req[$j];
	$sum_ing+=$ing[$j];
	$sum_saldo+=$saldo[$j];

	echo ("<tr id='par'> <td>".$cta[$j]."</td> <td id='benef'>".$d_cta[$j]."</td> <td id='monto'>".number_format($pres[$j],2)."</td> <td id='monto'>".number_format($rec[$j],2)."</td> <td id='monto'>".number_format($ch[$j],2)."</td> <td id='monto'>".number_format($egreso[$j],2)."</td> <td id='monto'>".number_format($req[$j],2)."</td> <td id='monto'>".number_format($ing[$j],2)."</td> <td id='monto'>".number_format($saldo[$j],2)."</td></tr>");
}
echo ("<tr id='non'> <td colspan='2'></td> <td id='total'>".number_format($sum_pres,2)."</td> <td id='total'>".number_format($sum_rec,2)."<sup><small>1</small></sup></td> <td id='total'>".number_format($sum_ch,2)."</td> <td id='total'>".number_format($sum_egreso,2)."</td> <td id='total'>".number_format($sum_req,2)."</td> <td id='total'>".number_format($sum_ing,2)."</td> <td id='total'>".number_format($sum_saldo,2)."</td> </tr>");
echo ("</tbody></table></p>");
}
?>