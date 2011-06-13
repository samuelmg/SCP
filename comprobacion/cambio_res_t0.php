<html>
<head><TITLE>Cambio de Responsable de Transferencias</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Cambio de Responsable de Transferencias</h3>
<?php
include("../script/conect_usr.php");
conect_usr();
include("../script/sui.php");
include("../script/egresos_x_ures.php");
include("../script/res_comp.php");
$usr = $_SERVER[PHP_AUTH_USER];
$seleccion = usr($usr);

switch ($usr){
	case raul: $filtro='and e.responsable = "Raul" and e.estatus in ("Facturas","Comprobado")';break;
	case samuel: $filtro='and e.responsable = ""';break;
	case norma: $filtro='and e.responsable = ""';break;
	case priscilla: $filtro='and e.responsable = "Priscilla"';break;
	case blanca: $filtro='and e.responsable = "Blanca"';break;
	case chelo: $filtro='and e.responsable = "Chelo"';break;
	case martha: $filtro='and e.responsable = "Martha"';break;
}

echo ("<form action='cambio_res_t1.php' method='post'>");
egresos_sel($seleccion,$filtro);
echo ("<table align='center'><tr><td><button type='submit'>Aceptar</button></td>");
echo ("<td><button type='reset'>Limpiar</button></td> </tr></table>");
echo ("</form>");
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./comprobacion.html">Menú Principal</a></p>
</body>
</html>