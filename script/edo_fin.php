<?php
function edo_fin($fondo, $head){
//Suma de las transferencias del fondo seleccionado
$sql_t = "select sum(t.monto) from tbl_transferencias t, tbl_proyectos p where t.proy=p.proy$fondo";
$qry_t = mysql_query($sql_t);
$sum_t = mysql_fetch_array($qry_t);

//Suma de las transferencias de Ing. Proy - MCYP
$sql_externos = "select sum(t.monto) from tbl_transferencias t, tbl_proyectos p where t.proy=p.proy$fondo and p.ures in (226008, 226009)";
$qry_externos = mysql_query($sql_externos);
$sum_externos = mysql_fetch_array($qry_externos);

//Suma de los cheques emitidos del fondo seleccionado **Desgloce en siguiente tabla
$sql_ch = "select sum(ch.monto) from tbl_cheques ch, tbl_proyectos p where ch.proy=p.proy$fondo";
$qry_ch = mysql_query($sql_ch);
$sum_ch = mysql_fetch_array($qry_ch);

//Suma de los reembolsos del fondo seleccionado
$sql_in = "select sum(i.monto) from tbl_ingresos i, tbl_proyectos p where i.proy=p.proy$fondo";
$qry_in = mysql_query($sql_in);
$sum_in = mysql_fetch_array($qry_in);

//Suma de los egresos del fondo seleccionado
$sql_eg = "select sum(eg.monto) from tbl_egresos eg, tbl_proyectos p where eg.proy=p.proy$fondo";
$qry_eg = mysql_query($sql_eg);
$sum_eg = mysql_fetch_array($qry_eg);

//Suma de requisiciones autorizadas y sin pagar
$sql_req = "select sum(req.monto) from tbl_req req, tbl_proyectos p where req.proy=p.proy$fondo and req.estado not in ('C','P')";
$qry_req = mysql_query($sql_req);
$sum_req = mysql_fetch_array($qry_req);

echo ("<table><thead><tr><th colspan='2'>".$head."</th></tr></thead>");
echo ("<tr id='h'><td id='desc'>(+) Trans. Recibidas (".substr($fondo,13,6).")</td> <td id='monto'>".number_format($sum_t['sum(t.monto)'],2)."</td></tr>");
echo ("<tr><td>(-) Trans. Mad-Ing.Proy</td><td id='monto'>".number_format($sum_externos['sum(t.monto)'],2)."</td></tr>");
echo ("<tr><td>(-) Cheques Emitidos</td> <td id='monto'>".number_format($sum_ch['sum(ch.monto)'],2)."<sup><small>1</small></sup></td></tr>");
echo ("<tr><td>(+) Reembolsos</td> <td id='monto''>".number_format($sum_in['sum(i.monto)'],2)."</td></tr>");
echo ("<tr><td>(-) Egresos (Trans y Dev)</td> <td id='monto'>".number_format($sum_eg['sum(eg.monto)'],2)."<sup><small>2</small></sup></td></tr>");
$saldo_banco=$sum_t['sum(t.monto)']-$sum_externos['sum(t.monto)']-$sum_ch['sum(ch.monto)']+$sum_in['sum(i.monto)']-$sum_eg['sum(eg.monto)'];
echo ("<tr><td>(=) Saldo en Banco</td> <td id='monto'>".number_format($saldo_banco,2)."</td></tr>");
echo ("<tr><td>(-) Req. Autorizadas</td> <td id='monto'>".number_format($sum_req['sum(req.monto)'],2)."</td></tr>");
echo ("</table>");
}

function comp_dfin($fondo){
//Suma de los cheques emitidos del fondo seleccionado
$sql_ch = "select sum(ch.monto) from tbl_cheques ch, tbl_proyectos p where ch.proy=p.proy$fondo";
$qry_ch = mysql_query($sql_ch);
$sum_ch = mysql_fetch_array($qry_ch);

//Suma de los cheques comprobados a la Dir. de Finanzas del fondo seleccionado
$sql_comp_dfin = "select sum(ch.monto) from tbl_cheques ch, tbl_proyectos p where ch.proy=p.proy$fondo and (oficio is not null and oficio != '') and (estatus='Facturas' or estatus='Comprobado')";
$qry_comp_dfin = mysql_query($sql_comp_dfin);
$sum_comp_dfin = mysql_fetch_array($qry_comp_dfin);

//Suma de los cheques no comprobados a la Dir. de Finanzas del fondo seleccionado **Desgloce en siguiente tabla
$sql_ncomp_dfin = "select sum(ch.monto) from tbl_cheques ch, tbl_proyectos p where ch.proy=p.proy$fondo and (oficio is null or oficio = '')";
$qry_ncomp_dfin = mysql_query($sql_ncomp_dfin);
$sum_ncomp_dfin = mysql_fetch_array($qry_ncomp_dfin);

echo ("<table>");
echo ("<tr id='h'><td id='desc'>(+) Cheques Emitidos</td> <td id='monto'>".number_format($sum_ch['sum(ch.monto)'],2)."<sup><small>1</small></sup></td></tr>");
echo ("<tr><td>(-) Comprobado Dir. Finanzas</td> <td id='monto'>".number_format($sum_comp_dfin['sum(ch.monto)'],2)."</td></tr>");
echo ("<tr><td>(=) Sin Comprobar a Dir. Finanzas</td><td id='monto'>".number_format($sum_ncomp_dfin['sum(ch.monto)'],2)."</td></tr>");
echo ("</table>");
}

function x_comp($fondo){
//Suma de los cheques no comprobados a la Dir. de Finanzas
$sql_xcomp = "select sum(ch.monto) from tbl_cheques ch, tbl_proyectos p where ch.proy=p.proy$fondo and (oficio is null or oficio = '')";
$qry_xcomp = mysql_query($sql_xcomp);
$sum_xcomp = mysql_fetch_array($qry_xcomp);

//Suma de los cheques en transito del fondo seleccionado
$sql_transito = "select sum(ch.monto) from tbl_cheques ch, tbl_proyectos p where ch.proy=p.proy$fondo and (oficio is null or oficio = '') and (responsable is null or responsable = '')";
$qry_transito = mysql_query($sql_transito);
$sum_transito = mysql_fetch_array($qry_transito);

//Suma de los cheques sin clasificar del fondo seleccionado
$sql_sclas = "select sum(ch.monto) from tbl_cheques ch, tbl_proyectos p where ch.proy=p.proy$fondo and (estatus is null or estatus = '') and responsable = 'Raul'";
$qry_sclas = mysql_query($sql_sclas);
$sum_sclas = mysql_fetch_array($qry_sclas);

//Suma de los cheques sin comprobación del fondo seleccionado
$sql_sc = "select sum(ch.monto) from tbl_cheques ch, tbl_proyectos p where ch.proy=p.proy$fondo and estatus = 'Sin Comprobar'";
$qry_sc = mysql_query($sql_sc);
$sum_sc = mysql_fetch_array($qry_sc);

//Suma de los cheques pendientes por altas del fondo seleccionado
$sql_alta = "select sum(ch.monto) from tbl_cheques ch, tbl_proyectos p where ch.proy=p.proy$fondo and estatus = 'Alta Pendiente'";
$qry_alta = mysql_query($sql_alta);
$sum_alta = mysql_fetch_array($qry_alta);

//Suma de los cheques en proceso de comprobación del fondo seleccionado **Desgloce en siguiente tabla
$sql_proceso = "select sum(ch.monto) from tbl_cheques ch, tbl_proyectos p where ch.proy=p.proy$fondo and (estatus = 'Comprobado' or estatus = 'Facturas') and (oficio is null or oficio = '')";
$qry_proceso = mysql_query($sql_proceso);
$sum_proceso = mysql_fetch_array($qry_proceso);

echo ("<table>");
echo ("<tr id='h'><td id='desc'>(=) Desgloce de Cheques</td><td id='monto'>".number_format($sum_xcomp['sum(ch.monto)'],2)."</td></tr>");
echo ("<tr><td>(-) En Tránsito</td><td id='monto'>".number_format($sum_transito['sum(ch.monto)'],2)."</td></tr>");
echo ("<tr><td>(-) Sin Clasificar</td><td id='monto'>".number_format($sum_sclas['sum(ch.monto)'],2)."</td></tr>");
echo ("<tr><td>(-) Sin Comprobación</td><td id='monto'>".number_format($sum_sc['sum(ch.monto)'],2)."</td></tr>");
echo ("<tr><td>(-) Pendiente por Alta</td><td id='monto'>".number_format($sum_alta['sum(ch.monto)'],2)."</td></tr>");
echo ("<tr><td>(-) En proceso</td><td id='monto'>".number_format($sum_proceso['sum(ch.monto)'],2)."</td></tr>");
echo ("</table>");
}

function proceso($fondo){
//Suma de los cheques en proceso de comprobación del fondo seleccionado
$sql_proceso = "select sum(ch.monto) from tbl_cheques ch, tbl_proyectos p where ch.proy=p.proy$fondo and (estatus = 'Comprobado' or estatus = 'Facturas') and (oficio is null or oficio = '')";
$qry_proceso = mysql_query($sql_proceso);
$sum_proceso = mysql_fetch_array($qry_proceso);

//Cheques recien clasificados como comprobados (Raul)
$sql_clas = "select sum(ch.monto) from tbl_cheques ch, tbl_proyectos p where ch.proy=p.proy$fondo and (estatus = 'Comprobado' or estatus = 'Facturas') and responsable = 'Raul'";
$qry_clas = mysql_query($sql_clas);
$sum_clas = mysql_fetch_array($qry_clas);

//Cheques en proceso de copiado para archivo (Priscilla)
$sql_copia = "select sum(ch.monto) from tbl_cheques ch, tbl_proyectos p where ch.proy=p.proy$fondo and (estatus = 'Comprobado' or estatus = 'Facturas') and responsable = 'Priscilla'";
$qry_copia = mysql_query($sql_copia);
$sum_copia = mysql_fetch_array($qry_copia);

//Cheques en proceso de Comprobación (Chelo)
$sql_acad = "select sum(ch.monto) from tbl_cheques ch, tbl_proyectos p where ch.proy=p.proy$fondo and (estatus = 'Comprobado' or estatus = 'Facturas') and (oficio is null or oficio = '') and responsable = 'Chelo'";
$qry_acad = mysql_query($sql_acad);
$sum_acad = mysql_fetch_array($qry_acad);

//Cheques en proceso de Comprobación (Blanca)
$sql_admin = "select sum(ch.monto) from tbl_cheques ch, tbl_proyectos p where ch.proy=p.proy$fondo and (estatus = 'Comprobado' or estatus = 'Facturas') and (oficio is null or oficio = '') and responsable = 'Blanca'";
$qry_admin = mysql_query($sql_admin);
$sum_admin = mysql_fetch_array($qry_admin);

//Cheques en proceso de Comprobación (Martha)
$sql_esp = "select sum(ch.monto) from tbl_cheques ch, tbl_proyectos p where ch.proy=p.proy$fondo and (estatus = 'Comprobado' or estatus = 'Facturas') and (oficio is null or oficio = '') and responsable = 'Martha'";
$qry_esp = mysql_query($sql_esp);
$sum_esp = mysql_fetch_array($qry_esp);

echo ("<table>");
echo ("<tr id='h'><td id='desc'>(+) Cheques en proceso</td><td id='monto'>".number_format($sum_proceso['sum(ch.monto)'],2)."</td></tr>");
echo ("<tr><td>(-) Clasificación (Raul)</td><td id='monto'>".number_format($sum_clas['sum(ch.monto)'],2)."</td></tr>");
echo ("<tr><td>(-) Archivo (Priscilla)</td><td id='monto'>".number_format($sum_copia['sum(ch.monto)'],2)."</td></tr>");
echo ("<tr><td>(-) Comprobación (Chelo)</td><td id='monto'>".number_format($sum_acad['sum(ch.monto)'],2)."</td></tr>");
echo ("<tr><td>(-) Comprobación (Blanca)</td><td id='monto'>".number_format($sum_admin['sum(ch.monto)'],2)."</td></tr>");
echo ("<tr><td>(-) Comprobación (Martha)</td><td id='monto'>".number_format($sum_esp['sum(ch.monto)'],2)."</td></tr>");
echo ("</table>");
}
//Desglose de Transferencias
function t_comp_dfin($fondo){
//Suma de los egresos del fondo seleccionado
$sql_e = "select sum(e.monto) from tbl_egresos e, tbl_proyectos p where e.proy=p.proy$fondo";
$qry_e = mysql_query($sql_e);
$sum_e = mysql_fetch_array($qry_e);

//Suma de los egresos comprobados a la Dir. de Finanzas del fondo seleccionado
$sql_e_comp_dfin = "select sum(e.monto) from tbl_egresos e, tbl_proyectos p where e.proy=p.proy$fondo and (oficio is not null and oficio != '') and (estatus='Facturas' or estatus='Comprobado')";
$qry_e_comp_dfin = mysql_query($sql_e_comp_dfin);
$sum_e_comp_dfin = mysql_fetch_array($qry_e_comp_dfin);

//Suma de los egresos no comprobados a la Dir. de Finanzas del fondo seleccionado **Desgloce en siguiente tabla
$sql_e_ncomp_dfin = "select sum(e.monto) from tbl_egresos e, tbl_proyectos p where e.proy=p.proy$fondo and (oficio is null or oficio = '')";
$qry_e_ncomp_dfin = mysql_query($sql_e_ncomp_dfin);
$sum_e_ncomp_dfin = mysql_fetch_array($qry_e_ncomp_dfin);

echo ("<table>");
echo ("<tr id='h'><td id='desc'>(+) Egresos x Transferencias</td> <td id='monto'>".number_format($sum_e['sum(e.monto)'],2)."<sup><small>2</small></sup></td></tr>");
echo ("<tr><td>(-) Comprobado Dir. Finanzas</td> <td id='monto'>".number_format($sum_e_comp_dfin['sum(e.monto)'],2)."</td></tr>");
echo ("<tr><td>(=) Sin Comprobar a Dir. Finanzas</td><td id='monto'>".number_format($sum_e_ncomp_dfin['sum(e.monto)'],2)."</td></tr>");
echo ("</table>");
}

function t_x_comp($fondo){
//Suma de transferencias no comprobadas a la Dir. de Finanzas
$sql_e_xcomp = "select sum(e.monto) from tbl_egresos e, tbl_proyectos p where e.proy=p.proy$fondo and (oficio is null or oficio = '')";
$qry_e_xcomp = mysql_query($sql_e_xcomp);
$sum_e_xcomp = mysql_fetch_array($qry_e_xcomp);

//Suma de transferencias en transito del fondo seleccionado
$sql_e_transito = "select sum(e.monto) from tbl_egresos e, tbl_proyectos p where e.proy=p.proy$fondo and (oficio is null or oficio = '') and (responsable is null or responsable = '')";
$qry_e_transito = mysql_query($sql_e_transito);
$sum_e_transito = mysql_fetch_array($qry_e_transito);

//Suma de egresos sin clasificar del fondo seleccionado
$sql_e_sclas = "select sum(e.monto) from tbl_egresos e, tbl_proyectos p where e.proy=p.proy$fondo and (estatus is null or estatus = '') and responsable = 'Raul'";
$qry_e_sclas = mysql_query($sql_e_sclas);
$sum_e_sclas = mysql_fetch_array($qry_e_sclas);

//Suma de egresos sin comprobación del fondo seleccionado
$sql_e_sc = "select sum(e.monto) from tbl_egresos e, tbl_proyectos p where e.proy=p.proy$fondo and estatus = 'Sin Comprobar'";
$qry_e_sc = mysql_query($sql_e_sc);
$sum_e_sc = mysql_fetch_array($qry_e_sc);

//Suma de egresos pendientes por altas del fondo seleccionado
$sql_e_alta = "select sum(e.monto) from tbl_egresos e, tbl_proyectos p where e.proy=p.proy$fondo and estatus = 'Alta Pendiente'";
$qry_e_alta = mysql_query($sql_e_alta);
$sum_e_alta = mysql_fetch_array($qry_e_alta);

//Suma de egresos en proceso de comprobación del fondo seleccionado **Desgloce en siguiente tabla
$sql_e_proceso = "select sum(e.monto) from tbl_egresos e, tbl_proyectos p where e.proy=p.proy$fondo and (estatus = 'Comprobado' or estatus = 'Facturas') and (oficio is null or oficio = '')";
$qry_e_proceso = mysql_query($sql_e_proceso);
$sum_e_proceso = mysql_fetch_array($qry_e_proceso);

echo ("<table>");
echo ("<tr id='h'><td id='desc'>(=) Desgloce de Egresos</td><td id='monto'>".number_format($sum_e_xcomp['sum(e.monto)'],2)."</td></tr>");
echo ("<tr><td>(-) En Tránsito</td><td id='monto'>".number_format($sum_e_transito['sum(e.monto)'],2)."</td></tr>");
echo ("<tr><td>(-) Sin Clasificar</td><td id='monto'>".number_format($sum_e_sclas['sum(e.monto)'],2)."</td></tr>");
echo ("<tr><td>(-) Sin Comprobación</td><td id='monto'>".number_format($sum_e_sc['sum(e.monto)'],2)."</td></tr>");
echo ("<tr><td>(-) Pendiente por Alta</td><td id='monto'>".number_format($sum_e_alta['sum(e.monto)'],2)."</td></tr>");
echo ("<tr><td>(-) En proceso</td><td id='monto'>".number_format($sum_e_proceso['sum(e.monto)'],2)."</td></tr>");
echo ("</table>");
}

function t_proceso($fondo){
//Suma de egresos en proceso de comprobación del fondo seleccionado
$sql_e_proceso = "select sum(e.monto) from tbl_egresos e, tbl_proyectos p where e.proy=p.proy$fondo and (estatus = 'Comprobado' or estatus = 'Facturas') and (oficio is null or oficio = '')";
$qry_e_proceso = mysql_query($sql_e_proceso);
$sum_e_proceso = mysql_fetch_array($qry_e_proceso);

//Egresos clasificados como comprobados (Raul)
$sql_e_clas = "select sum(e.monto) from tbl_egresos e, tbl_proyectos p where e.proy=p.proy$fondo and (estatus = 'Comprobado' or estatus = 'Facturas') and responsable = 'Raul'";
$qry_e_clas = mysql_query($sql_e_clas);
$sum_e_clas = mysql_fetch_array($qry_e_clas);

//Cheques en proceso de copiado para archivo (Priscilla)
$sql_e_copia = "select sum(e.monto) from tbl_egresos e, tbl_proyectos p where e.proy=p.proy$fondo and (estatus = 'Comprobado' or estatus = 'Facturas') and responsable = 'Priscilla'";
$qry_e_copia = mysql_query($sql_e_copia);
$sum_e_copia = mysql_fetch_array($qry_e_copia);

//Cheques en proceso de Comprobación (Chelo)
$sql_e_acad = "select sum(e.monto) from tbl_egresos e, tbl_proyectos p where e.proy=p.proy$fondo and (estatus = 'Comprobado' or estatus = 'Facturas') and (oficio is null or oficio = '') and responsable = 'Chelo'";
$qry_e_acad = mysql_query($sql_e_acad);
$sum_e_acad = mysql_fetch_array($qry_e_acad);

//Cheques en proceso de Comprobación (Blanca)
$sql_e_admin = "select sum(e.monto) from tbl_egresos e, tbl_proyectos p where e.proy=p.proy$fondo and (estatus = 'Comprobado' or estatus = 'Facturas') and (oficio is null or oficio = '') and responsable = 'Blanca'";
$qry_e_admin = mysql_query($sql_e_admin);
$sum_e_admin = mysql_fetch_array($qry_e_admin);

//Cheques en proceso de Comprobación (Martha)
$sql_e_esp = "select sum(e.monto) from tbl_egresos e, tbl_proyectos p where e.proy=p.proy$fondo and (estatus = 'Comprobado' or estatus = 'Facturas') and (oficio is null or oficio = '') and responsable = 'Martha'";
$qry_e_esp = mysql_query($sql_e_esp);
$sum_e_esp = mysql_fetch_array($qry_e_esp);

echo ("<table>");
echo ("<tr id='h'><td id='desc'>(+) Egresos en proceso</td><td id='monto'>".number_format($sum_e_proceso['sum(e.monto)'],2)."</td></tr>");
echo ("<tr><td>(-) Clasificación (Raul)</td><td id='monto'>".number_format($sum_e_clas['sum(e.monto)'],2)."</td></tr>");
echo ("<tr><td>(-) Archivo (Priscilla)</td><td id='monto'>".number_format($sum_e_copia['sum(e.monto)'],2)."</td></tr>");
echo ("<tr><td>(-) Comprobación (Chelo)</td><td id='monto'>".number_format($sum_e_acad['sum(e.monto)'],2)."</td></tr>");
echo ("<tr><td>(-) Comprobación (Blanca)</td><td id='monto'>".number_format($sum_e_admin['sum(e.monto)'],2)."</td></tr>");
echo ("<tr><td>(-) Comprobación (Martha)</td><td id='monto'>".number_format($sum_e_esp['sum(e.monto)'],2)."</td></tr>");
echo ("</table>");
}
?>