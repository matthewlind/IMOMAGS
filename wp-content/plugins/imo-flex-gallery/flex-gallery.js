var isLoaded;
function imoFlexSetupMobile(isCommunity){
	community = isCommunity;
	jQuery(document).ready(function(){
		jQuery('.explore-more-mobile').waitForImages(function() {
			jQuery('.imo-flex-loading-block').removeClass('imo-flex-loading-block');
			jQuery('.explore-more-mobile-container').css({'visibility':'visible'});
		});
	});
	jQuery('.community-select').change(function(){
		flexSortReloadMobile();	
	});
}

function imoFlexInitiate(isCommunity, galleryID, totalSlides, isFullScreenNow) {
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
			animationLoop: true,
			animationSpeed: 200,
			slideshow: false,
			smoothHeight: false,
			sync: '#carousel-' + galleryID,
			start: function (slider) {
				imoFlexSetup(isCommunity, galleryID, totalSlides, isFullScreenNow);
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
					totalSlidesCount--;
				}
				jQuery('#flex-content-'+theSlide).show();
				jQuery('#flex-content-title-'+theSlide).show();
				jQuery('#flex-content-community-'+theSlide).show();
				jQuery('span.current-slide').text(theSlide);
				if(isCommunity == true) {
					jQuery('.flex-gallery-title h2').html(truncateSlideTitle(theSlideTitleText, theSlideTitleLink));
				}
				jQuery('.flex-content').perfectScrollbar('update');	
			}
		});
	});
}

function imoFlexSetup(isCommunity, galleryID, totalSlides, isFullScreenNow){
	community = isCommunity;
	isFullScreen = isFullScreenNow;
	lockedOpen = false;
	slideOutHover = false;
	containerHover = false;
	slideoutPositioned = false;
	theSlider = jQuery('.flex-gallery').data('flexslider');
	
	jQuery(document).ready(function(){
		jQuery('.flex-gallery-slide-out').hide();
		jQuery('.flex-gallery').waitForImages(function() {
			isLoaded = true;
			centerSlides();
			jQuery('.imo-flex-loading-block').removeClass('imo-flex-loading-block');
			jQuery('.flex-gallery-container').css({'background':'#000'});
			jQuery('.flex-gallery').css({'visibility':'visible'});
			jQuery('.flex-carousel').css({'visibility':'visible'});	
		});
	
		jQuery('.flex-direction-nav a').text('');
		jQuery('.background-overlay').prependTo('#main');
		jQuery('.flex-gallery .flex-direction-nav').prependTo('.flex-gallery .flex-gallery-title');
		jQuery('.flex-carousel .flex-direction-nav').prependTo('.flex-carousel-nav');
			if (jQuery('#sidebar').length) { //checks for old theme
				jQuery('.flex-carousel-nav ul.flex-direction-nav li').css({'margin-top':'-62px'});
			}
		jQuery('#flex-content-1').show();
		jQuery('#flex-content-title-1').show();
		jQuery('#flex-content-community-1').show();
		var theSlideTitleText = jQuery('#flex-content-title-1 a').text();
		var theSlideTitleLink = jQuery('#flex-content-title-1 a').attr('href');
		if(community == true) {
			jQuery('.flex-gallery-title h2').html(truncateSlideTitle(theSlideTitleText, theSlideTitleLink));
		}
		jQuery('.flex-content').perfectScrollbar();
		
		//Event triggers
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
		jQuery('.x-close').on('click touchstart', function(){
			if(isFullScreen == false) {
				closeSlideout();
			} else {
				closeFullScreen();
			}
		});
		jQuery('.background-overlay').on('click touchstart', function(){
			if(isFullScreen == false) {
				closeSlideout();
			}
		});
		jQuery('.btn-full-screen').on('click touchstart', function(){
			if(isFullScreen == false) {
				goFullScreen();
			} else {
				closeFullScreen();
			}
		});
		jQuery('.community-select').change(function(){
			lockedOpen = true;
			flexSortReload(isCommunity, galleryID, totalSlides, isFullScreenNow);	
		});
		jQuery(window).bind('resize', function () { 
			if(isFullScreen == false) {
				positionSlideOut();
				centerSlides();
			} else {
				sizeFullScreen();
			}
		});
		if (jQuery('.custom-slider-section').length) {
		//if community page
			jQuery('div.main').bind('resize', function () { 
				if(isFullScreen == false) {
					positionSlideOut();
					centerSlides();
				} else {
					sizeFullScreen();
				}
			});
		}
		
		if(isFullScreen == true) {
			goFullScreen();
		}

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

function positionSlideOut() {
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
		//if old theme
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
	if (jQuery('.sidebar-area').length) {
	//if new responsive theme
		if (jQuery('.inner-main').length) {
		//if post page
			var sidebarWidth = jQuery('div.inner-main').outerWidth() - jQuery('#content').outerWidth() - 15;
			jQuery('.flex-content').css({
				'height':galHeight - adHeight + 40 - commFeatHeight
			});
			jQuery('.flex-gallery-slide-out').insertBefore('#footer');	
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

	slideoutPositioned = true;
}

function showSlideOut() {
	if(slideoutPositioned == false){
		positionSlideOut();
	}
	jQuery('.flex-gallery-slide-out').css({'visibility': 'visible'});
	jQuery('.flex-gallery-slide-out').show('slide', { direction: 'left' }, 300);
	jQuery('.flex-content').delay(100).perfectScrollbar('update');
}

function hideSlideOut() {
	jQuery('.flex-gallery-slide-out').hide('slide', { direction: 'left' }, 300);
}
	
function closeSlideout() {
	lockedOpen = false;
	setTimeout(function(){
	jQuery('.background-overlay').hide();
	}, 50);
	hideSlideOut();
}

function showSlideOutTouch() {
	if (lockedOpen == false) {
		lockedOpen = true;
		jQuery('.background-overlay').show();
		//positionSlideOut();
		showSlideOut();
	}
}
function centerSlides() {
	var viewportHeight = parseInt(jQuery('.flex-gallery .flex-viewport').height()+1);
	jQuery('.flex-slide').css({     
		'height':viewportHeight+'px',
		'line-height':viewportHeight+'px'
	});
}
function goFullScreen() {
	if(isFullScreen == false) {
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
		origWidthSlideOut = jQuery('.flex-gallery-slide-out').css('width');
		origZslideOut = jQuery('.flex-gallery-slide-out').css('z-index');
		origXcloseMargin = jQuery('.x-close').css('margin');
		isFullScreen = true;
	}
	
	
	jQuery('body').addClass('flex-full-body');
	jQuery('.flex-gallery-container').addClass('flex-fullscreen');
	jQuery('.flex-gallery-slide-out').addClass('flex-fullscreen');
	jQuery('.flex-gallery-container').prependTo('body');
	jQuery('#flex-gallery-social').prependTo('.flex-gallery');
	jQuery('.flex-gallery .flex-direction-nav').insertAfter('#flex-gallery-social');
	jQuery('.btn-full-screen').insertAfter('.flex-gallery .flex-direction-nav');
	jQuery('.flex-counter').insertAfter('.btn-full-screen');
	jQuery('.flex-gallery .flex-direction-nav').clone(true,true).appendTo('.flex-gallery .flex-viewport').attr('id','flex-direction-nav-clone');
	jQuery('.flex-gallery-slide-out').prependTo('.flex-gallery-container');
	jQuery('.btn-full-screen').text('Exit Fullscreen');
	jQuery('#flex-direction-nav-clone').hide();

	jQuery('.flex-gallery-container').css({
		'position':'fixed',
		'margin-top':'0px',
		'top':'0',
		'left':'0',
		'z-index':'200000006'/*in response to an element in jpsuperheader with a 200000005 z-index*/
	});
	jQuery('.flex-gallery-slide-out').css({
		'top':'0' ,
		'z-index':'200000007'
	});

	jQuery('.flex-fullscreen .flex-gallery .flex-viewport').mouseenter(function(){
		jQuery('#flex-direction-nav-clone').fadeIn();	
	});
	jQuery('.flex-fullscreen .flex-gallery .flex-viewport').mouseleave(function(){
		jQuery('#flex-direction-nav-clone').fadeOut();	
	});
	
	sizeFullScreen();
	theSlider.resize();
}

function sizeFullScreen() {
	jQuery('.flex-gallery-slide-out').css({
		'width':'330px'
	});
	jQuery('.flex-content').css({
		'width':'283px'
	});
	var fullSliderWidth = jQuery(window).width() - jQuery('.flex-gallery-slide-out').outerWidth();
	jQuery('.flex-gallery-container').css({
		'width':fullSliderWidth + 15,
		'height':'100%'
	});
	jQuery('.flex-gallery-slide-out').css({
		'left':fullSliderWidth,
		'height':'100%'	
	});
	if (jQuery('.sidebar-area').length) {
		//above line checks if new sidebar exists, indicator of new theme
		jQuery('.flex-fullscreen .slide-out-content-top').css({
			'width':'294px'
		});
		jQuery('.flex-content').css({
			'width':'301px'
		});
		jQuery('.flex-gallery-container').css({
			'width':fullSliderWidth
		});
	}
	positionSlideOut(); 
	fullViewportHeight = parseInt(jQuery('.flex-gallery-container').height() - jQuery('.flex-carousel').outerHeight() - jQuery('#flex-gallery-social').outerHeight() - 32);
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
	jQuery('.flex-content').delay(100).perfectScrollbar('update');
	window.scrollTo(0, 0);//Fixes Chrome OS X bug
}

function closeFullScreen() {
	jQuery('.flex-gallery-container').removeClass('flex-fullscreen');
	jQuery('.flex-gallery-slide-out').removeClass('flex-fullscreen');
	setTimeout(function(){
		isFullScreen = false;
		lockedOpen = false;
		jQuery('#flex-gallery-social').appendTo('.flex-gallery-title');
		jQuery('.flex-counter').insertAfter('#flex-gallery-social');
		jQuery('.flex-gallery .flex-direction-nav').prependTo('.flex-gallery-title');
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
		jQuery('.flex-gallery-slide-out').css({
			'z-index':origZslideOut,
			'width':origWidthSlideOut
		});
		jQuery('.slide-out-content-top').css({
			'width':'auto'
		});
		if (jQuery('#sidebar').length) {
			//checks for old theme
			jQuery('.flex-content').css({
				'width':origWidthFlexContent
			});
		} else {
			jQuery('.flex-content').css({
				'width':origWidthContent
			});
		}

		jQuery('.x-close').css({
			'margin':origXcloseMargin
		});
	}, 50);
	jQuery('body').removeClass('flex-full-body');
	jQuery('body').css({'overflow':'visible'});
	jQuery('.flex-gallery-container').insertAfter('.flex-gallery-insertion-point');
	jQuery('.flex-gallery-slide-out').insertBefore('#footer');
	jQuery('.flex-gallery-slide-out').hide();
	jQuery('.background-overlay').hide();
	jQuery('#flex-direction-nav-clone').remove();
	setTimeout(function(){
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
		
		centerSlides();
	}, 50);
	if (jQuery('#imo-tophat').length) {
		var topHatOffset = jQuery('#imo-tophat').height();
	}
	jQuery(window).scrollTop(jQuery('.flex-gallery-insertion-point').offset().top);
}

function flexSortReload(isCommunity, galleryID, totalSlides, isFullScreenNow) {
	var sortBy = jQuery('.community-select').val();
	jQuery('.flex-gallery-slide-out-inner').hide();
	jQuery('.flex-gallery-inner').hide();
	jQuery('.flex-gallery-container').addClass('community-sort-reload');
	jQuery('.community-sort-reload').css({'height':jQuery('.flex-gallery-inner').height()});
	//jQuery('.flex-gallery-jquery-container').load(window.location + '?gallery_sort='+sortBy+' .flex-gallery-jquery', function() {
		jQuery('.flex-gallery-container').load(window.location + '?gallery_sort='+sortBy+' .flex-gallery-inner', function() {
			jQuery('.flex-gallery-slide-out').load(window.location + '?gallery_sort='+sortBy+' .flex-gallery-slide-out-inner', function() {
					//the below are now "static" from the original load, need to change total slides as this could change by saving in div maybe
					imoFlexInitiate(isCommunity, galleryID, totalSlides, isFullScreenNow);
			});
			jQuery('#flex-gallery-social-save').clone().attr('id', 'flex-gallery-social-save-clone').insertBefore(jQuery('#flex-gallery-social'));
			jQuery('#flex-gallery-social-save-clone').removeClass('displayNone');
			jQuery('#flex-gallery-social').remove();
			jQuery('#flex-gallery-social-save-clone').attr('id', 'flex-gallery-social');
		});
	//});
}

function flexSortReloadMobile() {
	var sortBy = jQuery('.community-select').val();
	var ulWidth = jQuery('.explore-more-mobile ul.slides').css('width');
	jQuery('.imo-flex-mobile').remove();
	jQuery('<div class="imo-flex-mobile imo-flex-loading-block"></div>').insertAfter('.flex-gallery-insertion-point');
	jQuery('.imo-flex-mobile').load(window.location + '?gallery_sort='+sortBy+' .explore-more-mobile-container', function() {
				imoFlexSetupMobile(community);
				jQuery('.explore-more-mobile ul.slides').css({'width':ulWidth});
	});
}

/*
waitForImages() jQuery Plugin
https://github.com/alexanderdickson/waitForImages
*/
!function(a){var b="waitForImages";a.waitForImages={hasImageProperties:["backgroundImage","listStyleImage","borderImage","borderCornerImage","cursor"]},a.expr[":"].uncached=function(b){if(!a(b).is('img[src!=""]'))return!1;var c=new Image;return c.src=b.src,!c.complete},a.fn.waitForImages=function(c,d,e){var f=0,g=0;if(a.isPlainObject(arguments[0])&&(e=arguments[0].waitForAll,d=arguments[0].each,c=arguments[0].finished),c=c||a.noop,d=d||a.noop,e=!!e,!a.isFunction(c)||!a.isFunction(d))throw new TypeError("An invalid callback was supplied.");return this.each(function(){var h=a(this),i=[],j=a.waitForImages.hasImageProperties||[],k=/url\(\s*(['"]?)(.*?)\1\s*\)/g;e?h.find("*").addBack().each(function(){var b=a(this);b.is("img:uncached")&&i.push({src:b.attr("src"),element:b[0]}),a.each(j,function(a,c){var d,e=b.css(c);if(!e)return!0;for(;d=k.exec(e);)i.push({src:d[2],element:b[0]})})}):h.find("img:uncached").each(function(){i.push({src:this.src,element:this})}),f=i.length,g=0,0===f&&c.call(h[0]),a.each(i,function(e,i){var j=new Image;a(j).on("load."+b+" error."+b,function(a){return g++,d.call(i.element,g,f,"load"==a.type),g==f?(c.call(h[0]),!1):void 0}),j.src=i.src})})}}(jQuery);