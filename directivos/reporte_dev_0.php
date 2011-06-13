<html>
<head><TITLE>Devolución de Recursos Ordinarios</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Selección de Quincena</h3>
<form action="reporte_dev_1.php" method="post">
<table>
<tr>
<td>Seleccione la quincena hasta la cual desea regresar recursos:</td>
	<td>
	<select name='lim_quin'>
	<?php
	include("../script/conect_usr.php");
	conect_usr();
	$sql_quin = "select quin from tbl_quincenas group by quin";
	$qry_quin = mysql_query($sql_quin);
	while ($arr_quin = mysql_fetch_array($qry_quin)){
		echo ("<option>".$arr_quin['quin']."</option>");
		}
	?>
	</select>
	</td>
<td><button type="submit" value="ures">Aceptar</button></td>
</tr>
</table>
</form>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./directivos.html">Menú Principal</a></p>
</body>
</html>