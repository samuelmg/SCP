<?php
/*
 * captura_ch_0.php
 * 
 * Copyright (C) 2005 Samuel Mercado Garibay <samuel.mg@gmx.com>.
 * 
 * This file is part of SCP.
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http ://www.gnu.org/licenses/>.
 */
?>
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