<html>
<head><TITLE>Proceso de Comprobación</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_usr.php");
conect_usr();
include("../script/sui.php");
include("../script/chxcat.php");
$cat = $_POST['cat'];
$usr = $_SERVER[PHP_AUTH_USER];//extrae el nombre de usuario
$seleccion = usr($usr);//Determina que cheques pueden ver

switch ($cat){
	case "En Transito":ch_transito($seleccion);break;
	case "Sin Clasificar":ch_nclas($seleccion);break;
	case "Sin Comprobar":$estatus="= 'Sin Comprobar'";chxest($estatus, $seleccion);break;
	case "Alta Pendiente":$estatus="= 'Alta Pendiente'"; chxest($estatus, $seleccion);break;
	//case "Comprobados en Proceso":$estatus="in ('Facturas','Comprobado')";chxest($estatus, $seleccion);break;
	case "Raul":$res="raul";ch_comp($res, $seleccion);break;
	case "Priscilla":$res="priscilla";ch_comp($res, $seleccion);break;
	case "Blanca":$res="blanca";ch_comp($res, $seleccion);break;
	case "Chelo":$res="chelo";ch_comp($res, $seleccion);break;
	case "Martha":$res="martha";ch_comp($res, $seleccion);break;
	case "Dir Finanzas":ch_dfin($seleccion);break;
	case "Cancelados":ch_cancelados();break;
}
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./comprobacion.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./ch_categoria_0.php">Otra Selección</a></p>
</body>
</html>