<?php
/*
 * chxbenef_1.php
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
<head><TITLE>Cheques x Beneficiario</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>

<?php
include("../script/conect_usr.php");
conect_usr();
settype($_POST['benef_id'],integer);
$benef_id=$_POST['benef_id'];

$sql_benef = "select benef from tbl_benef where benef_id = '$benef_id'";
$qry_benef = mysql_query($sql_benef);
$arr_benef = mysql_fetch_array($qry_benef);
$benef = $arr_benef['benef'];
echo ("<h3>Cheques a favor de ".$benef."</h3>");

$sql_ch_benef = "select fecha, cta_b, cheque, monto, proy, cta, obs from tbl_cheques where benef_id = '$benef_id' order by fecha, cheque";
$qry_ch_benef = mysql_query($sql_ch_benef);
echo ("<p><table id='info' align='center' border='1'><thead><tr> <th>Fecha</th> <th>Cta Bancaria</th> <th>No. Cheque</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta(OG)</th> <th>Observaciones</th> </tr></thead>");

while ($arr_ch_benef = mysql_fetch_array($qry_ch_benef)){
	echo ("<tr> <td>".$arr_ch_benef['fecha']."</td> <td>".$arr_ch_benef['cta_b']."</td> <td>".$arr_ch_benef['cheque']."</td> <td align = 'right'>".number_format($arr_ch_benef['monto'],2)."</td> <td>".$arr_ch_benef['proy']."</td> <td>".$arr_ch_benef['cta']."</td> <td>".$arr_ch_benef['obs']."</td> </tr>");
}
echo ("</table></p>");
?>
</form>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./recepcion.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./chxbenef_0.php">Seleccionar Otro Beneficiario</a></p>
</body>
</html>