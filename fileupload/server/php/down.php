<?php

 $name = $_GET["name"];
 //file_put_contents("./log.txt", $name."\r",FILE_APPEND);
 header("Cache-Control: public");
 header("Content-Description: File Transfer");
 header('Content-disposition: attachment; filename='.basename($name)); //文件名
 header("Content-Type: application/zip"); //zip格式的
 header("Content-Transfer-Encoding: binary"); //告诉浏览器，这是二进制文件
 header('Content-Length: '. filesize($name)); //告诉浏览器，文件大小
 @readfile($name);
 unlink ($name);
?>