<html>
<head><TITLE>Captura de Quincenas</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_nav.php");
conect_nav();

$proy = $_POST['proy'];
$cta = $_POST['cta'];
$quin = $_POST['quin'];
$monto = $_POST['monto'];

if ($proy != null && $cta != null && $quin != null && $monto != null){
	$sql_cta = "select cta from tbl_cuentas where cta = '$cta'";
	$qry_cta = mysql_query($sql_cta);
	$arr_cta = mysql_fetch_array($qry_cta);
	if ($cta==$arr_cta['cta']){//Comprueba existencia de la cuenta
		if (mysql_query("insert into tbl_quincenas values ($proy,$cta,$quin,$monto)")){//Verifica Insert
			echo ("<h3>Captura realizada con Exito</h3>");
			echo ("<form action='captura_quin_1.php' method='post'>");
			echo ("<input type='hidden' name='proy' value='$proy'>");
			echo ("<table align='center'><tr><td><button type='submit'>Aceptar</button></td></tr></table>");
			echo ("</form>");
			//Menú de Navegación
			echo ("<hr /><p><a id='btn_h' target='_self' href='./admin.html'>Volver al Menú Principal</a></p>");
		}else{
			echo ("<h3>Cuenta-Quincena-Monto Duplicado</h3>");
			echo ("<form action='captura_quin_1.php' method='post'>");
			echo ("<input type='hidden' name='proy' value='$proy'>");
			echo ("<table align='center'><tr><td><button type='submit'>Aceptar</button></td></tr></table>");
			echo ("</form>");
			}
	}else {
		echo ("<h3>No existe la Cuenta</h3>");
		echo ("<form action='captura_quin_1.php' method='post'>");
		echo ("<input type='hidden' name='proy' value='$proy'>");
		echo ("<table align='center'><tr><td><button type='submit'>Aceptar</button></td></tr></table>");
		echo ("</form>");
		}
}else{
	echo ("<h3>Datos insuficientes para capturar</h3>");
	echo ("<form action='captura_quin_1.php' method='post'>");
	echo ("<input type='hidden' name='proy' value='$proy'>");
	echo ("<table align='center'><tr><td><button type='submit'>Aceptar</button></td></tr></table>");
	echo ("</form>");
	}
?>
</body>
</html>