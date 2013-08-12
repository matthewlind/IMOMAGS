jQuery(window).load(function() {
	jQuery('.onload-hidden').removeClass('onload-hidden');
    jQuery('.onload-hidden-abs').removeClass('onload-hidden-abs');
    jQuery('.loading-block').removeClass('loading-block');
    
});

jQuery(function(){
    
jQuery(document).ready(function () {

	var snapper = new Snap({
		element: document.getElementById('page')
	});
	
	var addEvent = function addEvent(element, eventName, func) {
		if (element.addEventListener) {
	    	return element.addEventListener(eventName, func, false);
	    } else if (element.attachEvent) {
	        return element.attachEvent("on" + eventName, func);
	    }
	};
	
	ie9 = false;
	addEvent(document.getElementById('open-left'), 'click', function(){
		
		var data = snapper.state();
		
		//IE9 menu close fix
		if( jQuery("#page").hasClass("ie9fix") ){
			if( ie9 == false ){
				jQuery(".snap-drawers").show();
        	snapper.open("left");
        	_gaq.push(['_trackPageview',"/" + window.location.pathname + "-mobile-menu-open"]);  
        	ie9 = true;
			document.getElementById('menu-iframe-ad').contentWindow.location.reload();

			} else {
				ie9 = false;
				snapper.close();
				jQuery(".snap-drawers").fadeOut();
		   	}
		}else{
		
			if( data.state == "closed" ){
				jQuery(".snap-drawers").show();
	        	snapper.open("left");
	        	_gaq.push(['_trackPageview',"/" + window.location.pathname + "-mobile-menu-open"]);  
				document.getElementById('menu-iframe-ad').contentWindow.location.reload();
	
			} else {
				snapper.close();
				jQuery(".snap-drawers").fadeOut();
		   	}
		}
	});
	
	
	

	/* Prevent Safari opening links when viewing as a Mobile App */
	(function (a, b, c) {
	    if(c in b && b[c]) {
	        var d, e = a.location,
	            f = /^(a|html)$/i;
	        a.addEventListener("click", function (a) {
	            d = a.target;
	            while(!f.test(d.nodeName)) d = d.parentNode;
	            "href" in d && (d.href.indexOf("http") || ~d.href.indexOf(e.host)) && (a.preventDefault(), e.href = d.href)
	        }, !1)
	    }
	})(document, window.navigator, "standalone");

	// Load more 
	if(jQuery(".next-link a").length){
	    jQuery("a.btn-base").show();
    }
    	
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

jQuery(function(){
	
	// jFollow
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
    

jQuery('.snap-drawers').on("click", ".mob-aside-menu .has-drop", function(){
    jQuery(this).parent("li").toggleClass('drop-open');
});
jQuery('.snap-drawers').on("click", ".mob-aside-menu .has-drop", function(e){
    e.preventDefault();
});


    
//placeholder
jQuery('input[placeholder], textarea[placeholder]').placeholder();

// iphone scale fix
MBP.scaleFix();


function updateSliderCounter(slider){
    jQuery(slider).find('.slide-count').html((slider.currentSlide + 1) + '/' + slider.count);
}



    