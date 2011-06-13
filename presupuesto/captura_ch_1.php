<?php
/*
 * captura_ch_1.php
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
<head><TITLE>Captura de Cheque</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Captura de Cheque</h3>
<?php
include("../script/conect_nav.php");
include("../script/sel_fondo.php");
conect_nav();

$proy=$_POST['proy']; //Obtiene el numero de proyecto seleccionado
sel_fondo($proy);

//---Inicia seccion de Captura de Cheque---
echo ("<hr /><p>");
echo ("<form action='captura_ch_2.php' method='post'>");

//Captura de Fecha del Cheque
$fecha=getdate();
$d=20;
$m=12;
//$d=$fecha['mday'];
//$m=$fecha['mon'];
//echo("Hoy es: ".$fecha['mday']."/".$fecha['mon']."/".$fecha['year']."</div>");//Muestra la fecha actual

echo ("<table><thead><tr><th>Día</th> <th>Mes</th> <th>Año</th></tr></thead><tbody><tr> <td><input type='text' size='2' maxlength='2' name='d' value='$d'/></td> <td><input type='text' size='2' maxlength='2' name='m' value='$m' /></td> <td><input type='hidden' value='2006' size='4' name='a' />2006</td> </tr></tbody></table>");

echo ("<table cellspacing='5'><thead><tr> <th>Cta Bancaria</th> <th>No. Cheque</th> <th>Cuenta (OG)</th> <th>Beneficiario</th> <th>Monto</th></tr></thead> <tbody align='center'><tr>");

//Seleccion de Cuenta Bancaria
echo ("<td><select name='cta_b'>");
$sql_cta_b= "select cta_b from tbl_cta_b order by cta_b DESC"; //Obtiene la relacion de Cuentas Bancarias
$qry_cta_b = mysql_query($sql_cta_b); //Realiza la consulta
while ($arr_cta_b = mysql_fetch_array($qry_cta_b)){
	echo ("<option>".$arr_cta_b['cta_b']."</option>");
}
echo ("</select></td>");

//Captura de Numero de Cheque
echo ("<td><input type='text' size='4' maxlength='4' name='cheque' /></td>");

//Seleccion de Cuenta (Objeto de Gasto)
echo ("<td><select name='cta'>");
for ($k=0; $k<$reg; $k++){
	echo ("<option>".$cta[$k]."</option>");
}
echo ("</select></td>");

//Seleccion de Beneficiario
echo ("<td><select name='benef_id'>");
$sql_benef= "select benef_id, benef from tbl_benef order by benef"; //Obtiene la relacion de Beneficiarios
$qry_benef = mysql_query($sql_benef); //Realiza la consulta
while ($arr_benef = mysql_fetch_array($qry_benef)){
	echo ("<option>".$arr_benef['benef_id']." - ".utf8_decode($arr_benef['benef'])."</option>");
}
echo ("</select></td>");

//Captura del Monto Cheque
echo ("<td>");
echo ("<input type='text' size='9' maxlength='9' name='monto' />");
echo ("</td>");

echo ("</tr></tbody></table><table cellspacing='5'><thead><tr> <th>Observaciones</th> <th>Descripción ID</th> </tr></thead><tbody><tr>");

//Captura de Observaciones
echo ("<td>");
echo ("<input type='text' size='50' maxlength='50' name='obs' /></textarea>");
echo ("</td>");

//Captura de la Descripción del ID 
echo ("<td>");
echo ("<input type='text' size='10' maxlength='10' name='d_inv' />");
echo ("</td>");

echo ("</tr></tbody></table>");

echo ("<input type='hidden' name='proy' value='$proy'>");

echo ("<table align='center'><tr><td><button type='submit' name='aceptar'>Aceptar</button></td>");
echo ("<td><button type='reset' name='limpiar'>Limpiar</button></td> </tr></table>");

echo ("</form>");
echo ("</p>");

?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./presupuesto.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./captura_ch_0.php">Cambiar de Proyecto</a>
<a id="btn_h" target="_self" href="./captura_benef.html">Capturar Beneficiario</a></p>
</body>
</html>