<?php
		$name = $_POST['name'];
		$location = $_POST['location'];
		
	    file_put_contents("log.txt", "name: ".$name." "."Location: ".$location."\r", FILE_APPEND);
		
		$arr = array(
			'msg'  => "success",
			'info' => "come on"
		);
		
		$response = json_encode($arr);
		echo  $response; 
		
?>
