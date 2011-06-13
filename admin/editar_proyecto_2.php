<html>
<head><TITLE>Edición de Proyecto</TITLE>
<link rel="stylesheet" href="../css/cucei.css" />
</head>
<body>
<h3>Captura de Cheque</h3>
<?php
include("../script/conect_nav.php");
conect_nav();

//n_* -> nueva información
$n_ures=$_POST['ures'];
$n_proy=$_POST['proy'];
$n_d_proy=$_POST['d_proy'];
$n_monto=$_POST['monto'];
$n_fondo=$_POST['fondo'];
$n_quin=$_POST['quin'];
$n_prog=$_POST['prog'];
$n_eje=$_POST['eje'];
$o_proy=$_POST['o_proy'];

//Consulta la Base de Datos para comparar la información
$sql_proy = "select ures, proy, d_proy, monto, fondo, quin, prog, eje from tbl_proyectos where proy = $o_proy";
$qry_proy = mysql_query($sql_proy);
$arr_proy=mysql_fetch_array($qry_proy);

//o_* -> información original
$o_ures=$arr_proy['ures'];
$o_d_proy=$arr_proy['d_proy'];
$o_monto=$arr_proy['monto'];
$o_fondo=$arr_proy['fondo'];
$o_quin=$arr_proy['quin'];
$o_prog=$arr_proy['prog'];
$o_eje=$arr_proy['eje'];

$data="";
$coma="";
if ($n_ures!=$o_ures){$data="ures=$n_ures"; $coma=",";}
if ($n_proy!=$o_proy){$data="$data"."$coma proy=$n_proy"; $coma=",";}
if ($n_d_proy!=$o_d_proy){$data="$data"."$coma d_proy=$n_d_proy"; $coma=",";}
if ($n_monto!=$o_monto){$data="$data"."$coma monto=$n_monto"; $coma=",";}
if ($n_fondo!=$o_fondo){$data="$data"."$coma fondo=$n_fondo"; $coma=",";}
if ($n_quin!=$o_quin){$data="$data"."$coma quin=$n_quin"; $coma=",";}
if ($n_prog!=$o_prog){$data="$data"."$coma prog=$n_prog"; $coma=",";}
if ($n_eje!=$o_eje){$data="$data"."$coma eje=$n_eje";}

if ($data==""){
	echo ("<h3>No se realizó ningún cambio</h3>");
	}
else{
	if(mysql_query("update tbl_proyectos set $data where proy=$o_proy")){
		echo("<h3>Edición Exitosa</h3>");
		}
	}

$sql_nproy = "select ures, proy, d_proy, monto, fondo, quin, prog, eje from tbl_proyectos where proy = $n_proy";
$qry_nproy = mysql_query($sql_nproy);
$arr_nproy=mysql_fetch_array($qry_nproy);

echo ("<table id='info'><thead><tr> <th>URes</th> <th>Proyecto</th> <th>Nombre</th> <th>Monto</th> <th>Fondo</th> <th>Quincena</th> <th>Programa</th> <th>Eje</th> </tr></thead>");
echo ("<tbody><tr> <td>".$arr_nproy['ures']."</td> <td>".$arr_nproy['proy']."</td> <td>".$arr_nproy['d_proy']."</td> <td>".$arr_nproy['monto']."</td> <td>".$arr_nproy['fondo']."</td> <td>".$arr_nproy['quin']."</td> <td>".$arr_nproy['prog']."</td> <td>".$arr_nproy['eje']."</td> </tr></tbody>");
echo ("</table>");
?>
<!--Menú de Navegación-->
<hr /><p><a id="btn_h" target="_self" href="./admin.html">Menú Principal</a>
<a id="btn_h" target="_self" href="./editar_proyecto_0.php">Elegir Otro Proyecto</a></p>
</body>
</html>