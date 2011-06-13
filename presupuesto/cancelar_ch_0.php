<html>
<head><TITLE>Cancelar Cheque</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<form action="cancelar_ch_1.php" method="post">

<p><h3>Selección de Cuenta Bancaria</h3>
<table width="73%">
<tr>
<td>Selecciona la Cuenta Bancaria:</td>
	<td>
	<select name="cta_b">
	<?php
	include("../script/conect_nav.php");
	conect_nav();
	$sql_cta_b= "select cta_b from tbl_cta_b order by cta_b DESC"; //Obtiene la relacion de Todos las Ctas Bancarias
	$qry_cta_b = mysql_query($sql_cta_b);
	while ($row_cta_b = mysql_fetch_array($qry_cta_b)){
		echo ("<option>".$row_cta_b['cta_b']."</option>");
	}
	?>
	</select>
	</td>
<td><button type="submit" name="aceptar">Aceptar</button></td>
</tr>
</table>
</p>
</form>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./presupuesto.html">Menú Principal</a></p>
</body>
</html>