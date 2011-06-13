<html>
<head><TITLE>Reporte de Proyecto</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>

<?php
include("../script/conect_usr.php");
include("../script/reporte_proy.php");
$proy=$_POST['proy']; //Obtiene el numero de proyecto seleccionado
conect_usr();
reporte ($proy);
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./usr_p3e.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./reporte_proy_0.php">Seleccionar Otro Proyecto</a></p>
</body>
</html>