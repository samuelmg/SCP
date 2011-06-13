<html>
<head><TITLE>Proceso de Comprobación</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Selección de Categoría:</h3>
<form action="ch_categoria_1.php" method="post">
<table width="40%"> 
<tr>
<td>Eliga el Estatus:</td>
	<td>
	<select name='cat'>
	<?php
	echo ("<option>En Transito</option>");
	echo ("<option>Sin Clasificar</option>");
	echo ("<option>Sin Comprobar</option>");
	echo ("<option>Alta Pendiente</option>");
	//echo ("<option>Comprobados en Proceso</option>");
	echo ("<optgroup label='En proceso'>");
	echo ("<option>Raul</option>");
	echo ("<option>Priscilla</option>");
	echo ("<option>Blanca</option>");
	echo ("<option>Chelo</option>");
	echo ("<option>Martha</option>");
	echo ("</optgroup>");
	echo ("<option>Dir Finanzas</option>");
	echo ("<option>Cancelados</option>");
	
	?>
	</select>
	</td>
<td><button type="submit" name="aceptar" value="Aceptar">Aceptar</button></td>
</tr>
</table>
</form>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./comprobacion.html">Menú Principal</a></p>
</body>
</html>