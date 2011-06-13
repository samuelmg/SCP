<html>
<head><TITLE>Cheques x Beneficiario</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_usr.php");
$usrlink = conect_usr();

echo ("<p>");
echo ("<form action='chxbenef_1.php' method='post'>");

echo ("<table><tr><td>Elige el Beneficiario</td>");
//Seleccion de Beneficiario
echo ("<td><select name='benef_id'>");
$sql_benef= "select benef_id, benef from tbl_benef order by benef";
$qry_benef = mysql_query($sql_benef);
while ($arr_benef = mysql_fetch_array($qry_benef)){
	echo ("<option>".$arr_benef['benef_id']." - ".utf8_decode($arr_benef['benef'])."</option>");
}
echo("</td><td><button type='submit' name='captura_ch'>Seleccionar</button></td></tr></table>");
echo ("<table align='center'><tr></tr></table>");
echo ("</form>");
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./recepcion.html">Menú Principal</a></p>
</body>
</html>