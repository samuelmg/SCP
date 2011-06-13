<?php
/*
 * captura_fechac.php
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

function captura_oficio($_POST){
$cta_b = substr(current($_POST),0,4);
$cheque = substr(current($_POST),5,4);
$oficio = $_POST['oficio'];
$oficio = $_POST['d'];
$oficio = $_POST['m'];
$oficio = $_POST['a'];
$fecha=$a."-".$m."-".$d;
sql_update($cta_b, $cheque, $d, $m, $a);
$reg = count($_POST)-2; //Numero de Registros por evaluar
for($i=$reg; $i>1; $i--){
	next($_POST);
	$cta_b = substr(current($_POST),0,4);
	$cheque = substr(current($_POST),5,4);
	$oficio = $_POST['oficio'];
	$oficio = $_POST['d'];
	$oficio = $_POST['m'];
	$oficio = $_POST['a'];
	$fecha=$a."-".$m."-".$d;
	sql_update($cta_b, $cheque, $oficio);
	}
}

function sql_update($cta_b, $cheque, $fecha){
$sql_update = "update tbl_cheques set fecha_c = '$fecha' where cta_b = $cta_b and cheque = $cheque";
if(mysql_query($sql_update)){
}else{echo ("<h3>Error al actualizar</h3> <h4><a href='./captura_fecha_0.php'>Volver a Seleccionar</a></h4>");}
}
?>