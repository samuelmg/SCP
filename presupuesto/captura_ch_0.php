<html>
<head><TITLE>Captura de Cheque</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<form action="captura_ch_1.php" method="post">

<p><h3>Selección de Proyecto</h3>
<table width="60%"> 
<tr>
<td width="30%">Selecciona el Proyecto:</td>
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
<td width="10%"><button type="submit" name="proyecto" value="proy">Aceptar</button></td>
<td width="10%"><button type="reset" name="limpiar">Limpiar</button></td>
</tr>
</table>
</form>
</body>
</html>