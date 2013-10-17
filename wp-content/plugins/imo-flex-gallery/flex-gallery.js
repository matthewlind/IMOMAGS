function imoFlexSetupMobile(community, pictureLimit){
	jQuery(function(){
		jQuery('.jq-explore-slider').flexslider({
			animation: "slide",
			animationSpeed: 200,
			animationLoop: false,
			slideshow: false,
			controlNav: false,
			directionNav: false,
			itemWidth: 123,
			itemMargin: 0,
			minItems: 4,
			maxItems: pictureLimit
		});
	});
	jQuery(document).ready(function(){
		jQuery('.explore-more-mobile').waitForImages(function() {
			jQuery('.imo-flex-loading-block').removeClass('imo-flex-loading-block');
			jQuery('.explore-more-mobile-container').css({'visibility':'visible'});
		});
	});
	jQuery('.community-select').change(function(){
		flexSortReloadMobile(community);	
	});
}

function imoFlexInitiate(isCommunity, galleryID, totalSlides, isFullScreenNow, isReloaded, callback) {
	jQuery(function(){
		var fslider = 
			jQuery('#carousel-' + galleryID).flexslider({
				animation: "slide",
				controlNav: false,
				animationLoop: false,
				slideshow: false,
				itemWidth: 80,
				itemMargin: 0,
				asNavFor: '#gallery-' + galleryID
			});
		jQuery('#gallery-' + galleryID).flexslider({
			animation: "slide",
			controlNav: false,
			animationLoop: false,
			animationSpeed: 200,
			slideshow: false,
			smoothHeight: false,
			sync: '#carousel-' + galleryID,
			start: function (slider) {
				imoFlexSetup(isCommunity, galleryID, totalSlides, isFullScreenNow, isReloaded);
			},
			after: function (slider) {
				_gaq.push(['_trackPageview',"/" + window.location.pathname + "#" + slider.currentSlide]);
				document.getElementById('gallery-iframe-ad').contentWindow.location.reload();
				
				var theSlide = slider.currentSlide+1;
				var theSlideTitleText = jQuery('#flex-content-title-'+theSlide+' a').text();
				var theSlideTitleLink = jQuery('#flex-content-title-'+theSlide+' a').attr('href');
				var totalSlidesCount = totalSlides;
				while(totalSlidesCount > 0){
					jQuery('#flex-content-'+totalSlidesCount).hide();
					jQuery('#flex-content-title-'+totalSlidesCount).hide();
					jQuery('#flex-content-community-'+totalSlidesCount).hide();
					if(isCommunity == true) {
						jQuery('#flex-addthis-'+totalSlidesCount).css('visibility','hidden');
					}
					totalSlidesCount--;
				}
				jQuery('#flex-content-'+theSlide).show();
				jQuery('#flex-content-title-'+theSlide).show();
				jQuery('#flex-content-community-'+theSlide).show();
				jQuery('span.current-slide').text(theSlide);
				if(isCommunity == true) {
					if (window.addthis) {
						window.addthis = null;
						window._adr = null;
						window._atc = null;
						window._atd = null;
						window._ate = null;
						window._atr = null;
						window._atw = null;
					}
					jQuery.getScript('http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4de0e5f24e016c81');
					jQuery('#flex-addthis-'+theSlide).css('visibility','visible');
					jQuery('.flex-gallery-title h2').html(truncateSlideTitle(theSlideTitleText, theSlideTitleLink));
				}
				jQuery('.flex-content').perfectScrollbar('update');	
			}
		});
	});
	ifCallback(callback);
}

function responsiveReposition() {

}

function imoFlexSetup(isCommunity, galleryID, totalSlidesNow, isFullScreenNow, isReloaded){
	community = isCommunity;
	isFullScreen = isFullScreenNow;
	totalSlides = totalSlidesNow;
	theSlider = jQuery('.flex-gallery').data('flexslider');
	theGallery = galleryID;
	if(isReloaded != true) {
		lockedOpen = false;
		slideOutHover = false;
		containerHover = false;
		slideOutShown = false;
		slideOutPositioned = false;
	}
	
	jQuery(document).ready(function(){
		if(isReloaded != true) {
			jQuery('.flex-gallery-slide-out').hide();
		}
		jQuery('.flex-gallery').waitForImages(function() {
			isLoaded = true;
			centerSlides();
			sizeCarousel();
			jQuery('.imo-flex-loading-block').removeClass('imo-flex-loading-block');
			jQuery('.flex-gallery-inner').removeClass('community-sort-reload');
			jQuery('.flex-gallery-container').css({'background':'#000'});
			jQuery('.flex-gallery, .x-close, .flex-carousel, .flex-direction-nav, .flex-gallery-slide-out-inner').css({'visibility':'visible'});
			jQuery('#flex-gallery-social iframe').addClass('display-inline-block');
			jQuery('').css({'visibility':'visible'});
		});
	
		jQuery('.flex-direction-nav a').text('');
		jQuery('.background-overlay').prependTo('#main');
		if(isFullScreen != true) {
			jQuery('.flex-gallery .flex-direction-nav').prependTo('.flex-gallery .flex-gallery-title');
		}
		jQuery('.flex-carousel .flex-direction-nav').prependTo('.flex-carousel-nav');
		if(jQuery('.flex-carousel-nav .flex-prev').hasClass('flex-disabled')){
			jQuery('.flex-carousel-fade-left').addClass('display-none');
		}
		if(jQuery('.flex-carousel-nav .flex-next').hasClass('flex-disabled')){
			jQuery('.flex-carousel-fade-right').addClass('display-none');
		}
		if (jQuery('#sidebar').length) { //checks for old theme
			jQuery('.flex-carousel-nav ul.flex-direction-nav li').css({'margin-top':'-62px'});
		}
		filterSlideContent();
		jQuery('#flex-content-1').show();
		jQuery('#flex-content-title-1').show();
		jQuery('#flex-content-community-1').show();
		if(isCommunity == true) {
			jQuery('#flex-addthis-1').css('visibility','visible');
			var totalSlidesCount = totalSlides;
			while(totalSlidesCount > 0){
				jQuery('#flex-addthis-'+totalSlidesCount).appendTo('#flex-gallery-social');
				totalSlidesCount--;
			}
		}
		var theSlideTitleText = jQuery('#flex-content-title-1 a').text();
		var theSlideTitleLink = jQuery('#flex-content-title-1 a').attr('href');
		resizeMainTitleH2();
		if(community == true) {
			jQuery('.flex-gallery-title h2').html(truncateSlideTitle(theSlideTitleText, theSlideTitleLink));	
			//Annoying addthis more services should be removed jQuery('#at16p').remove();
		}
		jQuery('.flex-content').perfectScrollbar();
		
		//Events: Navigation
		jQuery('.flex-next, .flex-prev').on('click tap taphold', function(){
			carouselNavStyles();
		});
		//Events: Slide Out
		jQuery('.flex-gallery-container, .flex-gallery-slide-out').mouseleave(function(){
			setTimeout(function(){
				if (containerHover == false && slideOutHover == false && lockedOpen == false && isFullScreen == false) {
					hideSlideOut();
				} 
			}, 100);
		});
		jQuery('.flex-gallery-slide-out').mouseleave(function(){
			slideOutHover = false;
		});
		jQuery('.flex-gallery-slide-out').mouseenter(function(){
			slideOutHover = true;
		});
		jQuery('.flex-gallery-container').mouseleave(function(){
			containerHover = false;
		});
		jQuery('.flex-gallery-container').mouseenter(function(){
			if(isFullScreen == false && isLoaded == true) {
				containerHover = true;
				showSlideOut();
			}
		});
		jQuery('.flex-gallery-container, .flex-gallery-slide-out').click(function(){
			if(isFullScreen == false) {
				lockedOpen = true;
				jQuery('.background-overlay').show();
			}
		});
		jQuery('.flex-gallery-container').on('click swipeleft swiperight tap taphold', function(){
			if(isFullScreen == false && isLoaded == true) {
				showSlideOutTouch();
			}
		});
		
		jQuery('.x-close').on('click tap taphold', function(){
			if(isFullScreen == false) {
				closeSlideout();
			} else {
        		fullScreenClose(function(){
					jQuery('.loading-full-screen').remove();
				});
			}
		});
		jQuery(document).keyup(function(e) {
			if (e.keyCode == 27 && isFullScreen == true) { // Esc
        		fullScreenClose(function(){
					jQuery('.loading-full-screen').remove();
				});
			}
		});
		jQuery('.background-overlay').on('click swipeleft swiperight tap taphold', function(){
			if(isFullScreen == false) {
				closeSlideout();
			}
		});
		jQuery('.btn-full-screen').on('click touchstart', function(){
			if(isFullScreen == false) {
				if(jQuery('#tiptip_holder').css('display') != 'none') {
					tiptipWasShowing = true;
					jQuery('#tiptip_holder').css('display', 'none');
				}
				jQuery('body').append('<div class="loading-full-screen"></div>');	
				setTimeout(function(){
					fullScreenOpen(function(){
						fullScreenOpenTopLeft(function(){
							fullScreenResize(function(){
								jQuery('.loading-full-screen').remove();
								theSlider.resize();
							});
						});
					});
				}, 150);
				
			} else {
				fullScreenClose(function(){
					jQuery('.loading-full-screen').remove();
				});
			}
		});
		jQuery('.community-select').change(function(){
			lockedOpen = true;
			flexSortReload(isCommunity, galleryID, totalSlides, isFullScreen);	
		});
		jQuery(window).bind('resize', function () { 
			if(isFullScreen == false) {
				resizeMainTitleH2();
				centerSlides();
				positionSlideOut();
			} else {
				fullScreenResize();
			}
		});
		if (jQuery('.custom-slider-section').length) {
		//if community page
			jQuery('div.main').bind('resize', function () { 
				if(isFullScreen == false) {
					resizeMainTitleH2();
					centerSlides();
				} else {
					fullScreenResize();
				}
			});
		}
		jQuery(window).bind('orientationchange', function () { 
			if(isFullScreen == false) {
				resizeMainTitleH2();
				theSlider.resize();
				centerSlides();
				sizeCarousel();
			} else {
				fullScreenResize();
			}
		});
		if (jQuery('.custom-slider-section').length) {
		//if community page
			jQuery('div.main').bind('orientationchange', function () { 
				if(isFullScreen == false) {
					resizeMainTitleH2();
					theSlider.resize();
					centerSlides();
					sizeCarousel();
				} else {
					fullScreenResize();
				}
			});
		}
		if(isFullScreen == true) {
			fullScreenResize();
		}

	});
}

function resizeMainTitleH2() {
	jQuery('.flex-gallery-title h2').css({
		'width': jQuery('.flex-gallery-title').width() - (jQuery('.flex-gallery-title .flex-direction-nav').outerWidth() + jQuery('.flex-gallery-title .btn-full-screen').outerWidth() + 10)
	});
}
function truncateSlideTitle(theSlideTitleText, theSlideTitleLink) {
	if(theSlideTitleText.length > 54) {
		var theSlideTitleText = theSlideTitleText.substring(0,45);
		var theSlideTitleText = theSlideTitleText + '. . .';
	}
	if(theSlideTitleText.length > 44) {
		jQuery('.flex-gallery-title h2').addClass('flex-gallery-title-small');
	} else {
		jQuery('.flex-gallery-title h2').removeClass('flex-gallery-title-small');
	}
		var theSlideTitle = '<a href="'+theSlideTitleLink+'">'+theSlideTitleText+'</a>';
	return theSlideTitle;
}

function positionSlideOut(callback) {
	var galPos = jQuery('.flex-gallery-container').offset();
	var galHeight = jQuery('.flex-gallery-container').height();
	var galWidth = jQuery('.flex-gallery-container').width();
	var jpsuperheaderHeight = jQuery('#jpsuperheader').height();
	var slideOutPos = jQuery('.flex-gallery-slide-out').offset();
	var slideOutPosX = slideOutPos.left;
	var slideOutPosY = galPos.top;
	var adHeight = jQuery('.slide-out-ad').height();
	if (community == true) {
		var commFeatHeight = 93;
	} else {
		var commFeatHeight = 0;
	}
	if (jQuery('#sidebar').length) {
		//if old theme post
		var sidebarWidth = jQuery('#sidebar').outerWidth() + 2;
		var galHeight = galHeight - 15;
		jQuery('.flex-content').css({
			'height':galHeight - adHeight + 58 - commFeatHeight
		});
		
		jQuery('.flex-gallery-slide-out').insertBefore('#footer');	
		jQuery('.flex-gallery-slide-out').css({
			'left':galWidth + galPos.left,
			'height':galHeight,
			'width':sidebarWidth+15,
			'position':'absolute',
			'top':slideOutPosY
		});
	}
	if (jQuery('#sidebar').length + jQuery('.sidebar-area').length == 0 && jQuery('div.entry-content').length) {
		//if old theme page
		var galHeight = galHeight - 15;
		jQuery('.flex-content').css({
			'height':galHeight - adHeight - commFeatHeight - 45
		});
		
		jQuery('.flex-gallery-slide-out').insertBefore('#footer');	
		jQuery('.flex-gallery-slide-out').css({
			'left':galWidth + galPos.left,
			'height':galHeight,
			'width':jQuery('div.entry-content').width() - jQuery('.flex-gallery-container').width() - 15,
			'position':'absolute',
			'top':slideOutPosY
		});
	}
	if (jQuery('.sidebar-area').length) {
	//if new responsive theme
		if (jQuery('.inner-main').length) {
		//if post page
			var sidebarWidth = jQuery('div.inner-main').outerWidth() - jQuery('#content').outerWidth() - 15;
			jQuery('.flex-content').css({
				'height':galHeight - adHeight + 40 - commFeatHeight
			});
			jQuery('.flex-gallery-slide-out').insertAfter('.wrapper');	
			jQuery('.flex-gallery-slide-out').css({
				'left':galWidth + galPos.left,
				'height':galHeight,
				'width':sidebarWidth+15,
				'position':'absolute',
				'top':slideOutPosY
			});
		} else if (jQuery('.custom-slider-section').length) {
		//if community page
			var sidebarWidth = jQuery('#main').outerWidth() - jQuery('#content').outerWidth() - 15;
			jQuery('.flex-content').css({
				'height':galHeight - adHeight + 40 - commFeatHeight
			});
			jQuery('.flex-gallery-slide-out').insertAfter('.layout-frame');	
			jQuery('.flex-gallery-slide-out').css({
				'left':galWidth + galPos.left,
				'height':galHeight,
				'width':jQuery('div.main').width() - jQuery('.custom-slider-section').width() - 2,
				'position':'absolute',
				'top':slideOutPosY
			});
		}
	}

	slideOutPositioned = true;
	ifCallback(callback);
}

function showSlideOut() {
	if(slideOutShown == false){
		if(slideOutPositioned == false){
			positionSlideOut();
		}
		jQuery('.flex-gallery-slide-out').css({'visibility': 'visible'});
		if(community == true) {
			jQuery('.flex-gallery-slide-out').show('slide', { direction: 'left' }, 550, 'easeOutCirc');
		} else {
			jQuery('.flex-gallery-slide-out').show('slide', { direction: 'left' }, 300, 'easeOutExpo');
		}
		jQuery('.flex-content').delay(100).perfectScrollbar('update');
		slideOutShown = true;
	}
}

function showSlideOutTouch() {
	if (lockedOpen == false) {
		lockedOpen = true;
		jQuery('.background-overlay').show();
		//positionSlideOut();
		showSlideOut();
	}
}

function hideSlideOut(callback) {
	slideOutShown = false;
	jQuery('.flex-gallery-slide-out').hide('slide', { direction: 'left' }, 300);
	ifCallback(callback);
}
	
function closeSlideout() {
	lockedOpen = false;
	setTimeout(function(){
	jQuery('.background-overlay').hide();
	}, 50);
	hideSlideOut();
}

function centerSlides(callback) {
	var viewportHeight = parseInt(jQuery('.flex-gallery .flex-viewport').height()+1);
	jQuery('.flex-slide').css({     
		'height':viewportHeight+'px',
		'line-height':viewportHeight+'px'
	});
	ifCallback(callback);
}

function sizeCarousel(totalSlides, callback) {
	var caroWidth = jQuery('.flex-gallery-container').width() - 150; 
	var caroThumbsWidth = totalSlides * 80;
	if(caroWidth > caroThumbsWidth) {
		var caroWidth =  caroThumbsWidth;
	}
	jQuery('.flex-carousel').css('width', caroWidth);
	carouselNavStyles();
	ifCallback(callback);
	
}

function carouselNavStyles() {
	if(jQuery('.flex-carousel-nav .flex-prev').hasClass('flex-disabled')){
		jQuery('.flex-carousel ul').css('margin-left', '-10px');
		jQuery('.flex-carousel-fade-left').addClass('display-none');
	} else if(jQuery('.flex-carousel-nav .flex-next').hasClass('flex-disabled')){
		jQuery('.flex-carousel ul').css('margin-left', '-30px');
		jQuery('.flex-carousel-fade-right').addClass('display-none');
	}
			
	if(jQuery('.flex-carousel-nav .flex-prev').hasClass('flex-disabled') == false){
		jQuery('.flex-carousel-fade-left').removeClass('display-none');
	}
	if(jQuery('.flex-carousel-nav .flex-next').hasClass('flex-disabled') == false){
		jQuery('.flex-carousel-fade-right').removeClass('display-none');
	}
}
function fullScreenOpen(callback) {
	if(isFullScreen == false) {
		isFullScreen = true;
		slideOutShown = true;
		slideOutPositioned = true;
		origParent = jQuery('.flex-gallery-container').parent();
		origX = jQuery('.flex-gallery-container').css('left');
		origY = jQuery('.flex-gallery-container').css('top');
		origWidth = jQuery('.flex-gallery-container').css('width');
		origHeight = jQuery('.flex-gallery-container').css('height');
		origZ = jQuery('.flex-gallery-container').css('z-index');
		origPosition = jQuery('.flex-gallery-container').css('position');
		origMargin = jQuery('.flex-gallery-container').css('margin');
		origWidthContent = jQuery('.slide-out-content').css('width');
		origWidthFlexContent = jQuery('.flex-content').css('width');
		origZslideOut = jQuery('.flex-gallery-slide-out').css('z-index');
		origXcloseMargin = jQuery('.x-close').css('margin');	
	}

	jQuery('body').addClass('flex-full-body');
	jQuery('.flex-gallery-container, .flex-gallery-slide-out').addClass('flex-fullscreen');
	jQuery('.flex-gallery-container').prependTo('body');
	jQuery('.flex-gallery-slide-out').attr('style','');
	jQuery('.flex-gallery-slide-out').insertAfter('.flex-gallery-container');
	
	ifCallback(callback);	
}


function fullScreenOpenTopLeft(callback) {
	jQuery('#flex-gallery-social').prependTo('.flex-gallery');
	jQuery('.flex-gallery .flex-direction-nav').insertAfter('#flex-gallery-social');
	jQuery('.btn-full-screen').insertAfter('.flex-gallery .flex-direction-nav');
	jQuery('.flex-counter').insertAfter('.btn-full-screen');
	jQuery('.flex-gallery .flex-direction-nav').clone(true,true).appendTo('.flex-gallery .flex-viewport').attr('id','flex-direction-nav-clone');
	jQuery('.btn-full-screen').text('Exit Fullscreen');
	jQuery('#flex-direction-nav-clone').hide();
	
	jQuery('.flex-fullscreen .flex-gallery .flex-viewport').mouseenter(function(){
		jQuery('#flex-direction-nav-clone').fadeIn();	
	});
	jQuery('.flex-fullscreen .flex-gallery .flex-viewport').mouseleave(function(){
		jQuery('#flex-direction-nav-clone').fadeOut();	
	});
	ifCallback(callback);
}

function fullScreenResize(callback) {
	var fullSliderWidth = jQuery(window).width() - 325;
	var winHeight = jQuery(window).height();
	var adHeight = jQuery('.slide-out-ad').height();
	if (community == true) {
		var commFeatHeight = 93;
	} else {
		var commFeatHeight = 0;
	}
	jQuery('.flex-gallery-container').css({'height':'100%','width':fullSliderWidth+'px'});
	
	if (jQuery('.sidebar-area').length) {
		//if new responsive theme
		jQuery('.flex-content').css({
			'width':'301px',
			'height':winHeight - adHeight + 40 - commFeatHeight
		});
		jQuery('.flex-fullscreen .slide-out-content-top').css({
			'width':'294px'
		});
	} else {
		//old theme post
		var winHeight = winHeight - 15;
		jQuery('.flex-content').css({
			'width':'283px',
			'height':winHeight - adHeight + 58 - commFeatHeight
		});
		jQuery('.flex-gallery-slide-out').css('margin-right','-25px');
		jQuery('.x-close').css('margin-right','16px');
		if (jQuery('#sidebar').length + jQuery('.sidebar-area').length == 0 && jQuery('div.entry-content').length) {
			//if old theme page
			jQuery('.flex-content').css({
				'height':winHeight - adHeight - commFeatHeight - 45
			});
		}
		jQuery('.flex-gallery-container').css('width',fullSliderWidth + 15 + 'px');
	}
	
	fullViewportHeight = parseInt(jQuery('.flex-gallery-container').height() - jQuery('.flex-carousel').outerHeight() - jQuery('#flex-gallery-top-left').outerHeight() - 5);
	jQuery('.flex-gallery .flex-viewport').css({
		'height':fullViewportHeight+'px',
		'max-height':'none'
	});
	jQuery('.flex-slide').css({     
		'height':fullViewportHeight+'px',
		'line-height':fullViewportHeight+'px'
	});
	jQuery('.flex-slide img').css({     
		'max-height':(jQuery('.flex-slide').height()-3)+'px'
	});
	jQuery('#flex-direction-nav-clone').css({
		'top':(jQuery('.flex-gallery .flex-viewport').height()/2) - (jQuery('.flex-gallery .flex-direction-nav').height()/2)
	});
	sizeCarousel();
	setTimeout(function(){
	jQuery('.flex-gallery-slide-out').attr('style','');//repat from above for ios, figure this out and delete later. something is adding styles we on't want
	}, 500);
	jQuery('.flex-content').delay(100).perfectScrollbar('update');
	window.scrollTo(0, 0);//Fixes Chrome OS X bug
	ifCallback(callback);
}

function fullScreenClose(callback) {
	isFullScreen = false;
	lockedOpen = false;
	slideOutShown = false;
	slideOutPositioned = false;
	containerHover = false;
	slideOutHover = false;

	jQuery('body').removeClass('flex-full-body');
	jQuery('body').css({'overflow':'visible'});
	jQuery('.flex-gallery-container').removeClass('flex-fullscreen');
	jQuery('.flex-gallery-slide-out').removeClass('flex-fullscreen');
	jQuery('.flex-gallery .flex-viewport').css('visibility', 'hidden');
	jQuery('.flex-gallery-slide-out').attr('style', '');
	setTimeout(function(){jQuery('.background-overlay').hide();},50);

	jQuery('.flex-gallery-container').insertAfter('.flex-gallery-insertion-point');
	jQuery('#flex-gallery-social').appendTo('.flex-gallery-title');
	jQuery('.flex-counter').insertAfter('#flex-gallery-social');
	jQuery('.flex-gallery .flex-direction-nav').prependTo('.flex-gallery-title');
	jQuery('#flex-direction-nav-clone').remove();
	jQuery('.btn-full-screen').text('Fullscreen');
	jQuery('.btn-full-screen').insertAfter('.flex-gallery .flex-direction-nav');
	jQuery('.flex-gallery-container').css({
		'position':origPosition,
		'margin-top':origMargin,
		'top':origY,
		'left':origX,
		'height':origHeight,
		'width':origWidth,
		'z-index':origZ
	});
	theSlider.resize();
	var fullViewportHeight = parseInt(jQuery('.flex-gallery-container').height() - jQuery('.flex-carousel').outerHeight() - jQuery('.flex-gallery-title').outerHeight() - 26);
	jQuery('.flex-gallery .flex-viewport').css({
		'height':fullViewportHeight+'px',
		'max-height':'none'
	});
	jQuery('.flex-slide').css({     
		'height':fullViewportHeight+'px',
		'line-height':fullViewportHeight+'px'
	});
	jQuery('.flex-slide img').css({     
		'max-height':(jQuery('.flex-slide').height()-3)+'px'
	});
	sizeCarousel();

	jQuery('.flex-gallery .flex-viewport').hide();
	jQuery('.flex-gallery .flex-viewport').css('visibility', 'visible');
	jQuery('.flex-gallery .flex-viewport').fadeIn();

	
	jQuery(window).scrollTop(jQuery('.flex-gallery-insertion-point').offset().top);
	if(tiptipWasShowing == true) {
		tiptipWasShowing = null;
		jQuery('#tiptip_holder').css('display', 'block');
	}

	jQuery('.flex-gallery-slide-out').insertBefore('#footer');
	jQuery('.slide-out-content-top').css({
		'width':'auto'
	});
	if (jQuery('#sidebar').length) {
		//checks for old theme
		jQuery('.flex-content').css({
			'width':origWidthFlexContent
		});
	} else {
		//if(jQuery('.slide-out-ad').width() > origWidthContent){origWidthContent = jQuery('.slide-out-ad').width();}
		jQuery('.flex-content').css({
			'width':origWidthContent
		});
	}
	jQuery('.x-close').css('margin', origXcloseMargin);
	jQuery('.flex-gallery-slide-out').hide();
	jQuery('.flex-gallery-slide-out').css('visibility', 'visible');

	setTimeout(function(){
		slideOutShown = false;
		slideOutPositioned = false;
		lockedOpen = false;
	}, 100);
	ifCallback(callback);
}


function flexSortReload(isCommunity, galleryID, totalSlides, isFullScreen) {
	jQuery('.flex-gallery-slide-out-inner, .flex-gallery, .flex-carousel-nav, .flex-carousel, .flex-carousel-fade-left, .flex-carousel-fade-right, .x-close').fadeOut('fast');
	jQuery('.flex-gallery-inner').addClass('community-sort-reload');
	jQuery('.community-sort-reload').css({'height':jQuery('.flex-gallery-inner').height()});
	jQuery('.community-sort-reload').css({'background-position':((jQuery('.flex-gallery').width()+jQuery('.flex-gallery-slide-out').width())/2) - 104+'px 50%'});
	jQuery.get(window.location, {gallery_sort:jQuery('.community-select').val()}, function(data){
		var sortObj = document.createElement('div')
		sortObj.innerHTML = data;
		jQuery('.flex-gallery-inner').html(jQuery(sortObj).find('.flex-gallery-inner').html());
		jQuery('#flex-gallery-social-save').remove();
		jQuery('#flex-gallery-social').html(jQuery(sortObj).find('#flex-gallery-social-save').html());
		jQuery('.flex-gallery-slide-out').html(jQuery(sortObj).find('.flex-gallery-slide-out').html());
		sortObj = null;
		imoFlexInitiate(isCommunity, galleryID, totalSlides, isFullScreen, true, function(){
			positionSlideOut();
			if(isFullScreen == true) {
				fullScreenOpenTopLeft();
				jQuery('.flex-gallery-slide-out').attr('style','');
				jQuery('.flex-gallery-slide-out').insertAfter('.flex-gallery-container');
			}
			//jQuery('.flex-addthis').each(function(i,e) {		
				if (window.addthis) {
					window.addthis = null;
					window._adr = null;
					window._atc = null;
					window._atd = null;
					window._ate = null;
					window._atr = null;
					window._atw = null;
				}
				jQuery.getScript('http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4de0e5f24e016c81');
				//addthis.toolbox(e);
				//var urlFix = jQuery(e).find('div:first').attr('addthis:url');
				//var wrongUrlInstance = new RegExp(encodeURIComponent(window.location), 'g');
				//var fbSrc = jQuery(e).find('.addthis_button_facebook_like iframe').attr('src');
				//var gSrc = jQuery(e).find('.addthis_button_google_plusone iframe').attr('src');			
				//Facebook
				//jQuery(e).find('.addthis_button_facebook_like, .fb-like').attr('data-href', urlFix);
				//jQuery(e).find('.addthis_button_facebook_like iframe').attr('src', fbSrc.replace(wrongUrlInstance, encodeURIComponent(urlFix)));
				//Google Plus
				//jQuery(e).find('.addthis_button_google_plusone iframe').attr('src', gSrc.replace(wrongUrlInstance, encodeURIComponent(urlFix)));							
				//Twitter
				//jQuery(e).find('.addthis_button_tweet .twitter-share-button').attr('data-url', urlFix);
				//jQuery(e).find('.addthis_button_tweet .twitter-share-button').attr('data-counturl', urlFix);
				//jQuery(e).find('.addthis_button_tweet .twitter-share-button').attr('data-text', jQuery('#flex-content-title-'+(i+1)).text());
			//});
		});
	}, 'html');
}

function flexSortReloadMobile(community) {
	var sortBy = jQuery('.community-select').val();
	jQuery('.imo-flex-mobile').remove();
	jQuery('<div class="imo-flex-mobile imo-flex-loading-block"></div>').insertAfter('.flex-gallery-insertion-point');
	jQuery('.imo-flex-mobile').load(window.location + '?gallery_sort='+sortBy+' .explore-more-mobile-container', function() {
				imoFlexSetupMobile(community);
	});
}

function filterSlideContent() {
		//Filter Videos
		var i = 1;
		while(i <= totalSlides) {
			var iframe = jQuery('#flex-content-'+i).find('iframe').html();
			var object = jQuery('#flex-content-'+i).find('object').html();
			
			if(iframe != null) {
				jQuery('li.flex-slide-'+i).html(jQuery('#flex-content-'+i).find('iframe'));
				setTimeout(function(){
					jQuery('li.flex-slide-'+i+' iframe').css({'margin-top': (jQuery('li.flex-slide-'+i).height() - jQuery('li.flex-slide-'+i+' iframe').height())/2});
				},500);
				jQuery('#flex-content-'+i).find('iframe').remove();
			} 
			if(object != null ) {
				jQuery('li.flex-slide-'+i).html(jQuery('#flex-content-'+i).find('object'));
				jQuery('#flex-content-'+i).find('object').remove();
			}
			i++;
		}
}

function ifCallback(callback){
	if(typeof callback === 'function' && callback()){
		callback();
	}
}

/*
waitForImages() jQuery Plugin
https://github.com/alexanderdickson/waitForImages
*/
!function(a){var b="waitForImages";a.waitForImages={hasImageProperties:["backgroundImage","listStyleImage","borderImage","borderCornerImage","cursor"]},a.expr[":"].uncached=function(b){if(!a(b).is('img[src!=""]'))return!1;var c=new Image;return c.src=b.src,!c.complete},a.fn.waitForImages=function(c,d,e){var f=0,g=0;if(a.isPlainObject(arguments[0])&&(e=arguments[0].waitForAll,d=arguments[0].each,c=arguments[0].finished),c=c||a.noop,d=d||a.noop,e=!!e,!a.isFunction(c)||!a.isFunction(d))throw new TypeError("An invalid callback was supplied.");return this.each(function(){var h=a(this),i=[],j=a.waitForImages.hasImageProperties||[],k=/url\(\s*(['"]?)(.*?)\1\s*\)/g;e?h.find("*").addBack().each(function(){var b=a(this);b.is("img:uncached")&&i.push({src:b.attr("src"),element:b[0]}),a.each(j,function(a,c){var d,e=b.css(c);if(!e)return!0;for(;d=k.exec(e);)i.push({src:d[2],element:b[0]})})}):h.find("img:uncached").each(function(){i.push({src:this.src,element:this})}),f=i.length,g=0,0===f&&c.call(h[0]),a.each(i,function(e,i){var j=new Image;a(j).on("load."+b+" error."+b,function(a){return g++,d.call(i.element,g,f,"load"==a.type),g==f?(c.call(h[0]),!1):void 0}),j.src=i.src})})}}(jQuery);