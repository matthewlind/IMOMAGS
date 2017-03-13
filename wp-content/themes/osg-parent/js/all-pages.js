(function($) {
////////////////////

	var $document 		= $(document),
		body 			= $('body'),
		wh				= window.innerHeight,
		ww 				= window.innerWidth;
		menu 			= $('#menu_drop'),
		menu_container	= $('.menu-container'),
		h_search		= $('#h_search'),
		h_search_form	= $('#h_search_form'),
		menu_toggle		= $("#h_drop, #m_drop"),
		h_drop			= $("#h_drop"),
		nav_icon		= $('#nav-icon3')
		close_m2  		= $("#close_m2");

	
	$document.ready(function() {
		
		/*** Community menu ***/
		
		//Toggle Photos Menu
		if( $('.community-mobile-menu').length ){
			$('.community-mobile-menu').on('click touchstart', function(e){
				e.preventDefault();
				$('.menu-photo-wrap').toggle();
			});
		}
		//layout in columns
		/*if($(window).width() > 610){
		    var num_cols = 6,
		    container = $('.community-header ul.menu'),
		    listItem = 'li',
		    listClass = 'sub-list';
		    container.each(function() {
		        var items_per_col = new Array(),
		        items = $(this).find(listItem),
		        min_items_per_col = Math.floor(items.length / num_cols),
		        difference = items.length - (min_items_per_col * num_cols);
		        for (var i = 0; i < num_cols; i++) {
		            if (i < difference) {
		                items_per_col[i] = min_items_per_col + 1;
		            } else {
		                items_per_col[i] = min_items_per_col;
		            }
		        }
		        for (var i = 0; i < num_cols; i++) {
		            $(this).append($('<ul ></ul>').addClass(listClass));
		            for (var j = 0; j < items_per_col[i]; j++) {
		                var pointer = 0;
		                for (var k = 0; k < i; k++) {
		                    pointer += items_per_col[k];
		                }
		                $(this).find('.' + listClass).last().append(items[j + pointer]);
		            }
		        }
		    });
		    $(".community-header").show().css("overflow","visible");
		}*/

	
		// Simulate a hover with a touch in touch enabled browsers
		body.bind('touchstart', function() {});
		
		
		// MAIN NAV
		
		// Disable Parent links in the main mobile menu (column titles)
		$("#menu-mobile-menu > li.menu-item-has-children > a").click(function(e){
			e.preventDefault();
		});
		
		// Buy magazine dorp down menu
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
// 		buyMagDrop.mouseleave(function(){buyMagDrop.slideUp(200);})
		
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
			nav_icon.removeClass('open');
			h_search_form.removeClass('hsf-open');
	    } else {
	        // Scroll Up
	        if(st + $(window).height() < $(document).height()) {
	            head_wrap.removeClass('nav-up').addClass('nav-down');
	        }
	    }
	    lastScrollTop = st;
	}
	
	// NAVIGATION
	h_drop.click(function(){
		if (menu.hasClass("menu-down")){
			menu.removeClass("menu-down");
			body.removeClass('menu-open');
			nav_icon.removeClass('open');
		} else {
			menu.addClass("menu-down");
			body.addClass('menu-open');
			if (ww < 1030) {nav_icon.addClass('open');}
		}
	});
	$("#close_m2, #m_drop").click(function(){
		menu.removeClass("menu-down");
		body.removeClass('menu-open');
		nav_icon.removeClass('open');
	});

	//detect window width for responsive ads
	$('.iframe-ad').attr('src', function() {
		//if(window.outerWidth == 0){
			//ww = "1100";
		//}
	    return this.src + "&windowWidth=" + ww;
	});
	
	// SEARCH
	h_search.click(function(event){
		event.stopPropagation();
		h_search_form.toggleClass('hsf-open');
	});
	h_search_form.click(function(event){
		event.stopPropagation();
	});
	$("body").click(function(){
		h_search_form.removeClass('hsf-open');
	});
	
	
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
	
////////////////////
})(jQuery);