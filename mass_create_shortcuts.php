<?php
$dir = "I:\Movies";


$files = array();
$files = scandir($dir);
$final_list = array();

$stringData = "";
$i = 0;
foreach($files as $v){
    if(is_dir($v)){
    	$temp_sub = sub_scan($v);
    	foreach($temp_sub as $p){
    		$final_list[$i] = $p;
    		$i++;
    	}
    }else{
    	$final_list[$i] = $v;
    	$i++;
    }    
    //$stringData .= $v."\n";    
}

foreach($final_list as $y => $j){
	if($j == "." || $j == ".." || $j == " " || $j == null){
		unset($final_list[$y]);
	}else{
		$final_list[$y] = remove_crap($j);	
	}	
}

$myFile = "log.txt";
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $stringData);    
fclose($fh);

function sub_scan($folder){
	$sub_files = scandir($dir.$folder);
	return $sub_files;
}

function remove_crap($file_name){
	$file_name_buffer = explode(".", $file);
	foreach($file_name_buffer as $r){
		if($r == )
	}
}


?>