<html>
<head><TITLE>Cambio de Estatus de Transferencias</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Selección de Transferencias (Cambio de Responsable)</h3>
<?php
include("../script/conect_usr.php");
conect_usr();
include("../script/extractor_post-sel_t.php");
$usr = $_SERVER[PHP_AUTH_USER];

echo ("<form action='cambio_res_t2.php' method='post'>");
echo ("<table id='info' border='1' align='center'><thead><tr> <th>Fecha</th> <th>Cuenta</th> <th>No. Transferencia</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Responsable</th> <th>Estatus</th> <th>Seguimiento</th> </tr></thead><tbody>");
extraer_post_t($_POST);
echo ("</tbody></table>");

opciones ($usr);//Determina las opciones a mostrar según el usuario

echo ("<table align='center'><tr><td><button type='submit'>Aceptar</button></td>");//Aceptar
echo ("<td><button type='reset'>Limpiar</button></td> </tr></table>");//Limpiar
echo ("</form>");

function opciones($usr){
switch ($usr){
	case raul:echo ("<table align='center'><tr> <td><input type='radio' name='res' value='Raul'>Raul</td> <td><input type='radio' name='res' value='Priscilla'>Priscillas</td> <td><input type='radio' name='res' value='Blanca'>Blanca</td> <td><input type='radio' name='res' value='Chelo'>Chelo</td> <td><input type='radio' name='res' value='Martha'>Martha</td></tr></table>");break;
	case norma:echo ("<h4>Entregar a Raul<input type='radio' name='res' value='Raul'></h4>");break;
	case samuel:echo ("<h4>Entregar a Raul<input type='radio' name='res' value='Raul'></h4>");break;
	case priscilla:echo ("<table align='center'><tr><td><input type='radio' name='res' value='Blanca'>Blanca</td> <td><input type='radio' name='res' value='Chelo'>Chelo</td> <td><input type='radio' name='res' value='Martha'>Martha</td> <td><input type='radio' name='res' value='Raul'>Raul</td> </tr></table>");break;
	case chelo:echo ("<h4>Regresar a Raul<input type='radio' name='res' value='Raul'></h4>");break;
	case martha:echo ("<h4>Regresar a Raul<input type='radio' name='res' value='Raul'></h4>");break;
	case blanca:echo ("<h4>Regresar a Raul<input type='radio' name='res' value='Raul'></h4>");break;
	default:echo ("<h3>NO TIENE DERECHOS PARA MODIFICAR EL RESPONSABLE</h3>");break;
	}
}
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./comprobacion.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./cambio_res_t0.php">Cambiar Selección</a></p>
</body>	