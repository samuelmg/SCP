<html>
<head><TITLE>Proyectos x Quincena</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>

<p><h3>Proyectos x Quincenas</h3>

<?php
include("../script/conect_nav.php");
conect_nav();

$quin=$_POST['quin'];

echo ("<table id='info' border='1' align='center'><thead><tr> <th>URes</th> <th>Unidad Responsable</th> <th>Proyecto</th> <th>Nombre del Proyecto</th> <th>Quincena</th> <th>Monto</th>  </tr></thead><tbody>");

$sql_pxq= "select p.ures, u.d_ures, p.proy, p.d_proy, q.quin, sum(q.monto) from tbl_quincenas q, tbl_proyectos p, tbl_ures u where p.proy=q.proy and p.ures=u.ures and q.quin=$quin and p.fondo=1101 group by p.ures, u.d_ures, p.proy, p.d_proy, q.quin";
$qry_pxq = mysql_query($sql_pxq);
$renglon='non';//cambio de color en renglones
while ($arr_pxq = mysql_fetch_array($qry_pxq)){
	echo ("<tr id='$renglon'> <td>".$arr_pxq['ures']."</td> <td id='benef'>".utf8_decode($arr_pxq['d_ures'])."</td> <td>".$arr_pxq['proy']."</td> <td id='benef'>".utf8_decode($arr_pxq['d_proy'])."</td> <td>".$arr_pxq['quin']."</td> <td id='monto'>".number_format($arr_pxq['sum(q.monto)'],2)."</td></tr>");
	$sum_monto += $arr_pxq['sum(q.monto)'];
	if ($renglon=='non'){$renglon='par';}else{$renglon='non';}//cambio de color en renglones
}
echo ("<tr><td colspan='5'></td><td id='total'>".number_format($sum_monto,2)."</td></tr>");
?>

</body>
</html>