<html>
<head><TITLE>Cheques x Proyecto</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Cheques x Proyecto</h3>
<?php
include("../script/conect_usr.php");
include("../script/chxp.php");
$proy=$_POST['proy']; //Obtiene el numero de proyecto seleccionado
conect_usr();
chxp($proy);
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./comprobacion.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./chxp_0.php">Seleccionar Otro Proyecto</a></p>
</body>
</html>