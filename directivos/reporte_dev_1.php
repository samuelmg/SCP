<html>
<head><TITLE>Devoluci�n de Recursos Ordinarios</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
	<?php
	include("../script/conect_usr.php");
	include("../script/reporte_dev.php");
	conect_usr();
	$lim_quin = $_POST['lim_quin'];
	dev_ord($lim_quin);
	?>
<!--Men� de Navegaci�n-->
<hr /><p><a id="btn_h" target="_self" href="./directivos.html">Men� Principal</a></p>
</body>
</html>