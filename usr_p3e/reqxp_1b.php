<html>
<head><TITLE>Requisiciones Autorizadas</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Requisiciones Autorizadas</h3>
<?php
include("../script/conect_usr.php");
include("../script/reqxp.php");
$proy=$_POST['proy']; //Obtiene el numero de proyecto seleccionado
conect_usr();
reqxp_oxcta($proy);
echo ("<p><form align='center' action='reqxp_1.php' method='post'> <input type='hidden' value='$proy' name='proy' /><button type='submit' name='ordenar'>Ordenar x Fecha</button></form></p>");
echo ("P = Pagada (Existe Cheque)");
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./usr_p3e.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./lst_proy.php">Listado de Proyectos</a>
<a id="btn_h" target="_self" href="./reqxp_0.php">Seleccionar Otro Proyecto</a></p>
</body>
</html>