<?php
function ingresos($seleccion){
include ("fecha.php");
$sql_i = "select i.fecha, i.monto, i.proy, i.cta, i.id, i.cmt from tbl_ingresos i, tbl_proyectos p where i.proy=p.proy and p.ures $seleccion order by i.fecha, i.proy";
$qry_i = mysql_query($sql_i);

echo ("<table align='center' class='info' border='1'><thead><tr> <th>Fecha</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta</th> <th>ID(Participables)</th> <th>Comentarios</th> </tr></thead><tbody>");
$renglon='non';//cambio de color en renglones
while ($arr_i = mysql_fetch_array($qry_i)){
	$fecha = $arr_i['fecha'];
	fecha_info(&$fecha);
	echo ("<tr class='$renglon'> <td class='monto'>".$fecha."</td> <td class='monto'>".number_format($arr_i['monto'],2)."</td> <td>".$arr_i['proy']."</td> <td>".$arr_i['cta']."</td> <td>".$arr_i['id']."</td> <td class='txt'>".$arr_i['cmt']."</td> </tr>");
	$sum_i+=$arr_i['monto'];
	if ($renglon=='non'){$renglon='par';}else{$renglon='non';}//cambio de color en renglones
	}
echo ("<tr><td></td><td>".number_format($sum_i,2)."</td><td colspan='4'></td></tr>");
echo ("</tbody></table>");
}
?>