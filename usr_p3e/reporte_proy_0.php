<html>
<head><TITLE>Reporte de Proyecto</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Selección de Proyecto</h3>
<form action="reporte_proy_1.php" method="post">
<table width="40%">
<tr>
<td>Eliga un Proyecto:</td>
	<td>
	<select name='proy'>
	<?php
	include("../script/conect_usr.php");
	conect_usr();
	//Obtiene URes del Usuario
	include("../script/sui.php");//Smart User ID **
	$usr = $_SERVER[PHP_AUTH_USER];//Obtiene UID **
	$seleccion =  usr($usr);//Envía UID a funcion usr para que regrese SELECCION **

	$sql_proy = "select proy from tbl_proyectos where ures $seleccion and fondo=1101 order by proy"; //Obtiene la relacion de Proyectos 1101
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
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./usr_p3e.html">Menú Principal</a></p>
</body>
</html>