<html>
<head><TITLE>Captura de Proyecto</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_nav.php");
conect_nav();

$fondo = $_POST['fondo'];
$d_fondo = $_POST['d_fondo'];
$tipo = $_POST['tipo'];

$d_fondo = utf8_encode($d_fondo);//Codifica a UTF8

if ($fondo != null && $d_fondo != null){
	if (mysql_query("insert into tbl_fondos values ($fondo,'$d_fondo','$tipo')")){//Verifica Insert
		echo ("<h3>Captura realizada con Exito</h3>");
		//Menú de Navegación
		echo ("<hr /><p><a id='btn_h' target='_self' href='./admin.html'>Volver al Menú Principal</a>");
		echo ("<a id='btn_h' target='_self' href='./captura_fondo.html'>Capturar Fondo</a>");
	}else {echo ("<h3>El fondo ya está registrado</h3> <h4><a href='./captura_fondo.html'>Volver al Formulario</a></h4>");}
}else{echo ("<h3>Datos insuficientes para capturar</h3> <h4><a href='./captura_fondo.html'>Volver al Formulario</a></h4>");}
?>
</body>
</html>