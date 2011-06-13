<html>
<head><TITLE>Estatus de Comprobación</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_usr.php");
conect_usr();
include("../script/cheques_sel.php");
$usr = $_SERVER[PHP_AUTH_USER];
echo ("<h3>Cheques seleccionados para modificar Estatus</h3>");

echo ("<form action='cambio_estatus_2.php' method='post'>");
echo ("<table id='info' border='1' align='center'><thead><tr> <th>Cuenta</th> <th>Cheque</th> <th>Fecha</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Responsable</th> <th>Estatus</th> <th>Seguimiento</th> </tr></thead><tbody>");
extraer_post_estatus($_POST);
echo ("</tbody></table>");

if ($usr=='raul'){//Solo Raul o Norma pueden hacer cambio a Sin Comprobar
	echo ("<table align='center'><tr><td>Estatus</td><td>Seguimiento</td></tr><tr><td><select name='estatus'> <option>Sin Comprobar</option> <option>Facturas</option> <option>Alta Pendiente</option> <option>Comprobado</option> </select></td><td><input type='text' size='32' maxlength='30' name='seg'></td></tr></table>");
}
elseif ($usr=='martha' || $usr=='blanca' || $usr=='chelo'){//El área de comprobación puede modificar a Facturas, Alta Pendiente o Comrpobado
	echo ("<table align='center'><tr><td>Estatus</td><td>Seguimiento</td></tr><tr><td><select name='estatus'> <option>Facturas</option> <option>Alta Pendiente</option> <option>Comprobado</option> </select></td><td><input type='text' size='32' maxlength='30' name='seg'></td></tr></table>");
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