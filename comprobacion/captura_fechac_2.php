<html>
<head><TITLE>Captura Fecha de Comprobación</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_nav.php");
conect_nav();
include("../script/cheques_sel.php");//Extrae POST y selecciona cheques
include("../script/captura_fechac.php");//Realiza la actualización

captura_fechac($_POST);

echo ("<table border='1' align='center'><thead><tr> <th>Cuenta</th> <th>Cheque</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Responsable</th> <th>Oficio Comprobación</th> <th>Fecha Comprobación</th> </tr></thead><tbody>");
extraer_post_fecha($_POST);
echo ("</tbody></table>");
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./comprobacion.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./captura_fechac_0.php">Otra Selección</a></p>
</body>
</html>