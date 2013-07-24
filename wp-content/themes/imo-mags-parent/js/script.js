jQuery(window).load(function() {
	
	var my_body = document.getElementsByTagName('body')[0],
	my_script = document.createElement('script');
	
	my_script.src = 'http://' + window.location.hostname + '/wp-content/themes/imo-mags-parent/js/plugins/jquery.mobile/jquery.mobile-1.3.1.js';
	my_body.appendChild(my_script);
	
	
	
	jQuery('.onload-hidden').removeClass('onload-hidden');
    jQuery('.onload-hidden-abs').removeClass('onload-hidden-abs');
    jQuery('.loading-block').removeClass('loading-block');
    
    var optionsHash;
	jQuery( "#idofpanel" ).panel( "open" , optionsHash );
	jQuery("html").removeClass("ui-mobile");
});

jQuery(function(){
	
	//prevent jQuery mobile from styling form elements
	jQuery(document).live('pagebeforecreate', function( e ) {
        jQuery( "input, textarea, select", e.target ).attr( "data-role", "none" );
    });
    
    jQuery(document).ready(function () {
		// Load more 
		if(jQuery(".next-link a").length){
		    jQuery("a.btn-base").show();
	    }
	    //fix for menu loading before jquery mobile
	    jQuery(".open-menu").click(function(){
			jQuery("#mob-menu").show();
			_gaq.push(['_trackPageview',"/" + window.location.pathname + "-mobile-menu-open"]);  
			document.getElementById('menu-iframe-ad').contentWindow.location.reload();
		});
		
		jQuery( document ).on("swipeleft swiperight",".open-menu", function( e ) {
			_gaq.push(['_trackPageview',"/" + window.location.pathname + "-mobile-menu-open"]);  
			document.getElementById('menu-iframe-ad').contentWindow.location.reload();
		});
		
		if( jQuery(".mob-aside-menu .menu-main-menu-container").length ){
			jQuery(".mob-aside-menu .menu-main-menu-container").removeClass("menu-main-menu-container");
			jQuery(".mob-aside-menu .menu-main-menu-container").addClass("menu-mobile-menu-container");
		}
    });	
   	
   	jQuery(function(){
        jQuery(".pager-holder a.btn-base").click(function(e){
            jQuery("#ajax-loader").show();
            if (jQuery(window).width() <  610 ) {
                var findId = 'div.post, div.posts-image-banner';
            } else {
                var findId = 'div.post';
            }

            e.preventDefault();
            if (jQuery(".next-link a").length) {
                jQuery.ajax({
                    url: jQuery(".next-link a").attr('href'),
                    dataType: 'html',
                    success: function(data) {
                    	
                        jQuery('.main-content-preppend').append(
                            jQuery(data).find('.js-responsive-section').find(findId).hide()
                        );
                        jQuery('.main-content-preppend').find(findId).show('slow');
                        if (jQuery(data).find('.next-link a').length) {
                            jQuery(".next-link a").attr({'href': jQuery(data).find('.next-link a').attr('href')});
                        } else {
                            jQuery(".pager-holder a.btn-base").hide();
                        }
                        jQuery("#ajax-loader").hide();
                        //refresh the sticky ad on load more
                        if (jQuery(window).width() >  610 ) {
                        	document.getElementById('sticky-iframe-ad').contentWindow.location.reload();
                        	jQuery(".sidebar.advert").css({
	                        	display: 'block',
								position: 'fixed',
								top: 10
							});
                        }
                        if(jQuery(".next-link a").length){
						    jQuery("a.btn-base").show();
					    }
					}
                });
            }
        });
    });
});
// Flash ad z-index pecking order fix
jQuery(function(){
	FlashHeed.heed();
});

// jFollow
jQuery(function(){
	if (jQuery(".advert").length > 0) {
		jQuery('.advert').jfollow('#responderfollow');
	}
	
	jQuery('.jq-slider').flexslider({
        animation: "slide",
        animationSpeed: 200,
        slideshow: false
      });
      
    jQuery('.jq-ma-slider').flexslider({
        animation: "slide",
        animationSpeed: 200,
        slideshow: true
      });
      
    jQuery('.jq-featured-slider').flexslider({
        animation: "slide",
        animationSpeed: 200,
        slideshow: true
      });
      
    jQuery('.jq-paging-slider').flexslider({
          animation: "slide",
          animationSpeed: 200,
          slideshow: false,
          itemWidth: 312,
          itemMargin: 0,
          minItems: 1,
          maxItems: 3
        });
    
    jQuery('.jq-single-paging-slider').flexslider({
          animation: "slide",
          animationSpeed: 200,
          slideshow: false,
          itemWidth: 340,
          itemMargin: 0,
          minItems: 1,
          maxItems: 1
        });
     
    /*jQuery('.jq-cabela-slider').flexslider({
          animation: "slide",
          animationSpeed: 200,
          slideshow: false,
          itemWidth: 318,
          itemMargin: 0,
        });*/

    jQuery('.jq-custom-form input[type="checkbox"]').ezMark();
    
});


jQuery('.jq-go-top').click(function(){
    jQuery('html, body').animate({scrollTop:0}, 'slow');
    return false;
});

jQuery('.jq-open-search').toggle(function(){
        jQuery('.h-search-form').addClass('h-search-open');
        
    },function(){
        jQuery('.h-search-form').removeClass('h-search-open');
    });

jQuery('.jq-filter-by').toggle(function(){
        jQuery('.filter-by').addClass('filter-open');
        
    },function(){
        jQuery('.filter-by').removeClass('filter-open');
    });
    

jQuery('.aside-menu').on("click", ".mob-aside-menu .has-drop", function(){
    jQuery(this).parent("li").toggleClass('drop-open');
});
jQuery('.aside-menu').on("click", ".mob-aside-menu .has-drop", function(e){
    e.preventDefault();
});


    
//placeholder
jQuery('input[placeholder], textarea[placeholder]').placeholder();

// iphone scale fix
MBP.scaleFix();


function updateSliderCounter(slider){
    jQuery(slider).find('.slide-count').html((slider.currentSlide + 1) + '/' + slider.count);
}



    