function reformatText()
{
    
   
}
$(document).ready(function() 
{
	$("p").widowFix();
	
	//console.log(' ------------- BOOM BOOM ');
	//_________________________________________________________________________________
	//Message box listeners
	
	var privacySlug = "While we aim to protect your privacy, please realize that this is a large-scale project that outsources to volunteers all over the globe. We therefore have only limited control over the information you give and hold no responsibility for its misuse.";
	var legalSlug = "By sending a letter request, you give us all rights to the content within. This is just lawyer talk to make sure we're not limited in showcasing SMME in other creative ways. If you disagree, please do not send a letter request.";
	var alertSlug = "Sorry, you have not completed the following fields:<br>";
	var alertMessage = "";
	
	var successSlug = 'Thanks for submitting your letter!<br>Please check your email and confirm your request in order for it to be sent out.<br><span style="font-size:18px;font-style:italic;">Check your spam/junk folder if you have not received a confirmation email.</span>';
	var declineSlug = "It appears you have already submitted a letter.<br>Please only one letter per person.";
	var messageOverGrown = false;
	
	//_________________________________________________________________________________
	//Legal and Privacy
	
	$("#legal-btn").click(function(){ 
		runOverlay(legalSlug)
	});
	
	$("#privacy-btn").click(function(){
		runOverlay(privacySlug);
	});
	
	//_________________________________________________________________________________
	//Nav scroll ease
	
	$(".learn-more").click(function(){
		navScrollTo( $(this).attr('data-panel-id') );
	});
	
	$(".nav-item").click(function(){
		navScrollTo( $(this).attr('data-panel-id') );
		//$("#small-menu-slider").animate({left:"-221px"}, 500);
		highlightNav( $(this).attr("id") );
	});
	
	function highlightNav( item )
	{
		$("#nav .nav-item").each(function(){  $(this).removeClass('current'); })
		$('#nav #'+item).addClass('current');
	}
	
	function navScrollTo( to )
	{
		var top = $('#'+to).offset().top;
		$('body, html').animate({ scrollTop:top-45 }, 1000);	
	}
	
	//SCROLL LISTENER FOR TOP NAV AND WAYPOINTS
	$(window).scroll(function(){			
		var homeTop = $('#logo').offset().top - $(window).scrollTop();
		var smmevTop = $('#smme-v').offset().top - $(window).scrollTop();
		// var letterTop = $('#send-a-letter').offset().top - $(window).scrollTop();
		var mapTop = $('#map').offset().top - $(window).scrollTop();
		var galleryTop = $('#gallery').offset().top - $(window).scrollTop();
		var bookTop = $('#book-lg').offset().top - $(window).scrollTop();
		var footerTop = $('#footer-lg').offset().top - $(window).scrollTop();
		
			
		// if(homeTop <= 45 && $('#nav-home').hasClass('current') != true && isInViewport( $('#logo') ) ) { highlightNav('nav-home'); } else {};
		if(smmevTop <= 100 && $('#smme-v').hasClass('current') != true && isInViewport( $('#smme-v') ) ) { highlightNav('nav-smme-v'); } else {};
		// if(letterTop <= 100 && $('#nav-send-a-letter').hasClass('current') != true && isInViewport( $('#send-a-letter') ) ) { highlightNav('nav-send-a-letter'); } else {};
		if(mapTop <= 100 && $('#nav-map').hasClass('current') != true && isInViewport( $('#map') )) { highlightNav('nav-map'); } else {};
		if(galleryTop <= 100 && $('#nav-gallery').hasClass('current') != true && isInViewport( $('#gallery') )) { highlightNav('nav-gallery'); } else {};
		if(bookTop <= 100 && $('#nav-book').hasClass('current') != true && isInViewport( $('#book-lg') )) { highlightNav('nav-book'); } else {};
		if(footerTop <= 100 && $('#nav-footer').hasClass('current') != true && isInViewport( $('#footer-lg') )) { highlightNav('nav-footer'); } else {};
	});
	
	function isInViewport( item )
	{
  	 	var win = $(window);
  	 	var viewport = {
	        top : win.scrollTop(),
	        left : win.scrollLeft()
	    };
	    viewport.right = viewport.left + win.width();
	    viewport.bottom = viewport.top + win.height();
	
	    var bounds = item.offset();
	    bounds.right = bounds.left + item.outerWidth();
	    bounds.bottom = bounds.top + item.outerHeight();
	
	    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
	
	};
	
	//_________________________________________________________________________________
	//Message box listeners
	
	
	$("#message-text").bind("input propertychange keydown paste cut", function()
	{
		var x = $(this).val();
		
		//Check for carriage returns and keep count correct.
		var newLines = x.match(/(\r\n|\n|\r)/g);
        var addition = 0;
                
        if (newLines != null) 
        {
        	addition = newLines.length;
        }
        
		var count = 800 - (x.length + addition);
		if(count < 20)
		{
			$("#message-counter").addClass("red");
		}
		else
		{
			$("#message-counter").removeClass("red");
		}
		if(count < 0)
		{
			messageOverGrown = true;
		}
		else
		{
			messageOverGrown = false;
		}
		$("#message-counter").html(count+" Characters");
	});
	
	
	//_________________________________________________________________________________
	//Radio button listeners
	
	$("#custom-option-dropdown").change(function(){
		var val = $(this).val();
		
		if(val == "Suggest your own")
		{
			$("#custom-suggestion-small").removeAttr("disabled");
			$("#custom-suggestion-small").show(500, function(){ $("#custom-suggection").focus(); });
		}
		
	});
	
	
	$("input[name=custom-option]:radio").change(checkCustom);
	
	function checkCustom( e )
	{
		var val = $("input[name=custom-option]:checked").val();
		
		
		if(val == 'Suggest your own')
		{
			$("#custom-suggestion").removeAttr("disabled");
			$("#custom-suggestion").animate({opacity: 1}, function(){ $("#custom-suggection").focus(); });
		}
		else
		{
			$("#custom-suggestion").val('', function(){$("#custom-suggestion").attr("disabled", "disabled");});
			$("#custom-suggestion").animate({opacity: 0});
			//$("#custom-suggestion").attr("disabled", "disabled");
		}
	}
	
	function closeOverlay()
	{
		$(".screenOverlay").remove();
		$("#overlay-box-wrapper").remove();
		$("#overlay-gray").hide(0);
	}
	
	function runOverlay(text)
	{
		var overlayContent ='<div id="overlay-box">'+
								'<div id="close-x"></div>'+
								'<div id="overlay-text">'+text+'</div>'+
							'</div>';
		
		var overlay = document.createElement("div");
		overlay.setAttribute("id","screenOverlay");
		overlay.setAttribute("class", "screenOverlay");
		document.body.appendChild(overlay);
		$(".screenOverlay").click(function(){ closeOverlay(); });
		$(".screenOverlay").css('top', $(window).scrollTop() );
		$(".screenOverlay").fadeTo(100, 0.7);
							
		var overlayBox = document.createElement("div");
		overlayBox.setAttribute("id","overlay-box-wrapper");
		overlayBox.setAttribute("class", "");
		document.body.appendChild(overlayBox);	
		
		
		$("#overlay-box-wrapper").html(overlayContent);
		$("#close-x").click(function(){ closeOverlay(); });
		
		centerMe("#overlay-box-wrapper");
		
		$("#overlay-gray").show();
	}
	
	
	function centerMe( item )
	{
		$(item).css("position","absolute");
		$(item).css("top", Math.max(0, (($(window).height() - $(item).outerHeight()) / 2) + $(window).scrollTop()) + "px");
		$(item).css("left", Math.max(0, (($(window).width() - $(item).outerWidth()) / 2) + $(window).scrollLeft()) + "px");
	}
	
	//_________________________________________________________________________________
	//Submit Listener
	
	function dismissFields()
	{
		$("#send-a-letter").html('<div id="success-text">'+successSlug+'</div>');
	}
	
	function clearFields()
	{
		$("#address-text").val('');
		$("#input-email").val('');
		$("#message-text").val('');
		$("#legal-checkbox").removeAttr('checked');
		$("input[value=Doodle]").attr('checked', true);
		$("#message-counter").html("800 Characters");
	}
	
	//$("#form-button").bind("click touchstart", validateForm);
	
	$("#form-button").click(function(){ validateForm() });
	
	
	function validateForm()
	{			
		var alerts = [];
		
		var name = $("#input-name").val();
		var address1 = $("#input-address1").val();
		var address2 = $("#input-address2").val();
		var address3 = $("#input-address3").val();
		if(name == '' || address1 == '' || address2 == '')
		{
			alerts.push("Name & Mailing Address : 3 Rows Required");
		}
		
		var customOption = $("input[name=custom-option]:checked").val();
				
		if(customOption == "Suggest your own" && $("#custom-suggestion").val() == '')
		{
			alerts.push("Suggest your own Custom Option");
		}
		if( $("#custom-suggestion").val() != '' && customOption == "Suggest your own")
		{
			customOption = $("#custom-suggestion").val();	
		}			
		
		var email = $("#input-email").val();
		
		if(email == '' || email.indexOf('@') == -1)
		{
			alerts.push("Valid Email Address");
		}
		
		var message = $("#message-text").val();
		if(message == '')
		{
			alerts.push("Message");
		}
		if(messageOverGrown == true)
		{
			alerts.push("Message Over Max Characters");
		}
		
		var legal = $("#legal-checkbox").prop("checked");
		
		if(legal == false)
		{
			alerts.push("You Must Agree to Legal Terms");
		}
		
		if(alerts.length > 0)
		{
			var alertMessage = alertSlug+'<br>';
			for(var i = 0; i < alerts.length; i++)
			{
				alertMessage += "*"+alerts[i];
				
				if(i < alerts.length - 1)
				{
					alertMessage+='<br>';
				}
			}
			
			runOverlay(alertMessage);			
		}
		else
		{
			
			$.post("smmeform.php",{ name:name, address1:address1, address2:address2, address3:address3, customOption:customOption, email:email, message:message }).done(function(data)
			{
				
				if(data == "declined")
				{
					runOverlay(declineSlug);
					clearFields();
				}
				if(data == "success")
				{
					dismissFields();
				}
			});
		}	
	}
	
	$("#nav #nav-home").addClass("current");	
});