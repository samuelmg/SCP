<html>
<head><TITLE>Captura de Beneficiario</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_nav.php");
conect_nav();

$benef=$_POST['benef'];
$benef = strtoupper($benef);
$benef = utf8_encode($benef);

if ($benef != null){
	if (mysql_query("insert into tbl_benef values ('','$benef')")){//Verifica Insert
		echo ("<h3>Captura realizada con Exito</h3>");
		//Menú de Navegación
		echo ("<hr /><p><a id='btn_h' target='_self' href='./presupuesto.html'>Volver al Menú Principal</a>");
		echo ("<a id='btn_h' target='_self' href='./captura_benef.html'>Capturar otro Beneficiario</a>");
		echo ("<a id='btn_h' target='_self' href='./captura_ch_0.php'>Capturar Cheque</a></p>");
	}else {echo ("<h3>El beneficiario ya está registrado</h3> <h4><a href='./captura_benef.html'>Volver al Formulario</a></h4>");}
}else{echo ("<h3>No hay datos para capturar</h3> <h4><a href='./captura_benef.html'>Volver al Formulario</a></h4>");}
?>
</body>
</html>