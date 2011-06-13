<?php
/*
 * chxp.php
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
<head><TITLE>Cheques x Proyecto</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Selección de Proyecto</h3>
<form action="chxp_1.php" method="post">
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

	$sql_proy = "select p.proy from tbl_proyectos p where ures $seleccion order by proy"; //Obtiene la relacion de Proyectos Ordinariosr
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
<hr /><p><a id="btn_h" target="_self" href="./comprobacion.html">Menú Principal</a></p>
</body>
</html>