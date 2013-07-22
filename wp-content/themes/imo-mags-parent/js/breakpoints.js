jQuery(document).ready(function () {
	
	//object for check System
	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function() {
			return navigator.userAgent.match(/iPhone|iPod/i);
		},
		Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
		any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};
	
	//width const
    var breakpoint  = 1126;
    
	//resize and load events for window
	jQuery(window)
        .on('resize', function(){
			if(!isMobile.iOS()){
				change_visibility();
			}
		})
        .on('load', change_visibility);
	
	//change visibility for desktop and mobile
    function change_visibility(){
		
		var current_width = jQuery(window).width();

        if (current_width <= breakpoint) {
            mobile_visibility();
        }
        else if(current_width > breakpoint){
            desktop_visibility();
        }

        return false;
    }
	
	//mobile visibility
    function mobile_visibility() {
        jQuery('body').addClass("mobile-orientation");
        
		return false;
    }
	
	//desktop visibility
    function desktop_visibility(){
        jQuery('body').removeClass("mobile-orientation");
        
		return false;
    }
    
    //width const for slides
    var slidebreakpoint  = 870;
    
    //resize and load events for window
    jQuery(window)
        .on('resize', function(){
            if(!isMobile.iOS()){
                slide_change_visibility();
            }
        })
        .on('load', slide_change_visibility);
    
    //change visibility for desktop and mobile
    function slide_change_visibility(){
        
        var slide_current_width = jQuery(window).width();

        if (slide_current_width <= slidebreakpoint) {
            slide_mobile_visibility();
        }
        else if(slide_current_width > slidebreakpoint){
            slide_desktop_visibility();
        }

        return false;
    }
    
    //slide mobile visibility
    function slide_mobile_visibility() {
        
        
        return false;
    }
	
});