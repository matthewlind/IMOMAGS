jQuery(window).load(function() {
	jQuery('.onload-hidden').removeClass('onload-hidden');
    jQuery('.onload-hidden-abs').removeClass('onload-hidden-abs');
    jQuery('.loading-block').removeClass('loading-block');
    //jQuery('#at4m-mobile').appendTo("#page");
});

jQuery(document).ready(function () {
	
	



	jQuery(function(){
		
		if(jQuery.cookie('hide_alert') == null){
		
			jQuery("#tiptip_holder").show();
			jQuery(".community-tooltip").tipTip();
			
			jQuery(".user-btn").click(function(){
				jQuery("#tiptip_holder").hide();
				jQuery.cookie('hide_alert', true);
			});
		}
		
	});
	
	
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
	
	UpdateDrawers = function(){
		var state = snapper.state(),
		towards = state.info.towards,
		opening = state.info.opening;
		if(opening=='right' && towards=='left'){
			jQuery(".snap-drawer-left").hide();
			jQuery(".snap-drawer-right").show();
			
		} else if(opening=='left' && towards=='right') {
			jQuery(".snap-drawer-right").hide();
			jQuery(".snap-drawer-left").show();
			
		}
	};
		
	snapper.on('drag', UpdateDrawers);
	snapper.on('animating', UpdateDrawers);
	snapper.on('animated', UpdateDrawers);
	

		

	//Left Menu
	addEvent(document.getElementById('open-left'), 'click', function(){

		if( jQuery("body").hasClass("snapjs-left") ){
			snapper.close();
			jQuery(".snap-drawer-left").fadeOut();

		} else {
			jQuery("#tiptip_holder").hide();
			jQuery(".snap-drawer-right").hide();
			jQuery(".snap-drawer-left").show();
        	
        	_gaq.push(['_trackPageview',"/" + window.location.pathname + "-mobile-menu-open"]);  
			document.getElementById('menu-iframe-ad').contentWindow.location.reload();
			snapper.open("left");
			
		}
	
	});
	
	//Community Menu
	
    addEvent(document.getElementById('comm-mob-menu'), 'click', function(){

    	if( jQuery("body").hasClass("snapjs-right") ){
        	jQuery(".snap-drawer-right").fadeOut();
			snapper.close();
		} else {
			jQuery(".snap-drawer-left").hide();
        	jQuery(".snap-drawer-right").show();
        	jQuery("#jpsuperheader").addClass("jp-right-menu-open");
        	snapper.open('right');
	        _gaq.push(['_trackPageview',"/" + window.location.pathname + "-mobile-menu-open"]);  
			document.getElementById('menu-iframe-ad').contentWindow.location.reload();				
		}
		
    });
		
	/* Prevent Safari opening links when viewing as a Mobile App */
	(function (a, b, c) {
	    if(c in b && b[c]) {
	        var d, e = a.location,
	            f = /^(a|html)jQuery/i;
	        a.addEventListener("click", function (a) {
	            d = a.target;
	            while(!f.test(d.nodeName)) d = d.parentNode;
	            "href" in d && (d.href.indexOf("http") || ~d.href.indexOf(e.host)) && (a.preventDefault(), e.href = d.href)
	        }, !1)
	    }
	})(document, window.navigator, "standalone");

	// Load more 
	if(jQuery(".next-link a").length){
	    jQuery("a.btn-base").css("display","block");
    }
    	
	if( jQuery(".mob-aside-menu .menu-main-menu-container").length ){
		jQuery(".mob-aside-menu .menu-main-menu-container").removeClass("menu-main-menu-container");
		jQuery(".mob-aside-menu .menu-main-menu-container").addClass("menu-mobile-menu-container");
	}

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
						    jQuery("a.btn-base").css("display","block");
					    }
					}
	            });
            }
        });
    });


// Flash ad z-index pecking order fix
jQuery(function(){
	FlashHeed.heed();
	FlashHeed.heed(document.getElementById('_containermyExperience'));
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
    jQuery('.single-featured-slider').flexslider({
    	animation: "slide",
        animationSpeed: 200,
        slideshow: true,
    	directionNav: true
    });
    jQuery('.jq-ma-slider').flexslider({
        animation: "slide",
        animationSpeed: 200,
        slideshow: true
      });
      
    jQuery('.jq-featured-slider').flexslider({
        animation: "slide",
        animationSpeed: 200,
        controlNav: true,
        directionNav: true,
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
        
    jQuery('.jq-explore-slider').flexslider({
        animation: "slide",
        animationSpeed: 200,
        slideshow: false,
        controlNav: false,
        directionNav: false,
        itemWidth: 123,
        itemMargin: 0,
        minItems: 2,
        maxItems: 4
    });
	jQuery('.jq-explore-slider-sidebar').flexslider({
        animation: "slide",
        animationSpeed: 200,
        slideshow: false,
        controlNav: true,
        directionNav: true,
        itemWidth: 123,
        itemMargin: 0,
        minItems: 2,
        maxItems: 4
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

























