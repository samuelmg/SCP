<?php
//Muestra los cheques seleccionados para cambio de estatus
function extraer_post_estatus($_POST){//Extrae del POST la cta_b y cheque en base a la posicion y llena los datos a pasar en un formulario
$cta_b = substr(current($_POST),0,4);
$cheque = substr(current($_POST),5,4);
echo ("<input type='hidden' name='".$cta_b."-".$cheque."' value='".$cta_b."-".$cheque."'>");
ch_sel_estatus($cta_b, $cheque);
while (next($_POST)){
	$cta_b = substr(current($_POST),0,4);
	$cheque = substr(current($_POST),5,4);
	echo ("<input type='hidden' name='".$cta_b."-".$cheque."' value='".$cta_b."-".$cheque."'>");
	ch_sel_estatus($cta_b, $cheque);
	}
}
function ch_sel_estatus($cta_b, $cheque){//Muestra la informacion de un cheque
$sql_sel = "select ch.cta_b, ch.cheque, ch.fecha, b.benef, sum(ch.monto), ch.proy, ch.responsable, ch.estatus, ch.seguimiento from tbl_cheques ch, tbl_benef b where ch.benef_id=b.benef_id and cta_b=$cta_b and cheque=$cheque group by ch.cta_b, ch.cheque, b.benef, ch.proy, ch.responsable, ch.estatus, ch.seguimiento order by ch.cta_b, ch.cheque";
$qry_sel = mysql_query($sql_sel);
while ($arr_sel = mysql_fetch_array($qry_sel)){
	echo ("<tr> <td align='center'>".$arr_sel['cta_b']."</td> <td align='center'>".$arr_sel['cheque']."</td> <td align='center'>".$arr_sel['fecha']."</td> <td>".utf8_decode($arr_sel['benef'])."</td> <td align='right'>".number_format($arr_sel['sum(ch.monto)'],2)."</td> <td>".$arr_sel['proy']."</td> <td>".$arr_sel['responsable']."</td> <td>".$arr_sel['estatus']."</td> <td>".$arr_sel['seguimiento']."</td> </tr>");
	}
}
//********************************************************************************************
//Muestra los cheques seleccionados para cambio de responsable
function extraer_post_res($_POST){//Extrae del POST la cta_b y cheque en base a la posicion y llena los datos a pasar en un formulario
$cta_b = substr(current($_POST),0,4);
$cheque = substr(current($_POST),5,4);
if (substr(current($_POST),0,4) == 4685){//Corrige Alerta falsa de error
	echo ("<input type='hidden' name='".$cta_b."-".$cheque."' value='".$cta_b."-".$cheque."'>");
	ch_sel_res($cta_b, $cheque);
	}
while (next($_POST)){
	$cta_b = substr(current($_POST),0,4);
	$cheque = substr(current($_POST),5,4);
	if (substr(current($_POST),0,4) == 4685){//Corrige Alerta falsa de error
		echo ("<input type='hidden' name='".$cta_b."-".$cheque."' value='".$cta_b."-".$cheque."'>");
		ch_sel_res($cta_b, $cheque);
		}
	}
}
function ch_sel_res($cta_b, $cheque){//Muestra la informacion de un cheque
$sql_sel = "select ch.cta_b, ch.cheque, b.benef, sum(ch.monto), ch.proy, ch.responsable, ch.oficio from tbl_cheques ch, tbl_benef b where ch.benef_id=b.benef_id and cta_b=$cta_b and cheque=$cheque group by ch.cta_b, ch.cheque, b.benef, ch.proy, ch.responsable, ch.oficio order by ch.cta_b, ch.cheque";
$qry_sel = mysql_query($sql_sel);
while ($arr_sel = mysql_fetch_array($qry_sel)){
	echo ("<tr> <td align='center'>".$arr_sel['cta_b']."</td> <td align='center'>".$arr_sel['cheque']."</td> <td>".utf8_decode($arr_sel['benef'])."</td> <td align='right'>".number_format($arr_sel['sum(ch.monto)'],2)."</td> <td>".$arr_sel['proy']."</td> <td>".$arr_sel['responsable']."</td> <td>".$arr_sel['oficio']."</td> </tr>");
	}
}
?>