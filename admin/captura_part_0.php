<html>
<head><TITLE>Captura Participables</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Captura FIP's</h3>
<?php
include("../script/conect_nav.php");
include("../script/sel_fondo.php");
conect_nav();

echo ("<hr /><p>");
echo ("<form action='captura_part_1.php' method='post'>");

echo ("<table cellspacing='5'><thead><tr> <th>Id</th> <th>Beneficiario</th> <th>Proyecto</th> <th>Monto</th> <th>t</th> <th>Observaciones</th> </tr></thead> <tbody align='center'><tr>");

//Captura ID
echo ("<td>");
echo ("<input type='text' size='11' maxlength='10' name='id' />");
echo ("</td>");

//Seleccion de Beneficiario
echo ("<td><select name='benef_id'>");
$sql_benef= "select benef_id, benef from tbl_benef order by benef"; //Obtiene la relacion de Beneficiarios
$qry_benef = mysql_query($sql_benef); //Realiza la consulta
while ($arr_benef = mysql_fetch_array($qry_benef)){
	echo ("<option>".$arr_benef['benef_id']." - ".utf8_decode($arr_benef['benef'])."</option>");
}
echo ("</select></td>");

//Seleccion de Proyecto
echo ("<td><select name='proy'>");
$sql_proy= "select proy from tbl_proyectos where fondo in (select fondo from tbl_fondos where tipo = 'PAR')"; //Relacion Proyectos Participables
$qry_proy = mysql_query($sql_proy); //Realiza la consulta
while ($arr_proy = mysql_fetch_array($qry_proy)){
	echo ("<option>".$arr_proy['proy']."</option>");
}
echo ("</select></td>");

//Captura del Monto
echo ("<td>");
echo ("<input type='text' size='11' maxlength='11' name='monto' />");
echo ("</td>");

//Captura de Transferencia
echo ("<td>");
echo ("<input type='text' size='8' maxlength='7' name='t' />");
echo ("</td>");

//Captura de Observaciones
echo ("<td>");
echo ("<input type='text' size='15' maxlength='20' name='obs' />");
echo ("</td>");
echo ("</tr></tbody></table>");

echo ("<table align='center'><tr><td><button type='submit' name='aceptar'>Aceptar</button></td>");
echo ("<td><button type='reset' name='limpiar'>Limpiar</button></td> </tr></table>");

echo ("</form>");
echo ("</p>");
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./admin.html">Menú Principal</a>
<a id="btn_h" target="_self" href="../presupuesto/captura_benef.html">Capturar Beneficiario</a></p>
</body>
</html>