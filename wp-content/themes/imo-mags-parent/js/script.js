jQuery(window).load(function() {
	jQuery('.onload-hidden').removeClass('onload-hidden');
    jQuery('.onload-hidden-abs').removeClass('onload-hidden-abs');
    jQuery('.loading-block').removeClass('loading-block');
    //jQuery('#at4m-mobile').appendTo("#page");
    jQuery('td.gsc-input').removeClass('gsc-input');
    jQuery('.gsc-search-button').attr('src','').removeClass('gsc-search-button');
    jQuery(".feat-text.exp").css("height","0px");
	var li_height = jQuery(".flex-active-slide").height();
	jQuery(".gallery-slider div.flex-viewport").css("max-height",li_height);
});

jQuery(document).ready(function () {
	// TV-show functions
	function heightToggle() {
		jQuery(".m-shows-airtime").toggleClass("height-auto");
	}
	// End TV-show functions
	
	if(jQuery(".featured-area").length && jQuery(".posts-list").length){
		//remove any duplicate posts that are already in the featured area   
		var post;
		var remove;
		var featuredArray = [];
		
		jQuery('.featured-area').find(".home-featured").each(function(index){
			featuredArray.push(jQuery(this).attr("featured_id"));
		});
		
		jQuery.each(featuredArray, function (i, item) {
			post = jQuery(".posts-list").find("."+item);
			jQuery(".posts-list").find(".post-"+item).addClass(item);
			
			remove = post.selector;
			
		    if(remove == '.posts-list .'+item || remove == '.posts-list .'+category){ 
		        jQuery(remove).remove(); 
		   }
		});
	}
	//sidebar featured text  overlay
	jQuery('.sidebar-widget-featured li.sidebar-featured').hover(function () {
        jQuery(this).find('.feat-text').animate({'bottom': '-80px'});

    }, function () {
        jQuery(this).find('.feat-text').animate({'bottom': 0});
	});

	// jQuery('.sidebar-widget-featured li.footer-featured').hover(function () {
 //        jQuery(this).find('.feat-text').animate({'bottom': '-150px'});

 //    }, function () {
 //        jQuery(this).find('.feat-text').animate({'bottom': 0});
	// });

	/*****
	**
	** IMO NETWORK TOPHAT
	**
	*****/


		var $window = jQuery(window);
	    var $networkNav = jQuery(".network-nav");
	    var $tophat = jQuery("#imo-tophat");

	    // show network nav at top on load
	    if ($window.scrollTop() != 0) {
	        $networkNav.slideDown(1000,function(){
		        jQuery(this).css("top", "30px");
		    });
	    }
	    setTimeout(function() {
	    // Moves status bar to top of browser window on scroll
	    $window.scroll(function () {
	        $networkNav.stop().animate({
	            top: -100
	            }, 500, function() {
	                if ($window.scrollTop() == 0) {
	                    jQuery(this).animate({ display: 'block',top: 30 },300); // return to default position
	                }
	        });
	    });
	    }, 1000);

	    //hover over to reveal
		$tophat.hover(function(){
	    	$networkNav.slideDown(100,function(){
	    		jQuery(this).stop().animate({top: 30});
	    	});

	    });






	jQuery(function(){

		if(jQuery.cookie('hide_alert') == null){

			jQuery("#tiptip_holder").show();
			jQuery("#imo-modal").show();
			
			jQuery(".community-tooltip").tipTip();

			jQuery(".user-btn, .modal-close").click(function(){
				jQuery("#tiptip_holder").hide();
				jQuery("#imo-modal").hide();
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
			var _gaq = _gaq || [];
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
    	//console.log(_gaq.push(['_trackPageview',window.location.pathname + "/page/"]));
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
	                        jQuery(data).find('.posts-list.js-responsive-section').find(findId).hide()
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
        
    jQuery('#photoSlider.reader-photo-slider .photo-slider').flexslider({
		slideshow: false, 
		animation: "slide",
		animationSpeed: 200,
		controlNav: false,               
		directionNav: true
	});


    jQuery('.jq-custom-form input[type="checkbox"]').ezMark();
    jQuery('.jq-custom-form input[type="checkbox"]').show();

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

jQuery(window).scroll(function () {
	if (jQuery(window).scrollTop() > 50) {
		jQuery('.fixed-connect-mobile').fadeIn();
	}else{
		jQuery('.fixed-connect-mobile').fadeOut("fast");
	}
});

jQuery('.fixed-connect .close').click(function(){
	jQuery('.fixed-connect').remove();
});

//placeholder
jQuery('input[placeholder], textarea[placeholder]').placeholder();

// iphone scale fix
MBP.scaleFix();


function updateSliderCounter(slider){
    jQuery(slider).find('.slide-count').html((slider.currentSlide + 1) + '/' + slider.count);
}




















