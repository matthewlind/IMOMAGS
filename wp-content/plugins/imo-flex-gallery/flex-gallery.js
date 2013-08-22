function imoFlexSetup(){
	lockedOpen = false;
	isFullScreen = false;
	slideOutHover = false;
	containerHover = false;
	jQuery(document).ready(function(){
		jQuery('.flex-gallery').waitForImages(function() {
			setTimeout(function(){centerSlides()}, 500);
			jQuery('.imo-flex-loading-block').removeClass('imo-flex-loading-block');
			jQuery('.flex-gallery').css({'visibility':'visible'});
		});
	});
	
	jQuery('.flex-direction-nav a').text('');
	jQuery('.background-overlay').prependTo('#main');
	jQuery('.flex-gallery .flex-direction-nav').prependTo('.flex-gallery .flex-gallery-title');
	jQuery('.flex-carousel .flex-direction-nav').prependTo('.flex-carousel-nav');
		if (jQuery('#sidebar').length) { //checks for old theme
			jQuery('.flex-carousel-nav ul.flex-direction-nav li').css({'margin-top':'-62px'});
		}
	jQuery('#flex-content-1').show();
	jQuery('.flex-content').perfectScrollbar();
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
		if(isFullScreen == false) {
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
	jQuery(window).bind('resize', function () { 
		if(isFullScreen == false) {
			positionSlideOut();
			centerSlides();
		} else {
			sizeFullScreen();
		}
	});
	//setTimeout(centerSlides(), 1500);	
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
	if (jQuery('#sidebar').length) {
		//checks for old theme
		var sidebarWidth = jQuery('#sidebar').outerWidth() + 2;
		var galHeight = galHeight - 15;

		jQuery('.flex-content').css({
			'height':galHeight - adHeight + 58
		});
	}
	if (jQuery('.sidebar-area').length) {
		//checks for new responsive theme
		var sidebarWidth = jQuery('div.inner-main').outerWidth() - jQuery('#content').outerWidth() - 15;
		jQuery('.flex-content').css({
			'height':galHeight - adHeight + 40
		});
	}
	
	jQuery('.flex-gallery-slide-out').css({
		'top':-(galHeight+1),
		'left':galWidth + galPos.left,
		'height':galHeight,
		'width':sidebarWidth+15
	});
	jQuery('.flex-gallery-slide-out').insertBefore('#footer');
	jQuery('.flex-gallery-slide-out').css({
		'position':'absolute',
		'top':slideOutPosY
	});
}

function showSlideOut() {
	positionSlideOut();
	jQuery('.flex-gallery-slide-out').css({'visibility': 'visible'});
	jQuery('.flex-gallery-slide-out').show('slide', { direction: 'left' }, 400);
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
		positionSlideOut();
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
	isFullScreen = true;
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
	
	jQuery('body').addClass('flex-full-body');
	jQuery('.flex-gallery-container').addClass('flex-fullscreen');
	jQuery('.flex-gallery-slide-out').addClass('flex-fullscreen');
	jQuery('.flex-gallery-container').prependTo('body');
	jQuery('.btn-full-screen').text('Exit Fullscreen');
	
	jQuery('.flex-gallery-container').css({
		'position':'fixed',
		'margin-top':'0px',
		'top':'0',
		'left':'0',
		'z-index':'200000006'/*in response to an element in jpsuperheader with a 200000005 z-index*/
	});
	jQuery('.flex-gallery-slide-out').prependTo('.flex-gallery-container');
	jQuery('.flex-gallery-slide-out').css({
		'top':'0' ,
		'z-index':'200000007'
	});

	sizeFullScreen();
	var theSlider = jQuery('.flex-gallery').data('flexslider');
	theSlider.resize();
	
	jQuery('.flex-fullscreen .flex-gallery .flex-direction-nav').hide();
	jQuery('.flex-fullscreen .flex-gallery .flex-viewport').mouseenter(function(){
		jQuery('.flex-fullscreen .flex-gallery .flex-direction-nav').fadeIn();	
	});
	jQuery('.flex-fullscreen .flex-gallery .flex-viewport').mouseleave(function(){
		jQuery('.flex-fullscreen .flex-gallery .flex-direction-nav').fadeOut();	
	});
}

function sizeFullScreen() {
	jQuery('.flex-gallery-slide-out').css({
		'width':'330px'
	});
	jQuery('.flex-content').css({
		'width':'275px'
	});
	var fullSliderWidth = jQuery(document).width() - jQuery('.flex-gallery-slide-out').outerWidth();
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
		jQuery('.x-close').css({
			'margin-right':'27px'
		});
		jQuery('.flex-content').css({
			'width':'300px'
		});
		jQuery('.flex-gallery-container').css({
			'width':fullSliderWidth
		});
	}
	positionSlideOut(); 
	var fullViewportHeight = parseInt(jQuery('.flex-gallery-container').height() - jQuery('.flex-carousel').outerHeight() - jQuery('.flex-gallery-social').outerHeight() - 32);
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
	jQuery('.flex-content').delay(100).perfectScrollbar('update');

	//Resize and position nav arrows
	jQuery('.flex-gallery-social').prependTo('.flex-gallery');
	jQuery('.flex-counter').insertAfter('.flex-gallery-social');
	jQuery('.flex-gallery .flex-direction-nav').appendTo('.flex-gallery .flex-viewport');
	jQuery('.flex-gallery .flex-direction-nav').css({
		'top':(jQuery('.flex-gallery .flex-viewport').height()/2) - (jQuery('.flex-gallery .flex-direction-nav').height()/2),
	});

}

function closeFullScreen() {
	jQuery('.flex-gallery-container').removeClass('flex-fullscreen');
	jQuery('.flex-gallery-slide-out').removeClass('flex-fullscreen');
	setTimeout(function(){
		isFullScreen = false;
		lockedOpen = false;
		jQuery('.flex-gallery-social').appendTo('.flex-gallery-title');
		jQuery('.flex-counter').insertAfter('.flex-gallery-social');
		jQuery('.flex-gallery .flex-direction-nav').prependTo('.flex-gallery-title');
		jQuery('.flex-gallery .flex-direction-nav').css({'top':0});
		jQuery('.flex-gallery .flex-direction-nav').show();
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
	jQuery('.flex-gallery-slide-out').prependTo('#footer');
	jQuery('.flex-gallery-slide-out').hide();
	jQuery('.background-overlay').hide();

	setTimeout(function(){
		var theSlider = jQuery('.flex-gallery').data('flexslider');
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
	jQuery('.btn-full-screen').text('Fullscreen');
	
/*
	if (jQuery('.flex-gallery').width() < 425) {
		jQuery('.flex-fullscreen .flex-counter').addClass('displayNone');
	} else {
		jQuery('.flex-fullscreen .flex-counter').removeClass('displayNone');
	}
*/
	
	if (jQuery('#imo-tophat').length) {
		var topHatOffset = jQuery('#imo-tophat').height();
	}
	jQuery(window).scrollTop(jQuery('.flex-gallery-insertion-point').offset().top);
}


/*
waitForImages() jQuery Plugin
https://github.com/alexanderdickson/waitForImages
*/
!function(a){var b="waitForImages";a.waitForImages={hasImageProperties:["backgroundImage","listStyleImage","borderImage","borderCornerImage","cursor"]},a.expr[":"].uncached=function(b){if(!a(b).is('img[src!=""]'))return!1;var c=new Image;return c.src=b.src,!c.complete},a.fn.waitForImages=function(c,d,e){var f=0,g=0;if(a.isPlainObject(arguments[0])&&(e=arguments[0].waitForAll,d=arguments[0].each,c=arguments[0].finished),c=c||a.noop,d=d||a.noop,e=!!e,!a.isFunction(c)||!a.isFunction(d))throw new TypeError("An invalid callback was supplied.");return this.each(function(){var h=a(this),i=[],j=a.waitForImages.hasImageProperties||[],k=/url\(\s*(['"]?)(.*?)\1\s*\)/g;e?h.find("*").addBack().each(function(){var b=a(this);b.is("img:uncached")&&i.push({src:b.attr("src"),element:b[0]}),a.each(j,function(a,c){var d,e=b.css(c);if(!e)return!0;for(;d=k.exec(e);)i.push({src:d[2],element:b[0]})})}):h.find("img:uncached").each(function(){i.push({src:this.src,element:this})}),f=i.length,g=0,0===f&&c.call(h[0]),a.each(i,function(e,i){var j=new Image;a(j).on("load."+b+" error."+b,function(a){return g++,d.call(i.element,g,f,"load"==a.type),g==f?(c.call(h[0]),!1):void 0}),j.src=i.src})})}}(jQuery);