<html>
<head><TITLE>Listado de Proyectos</TITLE>
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
$sql_proy = "select ures, proy, d_proy, monto, fondo from tbl_proyectos where ures $seleccion order by ures, fondo, proy";
$qry_proy = mysql_query($sql_proy);

echo ("<table border='1'><thead><tr> <th>URes</th> <th>Proyecto</th> <th>Nombre</th> <th>Monto</th> <th>Fondo</th> </tr></thead> <tbody>");
while ($row_proy=mysql_fetch_array($qry_proy)){
	$proy = $row_proy['proy'];
	echo ("<tr> <td>".$row_proy['ures']."</td> <td>".$row_proy['proy']."</td> <td>".utf8_decode($row_proy['d_proy'])."</td> <td align='right'>".number_format($row_proy['monto'],2)."</td> <td>".$row_proy['fondo']."</td>");
	echo ("<td><form align='center' action='chxp_1.php' method='post'><input type='hidden' value='$proy' name='proy' /><button type='submit' name='cheques'>Cheques</button></form></td>");
	echo ("<td><form align='center' action='reqxp_1.php' method='post'><input type='hidden' value='$proy' name='proy' /><button type='submit' name='requisiciones'>Requisiciones</button></form></td>");
	echo ("<td><form align='center' action='sxp_1.php' method='post'><input type='hidden' value='$proy' name='proy' /><button type='submit' name='saldo'>Saldo</button></form></td></tr>");
	}
echo ("</tbody></table>");
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./usr_p3e.html">Menú Principal</a></p>
</body>
</html>