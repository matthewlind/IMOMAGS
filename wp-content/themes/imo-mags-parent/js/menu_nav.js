jQuery(document).ready(function(){

	var viewport;
	var header;
	var page;
	var pageContent;
	var slidingMenu;
	var slidingMenuContent;
	var isMenuOpen = false;
	var visiblePageMargin = 55;
	var maximumMenuWith = 320;
	var preloader   = '';

	initMetrics();

	function initMetrics() {
		
		header = jQuery(".header");
		page = jQuery("#page");
		pageContent  = jQuery("#main");
		slidingMenu  = jQuery("#slidingMenu");
		slidingMenuContent = jQuery("#slidingMenuContent");
		viewport = {
	    	width  : jQuery(window).width(),
	    	height : jQuery(window).height()
		};
	}
	
	initGestures();

    function initGestures() {

       // var openingGesture = Hammer(document).on("swiperight", function(event) {
           // openMenu();
       // });
        var closingGesture = Hammer(document).on("swipeleft", function(event) {
            closeMenu();
        });
    }

	function openMenu() { 
		
		isMenuOpen = true;
		//Rem : Had to do this here because viewport.width value could have been updated since next open/close. If we rotate the device for example
	    var menuWidth = viewport.width - visiblePageMargin;

	    if(viewport.width > (maximumMenuWith+visiblePageMargin) ){
			menuWidth = maximumMenuWith;	
		} 

		//Rem : Unecessary except for windows phone7.5 where div with lower z-index are clickable....
		slidingMenu.css("visibility","visible");
		slidingMenu.show();
		adjustHeight();
		//page.addClass("smooth-menu-open");
		page.animate({
    		left: "266px",
    		duration: 180
            });
        
	   // page.css("-webkit-transform","translate3d(266px,0,0)");
	}

	function closeMenu() {

		isMenuOpen = false;
		//page.removeClass("smooth-menu-open");
		//page.css("-webkit-transform","translate3d(0px,0,0)");
		 
    	page.animate({
    		left: 0,
            height : "100%"
    	}, { duration: 180 });
    	
	}

	//Use to avoid overflow problem with scroll
	function adjustHeight() {

		var menuHeight = slidingMenu.height();
	    var pageHeight = page.height();
	    var MenuContentHeight = slidingMenuContent.height();
	    //to avoid overflow block on Android < 2.3
	    if(pageHeight < menuHeight){
	    	slidingMenu.css("height",MenuContentHeight+"px");	
	    	page.css("height",MenuContentHeight+"px");	
	    } 
	    else{
	    	slidingMenu.css("height",pageHeight+"px");
	    } 
	} 

	function orientationChange() {

		//We must wait at least 500ms before recalculate metrics, 
		//If we don't, some old phones send the old metrics value instead of new orientation values
		window.setTimeout(function() {
	        
	        initMetrics();

			if(isMenuOpen) openMenu(); 
			else closeMenu();

	    }, 500);
	}
	
	


	//trigger the opening or closing action
	jQuery("a.show-menu-button").click(function () {
				
		if(isMenuOpen == false) {		
			jQuery("#page, .post-slider, .video-box").addClass("smooth-menu"); 
			openMenu();
		}
		else { 
			closeMenu(); 
			setTimeout(function() { 
				slidingMenu.css("visibility","hidden");
				jQuery("#page, .post-slider, .video-box").removeClass("smooth-menu");
	    	},1000);
		}
	});

	//Some windows phones (7.5) does'nt fired the "orientationchange" event, that's why we must use "resize" event
	if(window.addEventListener){
		window.addEventListener("resize", orientationChange, false);
		window.addEventListener("orientationchange", orientationChange, false);
	}
    
});