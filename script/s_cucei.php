<?php
function s_cucei_ord($seleccion){
echo ("<h3>SALDO POR UNIDAD RESPONSABLE (FONDO 1101 - ORDINARIO)</h3>");

$sql_ures = "select p.ures, u.d_ures from tbl_proyectos p, tbl_ures u where p.ures=u.ures and p.ures $seleccion and p.fondo = 1101 group by ures";
$qry_ures = mysql_query($sql_ures);
$cont = mysql_num_rows($qry_ures);

for ($h=0; $h<$cont; $h++){//Contador URes
	$arr_ures = mysql_fetch_array($qry_ures);
	$ures[$h] = $arr_ures['ures'];
	$d_ures = $arr_ures['d_ures'];
	echo ("<br />".$ures[$h]." ".$d_ures);

	$ures_temp = $ures[$h];
	$sql_proy = "select proy, quin from tbl_proyectos where ures = $ures_temp and fondo = 1101";
	$qry_proy = mysql_query($sql_proy);
	$reg = mysql_num_rows($qry_proy);//Cuenta el numero de registos para controlar el contador
	//Captura la informacion de las tablas
	for ($i=0; $i<$reg; $i++){//Contador Proyectos
		$arr_proy = mysql_fetch_array($qry_proy);
		$proy[$i] = $arr_proy['proy'];
		$quin = $arr_proy['quin'];
//<= $quin
		$sql_ts = "select sum(monto) from tbl_transferencias where proy=$proy[$i]";//monto real recibido en T's
		$qry_ts = mysql_query($sql_ts);
		$arr_ts = mysql_fetch_array($qry_ts);
		$ts[$i] = $arr_ts['sum(monto)'];

		$sql_disp = "select sum(monto) from tbl_quincenas where proy=$proy[$i] and quin <= $quin";//monto disponible por proy
		$qry_disp = mysql_query($sql_disp);
		$arr_disp = mysql_fetch_array($qry_disp);
		$disp[$i] = $arr_disp['sum(monto)'];

		$sql_ch = "select sum(monto) from tbl_cheques where proy=$proy[$i]";//monto ejercido en cheques
		$qry_ch = mysql_query($sql_ch);
		$arr_ch = mysql_fetch_array($qry_ch);
		$ch[$i] = $arr_ch['sum(monto)'];

		$sql_egreso = "select sum(monto) from tbl_egresos where proy =$proy[$i]";//monto egresos
		$qry_egreso = mysql_query($sql_egreso);
		$arr_egreso = mysql_fetch_array($qry_egreso);
		$egreso[$i] = $arr_egreso['sum(monto)'];

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
	echo ("<table class='info' border='1' width='70%'><thead><tr> <th>Proyecto</th>  <th>Transferido</th> <th>Q. Recibidas</th> <th>(-)Cheques</th> <th>(-)Transferencias</th> <th>(-)Requisiciones</th> <th>(+)Reembolsos</th> <th>(=)Saldo</th> </tr></thead><tbody align='right'>");
	$sum_ts=0;
	$sum_disp=0;
	$sum_ch=0;
	$sum_req=0;
	$sum_ing=0;
	$sum_egreso=0;
	$sum_saldo=0;
	for ($j=0; $j<$reg; $j++){
		$sum_ts+=$ts[$j];//Sumatoria Transferencias
		$saldo[$j] = $disp[$j]-$ch[$j]-$req[$j]+$ing[$j]-$egreso[$j];
		$sum_disp+=$disp[$j];//Sumatoria Disponible
		$sum_ch+=$ch[$j];//Sumatoria Cheques
		$sum_req+=$req[$j];//Sumatoria Requisiciones
		$sum_ing+=$ing[$j];//Sumatoria Ingresos
		$sum_egreso+=$egreso[$j];//Sumatoria Egresos
		$sum_saldo+=$saldo[$j];//Sumatoria Saldos
		echo ("<tr class='non'> <td>".$proy[$j]."</td> <td class='monto'>".number_format($ts[$j],2)."</td> <td class='monto'>".number_format($disp[$j],2)."</td> <td class='monto'>".number_format($ch[$j],2)."</td> <td class='monto'>".number_format($egreso[$j],2)."</td> <td class='monto'>".number_format($req[$j],2)."</td> <td class='monto'>".number_format($ing[$j],2)."</td> <td class='monto'>".number_format($saldo[$j],2)."</td> </tr>");
	}
echo ("<tr class='par'> <td>Total</td> <td class='total'>".number_format($sum_ts,2)."</td> <td class='total'>".number_format($sum_disp,2)."</td> <td class='total'>".number_format($sum_ch,2)."</td> <td class='total'>".number_format($sum_egreso,2)."</td> <td class='total'>".number_format($sum_req,2)."</td> <td class='total'>".number_format($sum_ing,2)."</td> <td class='total'>".number_format($sum_saldo,2)."</td> </tr>");
echo ("</tbody></table>");
}
}
function s_cucei_ext($seleccion){
echo ("<h3>SALDO POR UNIDAD RESPONSABLE (FONDO 1102 - EXTRAORDINARIO)</h3>");

$sql_ures = "select p.ures, u.d_ures from tbl_proyectos p, tbl_ures u where p.ures=u.ures and p.ures $seleccion and p.fondo = 1102 group by ures";
$qry_ures = mysql_query($sql_ures);
$cont = mysql_num_rows($qry_ures);

for ($h=0; $h<$cont; $h++){//Contador URes
	$arr_ures = mysql_fetch_array($qry_ures);
	$ures[$h] = $arr_ures['ures'];
	$d_ures = $arr_ures['d_ures'];
	echo ("<br />".$ures[$h]." ".$d_ures);

	$ures_temp = $ures[$h];
	$sql_proy = "select proy from tbl_proyectos where ures = $ures_temp and fondo = 1102";
	$qry_proy = mysql_query($sql_proy);
	$reg = mysql_num_rows($qry_proy);//Cuenta el numero de registos para controlar el contador
	//Captura la informacion de las tablas
	for ($i=0; $i<$reg; $i++){//Contador Proyectos
		$arr_proy = mysql_fetch_array($qry_proy);
		$proy[$i] = $arr_proy['proy'];

		$sql_disp = "select sum(monto) from tbl_transferencias where proy=$proy[$i]";//monto disponible por proy
		$qry_disp = mysql_query($sql_disp);
		$arr_disp = mysql_fetch_array($qry_disp);
		$disp[$i] = $arr_disp['sum(monto)'];

		$sql_ch = "select sum(monto) from tbl_cheques where proy=$proy[$i]";//monto ejercido en cheques
		$qry_ch = mysql_query($sql_ch);
		$arr_ch = mysql_fetch_array($qry_ch);
		$ch[$i] = $arr_ch['sum(monto)'];

		$sql_egreso = "select sum(monto) from tbl_egresos where proy =$proy[$i]";//monto egresos
		$qry_egreso = mysql_query($sql_egreso);
		$arr_egreso = mysql_fetch_array($qry_egreso);
		$egreso[$i] = $arr_egreso['sum(monto)'];

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
	echo ("<table border='1' width='70%' id='info'><thead><tr> <th>Proyecto</th> <th>Recibido</th> <th>(-)Cheques</th> <th>(-)Transferencias</th> <th>(-)Requisiciones</th> <th>(+)Reembolsos</th> <th>(=)Saldo</th> </tr></thead><tbody>");
	$sum_disp=0;
	$sum_ch=0;
	$sum_req=0;
	$sum_ing=0;
	$sum_egreso=0;
	$sum_saldo=0;
	for ($j=0; $j<$reg; $j++){
		$saldo[$j] = $disp[$j]-$ch[$j]-$req[$j]+$ing[$j]-$egreso[$j];
		$sum_disp+=$disp[$j];//Sumatoria Disponible
		$sum_ch+=$ch[$j];//Sumatoria Cheques
		$sum_req+=$req[$j];//Sumatoria Requisiciones
		$sum_ing+=$ing[$j];//Sumatoria Ingresos
		$sum_egreso+=$egreso[$j];//Sumatoria Egresos
		$sum_saldo+=$saldo[$j];//Sumatoria Saldos
		echo ("<tr id='par'> <td>".$proy[$j]."</td> <td id='monto'>".number_format($disp[$j],2)."</td> <td id='monto'>".number_format($ch[$j],2)."</td> <td id='monto'>".number_format($egreso[$j],2)."</td> <td id='monto'>".number_format($req[$j],2)."</td> <td id='monto'>".number_format($ing[$j],2)."</td> <td id='monto'>".number_format($saldo[$j],2)."</td> </tr>");
	}
echo ("<tr id='non'> <td>Total</td> <td id='total'>".number_format($sum_disp,2)."</td> <td id='total'>".number_format($sum_ch,2)."</td> <td id='total'>".number_format($sum_egreso,2)."</td> <td id='total'>".number_format($sum_req,2)."</td> <td id='total'>".number_format($sum_ing,2)."</td> <td id='total'>".number_format($sum_saldo,2)."</td> </tr>");
echo ("</tbody></table>");
}
}
function s_cucei_comp($seleccion){
echo ("<h3>SALDO PROYECTOS COMPROMETIDOS (FONDO 1105)</h3>");

$sql_ures = "select p.ures, u.d_ures from tbl_proyectos p, tbl_ures u where p.ures=u.ures and p.ures $seleccion and p.fondo = 1103 group by ures";
$qry_ures = mysql_query($sql_ures);
$cont = mysql_num_rows($qry_ures);

for ($h=0; $h<$cont; $h++){//Contador URes
	$arr_ures = mysql_fetch_array($qry_ures);
	$ures[$h] = $arr_ures['ures'];
	$d_ures = $arr_ures['d_ures'];
	echo ("<hr />".$d_ures);

	$ures_temp = $ures[$h];
	$sql_proy = "select proy from tbl_proyectos where ures = $ures_temp and fondo = 1103";
	$qry_proy = mysql_query($sql_proy);
	$reg = mysql_num_rows($qry_proy);//Cuenta el numero de registos para controlar el contador
	//Captura la informacion de las tablas
	for ($i=0; $i<$reg; $i++){//Contador Proyectos
		$arr_proy = mysql_fetch_array($qry_proy);
		$proy[$i] = $arr_proy['proy'];

		$sql_disp = "select sum(monto) from tbl_transferencias where proy=$proy[$i]";//monto disponible por proy
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

		$sql_egreso = "select sum(monto) from tbl_egresos where proy =$proy[$i]";//monto egresos
		$qry_egreso = mysql_query($sql_egreso);
		$arr_egreso = mysql_fetch_array($qry_egreso);
		$egreso[$i] = $arr_egreso['sum(monto)'];
	}

	//--Imprime los resultados en una tabla--
	echo ("<p><table border='1' width='70%'><thead><tr> <th>Proyecto</th> <th>Recibido</th> <th>Ejercido</th> <th>Requisiciones</th> <th>Reembolsos</th> <th>Egreso</th> <th>Saldo</th> </tr></thead><tbody align='right'>");
	$sum_disp=0;
	$sum_ch=0;
	$sum_req=0;
	$sum_ing=0;
	$sum_egreso=0;
	$sum_saldo=0;
	for ($j=0; $j<$reg; $j++){
		$saldo[$j] = $disp[$j]-$ch[$j]-$req[$j]+$ing[$j]-$egreso[$j];
		$sum_disp+=$disp[$j];//Sumatoria Disponible
		$sum_ch+=$ch[$j];//Sumatoria Cheques
		$sum_req+=$req[$j];//Sumatoria Requisiciones
		$sum_ing+=$ing[$j];//Sumatoria Ingresos
		$sum_egreso+=$egreso[$j];//Sumatoria Egresos
		$sum_saldo+=$saldo[$j];//Sumatoria Saldos
		echo ("<tr> <td align='center'>".$proy[$j]."</td> <td>".number_format($disp[$j],2)."</td> <td>".number_format($ch[$j],2)."</td> <td>".number_format($req[$j],2)."</td> <td>".number_format($ing[$j],2)."</td> <td>".number_format($egreso[$j],2)."</td> <td>".number_format($saldo[$j],2)."</td> </tr>");
	}
echo ("<tr><td></td></tr><tr> <td align='center'>Total</td> <td>".number_format($sum_disp,2)."</td> <td>".number_format($sum_ch,2)."</td> <td>".number_format($sum_req,2)."</td> <td>".number_format($sum_ing,2)."</td> <td>".number_format($sum_egreso,2)."</td> <td>".number_format($sum_saldo,2)."</td> </tr>");
echo ("</tbody></table></p>");
}
}
?>