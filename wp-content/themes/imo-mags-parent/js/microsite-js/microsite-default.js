(function($) {
	var $document 	= $(document);
		
	
	$document.ready(function() {
		
		$(".wpsocialite.small").remove();
		var windowWidth 		= $(window).width(),
			box1_width 			= $( ".post-box" ).eq(-1).width(),		
			box2_width 			= $( ".post-box" ).eq(-2).width(),
			box3_width 			= $( ".post-box" ).eq(-3).width(),
			box_width_diff 		= Math.abs(box1_width - box2_width)
			box_width_diff13 	= Math.abs(box1_width - box3_width),
			box_width_diff23 	= Math.abs(box2_width - box3_width),
			box_width_diff_real = box2_width - box1_width,
			box_width_diff_real13 = box3_width - box1_width;
			
		function moveBox() {
			if (box_width_diff > 50 && box_width_diff_real < 0) {
				$( ".post-box" ).eq(-1).css("margin", "0 26%");
			} else if (box_width_diff > 50 && box_width_diff_real > 0) {
				$( ".post-box" ).eq(-1).css({"margin" : "0 34.5%"});
			} else if ((box_width_diff < 50 || box_width_diff == 0) && box_width_diff13 > 50 && box_width_diff_real13 > 0) {
				$( ".post-box" ).eq(-2).css({"margin" : "0 1% 0 17.7%"});
			} else {
				
			}
		}//end isBox
			
		if (windowWidth > 600) {
			moveBox();
		}
			
		// Simulate a hover with a touch in touch enabled browsers
		$('body').bind('touchstart', function() {});
		
		
		
		// Main Nav, buy magazine dorp down menu
		var buyMagHeadLink 	= $("#head-subscribe"),	
			buyMag 			= $('li.buy-mag'),
			buyMagLink 		= $('#head-bottom-subscribe'),
			buyMagDrop 		= $('.m-buymag-drop');
		
		buyMagDrop.click(function(event){
			event.stopPropagation();
		});
		buyMagLink.click(function(event){
			event.stopPropagation();
			buyMagDrop.slideToggle(200);
		});
		buyMagHeadLink.click(function(event){
			event.stopPropagation();
			buyMagDrop.slideToggle(200);
		});
		$("body, .m-buymag-drop i").click(function(){
			buyMagDrop.slideUp(200);
		});
		buyMagDrop.mouseleave(function(){buyMagDrop.slideUp(200);})
		
		// add .disabled-link class to an <a> tag to disable it's dfault begavior 
		disabledLink = $('.disabled-link');
		disabledLink.click(function(event){
			event.preventDefault();
		});	
	}); // end of document.ready
	
	
	// STICKY HEADER
	var head_wrap		= $("#header_wrap"),
		head_main		= $(".main-header"),
		lastScrollTop 	= 0,
		delta 			= 30,
		navbarHeight	= head_main.outerHeight(),
		didScroll;					   

	function stickyHead() {
		var docTop 			= $document.scrollTop(),
			headMainTop 	= head_main.offset().top;
			
		//console.log(headMainTop);	
			
		if (docTop >= 2)	{
			head_wrap.addClass('head-fixed');
		} else {
			head_wrap.removeClass('head-fixed');
		}
	}
	
	function hasScrolled() {
		var st = $(this).scrollTop();
		
		// Make sure they scroll more than delta
		if(Math.abs(lastScrollTop - st) <= delta)
        return;
        
        // If they scrolled down and are past the navbar, add class .nav-up.
	    // This is necessary so you never see what is "behind" the navbar.
	    if (st > lastScrollTop && st > navbarHeight){
	        // Scroll Down
	        head_wrap.removeClass('nav-down').addClass('nav-up');
	    } else {
	        // Scroll Up
	        if(st + $(window).height() < $(document).height()) {
	            head_wrap.removeClass('nav-up').addClass('nav-down');
	        }
	    }
	    lastScrollTop = st;
	}
	
	// NAVIGATION
	var menu_toggle	= $("#h_drop, #m_drop"),
		h_drop		= $("#h_drop"),
		nav_icon	= $('#nav-icon3'),
		menu_drop	= $('#menu_drop'),
		sposors_dis	= $('.sponsors-disclaimer'),
		menu_drop_ht= menu_drop.outerHeight() - 5;
		
	menu_toggle.click(function(){
		var clicks = menu_toggle.data('clicks');
		if (clicks) {
			// even clicks
			menu_drop.css("bottom", "0px");
			nav_icon.removeClass('open');
		} else {
			// odd clicks
			menu_drop.css("bottom", "-"+menu_drop_ht+"px");
			nav_icon.addClass('open');
		}
		menu_toggle.data("clicks", !clicks);			
	});	
	menu_drop.mouseleave(function(){
		if (nav_icon.hasClass('open')) {
			h_drop.trigger("click");
		}
	});

	// end NAVIGATION
	
	$document.scroll(function() {
		didScroll = true;
	    stickyHead();
	});
	
	setInterval(function() {
	    if (didScroll) {
	        hasScrolled();
	        didScroll = false;
	    }
	}, 250);
	

	$( window ).resize(function() {
		var windowWidth = jQuery(window).width();
		
		if (windowWidth < 600) {
			jQuery( ".post-box" ).eq(-1).css("margin", "0 0 30px");
		}
	});

})(jQuery);