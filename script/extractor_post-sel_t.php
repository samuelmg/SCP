<?php
//EXTRACTOR DE POST DE SELECCION DE TRANSFERENCIAS (CAMBIO DE ESTATUS)
function extraer_post_t($_POST){//Extrae del POST el no_t y llena los datos a pasar en un formulario
$no_t = current($_POST);
echo ("<input type='hidden' name='".$no_t."' value='".$no_t."'>");
t_sel_estatus($no_t);
while (next($_POST)){
	$no_t = current($_POST);
	echo ("<input type='hidden' name='".$no_t."' value='".$no_t."'>");
	t_sel_estatus($no_t);
	}
}
function t_sel_estatus($no_t){//Muestra la informacion de la Transferencia
$sql_sel = "select e.fecha, e.cta_b, e.no_t, b.benef, sum(e.monto), e.proy, e.estatus, e.seguimiento, e.oficio, e.responsable from tbl_egresos e, tbl_benef b where e.benef_id=b.benef_id and e.no_t=$no_t group by e.fecha, e.cta_b, e.no_t, b.benef, e.proy, e.responsable, e.estatus, e.seguimiento order by e.cta_b, e.fecha";
$qry_sel = mysql_query($sql_sel);
while ($arr_sel = mysql_fetch_array($qry_sel)){
	echo ("<tr> <td>".$arr_sel['fecha']."</td> <td align='center'>".$arr_sel['cta_b']."</td> <td align='center'>".$arr_sel['no_t']."</td> <td>".utf8_decode($arr_sel['benef'])."</td> <td align='right'>".number_format($arr_sel['sum(e.monto)'],2)."</td> <td>".$arr_sel['proy']."</td> <td>".$arr_sel['estatus']."</td> <td>".$arr_sel['seguimiento']."</td> <td>".$arr_sel['oficio']."</td> <td>".$arr_sel['responsable']."</td></tr>");
	}
}
?>