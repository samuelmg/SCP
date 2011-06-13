<html>
<head><TITLE>Saldo x Proyecto</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<form action="sxp_ord_1.php" method="post">
<h3>Selección de Proyecto 1101</h3>
<table width="40%"> 
<tr>
<td>Elige un Proyecto:</td>
	<td>
	<select name='proy'>
	<?php
	include("../script/conect_nav.php");
	$navlink = conect_nav();
	$sql_proy= "select proy from tbl_proyectos where fondo = 1101 order by proy"; //Obtiene la relacion de Proyectos Ordinariosr
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
</form>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./presupuesto.html">Menú Principal</a></p>
</body>
</html>