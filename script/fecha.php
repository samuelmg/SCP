<?php
/*
 * fecha.php
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

function fecha_mx(&$fecha){
$mes = $fecha['5']*10;
$mes += $fecha['6'];

$dia = $fecha['8']*10;
$dia += $fecha['9'];

$a = $fecha['0']*1000;
$a += $fecha['2']*10;
$a += $fecha['3'];

switch ($mes){
	case 1:$m='Enero';break;
	case 2:$m='Febrero';break;
	case 3:$m='Marzo';break;
	case 4:$m='Abril';break;
	case 5:$m='Mayo';break;
	case 6:$m='Junio';break;
	case 7:$m='Julio';break;
	case 8:$m='Agosto';break;
	case 9:$m='Septiembre';break;
	case 10:$m='Octubre';break;
	case 11:$m='Noviembre';break;
	case 12:$m='Diciembre';break;
}
$fecha = ($dia." de ".$m." de ".$a);
}
?>