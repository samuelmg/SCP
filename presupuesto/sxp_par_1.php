<?php
/*
 * sxp_par_1.php
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
<head><TITLE>Saldo Proyecto Participable</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Saldo por Invoice</h3>
<?php
include("../script/conect_nav.php");
conect_nav();
include ("../script/sxp_par.php");
$proy=$_POST['proy'];
sxp_par($proy);

?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./presupuesto.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./sxp_par_0.php">Seleccionar Otro Proyecto</a></p>
</body>
</html>