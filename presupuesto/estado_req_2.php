<html>
<head><TITLE>Estatus de Comprobaci�n</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_nav.php");
conect_nav();
include("../script/estado_req.php");//Funciones para actualizar el estado de una requisici�n

actualiza_estado($_POST);

echo ("<table id='info' border='1' align='center'><thead><thead><tr> <th>Requisici�n</th> <th>Proyecto</th> <th>Cuenta</th> <th>Monto</th> <th>ID (Participables)</th> <th>Fecha</th> <th>Estado</th> </tr></thead></thead><tbody>");
extraer_post_req($_POST);
echo ("</tbody></table>");
?>
<!--Men� de Navegaci�n-->
<hr /><p><a id="btn_h" target="_self" href="./presupuesto.html">Men� Principal</a>
<a id="btn_h" target="_self" href="./estado_req_0.php">Otra Selecci�n</a></p>
</body>
</html>