<?php
/*
 * conect_usr.php
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

function conect_usr(){
	if(!($usrlink = mysql_connect("localhost","usuario")))
	{
		echo "Error al conectarse al Servidor";
	}
	if(!mysql_select_db ("cucei06",$usrlink))
	{
		echo "Error al seleccionar Base de Datos";
		exit();
	}
	return $usrlink;
}
?>
