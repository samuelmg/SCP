<html>
<head><TITLE>Captura de Ingresos</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h2>Captura de Ingresos</h2>
<?php
include("../script/conect_nav.php");
include("../script/reporte_ingresos.php");
conect_nav();

echo ("<p>");
echo ("<form action='captura_ingresos_script.php' method='post'>");

//Captura de Fecha del Ingreso
$fecha=getdate();
$d=$fecha['mday'];
$m=$fecha['mon'];
$a=$fecha['year'];
echo ("<table><thead><tr><th>Día</th><th>Mes</th><th>Año</th></tr></thead><tbody><tr> <td><input type='text' size='2' maxlength='2' name='d' value='$d'/></td> <td><input type='text' size='2' maxlength='2' name='m' value='$m' /></td> <td><input type='text' value='$a' size='4' name='a' /></td> </tr></tbody></table>");

echo ("<table cellspacing='4'><thead><tr> <th>Tipo de Ingreso</th> <th>Monto</th> <th>Cuenta Bancaria</th> <th>Proyecto</th> <th>Cuenta (OG)</th> <th>ID</th> <th>Comentario</th> </tr></thead> <tbody align='center'><tr>");

//Selección de Tipo de Ingreso
echo ("<td><select name='tipo'>");
echo ("<option>Reembolso a Proyecto</option>");
echo ("<option>No Identificado</option>");
echo ("</select></td>");

//Captura Monto del Ingreso
echo ("<td><input type='text' size='9' name='monto' /></td>");

//Selección de Cuenta Bancaria
echo ("<td><select name='cta_b'>");
$sql_cta_b= "select cta_b from tbl_cta_b order by cta_b DESC"; //Obtiene la relacion de Cuentas Bancarias
$qry_cta_b = mysql_query($sql_cta_b); //Realiza la consulta
while ($arr_cta_b = mysql_fetch_array($qry_cta_b)){
	echo ("<option>".$arr_cta_b['cta_b']."</option>");
}
echo ("</select></td>");
//Captura de Proyecto
echo ("<td><input type='text' size='5' maxlength='5' name='proy' /></td>");
//Captura de Cuenta(OG)
echo ("<td><input type='text' size='4' maxlength='5' name='cta' /></td>");
//Captura de la Descripción del ID 
echo ("<td><input type='text' size='10' maxlength='10' name='id' /></td>");
//Captura de Comentarios
echo ("<td><input type='text' size='40' maxlength='40' name='cmt' /></td>");
echo ("</tr></tbody></table>");
//Tabla para botones
echo ("<table align='center'><tr><td><button type='submit' name='captura_ingresos'>Aceptar</button></td>");
echo ("<td><button type='reset' name='limpiar'>Limpiar</button></td> </tr></table>");
echo ("</form>");
echo ("</p>");

echo ("<p><h3>Reporte de Ingresos Capturados</h3>");
ingresos($seleccion);
echo ("</p>");

//Menú de Navegación
echo ("<hr /><p><a id='btn_h' target='_self' href='./presupuesto.html'>Menú Principal</a></p>");
?>
</body>
</html>