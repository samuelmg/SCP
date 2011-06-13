<?php
/*
 * captura_req.php
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
<head><TITLE>Requisiciones Pendientes</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>

<p><h3>Requisiciones Pendientes de Pago</h3>
<?php
	include("../script/conect_nav.php");
	conect_nav();
	$sql_req = "select p.ures, u.d_ures, r.proy, r.cta, r.monto, r.n_req, r.d_inv, r.fecha from tbl_req r, tbl_proyectos p, tbl_ures u where p.proy=r.proy and u.ures=p.ures and r.estado not in ('C','P') order by p.ures, p.proy"; //Obtiene la relacion de Todos los Proyectos
	$qry_req = mysql_query($sql_req); //Realiza la consulta
	echo("<table border='1'>");
	while ($arr_req = mysql_fetch_array($qry_req)){
		echo ("<tr><td>".$arr_req['ures']."</td> <td>".$arr_req['d_ures']."</td> <td>".$arr_req['proy']."</td> <td>".$arr_req['cta']."</td> <td align='right'>".number_format($arr_req['monto'],2)."</td> <td>".$arr_req['n_req']."</td> <td>".$arr_req['d_inv']."</td> <td>".$arr_req['fecha']."</td></tr>");
	}
	echo("</table>");
?>

</body>
</html>