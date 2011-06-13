<?php
/*
 * actualiza_res.php
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

function update_res($_POST){
$cta_b = substr(current($_POST),0,4);
$cheque = substr(current($_POST),5,4);
$res = $_POST['res'];
sql_update($cta_b, $cheque, $res);
$reg = count($_POST)-2; //Numero de Registros por evaluar
for($i=$reg; $i>1; $i--){
	next($_POST);
	$cta_b = substr(current($_POST),0,4);
	$cheque = substr(current($_POST),5,4);
	$res = $_POST['res'];
	sql_update($cta_b, $cheque, $res);
	}
}

function sql_update($cta_b, $cheque, $res){
$sql_res = "update tbl_cheques set responsable = '$res' where cta_b = $cta_b and cheque = $cheque";
if($res!=null){
	if(mysql_query($sql_res)){
	}else{echo ("<h3>Error al actualizar</h3> <h4><a href='./cambio_res_0.php'>Volver a Seleccionar</a></h4>");}
}else{echo ("<h3>Error al actualizar - Campo Vacio</h3> <h4><a href='./cambio_res_0.php'>Volver a Seleccionar</a></h4>");}
}
?>