<html>
<head><TITLE>Proceso de Comprobación</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_usr.php");
conect_usr();
include("../script/sui.php");
include("../script/t_x_categoria.php");
$cat = $_POST['cat'];
$usr = $_SERVER[PHP_AUTH_USER];//extrae el nombre de usuario
$seleccion = usr($usr);//Determina que cheques pueden ver

switch ($cat){
	case "En Transito":t_transito($seleccion);break;
	case "Sin Clasificar":t_nclas($seleccion);break;
	case "Sin Comprobar":$estatus="= 'Sin Comprobar'";t_x_est($estatus, $seleccion);break;
	case "Alta Pendiente":$estatus="= 'Alta Pendiente'";t_x_est($estatus, $seleccion);break;
	//case "Comprobados en Proceso":$estatus="in ('Facturas','Comprobado')";chxest($estatus, $seleccion);break;
	case "Raul":$res="raul";t_comp($res, $seleccion);break;
	case "Priscilla":$res="priscilla";t_comp($res, $seleccion);break;
	case "Blanca":$res="blanca";t_comp($res, $seleccion);break;
	case "Chelo":$res="chelo";t_comp($res, $seleccion);break;
	case "Martha":$res="martha";t_comp($res, $seleccion);break;
	case "Dir Finanzas":t_dfin($seleccion);break;
}
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./comprobacion.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./t_categoria_0.php">Otra Selección</a></p>
</body>
</html>