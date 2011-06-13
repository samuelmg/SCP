<html>
<head><TITLE>Entregar Pólizas</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Selección de polizas a entregar</h3>
<?php
include("../script/conect_usr.php");
conect_usr();
include("../script/sui.php");
include("../script/chxures.php");
include("../script/res_comp.php");
$usr = $_SERVER[PHP_AUTH_USER];
$seleccion = usr($usr);

$filtro='and (ch.responsable = "" or ch.responsable is null)';

echo ("<form action='entregar_1.php' method='post'>");
chxures_sel($seleccion,$filtro);//función que muestra los cheques aplicando un filtro y agrega un checkbox.
echo ("<table align='center'><tr><td><button type='submit' name='aceptar'>Aceptar</button></td>");
echo ("<td><button type='reset' name='limpiar'>Limpiar</button></td> </tr></table>");
echo ("</form>");
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./recepcion.html">Menú Principal</a></p>
</body>
</html>