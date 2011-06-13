<?php
/*
 * insert_req_script.php
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
<head><TITLE>Captura de Requisiciones</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_nav.php");
conect_nav();

$req=$_POST['req'];
$proy=$_POST['proy'];
$cta=$_POST['cta'];
$monto=$_POST['monto'];
$d_inv=$_POST['d_inv'];
$d=$_POST['d'];
$m=$_POST['m'];
$a=$_POST['a'];

if ($req != null && $proy !=null && $cta != null && $monto != null){//Validación de Datos
	if (checkdate($m,$d,$a)){ //Validación de Fecha
		$fecha=$a."-".$m."-".$d;
		$sql_proy_cta = "select proy, cta from tbl_quincenas where proy = '$proy' and cta = '$cta' group by cta";
		$qry_proy_cta = mysql_query($sql_proy_cta);
		$res_proy_cta = mysql_fetch_array($qry_proy_cta);
		if ($res_proy_cta['proy'] == $proy && $res_proy_cta['cta'] == $cta){//Validación de Proyecto y Cuenta
			if (mysql_query("insert into tbl_req values ('$req','$proy','$cta','$monto','$d_inv','$fecha','')")){//Valida Insert
				echo ("<h3>Captura Realizada con Exito</h3>");
				//Menú de Navegación
				echo ("<hr /><p><a id='btn_h' target='_self' href='./presupuesto.html'>Menú Principal</a>");
				echo ("<a id='btn_h' target='_self' href='./insert_req.php'>Capturar Otra Requisición</a></p>");
			}else {echo ("<h3>Error de Captura -> posible No. de Requisicion Repetido</h3> <h4><a href='./insert_req.php'>Volver al Formulario</a></h4>");}
		}else {echo ("<h3>El Proyecto no Existe o no tiene la Cuenta elegida</h3> <h4><a href='./insert_req.php'>Volver al Formulario</a></h4>");}
	}else {echo ("<h3>Fecha Incorrecta</h3> <h4><a href='./insert_req.php'>Volver al Formulario</a></h4>");}
}else {echo ("<h3>Datos Insuficientes</h3> <h4><a href='./insert_req.php'>Volver al Formulario</a></h4>");}
?>
</body>
</html>