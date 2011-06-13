<html>
<head><TITLE>Captura de Proyecto</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_nav.php");
conect_nav();

$ures = $_POST['ures'];
$proy = $_POST['proy'];
$d_proy = $_POST['d_proy'];
$monto = $_POST['monto'];
$fondo = $_POST['fondo'];
$quin = $_POST['quin'];
$prog = $_POST['prog'];
$eje = $_POST['eje'];


$d_proy = strtoupper($d_proy);//Convierte a mayúsculas
$d_proy = utf8_encode($d_proy);//Codifica a UTF8

if ($ures != null && $proy != null && $d_proy != null && $monto != null && $fondo != null && $prog != null && $eje != null){
	$sql_fondo = "select fondo from tbl_fondos where fondo = '$fondo'";
	$sql_prog = "select prog from tbl_programas where prog = '$prog'";
	$sql_ures = "select ures from tbl_ures where ures = '$ures'";
	$qry_fondo = mysql_query($sql_fondo);
	$qry_prog = mysql_query($sql_prog);
	$qry_ures = mysql_query($sql_ures);
	$arr_fondo = mysql_fetch_array($qry_fondo);
	$arr_prog = mysql_fetch_array($qry_prog);
	$arr_ures = mysql_fetch_array($qry_ures);
	if ($fondo==$arr_fondo['fondo'] && $prog==$arr_prog['prog'] && $ures==$arr_ures['ures']){//Comprueba existencia de fondo, prog y ures
		if (mysql_query("insert into tbl_proyectos values ($ures,$proy,'$d_proy',$monto,$fondo,$quin,$prog,$eje)")){//Verifica Insert
			echo ("<h3>Captura realizada con Exito</h3>");
			//Menú de Navegación
			echo ("<hr /><p><a id='btn_h' target='_self' href='./admin.html'>Volver al Menú Principal</a>");
			echo ("<a id='btn_h' target='_self' href='./captura_proyecto.html'>Capturar otro Proyecto</a>");
			echo ("<a id='btn_h' target='_self' href='./captura_quin_0.php'>Capturar Quincenas</a></p>");
		}else {echo ("<h3>El proyecto ya está registrado</h3> <h4><a href='./captura_proyecto.html'>Volver al Formulario</a></h4>");}
	}else {echo ("<h3>No existe la Ures, Fondo o Programa</h3> <h4><a href='./captura_proyecto.html'>Volver al Formulario</a></h4>");}
}else{echo ("<h3>Datos insuficientes para capturar</h3> <h4><a href='./captura_proyecto.html'>Volver al Formulario</a></h4>");}
?>
</body>
</html>