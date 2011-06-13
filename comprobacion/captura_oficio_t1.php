<html>
<head><TITLE>Captura Estatus</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_usr.php");
conect_usr();
include("../script/extractor_post-sel_t.php");
$usr = $_SERVER[PHP_AUTH_USER];
echo ("<h3>Transferencias seleccionados para Captura Oficio de Comprobación</h3>");

echo ("<form action='captura_oficio_t2.php' method='post'>");
echo ("<table id='info' border='1' align='center'><thead><tr> <th>Fecha</th> <th>Cuenta</th> <th>No. Transferencia</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Estatus</th> <th>Seguimiento</th> <th>Oficio</th> <th>Responsable</th> </tr></thead><tbody>");
extraer_post_t($_POST);
echo ("</tbody></table>");
echo ("<table align='center'><tr><td><input type='text' size='22' maxlength='20' name='oficio'></td></tr></table>");
echo ("<table align='center'><tr><td><button type='submit'>Aceptar</button></td>");//Aceptar
echo ("<td><button type='reset'>Limpiar</button></td> </tr></table>");//Limpiar
echo ("</form>");

?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./comprobacion.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./captura_oficio_t0.php">Cambiar Selección</a></p>
</body>	