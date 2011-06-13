<?php
function res_comp($proy,&$ures){
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
	$res = "Martha";
	return $res;
	}
}
?>
