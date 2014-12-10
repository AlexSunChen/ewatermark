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
          <li class="active"><a href="about.php">宣伝</a></li>
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
        <h3 class="text-muted">写真Share</h3>
         
      </div>

      <div class="jumbotron">
        <p class="lead">写真Shareを用いて、友人と写真を手軽に共有しましょう！</p>
       <!-- <img src="image/posta.jpg"  width="580px;"/>-->
      </div>

      <div class="row marketing" style="margin-top:-40px;">
         <div class="section">
            <div class="page-header">
              <h1>友人と写真を共有したい！ <small>あなたならどうします？</small></h1>
            </div>
            <h3 class="alert alert-success" role="alert">メールを使いますか?</h3>
            <h4>写真をメールに添付して送りますか？共有したい写真が10枚も20枚もあったらどうします?それでもメールで送りたいですか?</h4>
            <h3 class="alert alert-success" role="alert">SNSサービスを使いますか?</h3>
            <label><h4>SNSサービスを用いて写真を共有しますか?友人はSNSサービスのアカウントを持っていますか?共有したい写真は知らない人に見せてもいいものですか?</h4></label>
            <div class="page-header">
              <h2>友人と写真を共有するなら写真Shareを使いましょう！</h2>
            </div>
            <label>
                <h4>写真Shareを使えば簡単に友人と写真を共有できます！あなたが友人に送るメールに添付する画像は1枚だけです。認証する際の鍵となる画像を送るだけで、あなたの共有するたくさんの画像にアクセスできます。</h4>
            </label>
        </div>

         <div class="list-group">
            <h2>写真Shareの使い方</h2>
            <h3 class="alert alert-danger" role="alert" name="setp1" >Step 1: 鍵となる画像を登録しましょう</h3>
            <a href="#setp1" class="list-group-item ">
            <h4 class="list-group-item-heading">あなたが最初に行うことは画像をアップロードしてアカウント登録することです。画像をアップロードするだけで、ユーザー名、パスワードを入力することなく簡単にアカウント登録できます。</h4>
            </a>
            <h3 class="alert alert-danger" role="alert" name="setp2" >Step 2: 友人に鍵画像を送信しましょう</h3>
                <a  href="#setp2" class="list-group-item ">
                 	<h4 class="list-group-item-heading">作成した鍵画像をメールを使って友人に送信しましょう！くれぐれもFacebookやTwitterなど、知らない人も鍵画像を見られるSNSサービスを使ってはいけません。</h4>
                </a>
            <h3 class="alert alert-danger" role="alert" name="setp3" >Step 3: ログインしましょう</h3>
            <a href="#setp3" class="list-group-item ">
                 	<h4 class="list-group-item-heading">トップページにある「画像認証」をクリックし、作成した鍵画像をアップロードしてログインしましょう。</h4>
            </a>
            <h3 class="alert alert-danger" role="alert" name="setp4">Step 4: 画像を共有しましょう！</h3>
            <a href="#setp4" class="list-group-item ">
                 	<h4 class="list-group-item-heading">画像をアップロードしたり、友人がアップロードした画像をダウンロードしたりして友人と画像を共有しましょう!</h4>
            </a>
        </div>
         
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
