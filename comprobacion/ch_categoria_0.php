<?php
/*
 * ch_categoria_0.php
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
	echo ("<option>Comprobados-En Proceso</option>");
	echo ("<option>Norma</option>");
	echo ("<option>Cuquis</option>");
	echo ("<option>Blanca</option>");
	echo ("<option>Chelo</option>");
	echo ("<option>Karla</option>");
	echo ("<option>Martha</option>");
	echo ("<option>Dir Finanzas</option>");
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