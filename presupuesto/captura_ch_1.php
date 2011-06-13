<html>
<head><TITLE>Captura de Cheque</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Captura de Cheque</h3>
<?php
include("../script/conect_nav.php");
include("../script/sel_fondo.php");
conect_nav();

$proy=$_POST['proy']; //Obtiene el numero de proyecto seleccionado
sel_fondo($proy);

//Retroalimentación en caso de que se capturen varias cuentas (OG) en el mismo cheque
$cta_b=$_POST['no_cta_b'];//Obtiene el numero de cta bancaria
$cheque=$_POST['no_cheque'];//Obtiene el numero de cheque

//Si no se tiene el valor del cheque se deduce que es una captura nueva
if ($cheque == ''){
	//---Inicia seccion de Captura de Cheque---
	echo ("<hr /><p>");
	echo ("<form action='captura_ch_2.php' method='post'>");

	//Captura de Fecha del Cheque
	$fecha=getdate();

	$d=$fecha['mday'];
	$m=$fecha['mon'];
	//echo("Hoy es: ".$fecha['mday']."/".$fecha['mon']."/".$fecha['year']."</div>");//Muestra la fecha actual

	echo ("<table><thead><tr><th>Día</th> <th>Mes</th> <th>Año</th></tr></thead><tbody><tr> <td><input type='text' size='2' maxlength='2' name='d' value='$d'/></td> <td><input type='text' size='2' maxlength='2' name='m' value='$m' /></td> <td><input type='hidden' value='2007' size='4' name='a' />2007</td> </tr></tbody></table>");

	echo ("<table cellspacing='5'><thead><tr> <th>Cta Bancaria</th> <th>No. Cheque</th> <th>Cuenta (OG)</th> <th>Beneficiario</th> <th>Monto</th></tr></thead> <tbody align='center'><tr>");

	//Seleccion de Cuenta Bancaria
	echo ("<td><select name='cta_b'>");
	$sql_cta_b= "select cta_b from tbl_cta_b order by cta_b DESC"; //Obtiene la relacion de Cuentas Bancarias
	$qry_cta_b = mysql_query($sql_cta_b); //Realiza la consulta
	while ($arr_cta_b = mysql_fetch_array($qry_cta_b)){
		echo ("<option>".$arr_cta_b['cta_b']."</option>");
	}
	echo ("</select></td>");

	//Captura de Numero de Cheque
	echo ("<td><input type='text' size='4' maxlength='4' name='cheque' /></td>");

	//Seleccion de Cuenta (Objeto de Gasto)
	echo ("<td><select name='cta'>");
	for ($k=0; $k<$reg; $k++){
		echo ("<option>".$cta[$k]."</option>");
	}
	echo ("</select></td>");

	//Seleccion de Beneficiario
	echo ("<td><select name='benef_id'>");
	$sql_benef= "select benef_id, benef from tbl_benef order by benef"; //Obtiene la relacion de Beneficiarios
	$qry_benef = mysql_query($sql_benef); //Realiza la consulta
	while ($arr_benef = mysql_fetch_array($qry_benef)){
		echo ("<option>".$arr_benef['benef_id']." - ".utf8_decode($arr_benef['benef'])."</option>");
	}
	echo ("</select></td>");

	//Captura del Monto Cheque
	echo ("<td>");
	echo ("<input type='text' size='11' maxlength='11' name='monto' />");
	echo ("</td>");

	echo ("</tr></tbody></table><table cellspacing='5'><thead><tr> <th>Observaciones</th> <th>Id. (Participables)</th> </tr></thead><tbody><tr>");

	//Captura de Comentarios
	echo ("<td>");
	echo ("<input type='text' size='50' maxlength='50' name='cmt' /></textarea>");
	echo ("</td>");

	//Captura de ID para recursos Participables 
	echo ("<td>");
	echo ("<input type='text' size='10' maxlength='10' name='id' />");
	echo ("</td>");

	echo ("</tr></tbody></table>");
}
// **** M O D I F I C A C I O N   E N   P R O G R E S O
else{//Mismo Cheque con Otra Cuenta de Objeto de Gasto
	$sql_cheque = "select fecha, cta_b, cheque, proy, cta, benef_id, monto, obs, id from tbl_cheques where cta_b='$cta_b' and cheque='$cheque'";
	$qry_cheque = mysql_query($sql_cheque);
	while ($arr_cheque = mysql_fetch_array($qry_cheque)){
	$fecha = $arr_cheque['fecha'];
	}

	echo ("<hr /><p>");
	echo ("<form action='captura_ch_2.php' method='post'>");

	//Captura de Fecha del Cheque
	$d=$fecha['mday'];
	$m=$fecha['mon'];

	//echo("Hoy es: ".$fecha['mday']."/".$fecha['mon']."/".$fecha['year']."</div>");//Muestra la fecha actual

	echo ("<table><thead><tr><th>Día</th> <th>Mes</th> <th>Año</th></tr></thead><tbody><tr> <td><input type='hidden' size='2' maxlength='2' name='d' value='$d'/>".$d."</td> <td><input type='hidden' size='2' maxlength='2' name='m' value='$m' />".$m."</td> <td><input type='hidden' value='2007' size='4' name='a' />2007</td> </tr></tbody></table>");

	echo ("<table cellspacing='5'><thead><tr> <th>Cta Bancaria</th> <th>No. Cheque</th> <th>Cuenta (OG)</th> <th>Beneficiario</th> <th>Monto</th></tr></thead> <tbody align='center'><tr>");

	//Seleccion de Cuenta Bancaria
	echo ("<td><select name='cta_b'>");
	$sql_cta_b= "select cta_b from tbl_cta_b order by cta_b DESC"; //Obtiene la relacion de Cuentas Bancarias
	$qry_cta_b = mysql_query($sql_cta_b); //Realiza la consulta
	while ($arr_cta_b = mysql_fetch_array($qry_cta_b)){
		echo ("<option>".$arr_cta_b['cta_b']."</option>");
	}
	echo ("</select></td>");

	//Captura de Numero de Cheque
	echo ("<td><input type='text' size='4' maxlength='4' name='cheque' /></td>");

	//Seleccion de Cuenta (Objeto de Gasto)
	echo ("<td><select name='cta'>");
	for ($k=0; $k<$reg; $k++){
		echo ("<option>".$cta[$k]."</option>");
	}
	echo ("</select></td>");

	//Seleccion de Beneficiario
	echo ("<td><select name='benef_id'>");
	$sql_benef= "select benef_id, benef from tbl_benef order by benef"; //Obtiene la relacion de Beneficiarios
	$qry_benef = mysql_query($sql_benef); //Realiza la consulta
	while ($arr_benef = mysql_fetch_array($qry_benef)){
		echo ("<option>".$arr_benef['benef_id']." - ".utf8_decode($arr_benef['benef'])."</option>");
	}
	echo ("</select></td>");

	//Captura del Monto Cheque
	echo ("<td>");
	echo ("<input type='text' size='11' maxlength='11' name='monto' />");
	echo ("</td>");

	echo ("</tr></tbody></table><table cellspacing='5'><thead><tr> <th>Observaciones</th> <th>Id. (Participables)</th> </tr></thead><tbody><tr>");

	//Captura de Comentario
	echo ("<td>");
	echo ("<input type='text' size='50' maxlength='50' name='cmt' /></textarea>");
	echo ("</td>");

	//Captura de ID para recursos Participables 
	echo ("<td>");
	echo ("<input type='text' size='10' maxlength='10' name='id' />");
	echo ("</td>");

	echo ("</tr></tbody></table>");
}

echo ("<input type='hidden' name='proy' value='$proy'>");

echo ("<table align='center'><tr><td><button type='submit' name='aceptar'>Aceptar</button></td>");
echo ("<td><button type='reset' name='limpiar'>Limpiar</button></td> </tr></table>");

echo ("</form>");
echo ("</p>");


?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./presupuesto.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./captura_ch_0.php">Cambiar de Proyecto</a>
<a id="btn_h" target="_self" href="./captura_benef.html">Capturar Beneficiario</a></p>
</body>
</html>