<html>
<head><TITLE>Listado General de Proyectos</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_usr.php");
conect_usr();
//Obtiene URes del Usuario
include("../script/sui.php");//Smart User ID **
$usr = $_SERVER[PHP_AUTH_USER];//Obtiene UID **
$seleccion =  usr($usr);//Envía UID a funcion usr para que regrese SELECCION **

echo ("<h3>Listado de Proyectos</h3>");
$sql_proy = "select ures, proy, d_proy, fondo from tbl_proyectos where ures $seleccion order by ures, fondo, proy";
$qry_proy = mysql_query($sql_proy);

echo ("<table align='center' border='1' id='info'><thead><tr> <th>URes</th> <th>Proyecto</th> <th>Nombre</th> <th>Fondo</th> </tr></thead> <tbody>");
while ($row_proy=mysql_fetch_array($qry_proy)){
	$proy = $row_proy['proy'];
	echo ("<tr id='par'> <td>".$row_proy['ures']."</td> <td>".$row_proy['proy']."</td> <td id='benef'>".utf8_decode($row_proy['d_proy'])."</td> <td>".$row_proy['fondo']."</td></tr>");
	}
echo ("</tbody></table>");
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./usr_p3e.html">Menú Principal</a></p>
</body>
</html>