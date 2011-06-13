<?php
/*
 * entregar_3.php
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
<?php
include("../script/conect_nav.php");
conect_nav();
$cta_b = $_POST['cta_b'];
$cheque = $_POST['cheque'];
$entregado = $_POST['entregado'];

$sql_ent = "update tbl_cheques set entregado = '$entregado' where cta_b = $cta_b and cheque = $cheque";
if (mysql_query($sql_ent)){
	echo ("<h3>Actualización Realizada con Exito</h3>");
	echo ("<form action='entregar_1.php' method='post' align='center'> <input type='hidden' value='$cta_b' name='cta_b' /> <input type='hidden' value='$cheque' name='cheque' /> <button type='submit' name='aceptar' value='aceptar'>Aceptar</button></form>");
	}else{
	echo ("<h3>Error al Actualizar</h3><br /><h3>Favor de Reportarlo al Administrador del Sistema</h3>");
	echo ("<form action='entregar_1.php' method='post' align='center'> <input type='hidden' value='$cta_b' name='cta_b' /> <input type='hidden' value='$cheque' name='cheque' /> <button type='submit' name='aceptar' value='aceptar'>Aceptar</button></form>");
	}
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./recepcion.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./entregar_0.php">Cambiar Cuenta Bancaria</a></p>
</body>
</html>