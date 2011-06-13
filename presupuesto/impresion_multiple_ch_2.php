<html>
<head><TITLE>Impresión de Cheques</TITLE>

<?php
echo ("
<style>
<!--
body {font-family: Century Gothic; font-size:13px;}
#fecha {position:absolute; top:55px; left:570px;}
#benef {position:absolute; top:98px; left:5px;}
#monto {position:absolute; top:98px; left:615px;}
#letras{position:absolute; top:128px; left:10px;}
#proy {position:absolute; top:363px; left:10px;}
#obs {position:absolute; top:380; left:10px;}
#inv {position:absolute; top:385px; left:170px;}
#haber {position:absolute; top:455px; left:672px;}
#cta_haber {position:absolute; top:455px; left:0px;}
#debe { position:absolute; top:500px; left:0px;}
span.monto_cuenta {position:absolute; left:597px;}
#hecho {position:absolute; top:978px; left:70px;}
#res {position:absolute; top:850px; left:200px;}
#sum_haber {position:absolute; top:978px; left:672px;}
#sum_debe {position:absolute; top:978px; left:597px;}
-->
</style>
</head>
<body>
");

include("../script/conect_nav.php");
conect_nav();
include("../script/nat.php");
include("../script/fecha.php");
include("../script/res_comp.php");
$cta_b = $_POST['cta_b'];	//Obtiene el Número de Cuenta Bancaria
$ch_ini = $_POST['ch_ini'];	//Obtiene el Número de Cheque Inicial
$ch_fin = $_POST['ch_fin'];	//Obtiene el Número de Cheque Final

$cheque=$ch_ini;
//No se obtienen cta ni obs en la sentencia SQL
$sql_cheque = ("select tbl_cheques.fecha, tbl_cheques.cta_b, tbl_cheques.proy, tbl_benef.benef, sum(tbl_cheques.monto), tbl_cheques.obs, tbl_cheques.d_inv from tbl_cheques, tbl_benef where tbl_cheques.benef_id=tbl_benef.benef_id and cta_b='$cta_b' and cheque='$cheque' group by tbl_cheques.cheque");//Selecciona una cuenta bancaria y un cheque
$qry_cheque = mysql_query($sql_cheque);//Hace la consulta a la Base de Datos
$arr_cheque = mysql_fetch_array($qry_cheque);//Convierte el resultado en arreglo

$fecha = $arr_cheque['fecha'];
fecha_mx(&$fecha);//llama la función que cambia el formato de la fecha a dia de Mes de año
$benef = utf8_decode($arr_cheque['benef']);
$monto = $arr_cheque['sum(tbl_cheques.monto)'];
$proy = $arr_cheque['proy'];
$obs = $arr_cheque['obs'];
$d_inv = $arr_cheque['d_inv'];

$res = res_comp($proy);//Determina el Responsable de la Comprobacion
$monto_letra = letras($monto);//Conversion del monto numerico a escrito

$sql_detalle = ("select cta, monto, obs from tbl_cheques where cta_b='$cta_b' and cheque='$cheque'");//Selecciona la cta y obs
$qry_detalle = mysql_query($sql_detalle);//Hace la consulta a la Base de Datos
echo ("<div id='debe'>");
while ($arr_detalle = mysql_fetch_array($qry_detalle)){
	$cta = $arr_detalle['cta'];
	$monto_cuenta = $arr_detalle['monto'];
	echo $cta;
	echo ("<span class='monto_cuenta'>".number_format($monto_cuenta,2)."</span><br />");
}
echo ("</div>");

echo ("<div id='fecha'>".$fecha."</div>");
echo ("<div id='benef'>".$benef."</div>");
echo ("<div id='monto'>".number_format($monto,2)."</div>");
echo ("<div id='letras'>".$monto_letra."</div>");
echo ("<div id='proy'>Proyecto: ".$proy."</div>");
echo ("<div id='inv'>".$d_inv."</div>");
echo ("<div id='obs'>".$obs."</div>");
echo ("<div id='haber'>".number_format($monto,2)."</div>");
echo ("<div id='cta_haber'>".$cta_b."</div>");
echo ("<div id='hecho'>".$_SERVER[PHP_AUTH_USER]."</div>");
echo ("<div id='res'>Comprueba ".$res."</div>");
echo ("<div id='sum_haber'>".number_format($monto,2)."</div>");
echo ("<div id='sum_debe'>".number_format($monto,2)."</div>");
?>

</body>
</html>