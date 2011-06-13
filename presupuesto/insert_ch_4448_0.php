<?php
/*
 * insert_ch_4448_0.php
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
<head><TITLE>Captura de Cheques 4448</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h2>Captura de Cheques (4448)</h2>
<?php
include("../script/conect_nav.php");
conect_nav();

//---Inicia seccion de Captura de Cheque---
echo ("<p>");
echo ("<form action='insert_ch_4448_1.php' method='post'>");

//Captura de Fecha del Cheque
$fecha=getdate();
$d=$fecha['mday'];
$m=$fecha['mon'];
//echo("Hoy es: ".$fecha['mday']."/".$fecha['mon']."/".$fecha['year']."</div>");//Muestra la fecha actual
echo ("<table><thead><tr><td>Día</td><td>Mes</td><td>Año</td></tr></thead><tbody><tr> <td><input type='text' size='2' maxlength='2' name='d' value='$d'/></td> <td><input type='text' size='2' maxlength='2' name='m' value='$m' /></td> <td><input type='hidden' value='2006' size='4' name='a' />2006</td> </tr></tbody></table>");

echo ("<table cellspacing='5'><thead><tr> <th>No. Cheque</th> <th>Beneficiario</th> <th>Monto</th></tr></thead> <tbody align='center'><tr>");

//Captura de Numero de Cheque
echo ("<td><input type='text' size='4' maxlength='4' name='cheque' /></td>");

//Selección de Beneficiario
echo ("<td><select name='benef_id'>");
$sql_benef= "select benef_id, benef from tbl_benef order by benef"; //Obtiene la relacion de Beneficiarios
$qry_benef = mysql_query($sql_benef); //Realiza la consulta
while ($arr_benef = mysql_fetch_array($qry_benef)){
	echo ("<option>".$arr_benef['benef_id']." - ".utf8_decode($arr_benef['benef'])."</option>");
}
echo ("</select></td>");

//Captura del Monto Cheque
echo ("<td>");
echo ("<input type='text' size='9' maxlength='10' name='monto' />");
echo ("</td>");

echo ("</tr></tbody></table><table cellspacing='5'><thead><tr> <th>Concepto</th> <th>Descripción</th> <th>Destino</th> </tr></thead><tbody><tr>");

//Selección del Concepto
echo ("<td><select name='concepto'>");
echo ("<option>K</option>");
echo ("<option>KE</option>");
echo ("<option>KF</option>");
echo ("<option>KG</option>");
echo ("<option>KI</option>");
echo ("<option>KK(MCYP)</option>");
echo ("<option>KA(MCYP)</option>");
echo ("<option>KB(PROY)</option>");
echo ("<option>KD(MET)</option>");
echo ("<option>T(CFE)</option>");
echo ("<option>IVA</option>");
echo ("<option>PROMEP</option>");
echo ("<option>Ext</option>");
echo ("<option>Dev 2006</option>");
echo ("<option>Dev Intereses</option>");
echo ("<option>Dev 2005</option>");
echo ("<option>CA</option>");
echo ("<option>CONACYT</option>");
echo ("</select></td>");

//Captura de Descripción
echo ("<td>");
echo ("<input type='text' size='30' maxlength='30' name='descripcion' />");
echo ("</td>");

//Selección del Destino
echo ("<td><select name='destino'>");
echo ("<option>Referencia</option>");
echo ("<option>748</option>");
echo ("<option>Particular</option>");
echo ("<option>4685</option>");
echo ("<option>4154</option>");
echo ("<option>3999</option>");
echo ("</select></td>");

echo ("</tr></tbody></table>");

echo ("<table align='center'><tr><td><button type='submit' name='aceptar'>Aceptar</button></td>");
echo ("<td><button type='reset' name='limpiar'>Limpiar</button></td> </tr></table>");

echo ("</form>");
echo ("</p>");
mysql_close($navlink);
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./presupuesto.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./insert_benef.html">Capturar Beneficiario</a></p>
</body>
</html>