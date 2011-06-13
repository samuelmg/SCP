<?php
/*
 * captura_oficio_t0.php
 * 
 * Copyright (C) 2006 Samuel Mercado Garibay <samuel.mg@gmx.com>.
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
<head><TITLE>Captura Oficio de Comprobación</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_usr.php");
conect_usr();
include("../script/sui.php");
include("../script/egresos_x_ures.php");
include("../script/res_comp.php");
$usr = $_SERVER[PHP_AUTH_USER];
$seleccion = usr($usr);

$filtro = 'and e.responsable = "'.$usr.'" and e.estatus in ("Facturas","Comprobado")';

echo ("<form action='captura_oficio_t1.php' method='post'>");
egresos_sel_oficio($seleccion,$filtro);
echo ("<table align='center'><tr><td><button type='submit'>Aceptar</button></td>");
echo ("<td><button type='reset'>Limpiar</button></td> </tr></table>");
echo ("</form>");
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./comprobacion.html">Menú Principal</a></p>
</body>
</html>