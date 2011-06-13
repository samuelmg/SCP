<?php
function dev_ord($lim_quin){
echo ("<h3>REPORTE GLOBAL PARA DEVOLUCION DE RECURSOS (FONDO 1101 - ORDINARIO)</h3>");
global $cta;
global $reg;

$sql_ures = "select p.ures, u.d_ures from tbl_proyectos p, tbl_ures u where p.ures=u.ures and p.fondo = 1101 group by ures order by p.ures";
$qry_ures = mysql_query($sql_ures);
$reg_ures = mysql_num_rows($qry_ures);

for ($h=0; $h<$reg_ures; $h++){//Contador URes
	$arr_ures = mysql_fetch_array($qry_ures);
	$ures = $arr_ures['ures'];
	$d_ures = $arr_ures['d_ures'];
	echo ("<h4>".$ures." ".$d_ures."</h4>");

	$sql_proy = "select proy, quin from tbl_proyectos where ures = $ures and fondo = 1101";
	$qry_proy = mysql_query($sql_proy);
	$reg_proy = mysql_num_rows($qry_proy);

	for ($i=0; $i<$reg_proy; $i++){//Contador Proyectos
		$arr_proy = mysql_fetch_array($qry_proy);
		$proy = $arr_proy['proy'];
		$quin = $arr_proy['quin'];
		echo ("<table id='info' border='1' width='70%'><thead><tr><th colspan='8'>".$proy."</th></tr>");
		echo ("<tr><th>Cuenta</th> <th>Recibido</th> <th>(-)Cheques</th> <th>(-)Transferencias</th> <th>(-)Requisiciones</th> <th>(+)Reembolsos</th> <th>(-)Quin > ".$lim_quin." hasta ".$quin."</th> <th>(=)Devolución</th></tr></thead><tbody>");

		$sql_ctas_proy = "select cta from tbl_quincenas where proy = '$proy' group by cta"; //Relaciona las cuentas (OG) del Proyecto
		$qry_ctas_proy = mysql_query($sql_ctas_proy);
		$reg_ctas = mysql_num_rows($qry_ctas_proy);//Cuenta el numero de registos para controlar el contador

		//Captura la informacion de las tablas
		for ($j=0; $j<$reg_ctas; $j++){
			$arr_ctas_proy = mysql_fetch_array($qry_ctas_proy);
			$cta[$j] = $arr_ctas_proy['cta'];

			$sql_disp = "select sum(monto) from tbl_quincenas where proy = '$proy' and cta = '$cta[$j]' and quin <= $quin group by cta";//monto disponible por cta
			$qry_disp = mysql_query($sql_disp);
			$arr_disp = mysql_fetch_array($qry_disp);
			$disp[$j] = $arr_disp['sum(monto)'];

			$sql_ch = "select sum(monto) from tbl_cheques where proy = '$proy' and cta = '$cta[$j]' group by cta";//monto ejercido en cheque por cuenta
			$qry_ch = mysql_query($sql_ch);
			$arr_ch = mysql_fetch_array($qry_ch);
			$ch[$j] = $arr_ch['sum(monto)'];

			$sql_egreso = "select sum(monto) from tbl_egresos where proy = '$proy' and cta = '$cta[$j]' group by cta";//monto egresos por cuenta
			$qry_egreso = mysql_query($sql_egreso);
			$arr_egreso = mysql_fetch_array($qry_egreso);
			$egreso[$j] = $arr_egreso['sum(monto)'];

			$sql_req = "select sum(monto) from tbl_req where proy = '$proy' and cta = '$cta[$j]' and estado not in ('P','C') group by cta";//monto comprometido en requisiciones por cuenta
			$qry_req = mysql_query($sql_req);
			$arr_req = mysql_fetch_array($qry_req);
			$req[$j] = $arr_req['sum(monto)'];

			$sql_ing = "select sum(monto) from tbl_ingresos where proy = '$proy' and cta = '$cta[$j]' group by cta";//monto reembolsado por cuenta
			$qry_ing = mysql_query($sql_ing);
			$arr_ing = mysql_fetch_array($qry_ing);
			$ing[$j] = $arr_ing['sum(monto)'];

			$sql_no_dev = "select sum(monto) from tbl_quincenas where proy = '$proy' and cta = '$cta[$j]' and quin > $lim_quin and quin <= $quin group by cta";//monto recibido pero que no se va a devolver
			$qry_no_dev = mysql_query($sql_no_dev);
			$arr_no_dev = mysql_fetch_array($qry_no_dev);
			$no_dev[$j] = $arr_no_dev['sum(monto)'];
		}
		//Imprime Información
		$sum_disp=0;
		$sum_ch=0;
		$sum_egreso=0;
		$sum_req=0;
		$sum_ing=0;
		$sum_no_dev=0;
		$sum_dev=0;
		for ($k=0; $k<$reg_ctas; $k++){
			$dev[$k] = $disp[$k] - $ch[$k] - $egreso[$k] - $req[$k] + $ing[$k] - $no_dev[$k];
			if ($dev[$k]>0){
				echo ("<tr id='par'><td>".$cta[$k]."</td> <td id='monto'>".number_format($disp[$k],2)."</td> <td id='monto'>".number_format($ch[$k],2)."</td> <td id='monto'>".number_format($egreso[$k],2)."</td> <td id='monto'>".number_format($req[$k],2)."</td> <td id='monto'>".number_format($ing[$k],2)."</td> <td id='monto'>".number_format($no_dev[$k],2)."</td> <td id='monto'>".number_format($dev[$k],2)."</td></tr>");
				$sum_disp+=$disp[$k];
				$sum_ch+=$ch[$k];
				$sum_egreso+=$egreso[$k];
				$sum_req+=$req[$k];
				$sum_ing+=$ing[$k];
				$sum_no_dev+=$no_dev[$k];
				$sum_dev+=$dev[$k];
			}
		}
		echo ("<tr id='non'> <td></td> <td id='total'>".number_format($sum_disp,2)."</td> <td id='total'>".number_format($sum_ch,2)."</td> <td id='total'>".number_format($sum_egreso,2)."</td> <td id='total'>".number_format($sum_req,2)."</td> <td id='total'>".number_format($sum_ing,2)."</td> <td id='total'>".number_format($sum_no_dev,2)."</td> <td id='total'>".number_format($sum_dev,2)."</td></tr>");
		echo ("</tbody></table><br />");
	}
}
}
?>