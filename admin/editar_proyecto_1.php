<html>
<head><TITLE>Editar Proyecto</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Edición de Proyecto</h3>
<?php
include("../script/conect_nav.php");
conect_nav();

$ures=$_POST['ures'];
$proy=$_POST['proy'];
$d_proy=$_POST['d_proy'];
$monto=$_POST['monto'];
$fondo=$_POST['fondo'];
$quin=$_POST['quin'];
$prog=$_POST['prog'];
$eje=$_POST['eje'];

echo ("<form action='editar_proyecto_2.php' method='post'>");
echo ("<table id='info'><thead><tr> <th>URes</th> <th>Proyecto</th> <th>Nombre</th> <th>Monto</th> <th>Fondo</th> <th>Quincena</th> <th>Programa</th> <th>Eje</th> </tr></thead>");
echo ("<tbody><tr> <td><input type='text' size='6' maxlength='6' name='ures' value='$ures' /></td> <td><input type='text' size='5' maxlength='5' name='proy' value='$proy' /></td> <td><input type='text' size='50' maxlength='45' name='d_proy' value='$d_proy' /></td> <td><input type='text' size='10' maxlength='12' name='monto' value='$monto' /></td> <td><input type='text' size='6' maxlength='6' name='fondo' value='$fondo' /></td> <td><input type='text' size='2' maxlength='2' name='quin' value='$quin' /></td> <td><input type='text' size='6' maxlength='6' name='prog' value='$prog' /></td> <td><input type='text' size='1' maxlength='1' name='eje' value='$eje' /></td> </tr></tbody>");
echo ("</table>");
$o_proy=$proy;
echo ("<input type='hidden' value='$o_proy' name='o_proy' />");//Envía el proyecto original para realizar la consulta
echo ("<br /><table align='center'><tr><td><button type='submit' name='aceptar'>Aceptar</button></td></tr></table>");
echo ("</form>");
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./admin.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./editar_proyecto_0.php">Elegir Otro Proyecto</a></p>
</body>
</html>