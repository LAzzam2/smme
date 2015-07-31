/* 
* Skeleton V1.0.3
* Copyright 2011, Dave Gamache
* www.getskeleton.com
* Free to use under the MIT license.
* http://www.opensource.org/licenses/mit-license.php
* 7/17/2011
*/	

$(document).ready(function() {
	
(function ($) {

	$.fn.photoResize = function (options) {

		var element	= $(this), 
			defaults = {
	            bottomSpacing: 10
			};
		
		$(element).load(function () {
			updatePhotoHeight();

			$(window).bind('resize', function () {
				updatePhotoHeight();
			});
		});

		options = $.extend(defaults, options);

		function updatePhotoHeight() {
			var o = options, 
				photoHeight = $(window).height();

			$(element).attr('height', photoHeight - o.bottomSpacing);
		}
	};

}(jQuery));
	
	$("#logo").photoResize({
		bottomSpacing: 15
	});
	
	$("#small-menu-close").click(function(){
		$("#small-menu-slider").animate({left:"-221px"}, 500);
	});
	
	$("#small-menu-hamburger").click(function(){
		$("#small-menu-slider").animate({left:"0px"}, 500);
	});
	
	$(".disable").click(function(){
		$(this).css({
			pointerEvents:"none",
			opacity: 0,
		});
		$(this).siblings('h1').css({top: '-50px'});
	});
	
	
	
	
	/* Tabs Activiation
	================================================== */
	var tabs = $('ul.tabs');
	
	tabs.each(function(i) {
		//Get all tabs
		var tab = $(this).find('> li > a');
		tab.click(function(e) {
			
			//Get Location of tab's content
			var contentLocation = $(this).attr('href') + "Tab";
			
			//Let go if not a hashed one
			if(contentLocation.charAt(0)=="#") {
			
				e.preventDefault();
			
				//Make Tab Active
				tab.removeClass('active');
				$(this).addClass('active');
				
				//Show Tab Content & add active class
				$(contentLocation).show().addClass('active').siblings().hide().removeClass('active');
				
			} 
		});
	}); 
	
});