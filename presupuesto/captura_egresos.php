<html>
<head><TITLE>Captura de Egresos</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h2>Captura de Egresos</h2>
<?php
include("../script/conect_nav.php");
conect_nav();

echo ("<p>");
echo ("<form action='captura_egresos_script.php' method='post'>");

//Captura de Fecha del Egreso
$fecha=getdate();
$d=$fecha['mday'];
$m=$fecha['mon'];
$a=$fecha['year'];
echo ("<table><thead><tr><th>Día</th><th>Mes</th><th>Año</th></tr></thead><tbody><tr> <td><input type='text' size='2' maxlength='2' name='d' value='$d'/></td> <td><input type='text' size='2' maxlength='2' name='m' value='$m' /></td> <td><input type='text' value='$a' size='4' name='a' /></td> </tr></tbody></table>");

//Selección de Tipo de Egreso
echo ("<select name='tipo'>");
echo ("<option>Cargo a Proyecto</option>");
echo ("<option>Devolucion</option>");
echo ("</select>");

echo ("<table><thead><tr> <th>Cuenta Bancaria</th> <th>No. Transferencia</th> <th>Beneficiario</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta (OG)</th> </tr></thead> <tbody align='center'><tr>");

//Selección de Cuenta Bancaria
echo ("<td><select name='cta_b'>");
$sql_cta_b= "select cta_b from tbl_cta_b order by cta_b DESC"; //Obtiene la relacion de Cuentas Bancarias
$qry_cta_b = mysql_query($sql_cta_b); //Realiza la consulta
while ($arr_cta_b = mysql_fetch_array($qry_cta_b)){
	echo ("<option>".$arr_cta_b['cta_b']."</option>");
}
echo ("</select></td>");
//Captura No. de Transferencia
echo ("<td><input type='text' size='10' maxlength='12' name='no_t' /></td>");
//Seleccion de Beneficiario
echo ("<td><select name='benef_id'>");
$sql_benef= "select benef_id, benef from tbl_benef order by benef"; //Obtiene la relacion de Beneficiarios
$qry_benef = mysql_query($sql_benef); //Realiza la consulta
while ($arr_benef = mysql_fetch_array($qry_benef)){
	echo ("<option>".$arr_benef['benef_id']." - ".utf8_decode($arr_benef['benef'])."</option>");
}
echo ("</select></td>");
//Captura Monto del Ingreso
echo ("<td><input type='text' size='9' name='monto' /></td>");
//Captura de Proyecto
echo ("<td><input type='text' size='5' maxlength='5' name='proy' /></td>");
//Captura de Cuenta(OG)
echo ("<td><input type='text' size='4' maxlength='5' name='cta' /></td>");
echo ("</tr></tbody></table>");

echo ("<table><thead><tr><th>Comentario</th><th>ID</th> </thead> <tbody align='center'><tr>");
//Captura de Comentarios
echo ("<td><input type='text' size='40' maxlength='40' name='cmt' /></td>");
//Captura de la Descripción del ID 
echo ("<td><input type='text' size='10' maxlength='10' name='id' /></td>");
echo ("</tr></tbody></table>");

//Tabla para botones
echo ("<table align='center'><tr><td><button type='submit' name='captura_egresos'>Aceptar</button></td>");
echo ("<td><button type='reset' name='limpiar'>Limpiar</button></td> </tr></table>");
echo ("</form>");
echo ("</p>");
//Menú de Navegación
echo ("<hr /><p><a id='btn_h' target='_self' href='./presupuesto.html'>Menú Principal</a></p>");
?>
</body>
</html>