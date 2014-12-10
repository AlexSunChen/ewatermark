<?php 
     @session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./favicon.ico">

    <title>写真Share</title>

    <!-- Bootstrap core CSS -->
    <link href="./dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/jumbotron-narrow.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./assets/js/ie-emulation-modes-warning.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./assets/js/ie10-viewport-bug-workaround.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <div class="header">
       
        <ul class="nav nav-pills pull-right">
          <li><a href="index.php">トップページ</a></li>
          <li><a href="about.php">宣伝</a></li>
          <li class="active"><a href="linkUs.php">連絡</a></li>
           <?php
		  	 if (isset($_SESSION["NAME"])){
		   ?>
           <li><a href="./fileupload/ImgList.php">Share領域</a></li>
           <li>
      	  	 <a href="./php/logout.php">
           	<span class="glyphicon glyphicon-off"></span>
               <span class="glyphicon-class">logout</span>
         	 </a>
          </li>
          <?php
		   }
          ?>
        </ul>
        <h3 class="text-muted">写真Share</h3>
         
      </div>

      <div class="jumbotron">
       <p class="lead">本サービスは撮った写真を自分用に整理したり、 友人と手軽に共有するためのサービスです。</p>
      </div>

      <div class="row marketing">
            <table class="table">
				 <tr class="bg-primary"> <td>** **</td> <td>email:</td> <td>Phone:</td></tr>
               <tr class="bg-success"> <td>**　**</td> <td>email:</td> <td>Phone:</td> </tr>
               <tr class="bg-info">    <td>**　**</td> <td>email:</td> <td>Phone:</td> </tr>
               <tr class="bg-warning"> <td>**　**</td> <td>email:</td> <td>Phone:</td> </tr>
               <tr class="bg-danger">  <td>**  **</td>    <td>email:</td> <td>Phone:</td> </tr>
            </table>
      </div>

      <div class="footer">
        <p>&copy; 電子透かしグループ  PBL作品　2014</p>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
