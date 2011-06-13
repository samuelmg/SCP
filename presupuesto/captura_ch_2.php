<html>
<head><TITLE>Captura de Cheque</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<?php
include("../script/conect_nav.php");
conect_nav();

$cta_b=$_POST['cta_b'];
$cheque=$_POST['cheque'];
$proy=$_POST['proy'];
$cta=$_POST['cta'];
settype($_POST['benef_id'],integer);
$benef_id=$_POST['benef_id'];
$monto=$_POST['monto'];
$cmt=$_POST['cmt'];
$id=$_POST['id'];
$d=$_POST['d'];
$m=$_POST['m'];
$a=$_POST['a'];
$fecha=$a."-".$m."-".$d;
$obs = utf8_encode($obs);

//Validación de Fecha
if (checkdate($m,$d,$a)){
	//Validación para proyectos participables
	$sql_proy = "select proy from tbl_proyectos p, tbl_fondos f where p.fondo=f.fondo and f.tipo='PAR'";
	$qry_proy = mysql_query($sql_proy);
	while ($arr_proy = mysql_fetch_array($qry_proy)){
		if ($proy == $arr_proy['proy']){
			$sql_par = "select id from tbl_participables where proy = '$proy' and id = '$id'";
			$qry_par = mysql_query($sql_par);
			$arr_par = (mysql_fetch_array($qry_par));
			if ($id != $arr_par['id'] || $id == ''){//Si el ID no está registrado cambia el valor del monto y benef_id para generar un error
				$benef_id=0;
				$monto=0;
			}
		}
	}

	if ($cheque != 0 && $benef_id != 0 && $monto != 0){

	if(mysql_query("insert into tbl_cheques values ('$fecha','$cta_b','$cheque','$proy','$cta','$benef_id','$monto','$cmt','$id','','','','','')")){
	echo ("<p><h3>Captura realizada con Exito</h3>");
	echo ("<table align='center' border='1'><tr> <td>Fecha</td> <td>Cta Bancaria</td> <td>No. Cheque</td> <td>Proyecto<td>Cuenta (OG)</td><td>ID Beneficiario</td> <td>Monto</td> <td>Observaciones</td> <td>Id. (Participables)</td> </tr><tr> <td>".$fecha."</td> <td>".$cta_b."</td> <td>".$cheque."</td> <td>".$proy."</td> <td>".$cta."</td> <td>".$benef_id."</td> <td>".$monto."</td> <td>".$cmt."</td> <td>".$id."</td> <td>".$estatus."</td> </tr></table>");

	//Formulario oculto para capturar otra Cuenta (OG) para el mismo cheque
/*	echo ("<p><form action='captura_ch_1.php' method='post'>");
	echo ("<input type='hidden' name='no_cta_b' value='$cta_b'>");
	echo ("<input type='hidden' name='no_cheque' value='$cheque'>");
	echo ("<button type='submit' name='enviar'>Capturar Otra Cuenta</button>");
	echo ("</form></p>");*/

	//Formulario oculto para imprimir cheque
	echo ("<p><form action='impresion_ch_2.php' method='post'>");
	echo ("<input type='hidden' name='cta_b' value='$cta_b'>");
	echo ("<input type='hidden' name='cheque' value='$cheque'>");
	echo ("<button type='submit' name='enviar'>Imprimir Cheque</button>");
	echo ("</form></p>");

	//Menú de Navegación
	echo ("<hr /><p><a id='btn_h' target='_self' href='./presupuesto.html'>Menú Principal</a>");
	echo ("<a id='btn_h' target='_self' href='./captura_ch_0.php'>Capturar Otro Cheque</a></p>");

	}else{echo ("<h3>Error al Insertar</h3><form align='center' action='captura_ch_1.php' method='post'><input type='hidden' value='$proy' name='proy' /><button type='submit' name='aceptar'>Aceptar</button></form>");}
	}else {echo ("<h3>Datos Insuficientes</h3><form align='center' action='captura_ch_1.php' method='post'><input type='hidden' value='$proy' name='proy' /><button type='submit' name='aceptar'>Aceptar</button></form>");}
	}else{echo ("<h3>Fecha Incorrecta</h3><form align='center' action='captura_ch_1.php' method='post'><input type='hidden' value='$proy' name='proy' /><button type='submit' name='aceptar'>Aceptar</button></form>");}
?>

</body>
</html>