<html>
<head><TITLE>Reporte Transferencias - Cheques</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include ("../script/conect_usr.php");
conect_usr();
echo ("<h3>Reporte de Transferencias - Cheques</h3>");


$sql_proy = "select proy from tbl_proyectos where proy > 0";
$qry_proy = mysql_query($sql_proy);

while ($arr_proy = mysql_fetch_array($qry_proy)){
	$proy = $arr_proy['proy'];
	echo ("$proy <br>");
	$ch_div = 0;

//FILTRANDO PRIMER SEMESTRE 01 DE ABRIL DE 2008

//Consultas
$sql_egresos = "select c.fecha, c.cta_b, c.cheque, c.proy, b.benef, sum(c.monto), c.obs, c.estatus, c.oficio, c.responsable from tbl_cheques c, tbl_benef b where c.benef_id=b.benef_id and c.proy = '$proy' group by c.fecha, c.cta_b, c.cheque, c.proy, b.benef, c.obs, c.estatus, c.oficio, c.responsable
UNION ALL
select e.fecha, e.cta_b, e.no_t, e.proy, b.benef, sum(e.monto), e.cmt, e.estatus, e.oficio, e.responsable from tbl_egresos e, tbl_benef b where e.benef_id=b.benef_id and e.proy = '$proy' group by e.fecha, e.cta_b, e.no_t, e.proy, b.benef, e.cmt, e.estatus, e.oficio, e.responsable
UNION ALL
select i.fecha, i.cta_b, 0, i.proy, 'U de G', (i.monto)*(-1), i.cmt, i.tipo, '', '' from tbl_ingresos i where i.proy='$proy' order by fecha";

$qry_egresos = mysql_query($sql_egresos);

$sql_t = "select t, invoice, fecha, monto, d_t, proy, d_inv, cta_b from tbl_transferencias where proy = '$proy' and fecha between '2007-01-01' and '2007-06-30'";
$qry_t = mysql_query($sql_t);

//Imprime Transferencias
while ($fila_t = mysql_fetch_row($qry_t)){
$sum_egresos=0;
//Encabezado
	echo ("<table class='info' border='1' width='98%'><thead><tr> <th>Transferencia</th> <th>Invoice</th> <th>Fecha</th> <th>Monto</th> <th>Descripción</th> <th>Proyecto</th> <th>Desc Invoice</th> <th>Cta Bancaria</th> </tr></thead> <tbody>");
//Transferencia
	echo ("<tr> <td>".$fila_t['0']."</td> <td>".$fila_t['1']."</td> <td>".$fila_t['2']."</td> <td class='monto'>".number_format($fila_t['3'],2)."</td> <td>".$fila_t['4']."</td> <td>".$fila_t['5']."</td> <td>".$fila_t['6']."</td> <td>".$fila_t['7']."</td> </tr>");
	$monto_t = $fila_t['3'];
	echo ("</tbody></table>");

//Imprime Cheques
//Encabezado
	echo ("<table id='info' border='1' width='98%'><thead><tr> <th>Fecha</th> <th>Cta Bancaria</th> <th>Cheque</th> <th>Proyecto</th> <th>Beneficiario</th> <th>Monto</th> <th>Observaciones</th> <th>Estatus</th> <th>Oficio Comp</th> <th>Responsable</th> </tr></thead> <tbody>");

	if ($ch_div == 1){//Imprime el complemento del cheque
		$egreso = $diferencia;
		echo ("<tr> <td>".$fila_egresos['0']."</td> <td>".$fila_egresos['1']."</td> <td>".$fila_egresos['2']."</td> <td>".$fila_egresos['3']."</td> <td>".$fila_egresos['4']."</td> <td class='monto'>".number_format($egreso,2)."</td> <td>".$fila_egresos['6']."</td> <td>".$fila_egresos['7']."</td> <td>".$fila_egresos['8']."</td> <td>".$fila_egresos['9']."</td> </tr>");
		$sum_egresos = $egreso;
	}
	$ch_div = 0;

	while ($fila_egresos = mysql_fetch_row($qry_egresos)){
		$egreso = $fila_egresos['5'];
		$sum_egresos += $fila_egresos['5'];
		evalua($monto_t, $sum_egresos);

		echo ("<tr> <td>".$fila_egresos['0']."</td> <td>".$fila_egresos['1']."</td> <td>".$fila_egresos['2']."</td> <td>".$fila_egresos['3']."</td> <td>".$fila_egresos['4']."</td> <td class='monto'>".number_format($egreso,2)."</td> <td>".$fila_egresos['6']."</td> <td>".$fila_egresos['7']."</td> <td>".$fila_egresos['8']."</td> <td>".$fila_egresos['9']."</td> </tr>");

		while(($sum_egresos < $monto_t) && ($fila_egresos = mysql_fetch_row($qry_egresos))){
			$ch_div=0;
			$egreso = $fila_egresos['5'];
			$sum_egresos += ($fila_egresos['5']);
			echo ("<tr> <td>".$fila_egresos['0']."</td> <td>".$fila_egresos['1']."</td> <td>".$fila_egresos['2']."</td> <td>".$fila_egresos['3']."</td> <td>".$fila_egresos['4']."</td> <td class='monto'>".number_format($egreso,2)."</td> <td>".$fila_egresos['6']."</td> <td>".$fila_egresos['7']."</td> <td>".$fila_egresos['8']."</td> <td>".$fila_egresos['9']."</td> </tr>");
		}
	break;
	}
	echo ("<tr><td colspan='5'></td><td class='total'>".number_format($sum_egresos,2)."</td><td colspan='4'</tr></tbody></table>");
	echo ("<br />");
}echo ("<hr><br />");

}

function evalua($monto_t, $sum_egresos){
	$diferencia = $sum_egresos - $monto_t;
	if ($diferencia > 0){
		$egreso -= $diferencia;
		$sum_egresos -= $diferencia;
		$ch_div = 1;//Cheque Dividido (bandera para imprimir el complemento del cheque en la siguiente transferencia)
	}
}
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./directivos.html">Menú Principal</a></p>
</body>
</html>