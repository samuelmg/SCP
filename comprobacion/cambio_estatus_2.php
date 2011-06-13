<html>
<head><TITLE>Estatus de Comprobación</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_nav.php");
conect_nav();
include("../script/cheques_sel.php");//Extrae POST y selecciona cheques
include("../script/estatus_comp.php");//Realiza la actualización

captura_estatus($_POST);

echo ("<table id='info' border='1' align='center'><thead><tr> <th>Cuenta</th> <th>Cheque</th> <th>Fecha</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Responsable</th> <th>Estatus</th> <th>Seguimiento</th> </tr></thead><tbody>");
extraer_post_estatus($_POST);
echo ("</tbody></table>");
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./comprobacion.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./cambio_estatus_0.php">Otra Selección</a></p>
</body>
</html>