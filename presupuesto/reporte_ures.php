<html>
<head><TITLE>Reporte de Ures</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Unidades Responsables</h3>
<?php
include("../script/conect_nav.php");
conect_nav();

$slq_ures = "select ures, d_ures from tbl_ures";
$qry_ures = mysql_query($slq_ures);
echo ("<table id='info' align='center' border='1'><thead><tr><th>Ures</th> <th>Descripción Ures</th> </tr></thead><tbody>");
while ($arr_ures = mysql_fetch_array($qry_ures)){
	echo ("<tr><td>".$arr_ures['ures']."</td> <td>".$arr_ures['d_ures']."</td> </tr>");
	}
echo ("</tbody></table><br />");
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./presupuesto.html">Menú Principal</a>
</p>
</body>
</html>