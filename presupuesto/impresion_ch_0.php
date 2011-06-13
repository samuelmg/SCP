<?php
/*
 * impresion_ch_0.php
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
<head><TITLE>Impresión de Cheques</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<form action="impresion_ch_1.php" method="post">

<p><h3>Selección de Cuenta Bancaria</h3>
<table width="73%">
<tr>
<td>Selecciona la Cuenta Bancaria:</td>
	<td>
	<select name="cta_b">
<?php
	include("../script/conect_nav.php");
	conect_nav();
	$sql_cta_b= "select cta_b from tbl_cta_b order by cta_b DESC"; //Obtiene la relacion de Todos las Ctas Bancarias
	$qry_cta_b = mysql_query($sql_cta_b);
	while ($row_cta_b = mysql_fetch_array($qry_cta_b)){
		echo ("<option>".$row_cta_b['cta_b']."</option>");
	}
	mysql_close($navlink);
?>
	</select>
	</td>
<td><button type="submit" name="aceptar">Aceptar</button></td>
</tr>
</table>
</p>
</form>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./presupuesto.html">Menú Principal</a></p>
</body>
</html>