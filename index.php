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
    
    <!-- Bootstrap tour  -->
    <link href="css/bootstrap-tour.min.css" rel="stylesheet">


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
    
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="fileupload/css/jquery.fileupload.css">
    <link rel="stylesheet" href="fileupload/css/jquery.fileupload-ui.css">
    <!-- CSS adjustments for browsers with JavaScript disabled -->
    <noscript>
    <link rel="stylesheet" href="fileupload/css/jquery.fileupload-noscript.css">
    </noscript>
    <noscript>
    <link rel="stylesheet" href="fileupload/css/jquery.fileupload-ui-noscript.css">
    </noscript>
    
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
        <h3 class="text-muted">写真Share</h3>
      </div>

      <div class="jumbotron">
        <h1>PhotoAlbum</h1>
        <p class="lead">写真Shareを用いて、友人と写真を手軽に共有しましょう！</p>
        <?php
		  	 if (isset($_SESSION["NAME"])){
		  ?>
          <p><a class="btn btn-lg btn-success" href="./fileupload/ImgList.php" role="button">あなたの領域へ</a>
        <?php
		   }else {
        ?>
        <p style="margin-top:40px;"></p>
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
          <p>鍵となる画像を友人に送るだけで写真を共有できます。</p>

          <h4>安全</h4>
          <p>画像を鍵として用いるため他人に鍵だと推測されず、安全に写真を交換できます。</p>

          <h4>簡単</h4>
          <p>面倒なアカウント登録作業をする必要がなく、すぐにサービスを開始することができます。また、画像を鍵として用いるため、面倒なログイン作業は必要ありません。</p>
        </div>

        <div class="col-lg-6">
          <h4>個人情報入力なし・パスワードなし</h4>
          <p>鍵となる画像をアップロードするだけでアカウント登録できます。</p>

          <h4>ファッション</h4>
          <p>手軽で安全に写真を共有できる写真Shareを用いて今すぐ写真を共有しましょう!</p>

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
        <div class ="alert alert-success" role="alert" >鍵画像をアップロードしてください。</div>
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

<!-- Modal2 已经弃用-->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h1 class="modal-title" id="myModalLabel"> <span class="label label-primary">新規登録</span></h1>
        
      </div>
      <div class="modal-body">
      <div class="alert alert-info" role="alert" >ようこそ、写真Shareサビースを使用しました。<br/><br/>今から、試してみましょうか</div>
      	<form id="new" role="form" >
        </form>
           <form id="new" role="form" >
              <div class="form-group">
                <h4 for="exampleInputFile" ><span class="label label-primary">File input</span></h4>
                <input id="input2" name="imgupload" type="file" class="file">
                <br />
                <p class="alert alert-warning">Upload your image and use our service Now!</p>
                <div class="alert alert-danger" role="alert"></div>
              </div>
              <img src="image/ajax-loader.gif" class="loading-img" style="display:none;" alt="Please Wait"/>
              <div class="progressbox" >
              		<div class="progressbar"></div >
                  <div class="statustxt">0%</div>
              </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade upload-modal-lg" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="panel panel-warning">
        <div class="panel-heading">
          <h3 class="panel-title">鍵となる画像をアップロードして、アカウント登録を行いましょう</h3>
          <!--<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>--> 
        </div>
        <div class="panel-body"> 
          <!-- The file upload form used as target for the file upload widget -->
          <p class="alert alert-warning">Upload your image and use our service Now!</p>
          <div id="result" class="alert alert-danger" role="alert"></div>
          <form id="fileupload"  method="POST" enctype="multipart/form-data">
            <!-- Redirect browsers with JavaScript disabled to the origin page -->
            <noscript>
            <input type="hidden" name="redirect" value="">
            </noscript>
            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
            <div class="row fileupload-buttonbar">
              <div class="col-lg-12"> 
                <!-- The fileinput-button span is used to style the file input field as button --> 
                <span class="btn btn-success fileinput-button"> <i class="glyphicon glyphicon-plus"></i> <span>Add files...</span>
                <input type="file" name="files[]" multiple>
                </span>
                <button type="submit" class="btn btn-primary start"> <i class="glyphicon glyphicon-upload"></i> <span>Start upload</span> </button>
                <button type="reset" class="btn btn-warning cancel"> <i class="glyphicon glyphicon-ban-circle"></i> <span>Cancel upload</span> </button>
                <!--
                <button type="button" class="btn btn-danger delete"> <i class="glyphicon glyphicon-trash"></i> <span>Delete</span> </button>
                <input type="checkbox" class="toggle">-->
                <!-- The global file processing state --> 
                <span class="fileupload-process"></span> </div>
              <!-- The global progress state -->
              <div class="col-lg-7 fileupload-progress fade"> 
                <!-- The global progress bar -->
                <div class="progress progress-striped active"  role="progressbar" aria-valuemin="0" aria-valuemax="100">
                  <div class="progress-bar progress-bar-success" id="allprocess" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
              </div>
            </div>
            <!-- The table listing the files available for upload/download -->
            <table role="presentation" class="table table-striped">
              <tbody class="files">
              </tbody>
            </table>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
        <!--<button type="button" class="btn btn-primary">アップロード</button>--> 
      </div>
      
      <!-- The template to display files available for upload --> 
      <script id="template-upload" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-upload fade">
                <td>
                    <span class="preview"></span>
                </td>
                <td>
                    <p class="name">{%=file.name%}</p>
                    <strong class="error text-danger"></strong>
                </td>
                <td>
                    <p class="size">Processing...</p>
                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
                </td>
                <td>
                    {% if (!i && !o.options.autoUpload) { %}
                        <button class="btn btn-primary start" disabled>
                            <i class="glyphicon glyphicon-upload"></i>
                            <span>Start</span>
                        </button>
                    {% } %}
                    {% if (!i) { %}
                        <button class="btn btn-warning cancel">
                            <i class="glyphicon glyphicon-ban-circle"></i>
                            <span>Cancel</span>
                        </button>
                    {% } %}
                </td>
            </tr>
        {% } %}
        </script> 
      <!-- The template to display files available for download --> 
      <!-- The template to display files available for download --> 
      <script id="template-download" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-download fade">
                <td>
                    <span class="preview">
                       
                    </span>
                </td>
                <td>
                    <p class="name">
                        {% if (file.url) { %}
                            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                        {% } else { %}
                            <span>{%=file.name%}</span>
                        {% } %}
                    </p>
                    {% if (file.error) { %}
                        <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                    {% } %}
                </td>
                <td>
                    <span class="size">{%=o.formatFileSize(file.size)%}</span>
                </td>
                <td>
                   
                </td>
            </tr>
        {% } %}
        </script> 
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
    
    <!-- Bootstrap tour -->
    <script src="js/bootstrap-tour.min.js"></script>
    
        <!-- Bootstrap core JavaScript
        ================================================== --> 
    <!-- Placed at the end of the document so the pages load faster --> 
    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included --> 
    <script src="fileupload/js/vendor/jquery.ui.widget.js"></script> 
    <!-- The Templates plugin is included to render the upload/download listings --> 
    <script src="fileupload/js/tmpl.min.js"></script> 
    <!-- The Load Image plugin is included for the preview images and image resizing functionality --> 
    <script src="fileupload/js/load-image.all.min.js"></script> 
    <!-- The Canvas to Blob plugin is included for image resizing functionality --> 
    <script src="fileupload/js/canvas-to-blob.min.js"></script> 
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads --> 
    <script src="fileupload/js/jquery.iframe-transport.js"></script> 
    <!-- The basic File Upload plugin --> 
    <script src="fileupload/js/jquery.fileupload.js"></script> 
    <!-- The File Upload processing plugin --> 
    <script src="fileupload/js/jquery.fileupload-process.js"></script> 
    <!-- The File Upload image preview & resize plugin --> 
    <script src="fileupload/js/jquery.fileupload-image.js"></script> 
    <!-- The File Upload audio preview plugin --> 
    <script src="fileupload/js/jquery.fileupload-audio.js"></script> 
    <!-- The File Upload video preview plugin --> 
    <script src="fileupload/js/jquery.fileupload-video.js"></script> 
    <!-- The File Upload validation plugin --> 
    <script src="fileupload/js/jquery.fileupload-validate.js"></script> 
    <!-- The File Upload user interface plugin --> 
    <script src="fileupload/js/jquery.fileupload-ui-index.js"></script> 
    <!-- The main application script --> 
    <script type="text/javascript" src="fileupload/js/main_index.js"></script>
    <script type="text/javascript" >
					// prepare the form when the DOM is ready 
	
	</script>
    
  </body>
</html>
