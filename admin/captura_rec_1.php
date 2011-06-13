<html>
<head><TITLE>Captura de Recursos Depositados</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>CAPTURA DE RECURSOS DEPOSITADOS</h3>
<?php
include("../script/conect_nav.php");
conect_nav();
$proy=$_POST['proy']; //Obtiene el numero de proyecto seleccionado

//Imprime cuenta-quincena-monto del proyecto seleccionado
$slq_rec = "select proy, cta, monto, t from tbl_recursos where proy='$proy'";
$qry_rec = mysql_query($slq_rec);
echo ("<table id='info' align='center' border='1'><thead><tr><th>Proyecto</th> <th>Cuenta</th> <th>Monto</th> <th>Transferencia</th></tr></thead><tbody>");
while ($arr_rec = mysql_fetch_array($qry_rec)){
	echo ("<tr><td>".$arr_rec['proy']."</td> <td>".$arr_rec['cta']."</td> <td align='right'>".number_format($arr_rec['monto'],2)."</td> <td>".$arr_rec['t']."</td> </tr>");
	$sum_monto += $arr_rec['monto'];
	}
echo ("<tr><td colspan='2'></td><td>".number_format($sum_monto,2)."</td></tr></tbody></table><br />");

//Formulario para capturar otra cuenta-quincena del proyecto seleccionado
echo ("<form action='captura_rec_2.php' method='post'>");
echo ("<input type='hidden' name='proy' value='$proy'>");
echo ("<table id='info' align='center' border='1'><thead><tr><th>Proyecto</th> <th>Cuenta</th> <th>Monto</th> <th>Transferencia</th></tr></thead>");
echo ("<tbody align='center'><tr>");
echo ("<td>".$proy."</td>");
echo ("<td><input name='cta' size='6' maxlength='4' type='text' /></td>");
echo ("<td><input name='monto' size='10' maxlength='10' type='text' /></td>");
echo ("<td><input name='t' size='7' maxlength='6' type='text' /></td>");
echo ("</tr></tbody></table>");

echo ("<table align='center'><tr><td><button type='submit'>Aceptar</button></td>");
echo ("<td><button type='reset'>Limpiar</button></td> </tr></table>");

echo ("</form>");
echo ("</p>");
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./admin.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./captura_rec_0.php">Cambiar de Proyecto</a></p>
</body>
</html>