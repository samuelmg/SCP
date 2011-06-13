<html>
<head><TITLE>Cheques Emitidos</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_usr.php");
conect_usr();
include("../script/sui.php");
include("../script/chxures.php");
$usr = $_SERVER[PHP_AUTH_USER];
$seleccion = usr($usr);
chxures($seleccion);
?>
</body>
</html>