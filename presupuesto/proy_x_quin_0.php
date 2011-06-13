<html>
<head><TITLE>Captura de Cheque</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<form action="proy_x_quin_1.php" method="post">

<p>
<table width="60%"> 
<tr>
<td width="30%">Selecciona la Quincena:</td>
<td>
<select name='quin'>

<?php
	include("../script/conect_nav.php");
	conect_nav();
	$sql_quin= "select q.quin from tbl_quincenas q, tbl_proyectos p where p.proy=q.proy and p.fondo=1101 group by q.quin";//Relación de quincenas del fondo 1101
	$qry_quin = mysql_query($sql_quin);
	while ($arr_quin = mysql_fetch_array($qry_quin)){
		echo ("<option>".$arr_quin['quin']."</option>");
	}
?>

</select>
</td>
<td><button type="submit" name="aceptar" value="aceptar">Aceptar</button></td>
</tr>
</table>
</form>
</body>
</html>