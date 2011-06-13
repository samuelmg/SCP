<html>
<head><TITLE>Impresión de Cheques (4448)</TITLE>
<link rel="stylesheet" href="../css/cheque.css" />
</head>
<body>
<?php
include("../script/conect_nav.php");
conect_nav();
include("../script/nat.php");
include("../script/fecha.php");

$cheque = $_POST['cheque'];	//Obtiene el Número de Cheque

//No se obtienen cta ni obs en la sentencia SQL
$sql_cheque = ("select tbl_cheques_4448.fecha, tbl_benef.benef, sum(tbl_cheques_4448.monto), tbl_cheques_4448.concepto, tbl_cheques_4448.descripcion from tbl_cheques_4448, tbl_benef where tbl_cheques_4448.benef_id = tbl_benef.benef_id and cheque='$cheque' group by tbl_cheques_4448.cheque");//Selecciona un cheque
$qry_cheque = mysql_query($sql_cheque);//Hace la consulta a la Base de Datos
$arr_cheque = mysql_fetch_array($qry_cheque);//Convierte el resultado en arreglo

$fecha = $arr_cheque['fecha'];
fecha_mx(&$fecha);//llama la función que cambia el formato de la fecha a dia de Mes de año
$benef = utf8_decode($arr_cheque['benef']);
$monto = $arr_cheque['sum(tbl_cheques_4448.monto)'];

$concepto = $arr_cheque['concepto'];
$descripcion = $arr_cheque['descripcion'];

$monto_letra = letras($monto);//Conversion del monto numerico a escrito

$sql_detalle = ("select concepto, monto, descripcion from tbl_cheques_4448 where cheque='$cheque'");//Selecciona los conceptos
$qry_detalle = mysql_query($sql_detalle);//Hace la consulta a la Base de Datos
echo ("<div id='debe'>");
while ($arr_detalle = mysql_fetch_array($qry_detalle)){
	$concepto = $arr_detalle['concepto'];
	$monto_concepto = $arr_detalle['monto'];
	echo $concepto;
	echo ("<span class='monto_cuenta'>".number_format($monto_concepto,2)."</span><br />");
}
echo ("</div>");

echo ("<div id='fecha'>".$fecha."</div>");
echo ("<div id='benef'>".$benef."</div>");
echo ("<div id='monto'>".number_format($monto,2)."</div>");
echo ("<div id='letras'>".$monto_letra."</div>");
echo ("<div id='proy'>".$concepto."</div>");
echo ("<div id='id_par'>".$descripcion."</div>");
echo ("<div id='obs'>".$obs."</div>");
echo ("<div id='haber'>".number_format($monto,2)."</div>");
echo ("<div id='cta_haber'>4448</div>");
echo ("<div id='hecho'>".$_SERVER[PHP_AUTH_USER]."</div>");
echo ("<div id='sum_haber'>".number_format($monto,2)."</div>");
echo ("<div id='sum_debe'>".number_format($monto,2)."</div>");
mysql_close($navlink);
?>
</body>
</html>