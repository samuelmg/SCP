<html>
<head><TITLE>Estado Financiero</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>

<style>
div#layout{
	width:5180px;
}
div#fondo {
	float:left;
	clear:right;
	margin:0.5em;
}
table {
	border:solid;
	width:450px;
	border-collapse: separate;
	background:#B4FFA5;
}
td {text-align:left;}
td#desc {width:75%; text-align:left;}
td#sig {width:1em;}
tr#h{
	background:#84BBFF;
	font-weight:bold;
}
</style>
<div id="layout">
<?php
include("../script/conect_usr.php");
include("../script/edo_fin.php");
conect_usr();

$fndo[0]="";
//$fndo[]=" and p.fondo=1100";
$fndo[1]=" and p.fondo=1101";
$fndo[2]=" and p.fondo=1102";
$fndo[3]=" and p.fondo=1103";
$fndo[4]=" and p.fondo=110407";
$fndo[5]=" and p.fondo=3102";
$fndo[6]=" and p.fondo=110403";
$fndo[7]=" and p.fondo=110616";
$fndo[8]=" and p.fondo in (110409,110412,110416)";
$fndo[9]=" and p.fondo=111031";

$titulo[0]="ESTADO FINANCIERO GLOBAL";
$titulo[1]="FONDO 1101 ORDINARIO";
$titulo[2]="FONDO 1102 EXTRAORDINARIO";
$titulo[3]="FONDO 1103 COMPROMETIDO";
$titulo[4]="FONDO 110407 Adq. Matrrial Bibliográfico";
$titulo[5]="FONDO 3102 FAM/CAPECE";
$titulo[6]="FONDO 110403 PESO X PESO";
$titulo[7]="FONDO 110616 COMPROMISOS DEP. ING. PROY.";
$titulo[8]="FONDO INSTITUCIONAL PARTICIPABLE";
$titulo[9]="PROCOFIN 2006 PFZV";

for ($i=0; $i<10; $i++){
	$fondo=$fndo[$i];
	$head=$titulo[$i];
	echo ("<div id='fondo'>");
	edo_fin($fondo, $head);
	echo ("<br />");

	comp_dfin($fondo);
	echo ("<br />");

	x_comp($fondo);
	echo ("<br />");

	proceso($fondo);
	echo ("<br />");

	t_comp_dfin($fondo);
	echo ("<br />");

	t_x_comp($fondo);
	echo ("<br />");

	t_proceso($fondo);
	echo ("</div>");
}
?>
</div>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./directivos.html">Menú Principal</a></p>
</body>
</html>