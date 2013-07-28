<?php 
header('Content-Type: text/html; charset=utf-8');
$dir = $_SERVER['DOCUMENT_ROOT']. "/movies/movies";
//$dir = "file:"
$blacklist = $_POST['blacklist'];

//this is for getting into the sub dirs
/*$folders = array();
$folders = scandir($dir);

$stringData = "";
foreach($folders as $v){
    $stringData .= $v."\n";    
}
$myFile = "log.txt";
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $stringData);    
fclose($fh);
*/

if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
    	
    	$file_names = array();
    	$i = 0;

        while (($file = readdir($dh)) !== false) {
        	$file_name_buffer = array();
        	$file_object = array();
        	$file = utf8_encode($file);
            
            if(($file != ".") && ($file != "..") && ($file != " ") && ($file != null)){            	
            	if(is_link($file)){
                    $file_object[0] = realpath($file);//keep the original file name so we can refer to as a link on client    
                    
                    $myFile = "log.txt";
                    $fh = fopen($myFile, 'w') or die("can't open file");
                    fwrite($fh, $file_object[0]);    
                    fclose($fh);
                }else{
                    $file_object[0] = $file;//keep the original file name so we can refer to as a link on client
                }
                
            	
                $file_name_buffer = explode(".", $file);//delimit on this so the file extension can be determined or removed for viewing            	            	
                $file_name_buffer = implode(" ", $file_name_buffer);//delimit on this so the file extension can be determined or removed for viewing
                $file_name_buffer = explode(" ", $file_name_buffer);//delimit on this so the file extension can be determined or removed for viewing
                $ext = array_pop($file_name_buffer);//sets the extension as well as knocks the ext off the buffer
            	$file_object[1] = $ext;//store the extension
				
				$num_words = sizeof($file_name_buffer);
            	for($k = 0; $k < $num_words; $k++){
            		$lower_c = strtolower($file_name_buffer[$k]);
            		if($lower_c == "x264" || $lower_c == "720p" || $lower_c == "1080p" || $lower_c == "brrip" || $lower_c == "avi" || $lower_c == "mp4" || $lower_c == "mkv" || $lower_c == "2012" || $lower_c == "2000"){
            			unset($file_name_buffer[$k]);
            		}
                    if($blacklist != "00000"){
                        $num_blacklist = sizeof($blacklist);
                        for($j = 0; $j < $num_blacklist; $j++){
                            if($lower_c == $blacklist[$j]){
                                unset($file_name_buffer[$k]);       
                            }    
                        }    
                    }                      
            	}        	
            	            	
            	$file_name_buffer = implode(" ", array_filter($file_name_buffer));
            	$file_object[2] = $file_name_buffer;//keeps the file name without ext
            	$file_names[$i] = $file_object;
				$i++;	
            }             
        }
        closedir($dh);
        echo json_encode($file_names);

    }
}



//file[]
//0 = original filename
//1 = extension
//2 = filename without extension and periods converted to spaces


?>