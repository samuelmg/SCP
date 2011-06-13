<?php
/*
 * sui.php
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

//Smart User ID
function usr($usr){

switch ($usr){
	case usuario_administrador:$seleccion="> 220000";break;
//directivos
	case usuario_directivo:$seleccion="> 220000";break;
//	case cuevas:$seleccion="> 220000";break;
//comp
	case usuario_comprobacion:$seleccion="> 200000";break;
//resepcion
	case usuario_resepcion:$seleccion="";break;
//p3e
	case usuario_p3e:$seleccion="= 222000";break;
}
return $seleccion;
}
?>