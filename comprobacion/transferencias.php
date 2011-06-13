<html>
<head><TITLE>Comprobaciones - CUCEI</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_usr.php");
conect_usr();
include("../script/sui.php");
include("../script/fecha.php");
$usr = $_SERVER[PHP_AUTH_USER];
$seleccion = usr($usr);
$sql_t = ("select p.ures, t.t, t.invoice, t.fecha, t.monto, t.d_t, t.proy, t.d_inv, t.cta_b from tbl_proyectos p, tbl_transferencias t where p.proy = t.proy and p.ures $seleccion order by t.t, t.invoice");
$qry_t = mysql_query($sql_t);

echo ("<table align='center' id='info' border='1'><thead><tr><th colspan='8'>Transferencias Recibidas</th></tr><tr> <th>Transferencia</th> <th>Invoice</th> <th>Fecha</th> <th>Monto</th> <th>Descripción</th> <th>Proyecto</th> <th>Desc. Invoice</th> <th>Cta Bancaria</th></tr></thead><tbody>");
$renglon='non';//cambio de color en renglones
while ($arr_t = mysql_fetch_array($qry_t)){
	$fecha=$arr_t['fecha'];
	fecha_info(&$fecha);
	echo ("<tr id='$renglon'> <td>".$arr_t['t']."</td> <td>".$arr_t['invoice']."</td> <td>".$fecha."</td> <td id='monto'>".number_format($arr_t['monto'],2)."</td> <td id='benef'>".utf8_decode($arr_t['d_t'])."</td>  <td>".$arr_t['proy']."</td> <td>".$arr_t['d_inv']."</td> <td>".$arr_t['cta_b']."</td> </tr>");
	$sum_monto += $arr_t['monto'];
	if ($renglon=='non'){$renglon='par';}else{$renglon='non';}//cambio de color en renglones
	}
echo ("<tr><td colspan='3'></td><td id='total'>".number_format($sum_monto,2)."</td><td colspan='4'></td></tr>");
echo ("</tbody></table>");

/*
echo "<table id='info' border='1'>";
echo("<thead><tr> <th>URes</th> <th>Transferencia</th> <th>Invoice</th> <th>Fecha</th> <th>Monto</th> <th>Descripcion</th> <th>Proyecto</th> <th>Desc_I</th> <th>Cuenta</th> </tr></thead>");
$qry_t = ("select p.ures, t.t, t.invoice, t.fecha, t.monto, t.d_t, t.proy, t.d_inv, t.cta_b from tbl_proyectos p, tbl_transferencias t where p.proy = t.proy and p.ures $seleccion and t.fecha > '2005-12-30' order by t.t, t.invoice");
	$suma_t = 0;
	$qry = mysql_query($qry_t);
	while ($fila=mysql_fetch_row($qry)){
		echo "<tr>";
		$i=0;
		while ($i < mysql_num_fields($qry)){
			if($i == 4){
				$suma_t += $fila[$i];
				$format = number_format($fila[$i],2);
				echo ("<td align='right'>". $format ."</td>");
			}
			else{
			echo ("<td>".utf8_decode($fila[$i])."</td>");
			}
			$i++;
		}
		echo "</tr>";
	}
	echo "</table>";
	$format = number_format($suma_t, 2);
	echo "<p>Monto total transferido: $format </p>";
}*/
?>
</body>
</html>