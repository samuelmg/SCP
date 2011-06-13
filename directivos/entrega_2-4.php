<html>
<head><TITLE>Formato Entrega Recepción 2.4</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_usr.php");
conect_usr();
include("../script/fecha.php");
$sql_gxc = ("select gxc.invoice, gxc.t, gxc.fecha, gxc.cargo, gxc.abono, gxc.saldo, gxc.d_t, gxc.proy, p.ures from tbl_proyectos p, tbl_gxc gxc where p.proy = gxc.proy");
$qry_gxc = mysql_query($sql_gxc);

echo ("<table align='center' id='info' border='1'><thead><tr><th colspan='9'>Partidas Pendientes por Comprobar</th></tr><tr> <th>Invoice</th> <th>Transferencia</th> <th>Fecha</th> <th>Cargo</th> <th>Abono</th> <th>Saldo</th> <th>Descripción</th> <th>Proyecto</th> <th>URes</th>  </tr></thead><tbody>");
$renglon='non';//cambio de color en renglones
while ($arr_gxc = mysql_fetch_array($qry_gxc)){
	$fecha=$arr_gxc['fecha'];
	fecha_info(&$fecha);
	echo ("<tr id='$renglon'> <td>".$arr_gxc['invoice']."</td> <td>".$arr_gxc['t']."</td> <td>".$fecha."</td> <td id='monto'>".number_format($arr_gxc['cargo'],2)."</td> <td id='monto'>".number_format($arr_gxc['abono'],2)."</td> <td id='monto'>".number_format($arr_gxc['saldo'],2)."</td> <td id='benef'>".utf8_decode($arr_gxc['d_t'])."</td>  <td>".$arr_gxc['proy']."</td> <td>".$arr_gxc['ures']."</td> </tr>");
	$sum_cargo += $arr_gxc['cargo'];
	$sum_abono += $arr_gxc['abono'];
	$sum_saldo += $arr_gxc['saldo'];
	if ($renglon=='non'){$renglon='par';}else{$renglon='non';}//cambio de color en renglones
	}
echo ("<tr><td colspan='3'></td><td id='total'>".number_format($sum_cargo,2)."</td> <td id='total'>".number_format($sum_abono,2)."</td> <td id='total'>".number_format($sum_saldo,2)."</td><td colspan='3'></td></tr>");
echo ("</tbody></table>");
?>
</body>
</html>