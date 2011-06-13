<?php
/*
 * sel_fondo.php
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

function sel_fondo($proy){//Determina el fondo para elegir el script adecuado sxp_*.php
//Obtiene el fondo del Proyecto
$sql_fondo = "select fondo from tbl_proyectos where proy = $proy";
$qry_fondo = mysql_query($sql_fondo);
$arr_fondo = mysql_fetch_array($qry_fondo);
$fondo = $arr_fondo['fondo'];
//Selecciona el archivo a incluir y llama a la funcion
if ($fondo == 1101 || $fondo == 1103){
	include("sxp_ord.php");
	sxp_ord($proy);
}elseif($fondo == 1102 || $fondo == 110403){
	include("sxp_ext.php");
	sxp_ext($proy);
}elseif($fondo == 111028 || $fondo == 111031){
	include("sxp_par.php");
	sxp_par($proy);
	}
}
?>