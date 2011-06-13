<?php
/*
 * sxu_ord_1.php
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
<head><TITLE>Saldos x Ures</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_usr.php");
include("../script/sxu.php");
conect_usr();
settype($_POST['ures'],integer); //Obtiene la URes
$ures=$_POST['ures'];
$sql_ures = "select ures, d_ures from tbl_ures where ures=$ures";
$qry_ures = mysql_query($sql_ures);
$arr_ures = mysql_fetch_array($qry_ures);
echo ("<table align='center' border='1'><tr> <td>".$arr_ures['ures']."</td> <td>".$arr_ures['d_ures']."</td> </tr></table>");

sxu_ord($ures);
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./directivos.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./sxu_ord_0.php">Listado de URes</a></p>
</body>
</html>