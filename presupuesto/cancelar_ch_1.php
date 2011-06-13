<?php
/*
 * cancelar_ch_1.php
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
<head><TITLE>Cancelar Cheque</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<form action="cancelar_ch_2.php" method="post">

<p><h3>Selección de Cheque</h3>
<table width="75%">
<?php
	include("../script/conect_nav.php");
	conect_nav();
	$cta_b = $_POST['cta_b'];
	echo("<tr><td>Cheques de la Cuenta ".$cta_b.": </td><td>");
	echo ("<select name='cheque'>");
	$sql_cheque = "select cheque from tbl_cheques where cta_b='$cta_b' order by cheque DESC"; //Obtiene la relacion de Todos las Ctas Bancarias
	$qry_cheque = mysql_query($sql_cheque);
	while ($row_cheque = mysql_fetch_array($qry_cheque)){
		echo ("<option>".$row_cheque['cheque']."</option>");
	}
	echo ("</select></td>");
	echo ("<input type='hidden' name='cta_b' value='$cta_b'>");
?>
<td><button type="submit" name="aceptar">Aceptar</button></td>
</tr>
</table>
</p>
</form>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./presupuesto.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./cancelar_ch_0.php">Cambiar Cuenta Bancaria</a></p>
</body>
</html>