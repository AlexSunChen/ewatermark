<?php 
     @session_start();
     if(!isset($_SESSION["NAME"]))
      {
	         header("Location: ../index.php");
             exit();
      }
	  //setcookie("user", $_SESSION["NAME"], time()-3600);
/*	  else if ($_SESSION["NAME"] != $_GET["name"])
	  {
		  header("Location: ../index.php");
         exit();
	  }*/
	  //$_SESSION["NAME"] = 100;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Force latest IE rendering engine or ChromeFrame if installed -->
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="../favicon.ico">
<title>写真Share</title>

<!-- Bootstrap core CSS -->
<link href="../dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="../css/jumbotron-narrow.css" rel="stylesheet">

<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="../assets/js/ie-emulation-modes-warning.js"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../assets/js/ie10-viewport-bug-workaround.js"></script>

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- fileupload -->
<!-- blueimp Gallery styles -->
<link rel="stylesheet" href="css/blueimp-gallery.min.css">
<link rel="stylesheet" href="../filedown/css/bootstrap-image-gallery.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="css/jquery.fileupload.css">
<link rel="stylesheet" href="css/jquery.fileupload-ui.css">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript>
<link rel="stylesheet" href="css/jquery.fileupload-noscript.css">
</noscript>
<noscript>
<link rel="stylesheet" href="css/jquery.fileupload-ui-noscript.css">
</noscript>

<!-- icheck plugin-->
<!--<link href="../skins/all.css?v=1.0.2" rel="stylesheet">-->

</head><body>
<div class="container">
  <div class="header">
    <ul class="nav nav-pills pull-right">
      <li><a href="../index.php">トップページ</a></li>
      <li><a href="../about.php">宣伝</a></li>
      <li><a href="../linkUs.php">連絡</a></li>
      <li class="active"><a href="#">Share領域</a></li>
      <li> <a href="../php/logout.php"> <span class="glyphicon glyphicon-off"></span> <span class="glyphicon-class">logout</span> </a> </li>
    </ul>
    <h3 class="text-muted">写真Share</h3>
  </div>
  <div class="jumbotron">
    <p class="lead">本サービスは撮った写真を自分用に整理したり、 友人と手軽に共有するためのサービスです。</p>
  </div>
  <div class="row marketing">
    <!--<form id="filedown" method="POST" enctype="multipart/form-data">-->
      <button type="button" class="btn btn-success fileinput-button" data-toggle="modal" data-target=".upload-modal-lg"> <i class="glyphicon glyphicon-upload"></i> <span>Upload</span></button>
      <button id="downimg" class="btn btn-primary"> <i class="glyphicon glyphicon-arrow-down"></i><span>Download</span> </button>
      <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".img-delete"> <i class="glyphicon glyphicon-trash"></i> <span>delete</span> </button>
      <div style="float:right;" class="btn-group" data-toggle="buttons">
        <label class="btn btn-success"> <i class="glyphicon glyphicon-leaf"></i>
          <input id="borderless-checkbox" type="checkbox">style 
        </label>
        <label class="btn btn-primary"> <i class="glyphicon glyphicon-fullscreen"></i>
          <input id="fullscreen-checkbox" type="checkbox">
          Fullscreen </label>
      </div>
       <!-- image show -->
      <!-- The container for the list of share images -->
      <div style="clear:both"></div>
      <br />
      	<div class="row">
       		<div class="imgs">
           </div>  
       </div>
    <!--</form>-->
    
   
      <!-- display template start-->
		<script type="text/x-tmpl" id="showImg">
             {% for (var i=0, file; file=o.files[i]; i++) { %}
                  <div class="col-xs-6 col-md-3">
				  	<table>
						<tr>
					      <td style="vertical-align:top; padding-right:2px;">
				  	        <label>
						      <input type="checkbox" id="blankCheckbox" value="{%=file.url%}" name="{%=file.name%}" aria-label="...">
					        </label>
					       </td>
						   <td>
                    <a class="thumbnail" href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img style="width:171px; height:120px" src="{%=file.thumbnailUrl%}" data-src="holder.js/100%x180" ></a>
							</td>
						</tr>
						</table>
                  </div>
				  
             {% } %}
        </script>
       <!-- display template over-->

  </div>
  <!-- The blueimp Gallery widget --> 
  <!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
  <div id="blueimp-gallery" class="blueimp-gallery"> 
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">‹</a> <a class="next">›</a> <a class="close">×</a> <a class="play-pause"></a>
    <ol class="indicator">
    </ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" aria-hidden="true">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body next"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left prev"> <i class="glyphicon glyphicon-chevron-left"></i> Previous </button>
            <button type="button" class="btn btn-primary next"> Next <i class="glyphicon glyphicon-chevron-right"></i> </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Image Gallery lightbox over-->
  <div class="footer">
    <p>&copy; 電子透かしグループ  PBL作品　2014 &nbsp;&nbsp;<button type="button" data-toggle="modal" data-target=".zone-delete"> <i class="glyphicon glyphicon-trash"></i> <span>zone delete</span> </button></p>
    
  </div>
  
</div>
<!-- /container --> 


<!-- Small modal -->
<div class="modal fade img-delete" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    
        <div class="alert alert-danger alert-dismissible fade in" role="alert" style="margin-bottom:-20px;">
      	 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
      	 <h4>警告！</h4>
        <p>Are you sure to Delete your images?</p>
        <div class="alert alert-warning" role="alert" id="loading2"></div>
        <p>
        <button type="button" class="btn btn-danger" name="<?php echo $_SESSION["NAME"]  ?>" id="delete-img">Yes! I sure</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Or return</button>
        </p>
    </div>
    
    </div>
  </div>
</div>

<!-- Small modal -->
<div class="modal fade zone-delete" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    
        <div class="alert alert-danger alert-dismissible fade in" role="alert" style="margin-bottom:-20px;">
      	 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
      	 <h4>警告！</h4>
        <p>Are you sure to Delete your image zone from our server?</p>
        <div class="alert alert-warning" role="alert" id="loading"></div>
        <p>
        <button type="button" class="btn btn-danger" name="<?php echo $_SESSION["NAME"]  ?>" id="delete-zone">Yes! I sure</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Or return</button>
        </p>
    </div>
    
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade upload-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="panel panel-warning">
        <div class="panel-heading">
          <h3 class="panel-title">FileUpload</h3>
          <!--<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>--> 
        </div>
        <div class="panel-body"> 
          <!-- The file upload form used as target for the file upload widget -->
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
                <button type="button" class="btn btn-danger delete"> <i class="glyphicon glyphicon-trash"></i> <span>Delete</span> </button>
                <input type="checkbox" class="toggle">
                <!-- The global file processing state --> 
                <span class="fileupload-process"></span> </div>
              <!-- The global progress state -->
              <div class="col-lg-7 fileupload-progress fade"> 
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                  <div class="progress-bar progress-bar-success" style="width:0%;"></div>
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
                        {% if (file.thumbnailUrl) { %}
                            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                        {% } %}
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
                    {% if (file.deleteUrl) { %}
                        <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                            <i class="glyphicon glyphicon-trash"></i>
                            <span>Delete</span>
                        </button>
                        <input type="checkbox" name="delete" value="1" class="toggle">
                    {% } else { %}
                        <button class="btn btn-warning cancel">
                            <i class="glyphicon glyphicon-ban-circle"></i>
                            <span>Cancel</span>
                        </button>
                    {% } %}
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
<script src="js/jquery.min.js"></script> 
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included --> 
<script src="js/vendor/jquery.ui.widget.js"></script> 
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included --> 
<script src="../assets/js/vendor/holder.js"></script> 
<!-- The Templates plugin is included to render the upload/download listings --> 
<script src="js/tmpl.min.js"></script> 
<!-- The Load Image plugin is included for the preview images and image resizing functionality --> 
<script src="js/load-image.all.min.js"></script> 
<!-- The Canvas to Blob plugin is included for image resizing functionality --> 
<script src="js/canvas-to-blob.min.js"></script> 
<!-- Bootstrap JS is not required, but included for the responsive demo navigation --> 
<script src="js/bootstrap.min.js"></script> 
<!-- blueimp Gallery script --> 
<script src="js/jquery.blueimp-gallery.min.js"></script> 
<script src="../filedown/js/bootstrap-image-gallery.js"></script> 
<!-- The Iframe Transport is required for browsers without support for XHR file uploads --> 
<script src="js/jquery.iframe-transport.js"></script> 
<!-- The basic File Upload plugin --> 
<script src="js/jquery.fileupload.js"></script> 
<!-- The File Upload processing plugin --> 
<script src="js/jquery.fileupload-process.js"></script> 
<!-- The File Upload image preview & resize plugin --> 
<script src="js/jquery.fileupload-image.js"></script> 
<!-- The File Upload audio preview plugin --> 
<script src="js/jquery.fileupload-audio.js"></script> 
<!-- The File Upload video preview plugin --> 
<script src="js/jquery.fileupload-video.js"></script> 
<!-- The File Upload validation plugin --> 
<script src="js/jquery.fileupload-validate.js"></script> 
<!-- The File Upload user interface plugin --> 
<script src="js/jquery.fileupload-ui.js"></script> 
<!-- The icheck user interface plugin --> 
<script src="../js/icheck.js?v=1.0.2"></script> 
<!-- The main application script --> 
<script src="js/main.js"></script> 
<script src="../filedown/js/mainCtl.js"></script> 
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 --> 
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="js/cors/jquery.xdr-transport.js"></script>
<![endif]--> 
<script type="text/javascript">
//$('#scroll_bar').scrollspy({ target: '.navbar' })
</script>
</body>
</html>
