<html>
<head><TITLE>Cheques Emitidos</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Cheques Emitidos</h3>
<?php
include("../script/conect_usr.php");
include("../script/chxp.php");
$proy=$_POST['proy']; //Obtiene el numero de proyecto seleccionado
conect_usr();
chxp_oxcta($proy);
echo ("<p><form align='center' action='chxp_1.php' method='post'> <input type='hidden' value='$proy' name='proy' /><button type='submit' name='ordenar'>Ordenar x Cheque</button></form></p>");
?>
<div id="nota">
	<ul><b>Nomenclatura de Estatus:</b>
	<li>Facturas o Comprobado -> Indica que se realiz� la comprobaci�n a la Coordinaci�n de Finanzas</li>
	<li>Sin Comprobar -> No se ha realizado la comprobaci�n de este Cheque</li>
	<li>Alta Pendiente -> No se tiene copia de el D�bito/Resgurado, sin esto no se puede hacer la comprobaci�n</li>
	<li>Campos Vacios -> En proceso de entrega o clasificaci�n por parte de la Coordinaci�n</li>
	</ul>
</div>
<!--Men� de Navegaci�n-->
<hr /><p><a id="btn_h" target="_self" href="./usr_p3e.html">Men� Principal</a>
<a id="btn_h" target="_self" href="./lst_proy.php">Listado de Proyectos</a>
<a id="btn_h" target="_self" href="./chxp_0.php">Seleccionar Otro Proyecto</a></p>
</body>
</html>