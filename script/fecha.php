<?php
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
function fecha_info(&$fecha){
$mes = $fecha['5']*10;
$mes += $fecha['6'];
$dia = $fecha['8']*10;
$dia += $fecha['9'];
$a = $fecha['0']*1000;
$a += $fecha['2']*10;
$a += $fecha['3'];
switch ($mes){
	case 1:$m='01';break;
	case 2:$m='02';break;
	case 3:$m='03';break;
	case 4:$m='04';break;
	case 5:$m='05';break;
	case 6:$m='06';break;
	case 7:$m='07';break;
	case 8:$m='08';break;
	case 9:$m='09';break;
	case 10:$m='10';break;
	case 11:$m='11';break;
	case 12:$m='12';break;
}
$fecha = ($dia."/".$m."/".$a);
}
?>