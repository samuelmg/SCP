<html>
<head><TITLE>Formato Entrega Recepción 2.6</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_usr.php");
conect_usr();

echo ("<h4>Formato 2.6 Entrega Recepción</h4>");
$sel_fondo = "fondo = 1101";
ejercicio ($sel_fondo);
echo ("<hr /><h4>Fondo </h4>");
$sel_fondo = "fondo != 1101";
ejercicio ($sel_fondo);

function ejercicio($sel_fondo){
$sql_proy = "select proy, d_proy, monto from tbl_proyectos where $sel_fondo order by fondo, proy";//Información principal del proyecto
$qry_proy = mysql_query($sql_proy);

echo ("<table id='info' border='1' align='center'><thead><tr> <th>Proyecto</th> <th>Asignado</th> <th>Transferido</th> <th>Ejercido</th> <th>Comprobado</th> </tr></thead>");
while ($arr_proy = mysql_fetch_array($qry_proy)){
	$proy = $arr_proy['proy'];
	$d_proy = $arr_proy['d_proy'];
	$asignado = $arr_proy['monto'];
	$sql_t = "select sum(monto) from tbl_transferencias where proy='$proy'";//Monto de Transferencias recibidas
	$sql_ch = "select sum(monto) from tbl_cheques where proy='$proy'";//Monto de Cheques emitidos
	$sql_ingresos = "select sum(monto) from tbl_ingresos where proy='$proy'";//Monto de ingresos (reembolsos a proyecto)
	$sql_egresos = "select sum(monto) from tbl_egresos where proy='$proy'";//Monto de egresos (transferencias y gastos de proyecto)
	$sql_comp = "select sum(monto) from tbl_cheques where proy='$proy' and (oficio!='' and oficio is not null)";//Comprobado a Dir. Finanzas
	$qry_t = mysql_query($sql_t);
	$qry_ch = mysql_query($sql_ch);
	$qry_ingresos = mysql_query($sql_ingresos);
	$qry_egresos = mysql_query($sql_egresos);
	$qry_comp = mysql_query($sql_comp);
	$arr_t = mysql_fetch_array($qry_t);
	$arr_ch = mysql_fetch_array($qry_ch);
	$arr_ingresos = mysql_fetch_array($qry_ingresos);
	$arr_egresos = mysql_fetch_array($qry_egresos);
	$arr_comp = mysql_fetch_array($qry_comp);
	//Variables
	$t = $arr_t['sum(monto)'];
	$ch = $arr_ch['sum(monto)'];
	$ingresos = $arr_ingresos['sum(monto)'];
	$egresos = $arr_egresos['sum(monto)'];
	$ejercido = $ch - $ingresos + $egresos;
	$comp = $arr_comp['sum(monto)'];
	//Suma Global
	$sum_asignado += $asignado;
	$sum_t += $t;
	$sum_ejercido += $ejercido;
	$sum_comp += $comp;

	echo ("<tr id='non'><td id='benef'>".$proy." ".utf8_decode($d_proy)."</td> <td id='monto'>".number_format($asignado,2)."</td> <td id='monto'>".number_format($t,2)."</td> <td id='monto'>".number_format($ejercido,2)."</td> <td id='monto'>".number_format($comp,2)."</td></tr>");
}
echo ("<tr><td></td><td id='total'>".number_format($sum_asignado,2)."</td> <td id='total'>".number_format($sum_t,2)."</td> <td id='total'>".number_format($sum_ejercido,2)."</td> <td id='total'>".number_format($sum_comp,2)."</td> </tr></table>");
}
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./directivos.html">Menú Principal</a></p>
</body>
</html>