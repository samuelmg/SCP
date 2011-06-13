<html>
<head><TITLE>Saldo Proyecto Participable</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Saldo por Invoice</h3>
<?php
include("../script/conect_nav.php");
conect_nav();
include ("../script/sxp_par.php");
$proy=$_POST['proy'];
sxp_par($proy);

?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./presupuesto.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./sxp_par_0.php">Seleccionar Otro Proyecto</a></p>
</body>
</html>