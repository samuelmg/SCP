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
$monto = $_POST['monto'];
$t = $_POST['t'];

if ($proy != null && $cta != null && $monto != null && $t != null){
	$sql_cta = "select cta from tbl_quincenas where proy = '$proy' and cta = '$cta'";
	$qry_cta = mysql_query($sql_cta);
	$arr_cta = mysql_fetch_array($qry_cta);
	if ($cta==$arr_cta['cta']){//Comprueba existencia de la cuenta en el proyecto
		if (mysql_query("insert into tbl_recursos values ($proy,$cta,$monto,$t)")){//Verifica Insert
			echo ("<h3>Captura realizada con Exito</h3>");
			echo ("<form action='captura_rec_1.php' method='post'>");
			echo ("<input type='hidden' name='proy' value='$proy'>");
			echo ("<table align='center'><tr><td><button type='submit'>Aceptar</button></td></tr></table>");
			echo ("</form>");
			//Menú de Navegación
			echo ("<hr /><p><a id='btn_h' target='_self' href='./admin.html'>Volver al Menú Principal</a></p>");
		}else{
			echo ("<h3>Cuenta-Monto-Transferencia Duplicado</h3>");
			echo ("<form action='captura_rec_1.php' method='post'>");
			echo ("<input type='hidden' name='proy' value='$proy'>");
			echo ("<table align='center'><tr><td><button type='submit'>Aceptar</button></td></tr></table>");
			echo ("</form>");
			}
	}else {
		echo ("<h3>No existe la Cuenta</h3>");
		echo ("<form action='captura_rec_1.php' method='post'>");
		echo ("<input type='hidden' name='proy' value='$proy'>");
		echo ("<table align='center'><tr><td><button type='submit'>Aceptar</button></td></tr></table>");
		echo ("</form>");
		}
}else{
	echo ("<h3>Datos insuficientes para capturar</h3>");
	echo ("<form action='captura_rec_1.php' method='post'>");
	echo ("<input type='hidden' name='proy' value='$proy'>");
	echo ("<table align='center'><tr><td><button type='submit'>Aceptar</button></td></tr></table>");
	echo ("</form>");
	}
?>
</body>
</html>