<?php
/*
 * nat.php
 * 
 * Copyright (C) 2005 Samuel Mercado Garibay <samuel.mg@gmx.com>.
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

$simple['1']='UN';
$simple['2']='DOS';
$simple['3']='TRES';
$simple['4']='CUATRO';
$simple['5']='CINCO';
$simple['6']='SEIS';
$simple['7']='SIETE';
$simple['8']='OCHO';
$simple['9']='NUEVE';

$simple['11']='ONCE';
$simple['12']='DOCE';
$simple['13']='TRECE';
$simple['14']='CATORCE';
$simple['15']='QUINCE';
$simple['16']='DIECISEIS';
$simple['17']='DIECISIETE';
$simple['18']='DIECIOCHO';
$simple['19']='DIECINUEVE';

$simple['10']='DIEZ';
$simple['20']='VEINTE';
$simple['30']='TREINTA';
$simple['40']='CUARENTA';
$simple['50']='CINCUENTA';
$simple['60']='SESENTA';
$simple['70']='SETENTA';
$simple['80']='OCHENTA';
$simple['90']='NOVENTA';

$compuesto['2']='VEINTI';
$compuesto['3']='TREINTA Y ';
$compuesto['4']='CUARENTA Y ';
$compuesto['5']='CINCUENTA Y ';
$compuesto['6']='SESENTA Y ';
$compuesto['7']='SETENTA Y ';
$compuesto['8']='OCHENTA Y ';
$compuesto['9']='NOVENTA Y ';

$centenas['0']='CIEN';
$centenas['1']='CIENTO ';
$centenas['2']='DOSCIENTOS ';
$centenas['3']='TRESCIENTOS ';
$centenas['4']='CUATROCIENTOS ';
$centenas['5']='QUINIENTOS ';
$centenas['6']='SEISCIENTOS ';
$centenas['7']='SETECIENTOS ';
$centenas['8']='OCHOCIENTOS ';
$centenas['9']='NOVECIENTOS ';

$miles=' MIL ';
$millon=' MILLON ';
$millones=' MILLONES ';

//Convierte numeros < 100 (Unidades, Decenas)
function menor_cien(&$ud){
global $simple;
global $compuesto;
if (($ud<20)||($ud%10==0)){//elige menores a 20 y multiplos de 10
	$ud = $simple[$ud];
	}
	else {
	$ud = $compuesto[$ud/10].$simple[$ud%10];
	}
}
//Convierte numeros entre 99 y 100(Centenas)
function centenas(&$c){
global $centenas;
if ($c==100){
	$c = $centenas['0'];
	}
	else{
	$c = $centenas[$c/100];
	}
}
function menor_mil(&$n){
	if($n<100){
		$ud=$n;
		menor_cien(&$ud);
		$n=$ud;
//		echo $ud;
	}elseif($n<1000){
		$ud=$n%100;
		menor_cien(&$ud);
		$c=$n;
		centenas(&$c);
//		echo $c.$ud;
		$n=$c.$ud;
	}
}
//Inicio de Conversión
function letras($numero){
global $miles;
global $millones;
global $millon;
//$numero=38467.50;
$n_entero = (integer)$numero;//Convierte el número a entero
$n_str = (string)$n_entero;//Convierte el número entero a cadena
//$n_dec = (string)$numero;//Convierte el número a cadena c/decimal
//echo $numero."<br />";
if ($n_entero<1000){//Numero < a 1000
	$n=$n_entero;
	menor_mil(&$n);
	$n_letra=$n;
//	echo $n_letra;
	$letras = $n_letra." PESOS ";
	}
	elseif($n_entero<1000000){//Numero {1000 > n > 1,000,000}
	$long_n=strlen($n_str);//cuenta el número de caracteres
	$f=1;
	for ($k=$long_n; $k>$long_n-3; $k--){//Separa los miles para ser evaluados con la función menor_mil
		$m+=($n_str[$k-4]*$f);	//recupera la posicion 0,1,2 y Multiplica por 1,10,y 100
		$f*=10;
		}
	$n=$m;//Miles que pasan a funcion menor_mil para ser evaluadas
	menor_mil(&$n);
	$n_letra_m=$n;
//	echo $n_letra_m.$miles;
	$n = $n_entero - $m*1000;//Elimina los miles
	menor_mil(&$n);//Unidades, Decenas y Centenas a ser evaluadas
	$n_letra=$n;
//	echo $n_letra;
	$letras = $n_letra_m.$miles.$n_letra." PESOS ";
	}
	else{//número mayor o igual a 1,000,000
	$long_n=strlen($n_str);//cuenta el número de caracteres
	$f=1;
	for ($k=$long_n; $k>$long_n-6; $k--){
		$mm+=($n_str[$k-7]*$f);	//Recupera la posición 0,1,2 del array u la Multiplica por 1,10,y 100 respectivamente
		$f*=10;
		}
	$n=$mm;//Millones que pasan a funcion menor_mil para ser evaluadas
	if($mm=1){
	$millones=$millon;
	}
	menor_mil(&$n);
	$n_letra_mm=$n;
	$f=1;
	for ($k=$long_n; $k>$long_n-3; $k--){//Separa los miles para ser evaluados con la función menor_mil
		$m+=($n_str[$k-4]*$f);	//Multiplica por 1,10,y 100
		$f*=10;
		}
	$n=$m;//Miles que pasan a funcion menor_mil para ser evaluadas
	menor_mil(&$n);
	$n_letra_m=$n;
//	echo $n_letra_m.$miles;
	$n = $n_entero - $m*1000 - $mm*1000000;//Elimina los miles y millones
	menor_mil(&$n);//Unidades, Decenas y Centenas a ser evaluadas
	$n_letra=$n;
//	echo $n_letra;
	$letras = $n_letra_mm.$millones.$n_letra_m.$miles.$n_letra." PESOS ";
	}

//Evaluación de decimales
if (strchr($numero,".")==""){//Si no tiene decimal
	return ("(".$letras."00/100 M.N.)");
	}
	else{
	$dec = strchr($numero,".");
	$d=$dec['1'].(integer)$dec['2'];
//	echo ("(".$letras.$d."/100 M.N.)");
	return ("(".$letras.$d."/100 M.N.)");
	}
}
?>