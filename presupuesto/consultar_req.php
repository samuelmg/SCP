<?php
/*
 * consultar_req.php
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
	$qry_proy= "select proy from tbl_proyectos order by proy"; //Obtiene la relacion de Todos los Proyectos
	$qry = mysql_query($qry_proy); //Realiza la consulta
	while ($fila = mysql_fetch_array($qry)){
		echo ("<option>".$fila['proy']."</option>");
	}
?>

</body>
</html>