<?php
/*
 * ingresos.php
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
<head><TITLE>Reembolsos</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h4>Reembolsos</h4>
<?php
include("../script/conect_usr.php");
conect_usr();
include("../script/sui.php");
include("../script/ingresosXures.php");
$usr = $_SERVER[PHP_AUTH_USER];
$seleccion = usr($usr);
ingresos($seleccion);
?>
<!--Menú de Navegación-->
<p><a id="btn_h" target="_self" href="./comprobacion.html">Menú Principal</a><hr /></p>
</body>
</html>