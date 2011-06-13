<?php
/*
 * edo_fin_global.php
 * 
 * Copyright (C) 2005 Samuel Mercado Garibay <samuel.mg@gmx.com>.
 * 
 * This file is part of SCP.
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http ://www.gnu.org/licenses/>.
 */
?>
<html>
<head><TITLE>Estado Financiero</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>

<style>
table {
border:solid;
width:40%;
border-collapse: separate;
background:#B4FFA5;
}
td#desc {width:75%}
td#sig {width:1em}
tr#h{
background:#84BBFF;
font-weight:bold;
}
thead {background:#FFC04C}
</style>

<?php
include("../script/conect_usr.php");
include("../script/edo_fin.php");
conect_usr();

$fndo[1]=" and p.fondo=1100";
$fndo[2]=" and p.fondo=1101";
$fndo[3]=" and p.fondo=1102";
$fndo[4]=" and p.fondo=1103";
$fndo[5]=" and p.fondo=110403";
$fndo[6]=" and p.fondo=111028";
$fndo[7]=" and p.fondo=111031";
$fndo[0]="";

for ($i=0; $i<8; $i++){
$fondo=$fndo[$i];

echo ("<div>");
edo_fin($fondo);
echo ("</div><br />");

echo ("<div>");
comp_dfin($fondo);
echo ("</div><br />");

echo ("<div'>");
x_comp($fondo);
echo ("</div><br />");

echo ("<div>");
proceso($fondo);
echo ("</div><br /><hr>");
}
?>

<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./directivos.html">Menú Principal</a></p>
</body>
</html>