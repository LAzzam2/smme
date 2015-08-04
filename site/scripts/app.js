/* 
* Skeleton V1.0.3
* Copyright 2011, Dave Gamache
* www.getskeleton.com
* Free to use under the MIT license.
* http://www.opensource.org/licenses/mit-license.php
* 7/17/2011
*/	

$(document).ready(function() {

	$('#clock').countdown('2015/11/09 12:34:56')
		.on('update.countdown', function(event) {
			var format = '<span>%-D</span> days <span>%-H</span> hours <span>%M</span> minutes <span>%S</span> seconds';
			$(this).html(event.strftime(format));
		})
		.on('finish.countdown', function(event) {
			$(this).html('This offer has expired!');
		});
	
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
		$('.map-wrap').css('margin','125px 0px 0px 0px');
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