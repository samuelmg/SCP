<?php
/*
 * cambio_res_t0.php
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
<head><TITLE>Cambio de Responsable de Transferencias</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Cambio de Responsable de Transferencias</h3>
<?php
include("../script/conect_usr.php");
conect_usr();
include("../script/sui.php");
include("../script/egresos_x_ures.php");
include("../script/res_comp.php");
$usr = $_SERVER[PHP_AUTH_USER];
$seleccion = usr($usr);

switch ($usr){
	case raul: $filtro='and e.responsable = "Raul" and e.estatus in ("Facturas","Comprobado")';break;
	case samuel: $filtro='and e.responsable = ""';break;
	case norma: $filtro='and e.responsable = ""';break;
	case cuquis: $filtro='and e.responsable = "Cuquis"';break;
	case blanca: $filtro='and e.responsable = "Blanca"';break;
	case chelo: $filtro='and e.responsable = "Chelo"';break;
	case karla: $filtro='and e.responsable = "Karla"';break;
}

echo ("<form action='cambio_res_t1.php' method='post'>");
egresos_sel($seleccion,$filtro);
echo ("<table align='center'><tr><td><button type='submit'>Aceptar</button></td>");
echo ("<td><button type='reset'>Limpiar</button></td> </tr></table>");
echo ("</form>");
?>
<!--Men� de Navegaci�n-->
<hr /><p><a id="btn_h" target="_self" href="./comprobacion.html">Men� Principal</a></p>
</body>
</html>