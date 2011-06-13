<html>
<head><TITLE>Captura de Cheque</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_nav.php");
conect_nav();

$id=$_POST['id'];
settype($_POST['benef_id'],integer);
$benef_id=$_POST['benef_id'];
$proy=$_POST['proy'];
$monto=$_POST['monto'];
$t=$_POST['t'];
$obs=$_POST['obs'];
$obs = utf8_encode($obs);

if ($id != '' && $monto != ''){
	if(mysql_query("insert into tbl_participables values ('$id','$benef_id','$proy','$monto','$t','$obs')")){
		echo ("<p><h3>Captura realizada con Exito</h3>");
		echo ("<table cellspacing='5'><thead><tr> <th>Id</th> <th>Beneficiario</th> <th>Proyecto</th> <th>Monto</th> <th>t</th> <th>Observaciones</th> </tr></thead> <tbody align='center'><tr> <tr><td>".$id."</td> <td>".$benef_id."</td> <td>".$proy."</td> <td>".$monto."</td> <td>".$t."</td> <td>".$obs."</td> </tr></table>");

		//Menú de Navegación
		echo ("<hr /><p><a id='btn_h' target='_self' href='./admin.html'>Menú Principal</a>");
		echo ("<a id='btn_h' target='_self' href='./captura_part_0.php'>Captura Nueva</a></p>");

	}else{echo ("<h3>Error al Insertar</h3><h4><a href='./captura_part_0.php'>Volver al Formulario</a></h4>");}
}else {echo ("<h3>Datos Insuficientes</h3><h4><a href='./captura_part_0.php'>Volver al Formulario</a></h4>");}
?>
</body>
</html>