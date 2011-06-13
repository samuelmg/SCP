<html>
<head><TITLE>Requisiciones Autorizadas Pendientes de Pago</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<p><h3>Requisiciones Pendientes de Pago</h3>
<form action="consulta_req.php" method="post">
<table align="center" width="30%">
<tr><td>Ordenar por:</td>
<td>
	<select name="orden">
	<option>Fecha</option>
	<option>Requisición</option>
	<option>Unidad Responsable</option>
	</select>
</td>
<td width="10%"><button type="submit" value="orden">Aceptar</button></td>
</tr>
</table>
</form>
<?php
	include("../script/conect_nav.php");
	include("../script/fecha.php");
	conect_nav();
	if ($_POST['orden'] == ''){
		$orden = "p.ures, p.proy";
	}
	else{
		switch ($_POST['orden']){
		case "Fecha":$orden = "r.fecha";break;
		case "Requisición":$orden = "r.n_req";break;
		case "Unidad Responsable":$orden = "p.ures, p.proy";break;
		}
	}
	$sql_req = "select p.ures, u.d_ures, r.proy, r.cta, r.monto, r.n_req, r.id, r.fecha from tbl_req r, tbl_proyectos p, tbl_ures u where p.proy=r.proy and u.ures=p.ures and r.estado not in ('C','P') order by $orden";
	$qry_req = mysql_query($sql_req); //Realiza la consulta
	echo("<table id='info' border='1'><thead><tr><th>URes</th> <th>Unidad Responsable</th> <th>Proyecto</th> <th>Cuenta</th> <th>Monto</th> <th>No. Requisición</th> <th>ID (Participables)</th> <th>Fecha</th> </tr></thead>");
	$renglon='non';//cambio de color en renglones
	while ($arr_req = mysql_fetch_array($qry_req)){
		$fecha = $arr_req['fecha'];
		fecha_info(&$fecha);
		echo ("<tr id='$renglon'><td>".utf8_decode($arr_req['ures'])."</td> <td id ='benef'>".$arr_req['d_ures']."</td> <td>".$arr_req['proy']."</td> <td>".$arr_req['cta']."</td> <td id='monto'>".number_format($arr_req['monto'],2)."</td> <td>".$arr_req['n_req']."</td> <td>".$arr_req['id']."</td> <td id='monto'>".$fecha."</td></tr>");
		$sum_monto += $arr_req['monto'];
		if ($renglon=='non'){$renglon='par';}else{$renglon='non';}//cambio de color en renglones
	}
	echo ("<tr><td colspan='4'></td><td id='total'>".number_format($sum_monto,2)."</td><td colspan='3'></td></tr>");
	echo("</table>");
?>
</body>
</html>