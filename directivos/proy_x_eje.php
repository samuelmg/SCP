<html>
<head><TITLE>Proyectos x Eje</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_usr.php");
conect_usr();
//Enlista todos los proyectos del fondo 1101

$fndo="1101";

$titulo="FONDO 1101 ORDINARIO";

$fondo=$fndo;
$head=$titulo;
proy_x_prog($fondo, $head);
echo ("<br />");


function proy_x_prog($fondo, $head){
$i=0;//se inicializa el contador en 0
$sql_proy = "select p.proy, p.d_proy, eje.d_eje, p.monto from tbl_proyectos p, tbl_ejes eje where fondo='$fondo' and p.eje=eje.eje order by p.eje";
$qry_proy = mysql_query($sql_proy);
while ($arr_proy = mysql_fetch_array($qry_proy)){
	$proy[$i] = $arr_proy['proy'];
	$d_proy[$i] = $arr_proy['d_proy'];
	$eje[$i] = $arr_proy['d_eje'];
	$d_sub_prog[$i] = $arr_proy['d_prog'];
	$monto_proy[$i] = $arr_proy['monto'];
	$i++;//Incrementa el contador
}
$fecha=getdate();
$año=$fecha['year'];
$periodo = "'2007-01-01' and '2007-12-31'";
for ($i=0; $i < sizeof($proy); $i++){
	$sql_t = "select sum(monto) from tbl_transferencias where proy='$proy[$i]' and fecha between $periodo";
	$qry_t = mysql_query($sql_t);
	$arr_t = mysql_fetch_array($qry_t);
	$t[$i] = $arr_t['sum(monto)'];

	$sql_ch = "select sum(monto) from tbl_cheques where proy='$proy[$i]' and fecha between $periodo";
	$qry_ch = mysql_query($sql_ch);
	$arr_ch = mysql_fetch_array($qry_ch);
	$ch[$i] = $arr_ch['sum(monto)'];
	$sql_e = "select sum(monto) from tbl_egresos where proy='$proy[$i]' and tipo != 'Devolucion' and fecha between $periodo";
	$qry_e = mysql_query($sql_e);
	$arr_e = mysql_fetch_array($qry_e);
	$e[$i] = $arr_e['sum(monto)'];
	$sql_r = "select sum(monto) from tbl_ingresos where proy='$proy[$i]' and fecha between $periodo";
	$qry_r = mysql_query($sql_r);
	$arr_r = mysql_fetch_array($qry_r);
	$r[$i] = $arr_r['sum(monto)'];
	$ejercido[$i] = $ch[$i] + $e[$i] - $r[$i];//Ejercido = Cheques + Egresos - Reembolsos

	$sql_comprobado = "select sum(monto) from tbl_cheques where proy='$proy[$i]' and oficio != '' and estatus != 'Alta Pendiente'";
	$qry_comprobado = mysql_query($sql_comprobado);
	$arr_comprobado = mysql_fetch_array($qry_comprobado);
	$comprobado[$i] = $arr_comprobado['sum(monto)'];
}
echo ("<table id='info' border='1'><thead><tr><th colspan='8'>".$head." - Enero - Diciembre 2007</tr><tr><th>Proyecto</th> <th>Desc. Proyecto</th> <th>Eje</th> <th>Asignado Anual</th> <th>Recibido</th> <th>Ejercido</th> <th>Comprobado</th></tr></thead>");
for ($i=0; $i < sizeof($proy); $i++){
	echo ("<tr id='non'><td>".$proy[$i]."</td> <td id='benef'>".utf8_decode($d_proy[$i])."</td> <td id='benef'>".utf8_decode($eje[$i])."</td> <td id='monto'>".number_format($monto_proy[$i],2)."</td> <td id='monto'>".number_format($t[$i],2)."</td> <td id='monto'>".number_format($ejercido[$i],2)."</td> <td id='monto'>".number_format($comprobado[$i],2)."</td>");
	echo ("</tr>");
}
echo ("</table>");
}
?>
<!--Men? de Navegaci?n-->
<hr /><p><a id="btn_h" target="_self" href="./directivos.html">Men? Principal</a></p>
</body>
</html>