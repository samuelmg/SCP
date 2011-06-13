<html>
<head><TITLE>Impresión de Cheques (4448)</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Selección de Cheque (4448)</h3>
<form action="impresion_ch_4448_1.php" method="post">
<table width="60%">
<?php
	include("../script/conect_nav.php");
	conect_nav();
	echo("<tr><td>Cheques de la Cuenta 4448:</td><td>");
	echo ("<select name='cheque'>");
	$sql_cheque = "select cheque from tbl_cheques_4448 order by cheque DESC"; //Obtiene la relacion de los cheques
	$qry_cheque = mysql_query($sql_cheque);
	while ($row_cheque = mysql_fetch_array($qry_cheque)){
		echo ("<option>".$row_cheque['cheque']."</option>");
	}
	echo ("</select></td>");
	mysql_close($navlink);
?>
<td><button type="submit" name="aceptar">Aceptar</button></td>
</tr>
</table>
</form>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./presupuesto.html">Menú Principal</a></p>
</body>
</html>