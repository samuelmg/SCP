<html>
<head><TITLE>Egresos x Transferencia</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h4>Egresos x Transferencia</h4>
<?php
include("../script/conect_usr.php");
conect_usr();
include("../script/sui.php");
include("../script/egresos_x_ures.php");
$usr = $_SERVER[PHP_AUTH_USER];
$seleccion = usr($usr);
egresos($seleccion);
?>
<!--Menú de Navegación-->
<p><a id="btn_h" target="_self" href="./comprobacion.html">Menú Principal</a><hr /></p>
</body>
</html>