<?php
require('db.class.php');
$dbhost = 'localhost' ;
$dbuser = 'root';
$dbpw = '87276495';
$dbname = 'ImageShare';
$dbcharset = 'utf8';
$db =  new class_db();
$db->connect($dbhost, $dbuser, $dbpw, $dbname, $dbcharset);

  

