<html>
<head><TITLE>Estado de Requisición</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_nav.php");
conect_nav();
include("../script/estado_req.php");
echo ("<h3>Requisiciones seleccionadas para modificar Estatus</h3>");

echo ("<form action='estado_req_2.php' method='post'>");
echo ("<table id='info' border='1' align='center'><thead><tr> <th>Requisición</th> <th>Proyecto</th> <th>Cuenta</th> <th>Monto</th> <th>ID (Participables)</th> <th>Fecha</th> <th>Estado</th> </tr></thead><tbody>");
extraer_post_req($_POST);
echo ("</tbody></table>");

echo ("<table align='center'><tr><td>Estado</td> <td><select name='estado'> <option>P</option> <option>C</option> <option>NA</option> <option></option> </select></td></tr></table>");

echo ("<table align='center'><tr><td><button type='submit'>Aceptar</button></td>");//Aceptar
echo ("<td><button type='reset'>Limpiar</button></td> </tr></table>");//Limpiar
echo ("</form>");
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./presupuesto.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./estado_req_0.php">Cambiar Selección</a></p>
</body>