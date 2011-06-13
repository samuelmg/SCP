<html>
<head><TITLE>Cheques x Beneficiario</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>

<?php
include("../script/conect_usr.php");
conect_usr();
settype($_POST['benef_id'],integer);
$benef_id=$_POST['benef_id'];

$sql_benef = "select benef from tbl_benef where benef_id = '$benef_id'";
$qry_benef = mysql_query($sql_benef);
$arr_benef = mysql_fetch_array($qry_benef);
$benef = $arr_benef['benef'];
echo ("<h3>Cheques a favor de ".utf8_decode($benef)."</h3>");

$sql_ch_benef = "select fecha, cta_b, cheque, monto, proy, cta, obs, responsable from tbl_cheques where benef_id = '$benef_id' order by fecha, cheque";
$qry_ch_benef = mysql_query($sql_ch_benef);
echo ("<p><table id='info' align='center' border='1'><thead><tr> <th>Fecha</th> <th>Cta Bancaria</th> <th>No. Cheque</th> <th>Monto</th> <th>Proyecto</th> <th>Cuenta(OG)</th> <th>Observaciones</th> <th>Estatus</th> </tr></thead>");

$renglon='non';//cambio de color en renglones
while ($arr_ch_benef = mysql_fetch_array($qry_ch_benef)){
	if($arr_ch_benef['responsable'] != ''){$entregado='Entregado';}else{$entregado='Pendiente';}//Determina si ya se entregó un cheque o no
	echo ("<tr id='$renglon'> <td>".$arr_ch_benef['fecha']."</td> <td>".$arr_ch_benef['cta_b']."</td> <td>".$arr_ch_benef['cheque']."</td> <td id='monto'>".number_format($arr_ch_benef['monto'],2)."</td> <td>".$arr_ch_benef['proy']."</td> <td>".$arr_ch_benef['cta']."</td> <td>".$arr_ch_benef['obs']."</td> <td>".$entregado."</td> </tr>");
	if ($renglon=='non'){$renglon='par';}else{$renglon='non';}//cambio de color en renglones
}
echo ("</table></p>");
?>
</form>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./recepcion.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./chxbenef_0.php">Seleccionar Otro Beneficiario</a></p>
</body>
</html>