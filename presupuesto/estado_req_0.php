<html>
<head><TITLE>Estado de Requisici�n</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_nav.php");
conect_nav();
include("../script/estado_req.php");

echo ("<form action='estado_req_1.php' method='post'>");
seleccion_req();
echo ("<table align='center'><tr><td><button type='submit' name='aceptar'>Aceptar</button></td>");
echo ("<td><button type='reset' name='limpiar'>Limpiar</button></td> </tr></table>");
echo ("</form>");
?>
<!--Men� de Navegaci�n-->
<hr /><p><a id="btn_h" target="_self" href="./presupuesto.html">Men� Principal</a></p>
</body>
</html>