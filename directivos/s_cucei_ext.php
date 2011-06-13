<html>
<head><TITLE>Saldos CUCEI 1102</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
	<?php
	include("../script/conect_usr.php");
	include("../script/sui.php");//Smart User ID **
	include("../script/s_cucei.php");
	conect_usr();
	$usr = $_SERVER[PHP_AUTH_USER];//Obtiene UID **
	$seleccion = usr($usr);//Envía UID a funcion usr para que regrese SELECCION **
	s_cucei_ext($seleccion);
	?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./directivos.html">Menú Principal</a></p>
</body>
</html>