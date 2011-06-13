<html>
<head><TITLE>Captura Oficio de Comprobación</TITLE>
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

$filtro = 'and ch.responsable = "'.$usr.'" and ch.estatus in ("Facturas","Comprobado")';

echo ("<form action='captura_oficio_1.php' method='post'>");
chxures_sel_oficio($seleccion,$filtro);
echo ("<table align='center'><tr><td><button type='submit' name='aceptar'>Aceptar</button></td>");
echo ("<td><button type='reset' name='limpiar'>Limpiar</button></td> </tr></table>");
echo ("</form>");
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./comprobacion.html">Menú Principal</a></p>
</body>
</html>