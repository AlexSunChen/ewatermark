/*
 * File UploadProcess JS 1.1.0
 *
 * Copyright 2014, SunChen
 * http://153.121.76.133/ewatermark/ImgList.html
 */

/* global $, window */

$(function () {
    'use strict';
    // Initialize the jQuery File Upload widget:
	 $('#result').hide();		
   　 $('#fileupload').fileupload({
				// Uncomment the following to send cross-domain cookies:
				//xhrFields: {withCredentials: true},
				url: 'fileupload/server/php/index-newuser.php',
				acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
				stop: function (e) {
                if (e.isDefaultPrevented()) {
                    return false;
                }
                var that = $(this).data('blueimp-fileupload') ||
                        $(this).data('fileupload'),
                    deferred = that._addFinishedDeferreds();
                $.when.apply($, that._getFinishedDeferreds())
                    .done(function () {
                        that._trigger('stopped', e);
                    });
                that._transition($(this).find('.fileupload-progress')).done(
                    function () {
                        $(this).find('.progress')
                            .attr('aria-valuenow', '0')
                            .children().first().css('width', '0%');
                        $(this).find('.progress-extended').html('&nbsp;');
                        deferred.resolve();
                    }
                );
				
				  //Extent-template
				   $.ajax({
							url: 'fileupload/server/php/watermark.php',
							//dataType: 'json'
					})
					.done(function (result) {
								$('#result').show();		
								$('#result').html( '<img width="150px" height="100px" src="fileupload/server/php/'+result+'"/><label><a href="fileupload/server/php/down_cert.php?src='+result+'">どうぞ、画像鍵をダウンロードしてください</a></label>' );
					});
				  //end;
				 
            }
			});

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            'cors/result.html?%s'
        )
    );

});
