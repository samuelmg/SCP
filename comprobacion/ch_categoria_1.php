<?php
/*
 * ch_categoria_1.php
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
<head><TITLE>Proceso de Comprobación</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_usr.php");
conect_usr();
include("../script/sui.php");
include("../script/chxcat.php");
$cat = $_POST['cat'];
$usr = $_SERVER[PHP_AUTH_USER];//extrae el nombre de usuario
$seleccion = usr($usr);//Determina que cheques pueden ver

switch ($cat){
	case "En Transito":ch_transito($seleccion);break;
	case "Sin Clasificar":ch_nclas($seleccion);break;
	case "Sin Comprobar":$estatus="= 'Sin Comprobar'";chxest($estatus, $seleccion);break;
	case "Alta Pendiente":$estatus="= 'Alta Pendiente'"; chxest($estatus, $seleccion);break;
	case "Comprobados-En Proceso":$estatus="in ('Facturas','Comprobado')";chxest($estatus, $seleccion);break;
	case "Norma":$res="norma";ch_comp($res, $seleccion);break;
	case "Cuquis":$res="cuquis";ch_comp($res, $seleccion);break;
	case "Blanca":$res="blanca";ch_comp($res, $seleccion);break;
	case "Chelo":$res="chelo";ch_comp($res, $seleccion);break;
	case "Karla":$res="karla";ch_comp($res, $seleccion);break;
	case "Martha":$res="martha";ch_comp($res, $seleccion);break;
	case "Dir Finanzas":ch_dfin($seleccion);break;
}
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./comprobacion.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./ch_categoria_0.php">Otra Selección</a></p>
</body>
</html>