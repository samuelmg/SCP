<?php
/*
 * sxp_ext_1.php
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
<head><TITLE>Saldo x Proyecto 1102</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h2>Datos del Proyecto</h2>
<?php
$proy=$_POST['proy']; //Obtiene el numero de proyecto seleccionado
include("../script/conect_nav.php");
include ("../script/sxp_ext.php");
conect_nav();
sxp_ext($proy);
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./presupuesto.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./sxp_ext_0.php">Seleccionar Otro Proyecto</a></p>
</body>
</html>