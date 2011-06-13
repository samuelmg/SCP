<?php
/*
 * s_cucei_ext.php
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
<head><TITLE>Saldos CUCEI 1102</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
	<?php
	include("../script/conect_usr.php");
	include("../script/sui.php");//Smart User ID **
	include("../script/s_cucei.php");
	conect_usr();
	$usr = $_SERVER[PHP_AUTH_USER];//Obtiene UID **
	$seleccion = usr($usr);//Envía UID a funcion usr para que regrese SELECCION **
	s_cucei_ext($seleccion);
	?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./directivos.html">Menú Principal</a></p>
</body>
</html>