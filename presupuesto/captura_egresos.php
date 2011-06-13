<?php
/*
 * captura_egresos.php
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
<head><TITLE>Captura de Egresos</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h2>Captura de Egresos</h2>
<?php
include("../script/conect_nav.php");
conect_nav();

echo ("<p>");
echo ("<form action='captura_egresos_script.php' method='post'>");

//Captura de Fecha del Egreso
$fecha=getdate();
$d=$fecha['mday'];
$m=$fecha['mon'];
$a=$fecha['year'];
echo ("<table><thead><tr><th>Día</th><th>Mes</th><th>Año</th></tr></thead><tbody><tr> <td><input type='text' size='2' maxlength='2' name='d' value='$d'/></td> <td><input type='text' size='2' maxlength='2' name='m' value='$m' /></td> <td><input type='text' size='4' maxlength='4' name='a' value='$a'/></td> </tr></tbody></table>");

echo ("<table cellspacing='4'><thead><tr> <th>Tipo de Ingreso</th> <th>Monto</th> <th>Cuenta Bancaria</th> <th>Proyecto</th> <th>Cuenta (OG)</th> <th>Invoice</th> <th>Comentario</th> </tr></thead> <tbody align='center'><tr>");

//Selección de Tipo de Ingreso
echo ("<td><select name='tipo'>");
$sql_tipo= "select tipo from tbl_tipos"; //Obtiene la relacion de Cuentas Bancarias
$qry_tipo = mysql_query($sql_tipo); //Realiza la consulta
while ($arr_tipo = mysql_fetch_array($qry_tipo)){
	echo ("<option>".$arr_tipo['tipo']."</option>");
}
echo ("</select></td>");
//Captura Monto del Ingreso
echo ("<td><input type='text' size='9' name='monto' /></td>");
//Selección de Cuenta Bancaria
echo ("<td><select name='cta_b'>");
$sql_cta_b= "select cta_b from tbl_cta_b order by cta_b DESC"; //Obtiene la relacion de Cuentas Bancarias
$qry_cta_b = mysql_query($sql_cta_b); //Realiza la consulta
while ($arr_cta_b = mysql_fetch_array($qry_cta_b)){
	echo ("<option>".$arr_cta_b['cta_b']."</option>");
}
echo ("</select></td>");
//Captura de Proyecto
echo ("<td><input type='text' size='5' maxlength='5' name='proy' /></td>");
//Captura de Cuenta(OG)
echo ("<td><input type='text' size='4' maxlength='5' name='cta' /></td>");
//Captura de la Descripción del ID 
echo ("<td><input type='text' size='10' maxlength='10' name='d_inv' /></td>");
//Captura de Comentarios
echo ("<td><input type='text' size='40' maxlength='40' name='cmt' /></td>");
echo ("</tr></tbody></table>");
//Tabla para botones
echo ("<table align='center'><tr><td><button type='submit' name='captura_egresos'>Aceptar</button></td>");
echo ("<td><button type='reset' name='limpiar'>Limpiar</button></td> </tr></table>");
echo ("</form>");
echo ("</p>");
//Menú de Navegación
echo ("<hr /><p><a id='btn_h' target='_self' href='./presupuesto.html'>Menú Principal</a></p>");
?>
</body>
</html>