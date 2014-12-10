/*
 * Image Gallery JS maniCtr 1.1.0
 * http://153.121.76.133/ewatermark/ImgList.html
 *
 * Copyright 2014, SunChen
 * http://153.121.76.133
 *
 */
/*jslint unparam: true */
/*global blueimp, $ */

$(function () {
    'use strict';
	/*
    $.ajax({
	  type: "POST",
	  url: "test.php",
	  data: { name: "John", location: "Boston" },
	  dataType:"json"
	})
	.done(function( data ) {
		alert( "Data info: " + data.msg );		
		alert( "Data info: " + data.info );
	})
	.fail(function() {
		alert( "error" );
	});*/
	//var dataout = { name: "John", location: "Boston" };
	$.ajax( {
		type: "POST",
		url: "test.php", 
		data: { name: "John", location: "Boston"},
		dataType:"json" 
	}).done(function( data ) {
	  var items = [];
	  $.each( data, function( key, val ) {
		items.push( "<li id='" + key + "'>" + val + "</li>" );
	  });
	 
	  $( "<ul/>", {
		"class": "my-new-list",
		html: items.join( "" )
	  }).appendTo( "body" );
	  
	});

});
