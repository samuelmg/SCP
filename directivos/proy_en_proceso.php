<html>
<head><TITLE>Proyectos en Proceso o Concluidos</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_usr.php");
conect_usr();
//Enlista todos los proyectos del fondo 1101

$fndo[1]="1101";
$fndo[2]="1102";
$fndo[3]="1103";
$fndo[4]="110407";
$fndo[5]="3102";
$fndo[6]="110403";
$fndo[7]="110616";

$titulo[1]="FONDO 1101 ORDINARIO";
$titulo[2]="FONDO 1102 EXTRAORDINARIO";
$titulo[3]="FONDO 1103 COMPROMETIDO";
$titulo[4]="FONDO 110407 Adq. Matrrial Bibliográfico";
$titulo[5]="FONDO 3102 FAM/CAPECE";
$titulo[6]="FONDO 110403 PESO X PESO";
$titulo[7]="FONDO 110616 COMPROMISOS DEP. ING. PROY.";

for ($i=0; $i<8; $i++){
	$fondo=$fndo[$i];
	$head=$titulo[$i];
	proy_x_prog($fondo, $head);
	echo ("<br />");
}

function proy_x_prog($fondo, $head){
$i=0;//se inicializa el contador en 0
$sql_proy = "select p.proy, p.d_proy, p.prog, prog.d_prog, p.monto from tbl_proyectos p, tbl_programas prog where fondo='$fondo' and p.prog=prog.prog order by p.prog";
$qry_proy = mysql_query($sql_proy);
while ($arr_proy = mysql_fetch_array($qry_proy)){
	$proy[$i] = $arr_proy['proy'];
	$d_proy[$i] = $arr_proy['d_proy'];
	$sub_prog[$i] = $arr_proy['prog'];
	$d_sub_prog[$i] = $arr_proy['d_prog'];
	$monto_proy[$i] = $arr_proy['monto'];

	//Selecciona el Programa en base al subprograma
	$ext = count($sub_prog[$i])-3;//Cuenta los caracteres del sub programa y le resta
	$prog[$i] = substr($sub_prog[$i],0,$ext);
	$sql_prog = "select d_prog from tbl_programas where prog='$prog[$i]'";
	$qry_prog = mysql_query($sql_prog);
	$arr_prog = mysql_fetch_array($qry_prog);
	$d_prog[$i] = $arr_prog['d_prog'];

	$i++;//Incrementa el contador
}
$fecha=getdate();
$año=$fecha['year'];
$periodo = "'".$año."-01-01' and '".$año."-06-30'";
for ($i=0; $i < sizeof($proy); $i++){
	$sql_t = "select sum(monto) from tbl_transferencias where proy='$proy[$i]' and fecha between $periodo";
	$qry_t = mysql_query($sql_t);
	$arr_t = mysql_fetch_array($qry_t);
	$t[$i] = $arr_t['sum(monto)'];

	$sql_ch = "select sum(monto) from tbl_cheques where proy='$proy[$i]' and fecha between $periodo";
	$qry_ch = mysql_query($sql_ch);
	$arr_ch = mysql_fetch_array($qry_ch);
	$ch[$i] = $arr_ch['sum(monto)'];
	$sql_e = "select sum(monto) from tbl_egresos where proy='$proy[$i]' and fecha between $periodo";
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
echo ("<table id='info' border='1'><thead><tr><th colspan='8'>".$head." - Enero - Junio ".$año."</tr><tr><th>Proyecto</th> <th>Desc. Proyecto</th> <th>Programa</th> <th>Sub Programa</th> <th>Asignado Anual</th> <th>Recibido</th> <th>Ejercido</th> <th>Comprobado</th></tr></thead>");
for ($i=0; $i < sizeof($proy); $i++){
	echo ("<tr id='non'><td>".$proy[$i]."</td> <td id='benef'>".utf8_decode($d_proy[$i])."</td> <td id='benef'>".utf8_decode($d_prog[$i])."</td> <td id='benef'>".utf8_decode($d_sub_prog[$i])."</td> <td id='monto'>".number_format($monto_proy[$i],2)."</td> <td id='monto'>".number_format($t[$i],2)."</td> <td id='monto'>".number_format($ejercido[$i],2)."</td> <td id='monto'>".number_format($comprobado[$i],2)."</td>");
	echo ("</tr>");
}
echo ("</table>");
}
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./directivos.html">Menú Principal</a></p>
</body>
</html>