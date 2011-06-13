<?php
/*
 * cambio_res_t1.php
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
<head><TITLE>Cambio de Estatus de Transferencias</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Selecci�n de Transferencias (Cambio de Responsable)</h3>
<?php
include("../script/conect_usr.php");
conect_usr();
include("../script/extractor_post-sel_t.php");
$usr = $_SERVER[PHP_AUTH_USER];

echo ("<form action='cambio_res_t2.php' method='post'>");
echo ("<table id='info' border='1' align='center'><thead><tr> <th>Fecha</th> <th>Cuenta</th> <th>No. Transferencia</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Responsable</th> <th>Estatus</th> <th>Seguimiento</th> </tr></thead><tbody>");
extraer_post_t($_POST);
echo ("</tbody></table>");

opciones ($usr);//Determina las opciones a mostrar seg�n el usuario

echo ("<table align='center'><tr><td><button type='submit'>Aceptar</button></td>");//Aceptar
echo ("<td><button type='reset'>Limpiar</button></td> </tr></table>");//Limpiar
echo ("</form>");

function opciones($usr){
switch ($usr){
	case raul:echo ("<table align='center'><tr> <td><input type='radio' name='res' value='Raul'>Raul</td> <td><input type='radio' name='res' value='Cuquis'>Cuquis</td> <td><input type='radio' name='res' value='Blanca'>Blanca</td> <td><input type='radio' name='res' value='Chelo'>Chelo</td> <td><input type='radio' name='res' value='Cuquis'>Cuquis</td></tr></table>");break;
	case norma:echo ("<h4>Entregar a Raul<input type='radio' name='res' value='Raul'></h4>");break;
	case samuel:echo ("<h4>Entregar a Raul<input type='radio' name='res' value='Raul'></h4>");break;
	case cuquis:echo ("<table align='center'><tr><td><input type='radio' name='res' value='Blanca'>Blanca</td> <td><input type='radio' name='res' value='Chelo'>Chelo</td> <td><input type='radio' name='res' value='Cuquis'>Cuquis</td> <td><input type='radio' name='res' value='Raul'>Raul</td> </tr></table>");break;
	case chelo:echo ("<h4>Regresar a Raul<input type='radio' name='res' value='Raul'></h4>");break;
	case karla:echo ("<h4>Regresar a Raul<input type='radio' name='res' value='Raul'></h4>");break;
	case blanca:echo ("<h4>Regresar a Raul<input type='radio' name='res' value='Raul'></h4>");break;
	default:echo ("<h3>NO TIENE DERECHOS PARA MODIFICAR EL RESPONSABLE</h3>");break;
	}
}
?>
<!--Men� de Navegaci�n-->
<hr /><p><a id="btn_h" target="_self" href="./comprobacion.html">Men� Principal</a>
<a id="btn_h" target="_self" href="./cambio_res_t0.php">Cambiar Selecci�n</a></p>
</body>	