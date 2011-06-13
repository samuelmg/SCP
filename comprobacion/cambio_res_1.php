<html>
<head><TITLE>Cambio de Responsable</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_usr.php");
conect_usr();
include("../script/cheques_sel.php");
$usr = $_SERVER[PHP_AUTH_USER];
echo ("<h3>Cheques seleccionados para cambio de responsable</h3>");

echo ("<form action='cambio_res_2.php' method='post'>");
echo ("<table id='info' border='1' align='center'><thead><tr> <th>Cuenta</th> <th>Cheque</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Responsable</th> <th>Oficio</th> </tr></thead><tbody>");
extraer_post_res($_POST);
echo ("</tbody></table>");
opciones ($usr);//Determina las opciones a mostrar según el usuario
echo ("<table align='center'><tr><td><button type='submit' name='aceptar'>Aceptar</button></td>");//Aceptar
echo ("<td><button type='reset' name='limpiar'>Limpiar</button></td> </tr></table>");//Limpiar
echo ("</form>");

function opciones($usr){
switch ($usr){
	case raul:echo ("<table align='center'><tr> <td><input type='radio' name='res' value='Priscilla'>Priscilla</td> <td><input type='radio' name='res' value='Blanca'>Blanca</td> <td><input type='radio' name='res' value='Chelo'>Chelo</td> <td><input type='radio' name='res' value='Martha'>Martha</td></tr></table>");break;
	case priscilla:echo ("<table align='center'><tr><td><input type='radio' name='res' value='Blanca'>Blanca</td> <td><input type='radio' name='res' value='Chelo'>Chelo</td> <td><input type='radio' name='res' value='Martha'>Martha</td> <td><input type='radio' name='res' value='Raul'>Raul</td> </tr></table>");break;
	case chelo:echo ("<h4>Regresar a Raul<input type='radio' name='res' value='Raul'></h4>");break;
	case martha:echo ("<h4>Regresar a Raul<input type='radio' name='res' value='Raul'></h4>");break;
	case blanca:echo ("<h4>Regresar a Raul<input type='radio' name='res' value='Raul'></h4>");break;
	default:echo ("<h3>NO TIENE DERECHOS PARA MODIFICAR ESTOS CHEQUES</h3>");break;
	}
}

?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./comprobacion.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./cambio_res_0.php">Cambiar Selección</a></p>
</body>
</html>