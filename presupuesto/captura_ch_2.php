<?php
/*
 * captura_ch_2.php
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
<?php
include("../script/conect_nav.php");
conect_nav();

$cta_b=$_POST['cta_b'];
$cheque=$_POST['cheque'];
$proy=$_POST['proy'];
$cta=$_POST['cta'];
settype($_POST['benef_id'],integer);
$benef_id=$_POST['benef_id'];
$monto=$_POST['monto'];
$obs=$_POST['obs'];
$d_inv=$_POST['d_inv'];
$d=$_POST['d'];
$m=$_POST['m'];
$a=$_POST['a'];
$fecha=$a."-".$m."-".$d;

if (checkdate($m,$d,$a)){ //Validación de Fecha
	if ($cheque != 0 && $benef_id != 0 && $monto != 0){

	if(mysql_query("insert into tbl_cheques values ('$fecha','$cta_b','$cheque','$proy','$cta','$benef_id','$monto','$obs','$d_inv','','','','','')")){
	echo ("<p><h3>Captura realizada con Exito</h3>");
	echo ("<table align='center' border='1'><tr> <td>Fecha</td> <td>Cta Bancaria</td> <td>No. Cheque</td> <td>Proyecto<td>Cuenta (OG)</td><td>ID Beneficiario</td> <td>Monto</td> <td>Observaciones</td> <td>Descripcion ID</td> </tr><tr> <td>".$fecha."</td> <td>".$cta_b."</td> <td>".$cheque."</td> <td>".$proy."</td> <td>".$cta."</td> <td>".$benef_id."</td> <td>".$monto."</td> <td>".$obs."</td> <td>".$d_inv."</td> <td>".$estatus."</td> </tr></table>");

	echo ("<p><form action='impresion_ch_2.php' method='post'>");
	echo ("<input type='hidden' name='cta_b' value='$cta_b'>");
	echo ("<input type='hidden' name='cheque' value='$cheque'>");
	echo ("<button type='submit' name='enviar'>Imprimir Este Cheque</button>");
	echo ("</form></p>");
	//Menú de Navegación
	/*echo ("<hr /><p><a id='btn_h' target='_self' href='./presupuesto.html'>Menú Principal</a>");*/
	echo ("<a id='btn_h' target='_self' href='./captura_ch_0.php'>Capturar Otro Cheque</a></p>");

	}else{echo ("<h3>Error al Insertar</h3><form align='center' action='captura_ch_1.php' method='post'><input type='hidden' value='$proy' name='proy' /><button type='submit' name='aceptar'>Aceptar</button></form>");}
	}else {echo ("<h3>Datos Insuficientes</h3><form align='center' action='captura_ch_1.php' method='post'><input type='hidden' value='$proy' name='proy' /><button type='submit' name='aceptar'>Aceptar</button></form>");}
	}else{echo ("<h3>Fecha Incorrecta</h3><form align='center' action='captura_ch_1.php' method='post'><input type='hidden' value='$proy' name='proy' /><button type='submit' name='aceptar'>Aceptar</button></form>");}
?>

</body>
</html>