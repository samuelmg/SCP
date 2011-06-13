<html>
<head><TITLE>Estatus de Requisición</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_usr.php");
conect_usr();
include("../script/req_sel.php");
$usr = $_SERVER[PHP_AUTH_USER];
echo ("<h3>Requisiciones seleccionadas para modificar Estatus</h3>");

echo ("<form action='estatus_req_2.php' method='post'>");
echo ("<table id='info' border='1' align='center'><thead><tr> <th>Requisición</th> <th>Proyecto</th> <th>Cuenta</th> <th>Monto</th> <th>Invoice</th> <th>Fecha</th> <th>Estado</th> </tr></thead><tbody>");
extraer_post_estatus($_POST);
echo ("</tbody></table>");

if ($usr=='norma'){
	echo ("<table align='center'><tr><td>Estatus</td><td>Seguimiento</td></tr><tr><td><select name='estatus'> <option>Sin Comprobar</option> <option>Facturas</option> <option>Alta Pendiente</option> <option>Comprobado</option> </select></td><td><input type='text' size='32' maxlength='30' name='seg'></td></tr></table>");
	}
	else{echo ("<h3>NO TIENE DERECHOS PARA MODIFICAR ESTE CAMPO</h3>");}

echo ("<table align='center'><tr><td><button type='submit' name='aceptar'>Aceptar</button></td>");//Aceptar
echo ("<td><button type='reset' name='limpiar'>Limpiar</button></td> </tr></table>");//Limpiar
echo ("</form>");

?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./comprobacion.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./cambio_estatus_0.php">Cambiar Selección</a></p>
</body>