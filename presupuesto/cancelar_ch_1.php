<html>
<head><TITLE>Cancelar Cheque</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<form action="cancelar_ch_2.php" method="post">

<p><h3>Selección de Cheque</h3>
<table width="75%">
<?php
	include("../script/conect_nav.php");
	conect_nav();
	$cta_b = $_POST['cta_b'];
	echo("<tr><td>Cheques de la Cuenta ".$cta_b.": </td><td>");
	echo ("<select name='cheque'>");
	$sql_cheque = "select cheque from tbl_cheques where cta_b='$cta_b' group by cheque order by cheque DESC"; //Obtiene la relacion de Todos las Ctas Bancarias
	$qry_cheque = mysql_query($sql_cheque);
	while ($row_cheque = mysql_fetch_array($qry_cheque)){
		echo ("<option>".$row_cheque['cheque']."</option>");
	}
	echo ("</select></td>");
	echo ("<input type='hidden' name='cta_b' value='$cta_b'>");
?>
<td><button type="submit" name="aceptar">Aceptar</button></td>
</tr>
</table>
</p>
</form>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./presupuesto.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./cancelar_ch_0.php">Cambiar Cuenta Bancaria</a></p>
</body>
</html>