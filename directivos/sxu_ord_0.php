<html>
<head><TITLE>Saldo x URes 1101</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Selección de Unidad Responsable</h3>
<form action="sxu_ord_1.php" method="post">
<table>
<tr>
<td>Eliga una Unidad Responsable:</td>
	<td>
	<select name='ures'>
	<?php
	include("../script/conect_usr.php");
	conect_usr();
	$sql_ures = "select p.ures, u.d_ures from tbl_ures u, tbl_proyectos p where u.ures=p.ures and p.ures>220000 and p.ures not in (226008,226009) and p.fondo=1101 group by p.ures";
	$qry_ures = mysql_query($sql_ures);
	while ($arr_ures = mysql_fetch_array($qry_ures)){
		echo ("<option>".$arr_ures['ures']." ".utf8_decode($arr_ures['d_ures'])."</option>");
		}
	?>
	</select>
	</td>
<td><button type="submit" name="aceptar" value="ures">Aceptar</button></td>
</tr>
</table>
</form>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./directivos.html">Menú Principal</a></p>
</body>
</html>