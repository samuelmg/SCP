<html>
<head><TITLE>Saldo x Proyecto 1102</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h2>Datos del Proyecto</h2>
<?php
$proy=$_POST['proy']; //Obtiene el numero de proyecto seleccionado
include("../script/conect_nav.php");
include ("../script/sxp_ext.php");
conect_nav();
sxp_ext($proy);
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./presupuesto.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./sxp_ext_0.php">Seleccionar Otro Proyecto</a></p>
</body>
</html>