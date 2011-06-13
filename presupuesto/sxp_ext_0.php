<html>
<head><TITLE>Saldo x Proyecto 1102</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h2>Selección de Proyecto 1102</h2>
<form action="sxp_ext_1.php" method="post">
<table width="40%"> 
<tr>
<td>Elige un Proyecto:</td>
	<td>
	<select name='proy'>
	<?php
	include("../script/conect_nav.php");
	conect_nav();
	$sql_proy= "select proy from tbl_proyectos where fondo = 1102 order by proy"; //Obtiene la relacion de Proyectos Extraordinarios
	$qry_proy = mysql_query($sql_proy); //Realiza la consulta
	while ($arr_proy = mysql_fetch_array($qry_proy)){
		echo ("<option>".$arr_proy['proy']."</option>");
		}
	?>
	</select>
	</td>
<td><button type="submit" name="aceptar" value="proy">Aceptar</button></td>
<td><button type="reset" name="limpiar">Limpiar</button></td>
</tr>
</table>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./presupuesto.html">Menú Principal</a></p>
</form>
</body>
</html>