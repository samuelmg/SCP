<html>
<head><TITLE>Ingresos</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Reembolsos</h3>
<?php
include("../script/conect_usr.php");
conect_usr();
include("../script/sui.php");
include("../script/reporte_ingresos.php");
$usr = $_SERVER[PHP_AUTH_USER];
$seleccion = usr($usr);
ingresos($seleccion);
?>
<!--Men� de Navegaci�n-->
<p><a id="btn_h" target="_self" href="./comprobacion.html">Men� Principal</a><hr /></p>
</body>
</html>