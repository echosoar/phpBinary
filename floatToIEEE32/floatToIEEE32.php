<?php
/*
Float To IEEE 32

Author:Echosoar

Convert the floating point number into IEEE32 binary number by php
*/
function tenToBinary($num,$j){
	$tem=pow(2,-$j);
	if($j>23){
		return '';
	}else if(($num-$tem)==0){
		return '1';
	}else{
		if(($num-$tem)>0){
			return '1'.tenToBinary($num-$tem,++$j);
		}else{
			return '0'.tenToBinary($num,++$j);
		}		
	}
}

function wsPositive($num){
	$tem=floor($num/10);
	if($tem>=1){
		return 1+wsPositive($num/10);
	}else{
		return 0;
	}
}
function wsNegative($num){
	$tem=$num*10;
	if($tem<1){
		return -1+wsNegative($num*10);
	}else{
		return -1;
	}
}

function ws($num){
	if($num>1){
		return wsPositive($num);
	}else{
		return wsNegative($num);
	}
}

function addzero($num){
	$zero='';
	for($i=0;$i<$num;$i++){
		$zero.='0';
	}
	return $zero;
}
function main($num){
	if($num<0){
		$s=1;
		$num=-$num;
	}else{
		$s=0;
	}
	$zs=floor($num);
	$bzs=decbin($zs);
	$xs=$num-$zs;
	$res=(float)($bzs.'.'.tenToBinary($xs,1));
	$teme=ws($res);
	$e=decbin($teme+127);
	if($teme==0){
		$e='0'.$e;
	}
	$temm=$res/pow(10,$teme);
	$m=end(explode(".",$temm));
	$lenm=strlen($m);
	if($lenm<23){
		$m.=addzero(23-$lenm);
	}
	return $s.' '.$e.' '.$m.' ';
}

echo main(-1.5);



