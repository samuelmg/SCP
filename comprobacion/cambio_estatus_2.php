<html>
<head><TITLE>Estatus de Comprobaci�n</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_nav.php");
conect_nav();
include("../script/cheques_sel.php");//Extrae POST y selecciona cheques
include("../script/estatus_comp.php");//Realiza la actualizaci�n

captura_estatus($_POST);

echo ("<table id='info' border='1' align='center'><thead><tr> <th>Cuenta</th> <th>Cheque</th> <th>Fecha</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Responsable</th> <th>Estatus</th> <th>Seguimiento</th> </tr></thead><tbody>");
extraer_post_estatus($_POST);
echo ("</tbody></table>");
?>
<!--Men� de Navegaci�n-->
<hr /><p><a id="btn_h" target="_self" href="./comprobacion.html">Men� Principal</a>
<a id="btn_h" target="_self" href="./cambio_estatus_0.php">Otra Selecci�n</a></p>
</body>
</html>