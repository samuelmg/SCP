<html>
<head><TITLE>Captura Estatus</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_nav.php");
conect_nav();
include("../script/extractor_post-sel_t.php");//Extrae POST y selecciona cheques
include("../script/captura_oficio.php");//Realiza la actualización

captura_oficio_t($_POST);

echo ("<table border='1' align='center'><thead><tr> <th>Fecha</th> <th>Cuenta</th> <th>No. Transferencia</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Estatus</th> <th>Seguimiento</th> <th>Oficio</th> <th>Responsable</th> </tr></thead><tbody>");
extraer_post_t($_POST);
echo ("</tbody></table>");
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./comprobacion.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./captura_oficio_t0.php">Otra Selección</a></p>
</body>
</html>