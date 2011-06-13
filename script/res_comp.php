<?php
/*
 * res_comp.php
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

function res_comp($proy){
$sql_ures = "select ures from tbl_proyectos where proy = $proy";
$qry_ures = mysql_query($sql_ures);
$arr_ures = mysql_fetch_array($qry_ures);
$ures = $arr_ures['ures'];
if ($ures >= 223000 && $ures < 224000){
	$res = "Consuelo";
	return $res;
	}elseif($ures==222000||$ures==224000||$ures==224002){
	$res = "Blanca";
	return $res;
	}elseif($ures>=225000 && $ures!=228000){
	$res = "Karla";
	return $res;
	}elseif($ures==228000){
	$res = "Martha";
	return $res;
	}
}
?>
