<html>
<head><TITLE>Captura de Cheques 4448</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_nav.php");
conect_nav();

$cheque=$_POST['cheque'];
settype($_POST['benef_id'],integer);
$benef_id=$_POST['benef_id'];
$monto=$_POST['monto'];
$concepto=$_POST['concepto'];
$descripcion=$_POST['descripcion'];
$destino=$_POST['destino'];
$d=$_POST['d'];
$m=$_POST['m'];
$a=$_POST['a'];
$fecha=$a."-".$m."-".$d;
if (checkdate($m,$d,$a)){ //Validación de Fecha
	if ($cheque != 0 && $benef_id != 0 && $monto != 0){
		if(mysql_query("insert into tbl_cheques_4448 values ('$fecha','$cheque','$benef_id','$monto','$concepto','$descripcion','$destino')")){//Verifica Insert
		echo ("<p><h3>Captura realizada con Exito</h3>");
		echo ("<table align='center' border='1'><tr> <td>Fecha</td> <td>No. Cheque</td> <td>ID Beneficiario</td> <td>Monto</td> <td>Concepto</td> <td>Descripcion</td> <td>Destino</td></tr><tr> <td>".$fecha."</td> <td>".$cheque."</td> <td>".$benef_id."</td> <td>".$monto."</td> <td>".$concepto."</td> <td>".$descripcion."</td> <td>".$destino."</td></tr></table>");

		echo ("<p><form action='impresion_ch_4448_1.php' method='post'>");
		echo ("<input type='hidden' name='cheque' value='$cheque'>");
		echo ("<button type='submit' name='enviar'>Imprimir Este Cheque</button>");
		echo ("</form></p>");
		//Menú de Navegación
		echo ("<hr /><p><a id='btn_h' target='_self' href='./presupuesto.html'>Menú Principal</a>");
		echo ("<a id='btn_h' target='_self' href='./insert_ch_4448_0.php'>Capturar Otro Cheque</a></p>");
		}
	}else {echo ("<h3>Datos Insuficientes</h3> <h4><a href='./captura_ch_4448_0.php'>Volver al Formulario</a></h4>");}
}else{echo ("<h3>Fecha Incorrecta</h3> <h4><a href='./captura_ch_1.php'>Volver al Formulario</a></h4>");}
?>
</body>
</html>