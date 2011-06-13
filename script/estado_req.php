<?php
function seleccion_req(){//Funcion para elegir requisiciones. Agrega un checkbox para seleccionar la requisicion
$sql_req = "select n_req, proy, cta, monto, id, fecha, estado from tbl_req order by n_req";
$qry_req = mysql_query($sql_req);
echo ("<table id='info' border='1'><thead><tr> <th>Requisición</th> <th>Proyecto</th> <th>Cuenta</th> <th>Monto</th> <th>ID (Participables)</th> <th>Fecha</th> <th>Estado</th> <th>Seleccionar</th> </tr></thead><tbody>");
while ($arr_req = mysql_fetch_array($qry_req)){
	echo ("<tr> <td>".$arr_req['n_req']."</td> <td>".$arr_req['proy']."</td> <td>".$arr_req['cta']."</td> <td align='right'>".number_format($arr_req['monto'],2)."</td> <td>".$arr_req['id']."</td> <td>".$arr_req['fecha']."</td> <td>".$arr_req['estado']."</td> <td align='center'><input type='checkbox' name='".$arr_req['n_req']."' value='".$arr_req['n_req']."'></td> </tr>");
	}
echo ("</tbody></table>");
}
function extraer_post_req($_POST){//Extrae del POST el número de requisicion
$n_req = current($_POST);
echo ("<input type='hidden' name='".$n_req."' value='".$n_req."'>");
	req_seleccionada($n_req);
while (next($_POST)){
	$n_req = current($_POST);
	echo ("<input type='hidden' name='".$n_req."' value='".$n_req."'>");
	req_seleccionada($n_req);
	}
}
function req_seleccionada($n_req){//Muestra la informacion de una req
$sql_sel = "select n_req, proy, cta, monto, id, fecha, estado from tbl_req where n_req='".$n_req."'";
$qry_sel = mysql_query($sql_sel);
while ($arr_sel = mysql_fetch_array($qry_sel)){
	echo ("<tr> <td>".$arr_sel['n_req']."</td> <td>".$arr_sel['proy']."</td> <td>".$arr_sel['cta']."</td> <td align='right'>".number_format($arr_sel['monto'],2)."</td> <td>".$arr_sel['id']."</td> <td>".$arr_sel['fecha']."</td> <td>".$arr_sel['estado']."</td> </tr>");
	}
}
function actualiza_estado($_POST){//Actualiza el estado de una requisición
$n_req = current($_POST);
$estado = $_POST['estado'];
sql_update($n_req, $estado);
$reg = count($_POST)-1; //Numero de Registros por evaluar
for($i=$reg; $i>1; $i--){
	next($_POST);
	$n_req = current($_POST);
	$estado = $_POST['estado'];
	sql_update($n_req, $estado);
	}
}
function sql_update($n_req, $estado){
$sql_update = "update tbl_req set estado='$estado' where n_req='$n_req'";
if(mysql_query($sql_update)){
	}
else{echo ("<h3>Error al actualizar</h3> <h4><a href='./estado_req_0.php'>Volver a Seleccionar</a></h4>");}
}
?>