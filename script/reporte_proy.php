<?php
function reporte($proy){
//Información del proyecto
$sql_proy = "select tbl_proyectos.proy, tbl_proyectos.d_proy, tbl_proyectos.monto, tbl_proyectos.quin from tbl_proyectos where tbl_proyectos.proy = '$proy'"; //Sentencia SQL donde se filtra el proyecto
$qry_proy = mysql_query($sql_proy);
$arr_proy = mysql_fetch_array($qry_proy);

echo("<table cellpadding='5'><tbody align='center'><tr><td>Proyecto: ".$arr_proy['proy']."</td> <td>".utf8_decode($arr_proy['d_proy'])."</td> <td>Monto: ".number_format($arr_proy['monto'],2)."</td> <td>Quincena Recibida:".$arr_proy['quin']."</td> </tr></tbody></table>");
echo ("<hr />");

$sql_quin_proy = "select quin from tbl_quincenas where proy = '$proy' group by quin"; //Relaciona las quincenas
$qry_quin_proy = mysql_query($sql_quin_proy);
$reg_x = mysql_num_rows($qry_quin_proy);//Cuenta el numero de registos para controlar el contador

$sql_cta_proy = "select cta from tbl_quincenas where proy = '$proy' group by cta"; //Relaciona las cuentas
$qry_cta_proy = mysql_query($sql_cta_proy);
$reg_y = mysql_num_rows($qry_cta_proy);//Cuenta el numero de registos para controlar el contador

for ($j=0; $j<$reg_x; $j++){//Captura la informacion de quincenas
	$arr_quin_proy = mysql_fetch_array($qry_quin_proy);
	$quin[$j] = $arr_quin_proy['quin'];
}

for ($i=0; $i<$reg_y; $i++){//Captura la informacion de cuentas
	$arr_cta_proy = mysql_fetch_array($qry_cta_proy);
	$cta[$i] = $arr_cta_proy['cta'];
}

//Impresión de Tabla
echo ("<table id='info' border='1'><tr><thead><th>Cuenta</th>");
for ($j=0; $j<$reg_x; $j++){//Imprime cabeceras
	echo ("<th>".$quin[$j]."</th>");
}
echo ("<th>Total Cuenta</th></thead></tr>");
$renglon='non';//cambio de color en renglones
for ($i=0; $i<$reg_y; $i++){	//inicia listado de cuentas
	echo ("<tr id='$renglon'><td>".$cta[$i]."</td>");
	$sql_quin_monto = "select quin, monto from tbl_quincenas where proy='$proy' and cta='$cta[$i]'";
	$qry_quin_monto = mysql_query($sql_quin_monto);
	$arr_quin_monto = mysql_fetch_array($qry_quin_monto);	//avanza un registro
	for ($j=0; $j<$reg_x; $j++){							//inicia listado de quincenas
		if ($quin[$j]==$arr_quin_monto['quin']){			//compara quincenas
			echo ("<td id='monto'>".number_format($arr_quin_monto['monto'],2)."</td>");
			$sum_quin[$j] += $arr_quin_monto['monto'];
			$sum_cta[$i] += $arr_quin_monto['monto'];
			$sum_total += $arr_quin_monto['monto'];
			$arr_quin_monto = mysql_fetch_array($qry_quin_monto);	//avanza registro si la igualdad se cumple
		}else{
			echo ("<td id='monto'>0.00</td>");
		}
	}
	echo ("<td id='total'>".number_format($sum_cta[$i],2)."</td></tr>");
	if ($renglon=='non'){$renglon='par';}else{$renglon='non';}//cambio de color en renglones
}
echo ("<tr><td>Total</td>");//Imprime totales x quincena
for ($j=0; $j<$reg_x; $j++){
	echo ("<td id='total'>".number_format($sum_quin[$j],2)."</td>");
}
echo ("<td id='total'>".number_format($sum_total,2)."</td></tr>");
echo ("</table>");
}