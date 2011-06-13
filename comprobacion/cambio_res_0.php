<?php
/*
 * cambio_res_0.php
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
<head><TITLE>Cambio de Responsable</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_usr.php");
conect_usr();
include("../script/sui.php");
include("../script/chxures.php");
include("../script/res_comp.php");
$usr = $_SERVER[PHP_AUTH_USER];
$seleccion = usr($usr);

switch ($usr){
	case raul:$filtro='and (ch.responsable = "Raul" and ch.estatus not in ("","Sin Comprobar"))';break;//impide el cambio de responsable de un cheque sin estatus o sin comprobar
	case cuquis:$filtro='and ch.responsable = "Cuquis" and ch.benef_id!=37';break;
	case karla:$filtro='and ch.responsable = "Karla"';break;
	case blanca:$filtro='and ch.responsable = "Blanca"';break;
	case chelo:$filtro='and ch.responsable = "Chelo"';break;
}

echo ("<form action='cambio_res_1.php' method='post'>");
chxures_sel($seleccion,$filtro);//funci�n que muestra los cheques segun el usuario, aplica un filtro y agrega un checkbox.
echo ("<table align='center'><tr><td><button type='submit' name='aceptar'>Aceptar</button></td>");
echo ("<td><button type='reset' name='limpiar'>Limpiar</button></td> </tr></table>");
echo ("</form>");
?>
<!--Men� de Navegaci�n-->
<hr /><p><a id="btn_h" target="_self" href="./comprobacion.html">Men� Principal</a></p>
</body>
</html>