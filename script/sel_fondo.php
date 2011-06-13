<?php
function sel_fondo($proy){//Determina el fondo para elegir el script adecuado sxp_*.php
//Obtiene el fondo del Proyecto
$sql_fondo = "select fondo from tbl_proyectos where proy = $proy";
$qry_fondo = mysql_query($sql_fondo);
$arr_fondo = mysql_fetch_array($qry_fondo);
$fondo = $arr_fondo['fondo'];

//Obtiene el tipo de fondo
$sql_tipo = "select tipo from tbl_fondos where fondo = $fondo";
$qry_tipo = mysql_query($sql_tipo);
$arr_tipo = mysql_fetch_array($qry_tipo);
$tipo = $arr_tipo['tipo'];

//Selecciona el archivo a incluir y llama a la funcion
if ($tipo == "ORD"){
	include("sxp_ord.php");
	sxp_ord($proy);
}elseif($tipo == "EXT"){
	include("sxp_ext.php");
	sxp_ext($proy);
}elseif($tipo == "PAR"){
	include("sxp_par.php");
	sxp_par($proy);
	}
}
?>