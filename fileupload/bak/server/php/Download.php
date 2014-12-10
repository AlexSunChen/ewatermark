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

error_reporting(E_ALL | E_STRICT);
require('DownloadHandler.php');

// header('Vary: Accept');

// if (isset($_SERVER['HTTP_ACCEPT']) &&
//     (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
//         header('Content-type: application/json');
//     } else {
//         header('Content-type: text/plain');
//     }
$Download_handler = new DownloadHandler();
//file_put_contents("./log.txt", "laile",FILE_APPEND);
//$Download_handler->download();