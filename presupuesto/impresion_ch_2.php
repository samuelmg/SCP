<html>
<head><TITLE>Impresi�n de Cheques</TITLE>
<link rel="stylesheet" href="../css/cheque.css" />
</head>
<body>
<?php
include("../script/conect_nav.php");
conect_nav();
include("../script/nat.php");
include("../script/fecha.php");
include("../script/res_comp.php");
$cta_b = $_POST['cta_b'];	//Obtiene el N�mero de Cuenta Bancaria
$cheque = $_POST['cheque'];	//Obtiene el N�mero de Cheque
//No se obtienen cta ni obs en la sentencia SQL
$sql_cheque = ("select tbl_cheques.fecha, tbl_cheques.cta_b, tbl_cheques.proy, tbl_benef.benef, sum(tbl_cheques.monto), tbl_cheques.obs, tbl_cheques.id from tbl_cheques, tbl_benef where tbl_cheques.benef_id=tbl_benef.benef_id and cta_b='$cta_b' and cheque='$cheque' group by tbl_cheques.cheque");//Selecciona una cuenta bancaria y un cheque
$qry_cheque = mysql_query($sql_cheque);//Hace la consulta a la Base de Datos
$arr_cheque = mysql_fetch_array($qry_cheque);//Convierte el resultado en arreglo

$fecha = $arr_cheque['fecha'];
fecha_mx(&$fecha);//llama la funci�n que cambia el formato de la fecha a dia de Mes de a�o
$benef = utf8_decode($arr_cheque['benef']);
$monto = $arr_cheque['sum(tbl_cheques.monto)'];
$proy = $arr_cheque['proy'];
$obs = $arr_cheque['obs'];
$id = $arr_cheque['id'];

$res = res_comp($proy,&$ures);//Determina el Responsable de la Comprobacion
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
echo ("<div id='id_par'>".$id."</div>");
echo ("<div id='obs'>".$obs."</div>");
echo ("<div id='haber'>".number_format($monto,2)."</div>");
echo ("<div id='cta_haber'>".$cta_b."</div>");
echo ("<div id='hecho'>".$_SERVER[PHP_AUTH_USER]."</div>");
echo ("<div id='res'>Comprueba ".$res." - Ures:".$ures."</div>");
echo ("<div id='sum_haber'>".number_format($monto,2)."</div>");
echo ("<div id='sum_debe'>".number_format($monto,2)."</div>");
mysql_close($navlink);
?>
</body>
</html>