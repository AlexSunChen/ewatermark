<?php
/*
 * File UploadProcess PHP 1.1.0
 *
 * Copyright 2014, SunChen
 * http://153.121.76.133/ewatermark/ImgList.html
 */


error_reporting(E_ALL | E_STRICT);
//require('UploadHandler.php');
//file_put_contents("./ls.txt","laile,laile,laile",FILE_APPEND);

//if(isset($_FILES["files"]))
//{
	
	//file_put_contents("./ls.txt","laile",FILE_APPEND);
	require_once($_SERVER['DOCUMENT_ROOT']."/ewatermark/php/conn.php");
	@session_start();
	$Folder = $_SESSION['NAME'];
	$dir = $_SERVER['DOCUMENT_ROOT']."/ewatermark/fileupload/server/php/files/".$Folder."/thumbnail";
	$nums = array();
	if (is_dir($dir)){
		if ($dh = opendir($dir)){
			while (($file = readdir($dh))!= false){
				//文件名的全路径 包含文件名
				if(substr($file,0,1) != "."){
					//$filePath = $dir.$file;
					//获取文件修改时间
					//$fmt = filemtime($filePath);
					$nums[] = $file;
					//echo "<span style='color:#666'>(".date("Y-m-d H:i:s",$fmt).")</span> ".$filePath."<br/>";
				}
			}
			closedir($dh);
		}
	}
	$length = count($nums);
	$which = mt_rand(0, $length-1);
	$name = $Folder."/thumbnail/".$nums[$which];
	
	$UploadDirectory    = $_SERVER['DOCUMENT_ROOT'].'/ewatermark/file_upload/uploads/'; 
	$md5file = md5_file($dir."/".$nums[$which]);
	$url = $Folder;
	$sql= "insert into files (name,type,url,date) values ('$md5file','img','$url',now());";
	$db->query($sql);
	$db->close();
	
	echo "files/".$name;
	exit();
	//$UploadDirectory    = $_SERVER['DOCUMENT_ROOT'].'/ewatermark/file_upload/uploads/';
	
	
//}

//echo"laile";
?>