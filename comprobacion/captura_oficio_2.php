<html>
<head><TITLE>Captura Estatus</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_nav.php");
conect_nav();
include("../script/cheques_sel.php");//Extrae POST y selecciona cheques
include("../script/captura_oficio.php");//Realiza la actualizaci�n

captura_oficio($_POST);

echo ("<table border='1' align='center'><thead><tr> <th>Cuenta</th> <th>Cheque</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Responsable</th> <th>Oficio Comprobaci�n</th> </tr></thead><tbody>");
extraer_post_res($_POST);
echo ("</tbody></table>");
?>
<!--Men� de Navegaci�n-->
<hr /><p><a id="btn_h" target="_self" href="./comprobacion.html">Men� Principal</a>
<a id="btn_h" target="_self" href="./captura_oficio_0.php">Otra Selecci�n</a></p>
</body>
</html>