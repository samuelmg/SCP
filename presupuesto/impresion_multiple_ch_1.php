<html>
<head><TITLE>Impresión de Cheques</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<form action="impresion_multiple_ch_2.php" method="post">
<p><h3>Rango de Cheques a Imprimir</h3>
<table width="75%">
	<tr><td>Cheque Inicial</td> <td><input type="text" name="ch_ini" size="5" maxlength="4" /></td></tr>
	<tr><td>Cheque Final</td> <td><input type="text" name="ch_fin" size="5" maxlength="4" /></td></tr>
	<input type="hidden" name="cta_b" value="$cta_b" />

	<tr><td></td><td><button type="submit" name="aceptar">Aceptar</button></td></tr>
</table>
</p>
</form>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./presupuesto.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./impresion_ch_0.php">Cambiar Cuenta Bancaria</a></p>
</body>
</html>

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
	mysql_close($navlink);
?>