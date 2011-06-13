<html>
<head><TITLE>Captura de Quincenas</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Captura Cuenta-Quincena-Monto</h3>
<?php
include("../script/conect_nav.php");
conect_nav();
$proy=$_POST['proy']; //Obtiene el numero de proyecto seleccionado

//Imprime cuenta-quincena-monto del proyecto seleccionado
$slq_quin = "select proy, cta, quin, monto from tbl_quincenas where proy='$proy'";
$qry_quin = mysql_query($slq_quin);
echo ("<table id='info' align='center' border='1'><thead><tr><th>Proyecto</th> <th>Cuenta</th> <th>Quincena</th> <th>Monto</th></tr></thead><tbody>");
while ($arr_quin = mysql_fetch_array($qry_quin)){
	echo ("<tr><td>".$arr_quin['proy']."</td> <td>".$arr_quin['cta']."</td> <td>".$arr_quin['quin']."</td> <td align='right'>".number_format($arr_quin['monto'],2)."</td></tr>");
	$sum_monto += $arr_quin['monto'];
	}
echo ("<tr><td></td><td></td><td></td><td>".number_format($sum_monto,2)."</td></tr></tbody></table><br />");

//Formulario para capturar otra cuenta-quincena del proyecto seleccionado
echo ("<form action='captura_quin_2.php' method='post'>");
echo ("<input type='hidden' name='proy' value='$proy'>");
echo ("<table id='info' align='center' border='1'><thead><tr><th>Proyecto</th> <th>Cuenta</th> <th>Quincena</th> <th>Monto</th></tr></thead>");
echo ("<tbody align='center'><tr>");
echo ("<td>".$proy."</td>");
echo ("<td><input name='cta' size='6' maxlength='5' type='text' /></td>");
echo ("<td><input name='quin' size='8' maxlength='2' type='text' value='1'/></td>");
echo ("<td><input name='monto' size='10' maxlength='10' type='text' /></td>");
echo ("</tr></tbody></table>");



echo ("<table align='center'><tr><td><button type='submit'>Aceptar</button></td>");
echo ("<td><button type='reset'>Limpiar</button></td> </tr></table>");

echo ("</form>");
echo ("</p>");

?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./admin.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./captura_quin_0.php">Cambiar de Proyecto</a></p>
</body>
</html>