<html>
<head><TITLE>Saldo x Proyecto</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Selecci�n de Proyecto</h3>
<form action="sxp_1.php" method="post">
<table width="40%"> 
<tr>
<td>Eliga un Proyecto:</td>
	<td>
	<select name='proy'>
	<?php
	include("../script/conect_nav.php");
	conect_nav();
	$sql_proy = "select proy from tbl_proyectos where ures $seleccion order by proy"; //Obtiene la relacion de Proyectos Ordinariosr
	$qry_proy = mysql_query($sql_proy); //Realiza la consulta
	while ($arr_proy = mysql_fetch_array($qry_proy)){
		echo ("<option>".$arr_proy['proy']."</option>");
		}
	?>
	</select>
	</td>
<td><button type="submit" name="aceptar" value="proy">Aceptar</button></td>
</tr>
</table>
</form>
<!--Men� de Navegaci�n-->
<hr /><p><a id="btn_h" target="_self" href="./presupuesto.html">Men� Principal</a></p>
</body>
</html>