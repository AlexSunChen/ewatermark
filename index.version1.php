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
    
    <!-- fileinput plugin -->
    <link href="./css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
  </head>

  <body>

    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="index.php">トップページ</a></li>
          <li><a href="about.php">宣伝</a></li>
          <li><a href="linkUs.php">連絡</a></li>
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
        <h3 class="text-muted">写真Shareサービス</h3>
      </div>

      <div class="jumbotron">
        <h1>PhotoAlbum</h1>
        <p class="lead">本サービスは撮った写真を自分用に整理したり、
友人と手軽に共有するためのサービスです。</p>
        <?php
		  	 if (isset($_SESSION["NAME"])){
		  ?>
          <p><a class="btn btn-lg btn-success" href="./fileupload/ImgList.php" role="button">あなたの領域へ</a>
        <?php
		   }else {
        ?>
        <p><a class="btn btn-lg btn-success" href="#" role="button" data-toggle="modal" data-target="#myModal">画像認証</a>
        &nbsp;&nbsp;&nbsp;
           <a class="btn btn-lg btn-primary" href="#" role="button" data-toggle="modal" data-target="#myModal2">新規登録</a>
        </p>
        <?php
		   }
        ?>
      </div>
	  

      <div class="row marketing">
        <div class="col-lg-6">
          <h4>手軽</h4>
          <p>友人に鍵となる画像を送るだけで手軽に写真を共有できます。</p>

          <h4>安全</h4>
          <p>画像を鍵として用いるため他人に鍵だと推測されず、安全に写真を交換できます。</p>

          <h4>簡単</h4>
          <p>面倒なアカウント登録作業をする必要がなく、すぐにサービスを開始することができます。
また、画像を鍵として用いるため、面倒なログイン作業は必要ありません。</p>
        </div>

        <div class="col-lg-6">
          <h4>個人情報入力なし</h4>
          <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

          <h4>パスワードなし</h4>
          <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

          <h4>ファッション</h4>
          <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div>
      </div>

      <div class="footer">
        <p>&copy; 電子透かしグループ  PBL作品　2014</p>
      </div>

    </div> <!-- /container -->



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <!--<h4 class="modal-title" id="myModalLabel">画像認証</h4>-->
        <h1 class=" modal-title" id="myModalLabel"> <span class="label label-success">画像認証</span></h1>
      </div>
      <div class="modal-body">
        <div class ="alert alert-success" role="alert" > どうぞ〜アップロードあなたの認証画像!</div>
        <form id="access" role="form" >
              <div class="form-group">
                <h4 for="exampleInputFile" ><span class="label label-success">Image input</span></h4>
                <!--<input id="input1" type="file"  name="imgaccess" id="exampleInputFile">-->
                <input id="input1" name="imgaccess" type="file" class="file">
                <!--<p class="help-block">どうぞ〜アップロードあなたの認証画像!</p>-->
                <br/>
                <div id="output1" hidden="true"  class="alert alert-danger" role="alert"></div>
              </div>
              <!--<button type="submit" class="btn btn-default">Submit</button>-->
     
              <img src="image/ajax-loader.gif" class="loading-img" style="display:none;" alt="Please Wait"/>
              <div class="progressbox" >
              		<div class="progressbar"></div >
                  <div class="statustxt">0%</div>
              </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
        <!--<button type="button" class="btn btn-primary">アップロード</button>-->
      </div>
    </div>
  </div>
</div>

<!-- Modal2 -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h1 class="modal-title" id="myModalLabel"> <span class="label label-primary">新規登録</span></h1>
        
      </div>
      <div class="modal-body">
      <div class="alert alert-info" role="alert" >ようこそ、写真Shareサビースを使用しました。<br/><br/>今から、試してみましょうか</div>
           <form id="new" role="form" >
              <div class="form-group">
                <h4 for="exampleInputFile" ><span class="label label-primary">File input</span></h4>
                <!--<input id = "input2"type="file" name="imgupload" id="exampleInputFile">-->
                <input id="input2" name="imgupload" type="file" class="file">
                <br />
                <p class="alert alert-warning">Upload your image and use our service Now!</p>
                <div id="output2" class="alert alert-danger" role="alert"></div>
              </div>
              <!--<button type="submit" class="btn btn-default">Submit</button>-->
              <img src="image/ajax-loader.gif" class="loading-img" style="display:none;" alt="Please Wait"/>
              <div class="progressbox" >
              		<div class="progressbar"></div >
                  <div class="statustxt">0%</div>
              </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
        <!--<button type="button" class="btn btn-primary">登録</button>-->
      </div>
    </div>
  </div>
</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.form.js"></script>
    <script src="./js/fileinput.js" type="text/javascript"></script>
	<script type="text/javascript" src="dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/main.js" ></script>
    <script type="text/javascript" >
					// prepare the form when the DOM is ready 
	
	</script>
    
  </body>
</html>
