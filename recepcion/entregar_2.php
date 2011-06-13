<html>
<head><TITLE>Entregar Cheques</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_nav.php");
conect_nav();
include("../script/cheques_sel.php");//Extrae POST y selecciona cheques
include("../script/actualiza_res.php");//Realiza la actualización

update_res($_POST);

echo ("<table id='info' border='1' align='center'><thead><tr> <th>Cuenta</th> <th>Cheque</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Responsable</th> <th>Oficio</th> </tr></thead><tbody>");
extraer_post_res($_POST);
echo ("</tbody></table>");
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./recepcion.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./entregar_0.php">Otra Selección</a></p>
</body>
</html>