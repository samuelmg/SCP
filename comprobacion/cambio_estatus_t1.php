<html>
<head><TITLE>Cambio de Estatus de Transferencias</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_usr.php");
conect_usr();
include("../script/extractor_post-sel_t.php");
$usr = $_SERVER[PHP_AUTH_USER];
echo ("<h3>Cheques seleccionados para modificar Estatus</h3>");

echo ("<form action='cambio_estatus_t2.php' method='post'>");
echo ("<table id='info' border='1' align='center'><thead><tr> <th>Fecha</th> <th>Cuenta</th> <th>No. Transferencia</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Responsable</th> <th>Estatus</th> <th>Seguimiento</th> </tr></thead><tbody>");
extraer_post_t($_POST);
echo ("</tbody></table>");

if ($usr=='raul'){
	echo ("<table align='center'><tr><td>Estatus</td><td>Seguimiento</td></tr><tr> <td><select name='estatus'> <option>Sin Comprobar</option> <option>Facturas</option> <option>Alta Pendiente</option> <option>Comprobado</option> </select></td> <td><input type='text' size='32' maxlength='30' name='seg'></td> </tr></table>");
}
elseif($usr=='martha' || $usr=='blanca' || $usr=='chelo'){
	echo ("<table align='center'><tr><td>Estatus</td><td>Seguimiento</td></tr><tr> <td><select name='estatus'> <option>Facturas</option> <option>Alta Pendiente</option> <option>Comprobado</option> </select></td> <td><input type='text' size='32' maxlength='30' name='seg'></td> </tr></table>");
}
else{echo ("<h3>NO TIENE DERECHOS PARA MODIFICAR ESTE CAMPO</h3>");}

echo ("<table align='center'><tr><td><button type='submit'>Aceptar</button></td>");//Aceptar
echo ("<td><button type='reset'>Limpiar</button></td> </tr></table>");//Limpiar
echo ("</form>");
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./comprobacion.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./cambio_estatus_t0.php">Cambiar Selección</a></p>
</body>	