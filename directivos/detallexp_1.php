<html>
<head><TITLE>Saldo x Proyecto</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Informacion del Proyecto</h3>
<?php
include("../script/conect_usr.php");
include("../script/sel_fondo.php");
include("../script/chxp.php");
$proy=$_POST['proy']; //Obtiene el numero de proyecto seleccionado
conect_usr();
sel_fondo($proy);

chxp_detalle($proy);
?>
<!--Men� de Navegaci�n-->
<hr /><p><a id="btn_h" target="_self" href="./usr_p3e.html">Men� Principal</a>
<a id="btn_h" target="_self" href="./lst_proy.php">Listado de Proyectos</a>
<a id="btn_h" target="_self" href="./sxp_0.php">Seleccionar Otro Proyecto</a></p>
</body>
</html>