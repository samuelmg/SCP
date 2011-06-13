<?php
/*
 * transferencias.php
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
<head><TITLE>Comprobaciones - CUCEI</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_usr.php");
conect_usr();
include("../script/sui.php");
$usr = $_SERVER[PHP_AUTH_USER];
$seleccion = usr($usr);

echo "<table id='info' border='1'>";
echo("<thead><tr> <th>URes</th> <th>Transferencia</th> <th>Invoice</th> <th>Fecha</th> <th>Monto</th> <th>Descripcion</th> <th>Proyecto</th> <th>Desc_I</th> <th>Cuenta</th> </tr></thead>");
$qry_t = ("select p.ures, t.t, t.invoice, t.fecha, t.monto, t.d_t, t.proy, t.d_inv, t.cta_b from tbl_proyectos p, tbl_transferencias t where p.proy = t.proy and p.ures $seleccion and t.fecha > '2005-12-30' order by t.t, t.invoice");
	$suma_t = 0;
	$qry = mysql_query($qry_t);
	while ($fila=mysql_fetch_row($qry)){
		echo "<tr>";
		$i=0;
		while ($i < mysql_num_fields($qry)){
			if($i == 4){
				$suma_t += $fila[$i];
				$format = number_format($fila[$i],2);
				echo ("<td align='right'>". $format ."</td>");
			}
			else{
			echo ("<td>".utf8_decode($fila[$i])."</td>");
			}
			$i++;
		}
		echo "</tr>";
	}
	echo "</table>";
	$format = number_format($suma_t, 2);
	echo "<p>Monto total transferido: $format </p>";
?>
</body>
</html>