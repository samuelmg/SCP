<html>
<head><TITLE>Captura de Quincenas</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<p><h3>Selección de Proyecto</h3>
<table width="60%"> 
<form action="captura_quin_1.php" method="post">
<tr>
<td>Selecciona el Proyecto:</td>
	<td>
	<select name='proy'>
	<?php
	include("../script/conect_nav.php");
	conect_nav();
	$qry_proy= "select proy from tbl_proyectos order by proy"; //Obtiene la relacion de Todos los Proyectos
	$qry = mysql_query($qry_proy); //Realiza la consulta
	while ($fila = mysql_fetch_array($qry)){
		echo ("<option>".$fila['proy']."</option>");
	}
	?>
	</select>
</td>
<td><button type="submit" name="proyecto" value="proy">Aceptar</button></td>
</tr>
</table>
</form>
<!--Menú de Navegación-->
<hr /><p><a id='btn_h' target='_self' href='./admin.html'>Volver al Menú Principal</a>
</body>
</html>