<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/ewatermark/php/conn.php");

	$dir = $_SERVER['DOCUMENT_ROOT']."/ewatermark/fileupload/server/php/files/6e246ea976d90aef3fd131db22249515/thumbnail";  //要获取的目录
	echo "********** 获取目录下所有文件和文件夹 ***********<hr/>";
	//先判断指定的路径是不是一个文件夹
	$nums = array();
	if (is_dir($dir)){
		if ($dh = opendir($dir)){
			while (($file = readdir($dh))!= false){
				//文件名的全路径 包含文件名
				if(substr($file,0,1) != "."){
					$filePath = $dir.$file;
					//获取文件修改时间
					$fmt = filemtime($filePath);
					$nums[] = $file;
					echo "<span style='color:#666'>(".date("Y-m-d H:i:s",$fmt).")</span> ".$filePath."<br/>";
				}
			}
			closedir($dh);
		}
	}
	rsort($nums);
	$length = count($nums);
	$which = mt_rand(0, $length-1);
	echo $nums[$which];
	/*
	foreach ($nums as $key => $val) {
    	echo "$key = $val <br />";
	}
	*/





$indicesServer = array('PHP_SELF', 
'argv', 
'argc', 
'GATEWAY_INTERFACE', 
'SERVER_ADDR', 
'SERVER_NAME', 
'SERVER_SOFTWARE', 
'SERVER_PROTOCOL', 
'REQUEST_METHOD', 
'REQUEST_TIME', 
'REQUEST_TIME_FLOAT', 
'QUERY_STRING', 
'DOCUMENT_ROOT', 
'HTTP_ACCEPT', 
'HTTP_ACCEPT_CHARSET', 
'HTTP_ACCEPT_ENCODING', 
'HTTP_ACCEPT_LANGUAGE', 
'HTTP_CONNECTION', 
'HTTP_HOST', 
'HTTP_REFERER', 
'HTTP_USER_AGENT', 
'HTTPS', 
'REMOTE_ADDR', 
'REMOTE_HOST', 
'REMOTE_PORT', 
'REMOTE_USER', 
'REDIRECT_REMOTE_USER', 
'SCRIPT_FILENAME', 
'SERVER_ADMIN', 
'SERVER_PORT', 
'SERVER_SIGNATURE', 
'PATH_TRANSLATED', 
'SCRIPT_NAME', 
'REQUEST_URI', 
'PHP_AUTH_DIGEST', 
'PHP_AUTH_USER', 
'PHP_AUTH_PW', 
'AUTH_TYPE', 
'PATH_INFO', 
'ORIG_PATH_INFO') ; 

echo '<table cellpadding="10">' ; 
foreach ($indicesServer as $arg) { 
    if (isset($_SERVER[$arg])) { 
        echo '<tr><td>'.$arg.'</td><td>' . $_SERVER[$arg] . '</td></tr>' ;
    } 
    else { 
        echo '<tr><td>'.$arg.'</td><td>-</td></tr>' ; 
    } 
} 
echo '</table>' ; 


?>