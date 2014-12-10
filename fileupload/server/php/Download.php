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

$files = $_POST["files"];
$names = $_POST["names"];
//file_put_contents("./log.txt", $files."\r",FILE_APPEND);
$zip=new ZipArchive;
$filename = "./image.zip";
$zip->open($filename,ZipArchive::OVERWRITE);
$length = count($files);
for($i = 0; $i < $length; $i++){
	//file_put_contents("./log.txt", "name: ".$names[$i]."file: ".$files[$i]."\r",FILE_APPEND);
	$sub = explode("ewatermark", $files[$i]);
	$file_path = urldecode($_SERVER['DOCUMENT_ROOT']."/ewatermark".$sub[1]);
	//file_put_contents("./ls.txt", "name: ".$names[$i]."file_path: ".$file_path."\r",FILE_APPEND);
    $zip->addFile($file_path,$names[$i]);
}
$zip->close();
echo $filename;
?>