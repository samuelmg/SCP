<html>
<head><TITLE>Entregar Pólizas</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_usr.php");
conect_usr();
include("../script/cheques_sel.php");
$usr = $_SERVER[PHP_AUTH_USER];
echo ("<h3>Cheques seleccionados para cambio de responsable</h3>");

echo ("<form action='entregar_2.php' method='post'>");
echo ("<table id='info' border='1' align='center'><thead><tr> <th>Cuenta</th> <th>Cheque</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Responsable</th> <th>Oficio</th> </tr></thead><tbody>");
extraer_post_res($_POST);
echo ("</tbody></table>");
echo ("<table align='center'><tr><td><input type='radio' name='res' value='Raul'>Raul</td></tr></table>");
echo ("<table align='center'><tr><td><button type='submit' name='aceptar'>Aceptar</button></td>");//Aceptar
echo ("<td><button type='reset' name='limpiar'>Limpiar</button></td> </tr></table>");//Limpiar
echo ("</form>");

?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./recepcion.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./entregar_0.php">Cambiar Selección</a></p>
</body>
</html>