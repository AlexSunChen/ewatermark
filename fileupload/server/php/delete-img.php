<?php
/*
 * jQuery File Upload Plugin PHP
 *
 * Copyright 2014, SunChen
 * https://#
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */
 
@session_start();
$Folder = $_SESSION['NAME'];

$files = $_POST["files"];
$names = $_POST["names"];
//file_put_contents("./log.txt", $files."\r",FILE_APPEND);

$length = count($files);
for($i = 0; $i < $length; $i++){
	//file_put_contents("./log.txt", "name: ".$names[$i]."file: ".$files[$i]."\r",FILE_APPEND);
	$sub = explode("ewatermark", $files[$i]);
	$file_path = urldecode($_SERVER['DOCUMENT_ROOT']."/ewatermark".$sub[1]);
	$file_path_thum = urldecode($_SERVER['DOCUMENT_ROOT']."/ewatermark/fileupload/server/php/files/".$Folder."/thumbnail/".$names[$i]);
	file_put_contents("./ls.txt", "file_path: ".$file_path_thum."\r",FILE_APPEND);
    unlink($file_path);
	unlink($file_path_thum);
}

if($length == 0){
	echo "Please choose image!";
	exit();
}else{
	echo "successlly deleted !";
	exit();
}

?>