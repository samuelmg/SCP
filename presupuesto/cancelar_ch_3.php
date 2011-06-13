<?php
/*
 * cancelar_ch_3.php
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
<head><TITLE>Cancelar Cheque</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_nav.php");
conect_nav();
$cta_b = $_POST['cta_b'];	//Obtiene el Número de Cuenta Bancaria
$cheque = $_POST['cheque'];	//Obtiene el Número de Cheque
if(mysql_query("update tbl_cheques set proy=0, cta=0, monto=0, benef_id=37, obs='' where cta_b=$cta_b and cheque=$cheque")) {
	echo ("<p><h3>Cancelación Realizada con Exito</h3>");

	$sql_ch = ("select ch.cta_b, ch.cheque, ch.fecha, benef.benef, ch.monto, ch.proy, ch.cta from tbl_cheques ch, tbl_benef benef where ch.benef_id=benef.benef_id and ch.cta_b='$cta_b' and ch.cheque='$cheque'");
	$qry_ch = mysql_query($sql_ch);

//Muestra el Cheque Cancelado
	echo ("<table border='1'><thead><tr> <th>Cta Bancaria</th> <th>Cheque</th> <th>Fecha</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta</th> </tr></thead><tbody>");
	while ($arr_ch = mysql_fetch_array($qry_ch)){
	echo ("<tr> <td align='center'>".$arr_ch['cta_b']."</td> <td align='center'>".$arr_ch['cheque']."</td> <td>".$arr_ch['fecha']."</td> <td>".$arr_ch['benef']."</td> <td align='right'>".number_format($arr_ch['monto'],2)."</td> <td>".$arr_ch['proy']."</td> <td>".$arr_ch['cta']."</td> </tr>");
	}
echo ("</tbody></table>");

	//Menú de Navegación
	echo ("<hr /><p><a id='btn_h' target='_self' href='./presupuesto.html'>Menú Principal</a>");
	echo ("<a id='btn_h' target='_self' href='./cancelar_ch_0.php'>Cancelar Otro Cheque</a></p>");

}else{echo ("<h3>Error al Cancelar Cheque</h3><h4>Favor de Reportar este Error al Administrador del Sistema</h4><form align='center' action='cancelar_ch_2.php' method='post'><input type='hidden' name='cta_b' value='$cta_b' /><input type='hidden' name='cheque' value='$cheque' /><button type='submit' name='aceptar'>Aceptar</button></form>");}
?>
</body>
</html>