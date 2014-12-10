<?php
/* image delete function 1.1.0
 * http://153.121.76.133/ewatermark/ImgList.html
 *
 * Copyright 2014, SunChen
 * http://153.121.76.133
 */
$root = $_SERVER['DOCUMENT_ROOT'];
require_once($root.'/ewatermark/php/conn.php');

function del_directory($directory,$subdir=true){
	if (is_dir($directory) == false){
		echo "The Directory Is Not Exist!";
		exit();
	}
	$handle = opendir($directory);
	while (($file = readdir($handle)) !== false){
		if ($file != "." && $file != ".."){
			is_dir("$directory/$file")?
				del_directory("$directory/$file"):
				unlink("$directory/$file");
		}	
	}
	if (readdir($handle) == false){
		closedir($handle);
		rmdir($directory);
	}
}
	$zone = $_POST['zone'];
	$path = "./files/".$zone;
	del_directory($path);
	//file_put_contents("./ls.txt", $path."\r",FILE_APPEND);
	$sql= "delete from files where url='$zone'";
	$db->query($sql);
	$db->close();
	session_start();
	session_destroy();
	echo 'deleted! ご使用ありがとうございました!';
?>