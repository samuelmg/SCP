<html>
<head><TITLE>Captura Estatus</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_usr.php");
conect_usr();
include("../script/cheques_sel.php");
$usr = $_SERVER[PHP_AUTH_USER];
echo ("<h3>Cheques seleccionados para Captura Oficio de Comprobaci�n</h3>");

echo ("<form action='captura_oficio_2.php' method='post'>");
echo ("<table id='info' border='1' align='center'><thead><tr> <th>Cuenta</th> <th>Cheque</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Responsable</th> <th>Oficio Comprobaci�n</th> </tr></thead><tbody>");
extraer_post_res($_POST);
echo ("</tbody></table>");
echo ("<table align='center'><tr><td><input type='text' size='22' maxlength='20' name='oficio'></td></tr></table>");
echo ("<table align='center'><tr><td><button type='submit' name='aceptar'>Aceptar</button></td>");//Aceptar
echo ("<td><button type='reset' name='limpiar'>Limpiar</button></td> </tr></table>");//Limpiar
echo ("</form>");

?>
<!--Men� de Navegaci�n-->
<hr /><p><a id="btn_h" target="_self" href="./comprobacion.html">Men� Principal</a>
<a id="btn_h" target="_self" href="./captura_oficio_0.php">Cambiar Selecci�n</a></p>
</body>	