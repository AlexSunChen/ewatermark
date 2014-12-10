<?php
/*
 * File UploadProcess PHP 1.1.0
 *
 * Copyright 2014, SunChen
 * http://153.121.76.133/ewatermark/ImgList.html
 */
 
//file_get_contents();
require_once('conn.php');
header("Content-Type: text/html;charset=uft-8");
header("Cache-Control: no-cache");

if(isset($_FILES["imgaccess"]) && $_FILES["imgaccess"]["error"]== UPLOAD_ERR_OK)
{
    ############ Edit settings ##############
    $UploadDirectory    = $_SERVER['DOCUMENT_ROOT'].'/ewatermark/file_upload/uploads/'; //specify upload directory ends with / (slash)
    ##########################################
    
    /*
    Note : You will run into errors or blank page if "memory_limit" or "upload_max_filesize" is set to low in "php.ini". 
    Open "php.ini" file, and search for "memory_limit" or "upload_max_filesize" limit 
    and set them adequately, also check "post_max_size".
    */
    
    //check if this is an ajax request
		if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
			$arr = array(
						'msg' => "your have no permit"
					);
			$response = json_encode($arr);
			echo $response;
			exit();
			//die();
		}
		
		//Is file size is less than allowed size.
		if ($_FILES["imgaccess"]["size"] > 5242880) {
			//die("File size is too big!");
			$arr = array(
						'msg' => "File size is too big!"
					);
			$response = json_encode($arr);
			echo $response;
			exit();
		}
		
		//allowed file type Server side check
		switch(strtolower($_FILES['imgaccess']['type'])){
				//allowed file types
				case 'image/png': 
				case 'image/gif': 
				case 'image/jpeg': 
				case 'image/pjpeg':
					break;
				default:
					//die('Unsupported File!'); //output error
					$arr = array(
						'msg' => "Unsupported File!"
					);
					$response = json_encode($arr);
					echo $response;
					exit();
		}
    
    $File_Name          = strtolower($_FILES['imgaccess']['name']);
    $File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
    $Random_Number      = rand(0, 9999999999); //Random number to be added to name.
    $NewFileName        = $Random_Number.$File_Ext; //new file name
    if(move_uploaded_file($_FILES['imgaccess']['tmp_name'], $UploadDirectory.$NewFileName ))
    {
        // do other stuff 
		$md5file = md5_file($UploadDirectory.$NewFileName);
		$sql= "select name,url from files where name ='$md5file'";
	    $res = $db->query($sql);
		//file_put_contents("./log.txt", "daoledaole", FILE_APPEND);
		if( ($row=$db->fetch_array($res)) ){
        
		  $url  = $row['url'];
		  $info = array(
	  		'msg'=>'Access Success!',
			'name'=> $url
	      );
		  @session_start();
		  $_SESSION['NAME'] = $url;
		  
		}else {
			$info = array(
	  		'msg'=>'認証画像違いました！'
	        );
			// die('認証画像違いました！');
		}

//两种方法提供json返回一种json字符串拼接 另外一种使用json_encode编码
	  //	 $url = "success";
      //  $info = '{"info":"'.$url.'"}';
	  $db->close();
	  $response = json_encode($info);
		//die('success');
    }else{
		$info = array(
	  		'msg'=>'error uploading File!'
	    );
		
	    $response = json_encode($info);
		// $info = '{"msg":"error uploading File!"}';
       // die('error uploading File!');
    }
	unlink($UploadDirectory.$NewFileName);
   echo $response;
   exit();
}
elseif(isset($_FILES["imgupload"]) && $_FILES["imgupload"]["error"]== UPLOAD_ERR_OK){
	
		############ Edit settings ##############
		$UploadDirectory    = '../file_upload/'; //specify upload directory ends with / (slash) the temp dir for MD5
		##########################################

		//check if this is an ajax request
		if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
			$arr = array(
						'msg' => "your have no permit"
					);
			$response = json_encode($arr);
			echo $response;
			exit();
			//die();
		}
		
		//Is file size is less than allowed size.
		if ($_FILES["imgupload"]["size"] > 5242880) {
			//die("File size is too big!");
			$arr = array(
						'msg' => "File size is too big!"
					);
			$response = json_encode($arr);
			echo $response;
			exit();
		}
		
		//allowed file type Server side check
		switch(strtolower($_FILES['imgupload']['type'])){
				//allowed file types
				case 'image/png': 
				case 'image/gif': 
				case 'image/jpeg': 
				case 'image/pjpeg':
					break;
				default:
					//die('Unsupported File!'); //output error
					$arr = array(
						'msg' => "Unsupported File!"
					);
					$response = json_encode($arr);
					echo $response;
					exit();
		}
		
		$File_Name          = strtolower($_FILES['imgupload']['name']);
		$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
		$Random_Number      = rand(0, 9999999999); //Random number to be added to name.
		$NewFileName        = $Random_Number.$File_Ext; //new file name
		if(move_uploaded_file($_FILES['imgupload']['tmp_name'], $UploadDirectory.$NewFileName ))
		{
			// do other stuff
			$md5file = md5_file($UploadDirectory.$NewFileName);
			$path = $_SERVER['DOCUMENT_ROOT']."/ewatermark/fileupload/server/php/files/".$md5file;
			$url = $_SERVER['DOCUMENT_ROOT']."/ewatermark/fileupload/server/php/files/";
			if(!mkdir($path, 0755, true)){
					//file_put_contents("./log.txt", "zhuse", FILE_APPEND);
					unlink($UploadDirectory.$NewFileName);
					$arr = array(
						'msg' => "file already existed, please chage other image"
					);
					$response = json_encode($arr);
					echo $response;
					exit();
					//die( "die! no file's permition to access");
			}
			$sql= "insert into files (name,type,url,date) values ('$md5file','img','$url',now());";
			$db->query($sql);
			$db->close();
			$arr = array(
				'msg' => "Success! File Uploaded.",
				'url' => "/ewatermark/file_upload/".$NewFileName
			);
			$response = json_encode($arr);
			//die("success!");
		}else{
			$arr = array(
				'msg' => "error uploading File!"
			);
			$response = json_encode($arr);
			//die('error uploading File!');
		}
		unlink($UploadDirectory.$NewFileName);
		echo  $response;
		exit();
		
}else
{
		$arr = array(
				'msg' => 'Something wrong with upload! Is "upload_max_filesize" set correctly?'
			);
		$response = json_encode($arr);
		echo $response;
		exit();
		//die('Something wrong with upload! Is "upload_max_filesize" set correctly?');
}

?>
