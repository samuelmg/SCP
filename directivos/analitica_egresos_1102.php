<?php
/*
 * analitica_egresos_1102.php
 * 
 * Copyright (C) 2005 Samuel Mercado Garibay <samuel.mg@gmx.com>.
 * 
 * This file is part of SCP.
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http ://www.gnu.org/licenses/>.
 */
?>
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

$periodo[0] = "'2006-01-01' and '2006-06-30'";
$periodo[1] = "'2006-01-01' and '2006-01-31'";
$periodo[2] = "'2006-02-01' and '2006-02-29'";
$periodo[3] = "'2006-03-01' and '2006-03-31'";
$periodo[4] = "'2006-04-01' and '2006-04-30'";
$periodo[5] = "'2006-05-01' and '2006-05-31'";
$periodo[6] = "'2006-06-01' and '2006-06-30'";
$periodo[7] = "'2006-07-01' and '2006-07-31'";
$periodo[8] = "'2006-08-01' and '2006-08-31'";
$periodo[9] = "'2006-09-01' and '2006-09-30'";
$periodo[10] = "'2006-10-01' and '2006-10-31'";
$periodo[11] = "'2006-11-01' and '2006-11-30'";
$periodo[12] = "'2006-12-01' and '2006-12-31'";

echo ("<table id='info' border='1'><thead><tr><td>Proyecto</td> <td>1er Semestre</td> <td>Enero</td> <td>Febrero</td> <td>Marzo</td> <td>Abril</td> <td>Mayo</td> <td>Junio</td> <td>Julio</td> <td>Agosto</td> <td>Septiembre</td> <td>Octubre</td> <td>Noviembre</td> <td>Diciembre</td> </tr></thead>");
for ($i=0; $i < sizeof($proy); $i++){
	echo ("<tr><td align='center'>".$proy[$i]." ".$d_proy[$i]."</td>");
	for ($j=0; $j<13; $j++){
		$sql_mes = "select sum(monto) from tbl_cheques where proy = $proy[$i] and fecha between $periodo[$j]";
		$qry_mes = mysql_query($sql_mes);
		$arr_mes = mysql_fetch_array($qry_mes);
		echo ("<td align='right'>".number_format($arr_mes['sum(monto)'],2)."</td>");
	}
	echo ("</tr>");
}
echo ("</table>");

?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./directivos.html">Menú Principal</a></p>
</body>
</html>