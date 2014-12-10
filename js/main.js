  /*
 * File Upload Access main 1.1.0
 * http://153.121.76.133/ewatermark/ImgList.html
 *
 * Copyright 2014, SunChen
 * http://153.121.76.133/ewatermark/ImgList.html
 */    
	   // JavaScript Document
$(function(){
		// model access 
		$('#output1').hide();
		$('#output2').hide();
		$('.progressbox').hide(); //hide progress bar
		$('#access').on("submit",function() {
			var options = { 
				target:        '#output1',   // target element(s) to be updated with server response 
				beforeSubmit:  showRequest,  // pre-submit callback 
				success:       afterSuccess,  // post-submit callback 
		        uploadProgress: OnProgress, //upload progress callback 
				// other available options: 
				url:       '/ewatermark/php/uploadprocess.php',         // override for form's 'action' attribute 
				type:      'post',        // 'get' or 'post', override for form's 'method' attribute 
				dataType:  'json',        // 'xml', 'script', or 'json' (expected server response type) 
				clearForm: true,        // clear all form fields after successful submit 
				resetForm: true,        // reset the form after successful submit 
		 		xhrFields: {
					  input: '#input1'	  
				}
				// $.ajax options can be used here too, for example: 
				//timeout:   3000 
			}
			// bind form using 'ajaxForm' 
			//$('#access').ajaxForm(options); 
			   $('#access').ajaxSubmit(options);  			
			   // always return false to prevent standard browser submit and page navigation 
			   return false; 
		}); 
		
		// model new 
		$('#new').on("submit",function() {
			var options = { 
				target:        '#output2',   // target element(s) to be updated with server response 
				beforeSubmit:  showRequest,  // pre-submit callback 
				success:       afterSuccess2,  // post-submit callback 
		       uploadProgress: OnProgress, //upload progress callback 
				// other available options: 
				url:       '/ewatermark/php/uploadprocess.php',         // override for form's 'action' attribute 
				type:      'post',        // 'get' or 'post', override for form's 'method' attribute 
				dataType:  'json',        // 'xml', 'script', or 'json' (expected server response type) 
				clearForm: true,        // clear all form fields after successful submit 
				resetForm: true,        // reset the form after successful submit 
		 		xhrFields: {
					  input: '#input2'	  
				}
			}
			$('#new').ajaxSubmit(options);  			
			   // always return false to prevent standard browser submit and page navigation 
			return false; 
		}); 
		
		// common function
		function afterSuccess(responseText, statusText, xhr, $form)
		{
			//$('#btn1').css("disabled", disabled); //hide submit button
			
			$('.loading-img').hide(); //hide submit button
			$('.progressbox').delay( 1000 ).fadeOut(); //hide progress bar
			//var node = '<img src="'+responseText+'" width = 80px height = 80px>';
			//$(node).insertAfter(xhr.target);
			//alert(responseText.info);
			
//			var test0 = '{"url":"http://fdfdsfsdf.com/fdfdsf/dsad"}';
//			var test = eval("("+test0+")");
//			var node = '<img src="'+test.url+'" width = 80px height = 80px>';
//			if(test.url){  
//				alert(node);  //显示
//			}else{
//				alert("0");  
//			}
			$('#output1').show();
			$('#output1').html(responseText.msg).delay( 3000 ).fadeOut();
		
			if(responseText.name){
				  //var hrefdown = "./fileupload/ImgList.php?name="+responseText.name;
				  setTimeout(function () {
					var hrefdown = "./fileupload/ImgList.php";
                  location.href= hrefdown;	
				  }, 1000);
			}
		}
		function afterSuccess2(responseText, statusText, xhr, $form)
		{
			//$('#btn1').css("disabled", disabled); //hide submit button
			$('.loading-img').hide(); //hide submit button
			$('.progressbox').delay( 1000 ).fadeOut(); //hide progress bar
			$('#output2').show();
			$('#output2').html(responseText.msg).delay( 3000 ).fadeOut();
		//	if(responseText.url){
		//		var node = '<img src="'+responseText.url+'" width = 80px height = 80px>';
		//		$(node).insertAfter('#output2');
		//	}
		//     $.ajax(data).done(function(data){
        //            var hrefdown = sub[0]+"down.php?name="+data;
                    //alert(hrefdown);
        //         	window.location.href= hrefdown;
         //        });
		
		}
		// pre-submit callback 
		function showRequest(formData, jqForm, options) { 
			    //check whether browser fully supports all File API
			
		   if (window.File && window.FileReader && window.FileList && window.Blob)
			{
				
				if( !$(options.xhrFields.input).val()) //check empty input filed
				{
					$(options.target).show();
					$(options.target).html("Are you kidding me?");
					$(options.target).delay( 3000 ).fadeOut();
					return false;
				}
				
				var fsize = $(options.xhrFields.input)[0].files[0].size; //get file size
				var ftype = $(options.xhrFields.input)[0].files[0].type; // get file type
				
		
				//allow file types 
				switch(ftype)
				{
				    case 'image/png': 
					case 'image/gif': 
					case 'image/jpeg': 
					case 'image/pjpeg':
						break;
					default:
					    $(options.target).show();
						$(options.target).html("<b>"+ftype+"</b> Unsupported file type!");
						$(options.target).delay( 3000 ).fadeOut();
						return false;
				}
				
				//Allowed file size is less than 5 MB (1048576)
				if(fsize>5242880) 
				{
					$(options.target).show();
					$(options.target).html(
					"<b>"+bytesToSize(fsize) +"</b> Too big file! <br />File is too big, it should be less than 5 MB.");
					$(options.target).delay( 3000 ).fadeOut();
					
					return false;
				}
						
				//$('#submit-btn').hide(); //hide submit button
				$('.loading-img').show(); //hide submit button
				$(options.target).html("");  
			} else {
					//Output error to older unsupported browsers that doesn't support HTML5 File API
				$(options.target).show();
				$(options.target).html("Please upgrade your browser, because your current browser lacks some new features we need!");
				$(options.target).delay( 3000 ).fadeOut();
				return false;
			}
						
					
		} 
		//progress bar function
		function OnProgress(event, position, total, percentComplete)
		{
			//Progress bar
			$('.progressbox').show();
			$('.progressbar').width(percentComplete + '%') //update progressbar percent complete
			$('.statustxt').html(percentComplete + '%'); //update status text
			if(percentComplete>50)
				{
					$('.statustxt').css('color','#000'); //change status text to white after 50%
				}
		}
		// bytesToSize  function
		function bytesToSize(bytes) {
		   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
		   if (bytes == 0) return '0 Bytes';
		   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
		   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
		}
		
});