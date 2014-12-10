<?php
/*
 * File UploadProcess PHP 1.1.0
 *
 * Copyright 2014, SunChen
 * http://153.121.76.133/ewatermark/ImgList.html
 */

error_reporting(E_ALL | E_STRICT);
require('UploadHandler.php');
//file_put_contents("./ls.txt","laile,laile,laile",FILE_APPEND);
//$upload_handler = new UploadHandler();
//header('Vary: Accept');

//if (isset($_SERVER['HTTP_ACCEPT']) &&
//    (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
//        header('Content-type: application/json');
//    } else {
//        header('Content-type: text/plain');
//    }
//$upload_handler = new UploadHandler();



class CustomUploadHandler extends UploadHandler {
    protected function get_user_id() {
         @session_start();
         return $_SESSION['NAME'];
     }
}
//$upload_handler = new CustomUploadHandler();

$upload_handler = new CustomUploadHandler(array(
     'user_dirs' => true
));


//$upload_handler = new CustomUploadHandler($options);