<html>
<head><TITLE>Cancelar Cheque 4448</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<form action="cancelar_ch_4448_1.php" method="post">

<p><h3>Selección de Cheque</h3>
<table width="75%">
<?php
	include("../script/conect_nav.php");
	conect_nav();
	echo("<tr><td>Cheques de la Cuenta 4448: </td><td>");
	echo ("<select name='cheque'>");
	$sql_cheque = "select cheque from tbl_cheques_4448 order by cheque DESC";
	$qry_cheque = mysql_query($sql_cheque);
	while ($row_cheque = mysql_fetch_array($qry_cheque)){
		echo ("<option>".$row_cheque['cheque']."</option>");
	}
	echo ("</select></td>");
?>
<td><button type="submit" name="aceptar">Aceptar</button></td>
</tr>
</table>
</p>
</form>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./presupuesto.html">Menú Principal</a>
</body>
</html>