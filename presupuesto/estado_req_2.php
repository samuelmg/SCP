<html>
<head><TITLE>Estatus de Comprobación</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_nav.php");
conect_nav();
include("../script/estado_req.php");//Funciones para actualizar el estado de una requisición

actualiza_estado($_POST);

echo ("<table id='info' border='1' align='center'><thead><thead><tr> <th>Requisición</th> <th>Proyecto</th> <th>Cuenta</th> <th>Monto</th> <th>ID (Participables)</th> <th>Fecha</th> <th>Estado</th> </tr></thead></thead><tbody>");
extraer_post_req($_POST);
echo ("</tbody></table>");
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./presupuesto.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./estado_req_0.php">Otra Selección</a></p>
</body>
</html>