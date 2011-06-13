<html>
<head><TITLE>Saldo x Proyecto</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Informacion del Proyecto</h3>
<?php
include("../script/conect_nav.php");
include("../script/sel_fondo.php");
$proy=$_POST['proy']; //Obtiene el numero de proyecto seleccionado
conect_nav();
sel_fondo($proy);
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./presupuesto.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./sxp_0.php">Seleccionar Otro Proyecto</a></p>
</body>
</html>