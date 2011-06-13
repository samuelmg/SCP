<?php
/*
 * captura_fechac_1.php
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
<head><TITLE>Captura Fecha de Comprobación</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_usr.php");
conect_usr();
include("../script/cheques_sel.php");
$usr = $_SERVER[PHP_AUTH_USER];
echo ("<h3>Cheques seleccionados para Captura Oficio de Comprobación</h3>");

$fecha=getdate();
$d=$fecha['mday'];
$m=$fecha['mon'];

echo ("<form action='captura_fechac_2.php' method='post'>");
echo ("<table border='1' align='center'><thead><tr> <th>Cuenta</th> <th>Cheque</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Responsable</th> <th>Oficio Comprobación</th> <th>Fecha Comprobación</th> </tr></thead><tbody>");
extraer_post_fecha($_POST);
echo ("</tbody></table>");
opciones ($usr,$d,$m);//Determina las opciones a mostrar según el usuario
echo ("<table align='center'><tr><td><button type='submit' name='aceptar'>Aceptar</button></td>");//Aceptar
echo ("<td><button type='reset' name='limpiar'>Limpiar</button></td> </tr></table>");//Limpiar
echo ("</form>");

function opciones($usr,$d,$m){
switch ($usr){
	case samuel:echo ("<table align='center'><thead><tr><th>Día</th> <th>Mes</th> <th>Año</th></tr></thead><tbody><tr> <td><input type='text' size='2' maxlength='2' name='d' value='$d'/></td> <td><input type='text' size='2' maxlength='2' name='m' value='0$m' /></td> <td><input type='hidden' value='2006' size='4' name='a' />2006</td> </tr></tbody></table>");break;
	case norberto:echo ("<h3>NO TIENE DERECHOS PARA MODIFICAR ESTE CAMPO</h3>");break;
	case norma:echo ("<h3>NO TIENE DERECHOS PARA MODIFICAR ESTE CAMPO</h3>");break;
	case bertha:echo ("<h3>NO TIENE DERECHOS PARA MODIFICAR ESTE CAMPO</h3>");break;
	case chelo:echo ("<h3>NO TIENE DERECHOS PARA MODIFICAR ESTE CAMPO</h3>");break;
	case karla:echo ("<h3>NO TIENE DERECHOS PARA MODIFICAR ESTE CAMPO</h3>");break;
	case blanca:echo ("<h3>NO TIENE DERECHOS PARA MODIFICAR ESTE CAMPO</h3>");break;
	case maricela:echo ("<h3>NO TIENE DERECHOS PARA MODIFICAR ESTE CAMPO</h3>");break;
	case cecilia:echo ("<h3>NO TIENE DERECHOS PARA MODIFICAR ESTE CAMPO</h3>");break;
	case victor:echo ("<h3>NO TIENE DERECHOS PARA MODIFICAR ESTE CAMPO</h3>");break;
	case martha:echo ("<table align='center'><thead><tr><th>Día</th> <th>Mes</th> <th>Año</th></tr></thead><tbody><tr> <td><input type='text' size='2' maxlength='2' name='d' value='$d'/></td> <td><input type='text' size='2' maxlength='2' name='m' value='0$m' /></td> <td><input type='hidden' value='2006' size='4' name='a' />2006</td> </tr></tbody></table>");break;
	}
}

?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./comprobacion.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./captura_fechac_0.php">Cambiar Selección</a></p>
</body>