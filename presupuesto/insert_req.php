<html>
<head><TITLE>Captura de Requisiciones</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Captura de Requisiciones</h3>

<form name='insert_req' method='post' action='insert_req_script.php'>
<table align='center' cellspacing="2" width="70%">
	<thead align="center"><tr>
	<td>No. de Requisicion</td> <td>Proyecto</td> <td>Cuenta (OG)</td> <td>Monto</td> <td>Descripcion ID</td> <td>Fecha</td>
	</tr></thead>
	<tbody align="center"><tr>
	<td><input name='req' size='10' maxlength='10' type='text' /></td>
	<td><input name='proy' size='6' maxlength='6' type='text' /></td>
	<td><input name='cta' size='4' maxlength='4' type='text' /></td>
	<td><input name='monto' size='10' maxlength='10' type='text' /></td>
	<td><input name='d_inv' size='10' maxlength='10' type='text' /></td>
<?php
	$fecha=getdate();
	$d=$fecha['mday'];
	$m=$fecha['mon'];
	$a=$fecha['year'];
	echo ("<td> <input name='d' size='2' maxlength='2' type='text' value='$d' /> <input name='m' size='2' maxlength='2' type='text' value='$m' /> <input name='a' size='4' maxlength='4' type='text' value='$a' /> </td>");
?>
	</tr></tbody>
	</table>
<table align="center">
	<tr>
	<td><input name="Reset" type="reset" value="Limpiar" /></td>
	<td><input type="submit" name="insertar" value="Insertar" /></td>
	</tr>
</table>
</form>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./presupuesto.html">Menú Principal</a></p>
</body>
</html>