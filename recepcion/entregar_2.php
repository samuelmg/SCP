<?php
/*
 * entregar_2.php
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
<head><TITLE>Entregar Cheques</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Actualizar Entrega</h3>
<?php
include("../script/conect_usr.php");
conect_usr();
$cta_b = $_POST['cta_b'];
$cheque = $_POST['cheque'];

$sql_ch = "select ch.fecha, ch.cta_b, ch.cheque, b.benef, ch.monto, ch.proy, ch.cta, ch.entregado from tbl_cheques ch, tbl_benef b where ch.benef_id = b.benef_id and ch.cta_b = $cta_b and ch.cheque = $cheque";
$qry_ch = mysql_query($sql_ch);
echo ("<p><table align='center' border='1'><thead><tr> <th>Fecha</th> <th>Cta Bancaria</th> <th>No. Cheque</th> <th>Monto</th> <th>Beneficiario</th> <th>Proyecto</th> <th>Cuenta(OG)</th> <th>Entregado</th> </tr></thead>");

while ($arr_ch = mysql_fetch_array($qry_ch)){
	echo ("<tr> <td>".$arr_ch['fecha']."</td> <td>".$arr_ch['cta_b']."</td> <td>".$arr_ch['cheque']."</td> <td>".utf8_decode($arr_ch['benef'])."</td> <td align = 'right'>".number_format($arr_ch['monto'],2)."</td> <td>".$arr_ch['proy']."</td> <td>".$arr_ch['cta']."</td> <td>".$arr_ch['entregado']."</td></tr>");
}
echo ("</table></p>");

echo ("<form action='entregar_3.php' method='post'>");
echo ("<table> <tr> <td>Entregar Cheque:</td> <td><select name='entregado'><option>SI</option> <option>NO</option></select></td>");
echo ("<input type='hidden' value='$cta_b' name='cta_b' /> <input type='hidden' value='$cheque' name='cheque' /> <td><button type='submit' name='aceptar'>Aceptar</button></td> </tr> </table>");
echo ("</form>");
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./recepcion.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./entregar_0.php">Cambiar Cuenta Bancaria</a></p>
</body>
</html>