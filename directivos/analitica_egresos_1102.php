<html>
<head><TITLE>Analítica de Egresos</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_usr.php");
conect_usr();

//Enlista todos los proyectos del fondo 1102
$i=0;//se inicializa el contador en 0
$sql_proy = "select proy, d_proy from tbl_proyectos where fondo = 1102 order by proy";
$qry_proy = mysql_query($sql_proy);
while ($arr_proy = mysql_fetch_array($qry_proy)){
	$proy[$i] = $arr_proy['proy'];
	$d_proy[$i] = $arr_proy['d_proy'];
	$i++;
	}

$fecha=getdate();
//$año=$fecha['year'];
$año=2007;

$periodo[0] = "'".$año."-01-01' and '".$año."-06-30'";
$periodo[1] = "'".$año."-01-01' and '".$año."-01-31'";
$periodo[2] = "'".$año."-02-01' and '".$año."-02-29'";
$periodo[3] = "'".$año."-03-01' and '".$año."-03-31'";
$periodo[4] = "'".$año."-04-01' and '".$año."-04-30'";
$periodo[5] = "'".$año."-05-01' and '".$año."-05-31'";
$periodo[6] = "'".$año."-06-01' and '".$año."-06-30'";
$periodo[7] = "'".$año."-07-01' and '".$año."-07-31'";
$periodo[8] = "'".$año."-08-01' and '".$año."-08-31'";
$periodo[9] = "'".$año."-09-01' and '".$año."-09-30'";
$periodo[10] = "'".$año."-10-01' and '".$año."-10-31'";
$periodo[11] = "'".$año."-11-01' and '".$año."-11-30'";
$periodo[12] = "'".$año."-12-01' and '".$año."-12-31'";

echo ("<table id='info' border='1'><thead><tr><td>Proyecto</td> <td>1er Semestre</td> <td>Enero</td> <td>Febrero</td> <td>Marzo</td> <td>Abril</td> <td>Mayo</td> <td>Junio</td> <td>Julio</td> <td>Agosto</td> <td>Septiembre</td> <td>Octubre</td> <td>Noviembre</td> <td>Diciembre</td> </tr></thead>");
for ($i=0; $i < sizeof($proy); $i++){
	echo ("<tr id='non'><td id='benef'>".$proy[$i]." ".$d_proy[$i]."</td>");
	for ($j=0; $j<13; $j++){
		$sql_mes = "select sum(monto) from tbl_cheques where proy = $proy[$i] and fecha between $periodo[$j]";
		$qry_mes = mysql_query($sql_mes);
		$arr_mes = mysql_fetch_array($qry_mes);
		$monto_ch = $arr_mes['sum(monto)'];

		$sql_e = "select sum(monto) from tbl_egresos where proy = $proy[$i] and tipo != 'Devolucion' and fecha between $periodo[$j]";
		$qry_e = mysql_query($sql_e);
		$arr_e = mysql_fetch_array($qry_e);
		$monto_e = $arr_e['sum(monto)'];

		$total_mes = $monto_ch + $monto_e;

		echo ("<td id='monto'>".number_format($total_mes,2)."</td>");
	}
	echo ("</tr>");
}
echo ("</table>");

?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./directivos.html">Menú Principal</a></p>
</body>
</html>