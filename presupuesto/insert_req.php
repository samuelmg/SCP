<?php
/*
 * insert_req.php
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
<head><TITLE>Captura de Requisiciones</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Captura de Requisiciones</h3>

<form name='insert_req' method='post' action='insert_req_script.php'>
<table align='center' cellspacing="2" width="70%">
	<thead align="center"><tr>
	<td>No. de Requisicion</td> <td>Proyecto</td> <td>Cuenta (OG)</td> <td>Monto</td> <td>Descripcion ID</td> <td>Fecha</td>
	</tr></thead>
	<tbody align="center"><tr>
	<td><input name='req' size='10' maxlength='10' type='text' /></td>
	<td><input name='proy' size='5' maxlength='5' type='text' /></td>
	<td><input name='cta' size='4' maxlength='4' type='text' /></td>
	<td><input name='monto' size='10' maxlength='10' type='text' /></td>
	<td><input name='d_inv' size='10' maxlength='10' type='text' /></td>
<?php
	$fecha=getdate();
	$d=$fecha['mday'];
	$m=$fecha['mon'];
	echo ("<td> <input name='d' size='2' maxlength='2' type='text' value='$d' /> <input name='m' size='2' maxlength='2' type='text' value='$m' /> <input name='a' size='4' maxlength='4' type='text' value='2006' /> </td>");
?>
	</tr></tbody>
	</table>
<table align="center">
	<tr>
	<td><input name="Reset" type="reset" value="Limpiar" /></td>
	<td><input type="submit" name="insertar" value="Insertar" /></td>
	</tr>
</table>
</form>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./presupuesto.html">Menú Principal</a></p>
</body>
</html>