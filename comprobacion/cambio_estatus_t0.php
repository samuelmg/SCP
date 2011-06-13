<html>
<head><TITLE>Cambio de Estatus de Transferencias</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_usr.php");
conect_usr();
include("../script/sui.php");
include("../script/egresos_x_ures.php");
include("../script/res_comp.php");
$usr = $_SERVER[PHP_AUTH_USER];
$seleccion = usr($usr);

$filtro='and e.responsable = "'.$usr.'" and (e.oficio is null or e.oficio="")';

echo ("<form action='cambio_estatus_t1.php' method='post'>");
egresos_sel($seleccion,$filtro);
echo ("<table align='center'><tr><td><button type='submit'>Aceptar</button></td>");
echo ("<td><button type='reset'>Limpiar</button></td> </tr></table>");
echo ("</form>");
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./comprobacion.html">Menú Principal</a></p>
</body>
</html>