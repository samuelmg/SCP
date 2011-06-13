<html>
<head><TITLE>Saldos x Ures</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_usr.php");
include("../script/sxu.php");
conect_usr();
settype($_POST['ures'],integer); //Obtiene la URes
$ures=$_POST['ures'];
$sql_ures = "select ures, d_ures from tbl_ures where ures=$ures";
$qry_ures = mysql_query($sql_ures);
$arr_ures = mysql_fetch_array($qry_ures);
echo ("<table align='center' border='1'><tr> <td>".$arr_ures['ures']."</td> <td>".$arr_ures['d_ures']."</td> </tr></table>");

sxu_ord($ures);
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./directivos.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./sxu_ord_0.php">Listado de URes</a></p>
</body>
</html>