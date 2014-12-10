/*
 * Image Gallery JS maniCtr 1.1.0
 * http://153.121.76.133/ewatermark/ImgList.html
 *
 * Copyright 2014, SunChen
 * http://153.121.76.133
 *
 */
$(function () {
    'use strict';
        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: 'server/php/',
            dataType: 'json'
        })
		.done(function (result) {
			//alert(result.files[0].url);
			if(!jQuery.isEmptyObject(result.files)){
				 $('.imgs').html(tmpl("showImg", result));
			}
		  
        });
		
	 $('#borderless-checkbox').on('change', function () {
        var borderless = $(this).is(':checked');
        $('#blueimp-gallery').data('useBootstrapModal', !borderless);
        $('#blueimp-gallery').toggleClass('blueimp-gallery-controls', borderless);
    });

    $('#fullscreen-checkbox').on('change', function () {
        $('#blueimp-gallery').data('fullScreen', $(this).is(':checked'));
    });
	
	$('#fullscreen-checkbox').on('change', function () {
        $('#blueimp-gallery').data('fullScreen', $(this).is(':checked'));
    });
	
	$('#loading').hide();
	$('#loading2').hide();
	$('#delete-zone').click(function (){
		    var zonename = $(this).attr("name");
			//alert(zonename);
		    var obj = {"zone":zonename};
			$.ajax({
				// Uncomment the following to send cross-domain cookies:
				//xhrFields: {withCredentials: true},
				url: 'server/php/delete-zone.php',
				type: "POST",
				data: obj
			})
			.always(function(){
				$('#loading').show();
				$('#loading').html('<img src="../image/loading.gif">');
				$('#loading').hide();
			})
			.done(function (result) {
				$('#loading').show();
				$('#loading').html(result);
				$('#loading').delay( 500 ).fadeOut();
				setTimeout(function () {
					var hrefdown = "../index.php";
                  window.location.href= hrefdown;	
				}, 1000);
					
			});
		
		});
	
	/*$('#delete-img').click(function (){
		    var zonename = $(this).attr("name");
			//alert(zonename);
		    var obj = {"zone":zonename};
			$.ajax({
				// Uncomment the following to send cross-domain cookies:
				//xhrFields: {withCredentials: true},
				url: 'server/php/delete-zone.php',
				type: "POST",
				data: obj
			})
			.always(function(){
				$('#loading').show();
				$('#loading').html('<img src="../image/loading.gif">');
				$('#loading').hide();
			})
			.done(function (result) {
				$('#loading').show();
				$('#loading').html(result);
				$('#loading').delay( 500 ).fadeOut();
				setTimeout(function () {
					var hrefdown = "../index.php";
                  window.location.href= hrefdown;	
				}, 1000);
					
			});
		
		});*/
	
		
		/*$('.imgs').find('a[download]').each(function () {
                var link = $(this),
                url = link.prop('href'),
                name = link.prop('download'),
                type = 'application/octet-stream';
          		  link.bind('dragstart', function (e) {
                try {
                    e.originalEvent.dataTransfer.setData(
                        'DownloadURL',
                        [type, name, url].join(':')
                    );
                } catch (ignore) {}
            });
        }).end();*/
		$('#delete-img').click(function() {
			var links = new Array();
			var names = new Array();
			$('.imgs input:checked').each(function(){
					links.push($(this).val());
					names.push($(this).attr("name"));
			});
			if(links.length==0){
				$('#loading2').show();
				$('#loading2').html('Please choose image!');
				$('#loading2').delay( 500 ).fadeOut();
			}
			//var sent = JSON.stringify(link);
			var obj = {"files":links, "names":names};
			$.ajax({
				// Uncomment the following to send cross-domain cookies:
				//xhrFields: {withCredentials: true},
				url: 'server/php/delete-img.php',
				type: "POST",
				data: obj
			})
			.always(function(){
				$('#loading2').show();
				$('#loading2').html('<img src="../image/loading.gif">');
				$('#loading2').hide();
			})
			.done(function (result) {
				
					$.ajax({
					// Uncomment the following to send cross-domain cookies:
					//xhrFields: {withCredentials: true},
						url: 'server/php/',
						dataType: 'json'
					})
					.done(function (result) {
						//alert(result.files[0].url);
						if(!jQuery.isEmptyObject(result.files)){
							 $('.imgs').html(tmpl("showImg", result));
						}
					  
					});
					
					$('#loading2').show();
				    $('#loading2').html(result);
					$('#loading2').delay( 500 ).fadeOut();
				
			});
			
			
			
		});
		
		$('#downimg').click(function() {
			var links = new Array();
			var names = new Array();
			$('.imgs input:checked').each(function(){
					links.push($(this).val());
					names.push($(this).attr("name"));
			});
			if(links.length==0){
				$('.imgs input').each(function(){
					links.push($(this).val());
					names.push($(this).attr("name"));
				});
			}
			//var sent = JSON.stringify(link);
			var obj = {"files":links, "names":names};
			$.ajax({
				// Uncomment the following to send cross-domain cookies:
				//xhrFields: {withCredentials: true},
				url: 'server/php/Download.php',
				type: "POST",
				data: obj
			})
			.always(function(){
				$('#downimg').addClass('active');
			})
			.done(function (result) {
				$('#downimg').removeClass('active');
				if(result){
				 	var hrefdown = "./server/php/down.php?name="+result;
                    //alert(hrefdown);
                 window.location.href= hrefdown;
				}
			});
		});	

});
