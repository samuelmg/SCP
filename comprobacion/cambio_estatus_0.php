<html>
<head><TITLE>Cambio Estatus de Cheque</TITLE>
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

$filtro="and ch.responsable = '$usr' and (oficio is null or oficio='')";//Filtra por responsable de la poliza. No se puede cambiar el estatus si ya se captur� el oficio

echo ("<form action='cambio_estatus_1.php' method='post'>");
chxures_sel($seleccion,$filtro);
echo ("<table align='center'><tr><td><button type='submit' name='aceptar'>Aceptar</button></td>");
echo ("<td><button type='reset' name='limpiar'>Limpiar</button></td> </tr></table>");
echo ("</form>");
?>
<!--Men� de Navegaci�n-->
<hr /><p><a id="btn_h" target="_self" href="./comprobacion.html">Men� Principal</a></p>
</body>
</html>