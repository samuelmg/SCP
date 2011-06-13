<html>
<head><TITLE>Edición de Proyecto</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_nav.php");
conect_nav();

echo ("<h3>Listado de Proyectos</h3>");
$sql_proy = "select ures, proy, d_proy, monto, fondo, quin, prog, eje from tbl_proyectos order by ures, fondo, proy";
$qry_proy = mysql_query($sql_proy);

echo ("<table id='info' border='1'><thead><tr> <th>URes</th> <th>Proyecto</th> <th>Nombre</th> <th>Monto</th> <th>Fondo</th> <th>Quincena</th> <th>Programa</th> <th>Eje</th> </tr></thead> <tbody>");
while ($row_proy=mysql_fetch_array($qry_proy)){
	echo ("<tr> <td>".$row_proy['ures']."</td> <td>".$row_proy['proy']."</td> <td>".utf8_decode($row_proy['d_proy'])."</td> <td align='right'>".number_format($row_proy['monto'],2)."</td> <td>".$row_proy['fondo']."</td> <td>".$row_proy['quin']."</td> <td>".$row_proy['prog']."</td> <td>".$row_proy['eje']."</td>");
	$ures = $row_proy['ures'];
	$proy = $row_proy['proy'];
	$d_proy = utf8_decode($row_proy['d_proy']);
	$monto = $row_proy['monto'];
	$fondo = $row_proy['fondo'];
	$quin = $row_proy['quin'];
	$prog = $row_proy['prog'];
	$eje = $row_proy['eje'];
	echo ("<td><form align='center' action='editar_proyecto_1.php' method='post'>");
	echo ("<input type='hidden' value='$ures' name='ures' />");
	echo ("<input type='hidden' value='$proy' name='proy' />");
	echo ("<input type='hidden' value='$d_proy' name='d_proy' />");
	echo ("<input type='hidden' value='$monto' name='monto' />");
	echo ("<input type='hidden' value='$fondo' name='fondo' />");
	echo ("<input type='hidden' value='$quin' name='quin' />");
	echo ("<input type='hidden' value='$prog' name='prog' />");
	echo ("<input type='hidden' value='$eje' name='eje' />");
	echo ("<button type='submit'>Editar</button></form></td></tr>");
	}
echo ("</tbody></table>");
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./admin.html">Menú Principal</a></p>
</body>
</html>