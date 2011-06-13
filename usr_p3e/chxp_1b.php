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
	<li>Facturas o Comprobado -> Indica que se realizó la comprobación a la Coordinación de Finanzas</li>
	<li>Sin Comprobar -> No se ha realizado la comprobación de este Cheque</li>
	<li>Alta Pendiente -> No se tiene copia de el Débito/Resgurado, sin esto no se puede hacer la comprobación</li>
	<li>Campos Vacios -> En proceso de entrega o clasificación por parte de la Coordinación</li>
	</ul>
</div>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./usr_p3e.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./lst_proy.php">Listado de Proyectos</a>
<a id="btn_h" target="_self" href="./chxp_0.php">Seleccionar Otro Proyecto</a></p>
</body>
</html>