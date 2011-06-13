<html>
<head><TITLE>Cambio de Responsable</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_usr.php");
conect_usr();
include("../script/sui.php");
include("../script/chxures.php");
include("../script/res_comp.php");
$usr = $_SERVER[PHP_AUTH_USER];
$seleccion = usr($usr);

switch ($usr){
	case raul:$filtro='and (ch.responsable = "Raul" and ch.estatus not in ("","Sin Comprobar"))';break;//impide el cambio de responsable de un cheque sin estatus o sin comprobar
	case priscilla:$filtro='and ch.responsable = "Priscilla" and ch.benef_id!=37';break;
	case martha:$filtro='and ch.responsable = "Martha"';break;
	case blanca:$filtro='and ch.responsable = "Blanca"';break;
	case chelo:$filtro='and ch.responsable = "Chelo"';break;
}

echo ("<form action='cambio_res_1.php' method='post'>");
chxures_sel($seleccion,$filtro);//función que muestra los cheques segun el usuario, aplica un filtro y agrega un checkbox.
echo ("<table align='center'><tr><td><button type='submit' name='aceptar'>Aceptar</button></td>");
echo ("<td><button type='reset' name='limpiar'>Limpiar</button></td> </tr></table>");
echo ("</form>");
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./comprobacion.html">Menú Principal</a></p>
</body>
</html>