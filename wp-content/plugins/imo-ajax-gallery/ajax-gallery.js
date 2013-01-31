jQuery(document).ready(function($) {
	
	//Description Scrollbar


	$(window).load(function(){
		/* custom scrollbar fn call */

			var $thisScrollContent = $(".text-slides .slide").eq(0).find(".scroll-content");

			//$thisScrollContent.css("overflow","scroll");
			$thisScrollContent.css("width","300");
			
			if (!$thisScrollContent.hasClass("mCustomScrollbar")) {
				$thisScrollContent.mCustomScrollbar({
					scrollInertia:0
				});
			}


	});	

	var lockedOpen = false;
	
	function trackPage(slideID) {

		_gaq.push(['_trackPageview',"/" + window.location.pathname + "#" + slideID]);
	}
	


	//Resize images to fit and center them
	var maxImageHeight = parseInt($(".image_slideshow_mask").css('height'),10) - 6;
	var maxImageWidth = parseInt($(".image_slideshow_mask").css('width'),10) - 6;

	$(".pic img").each(function(index){
		var currentHeight = parseInt($(this).attr("image-height"),10);
		var currentWidth = parseInt($(this).attr("image-width"),10);
		var resizedHeight;
		var resizedWidth;

		var leftMargin = 0;
		var topMargin = 0;



		if (currentWidth > currentHeight) { //If image is landscape
			

			resizedWidth = maxImageWidth;
			resizedHeight = Math.round((currentHeight / currentWidth) * resizedWidth);

			topMargin = Math.round((maxImageHeight - resizedHeight) / 2);

		} else { //if image is portrait

		

			resizedHeight = maxImageHeight;
			resizedWidth = Math.round((currentWidth / currentHeight) * resizedHeight);

			leftMargin = Math.round((maxImageWidth - resizedWidth) / 2);
		}

		
		$(this).parent().css("margin-top",topMargin);
		$(this).parent().css("margin-left",leftMargin);
		$(this).height(resizedHeight);
		$(this).width(resizedWidth);
	});




	//Setup Slideshow Scrolling
	$(".text-slides .slide").eq(0).show();	
	$('.slideshow').scrollface({
		auto	: false,
		next	: $('.next'),
		prev	: $('.back'),
		speed	: 450,
		pager  : $('#slideshow-pager'),
		easing	: 'easeOutExpo',
		transition: "fade",
		before	: function(old_slide, new_slide) {
			adjustPager(new_slide.id); //Changes the active thumbnail
			slidePager(new_slide.id); //SLides the pager to the new position

			$("span.current-image").text(new_slide.id + 1);

			$(".text-slides .slide").eq(new_slide.id).find(".scroll-content").css("overflow","hidden");


			//Also change the text slide
			$(".text-slides .slide").eq(old_slide.id).fadeOut(80);
			$(".text-slides .slide").eq(new_slide.id).fadeIn(80);	

		

		},
		after   : function(old_slide, new_slide) {

			
			document.getElementById('gallery-iframe-ad').contentWindow.location.reload();

			//TRACK THE PAGE VIEW IN Google Analytics
			trackPage(new_slide.id);

			//Scrolling content function call

			var $thisScrollContent = $(".text-slides .slide").eq(new_slide.id).find(".scroll-content");

			//$thisScrollContent.css("overflow","scroll");

			
			


	
			


			if (!$thisScrollContent.hasClass("mCustomScrollbar")) {
				if ($thisScrollContent.hasScrollBar()) {
					$thisScrollContent.css("width","300");
				}
			

				$thisScrollContent.mCustomScrollbar({
					scrollInertia:0
				});
			}


			

				
		},
		pager_builder : function (pager, index, slide) {

		    return $('li a', pager).eq(index); // an element that already exists!

		 }
	});

	//Move the video iframes to the correct place
	$(".text-slides .slide").each(function(index){


		
		var $photobox = $(".slideshow_mask .slideshow .slide").eq(index);
		
		//First, move the youtube videos
		var $iframe = $(this).find("iframe");
		if ($iframe.length > 0) {
			$photobox.html("");
			$iframe.appendTo($photobox).css("margin-top","50px");
		}
		
		//Then, move the brightcove videos
		var $object = $(this).find("object");
		if ($object.length > 0) {
			$photobox.html("");
			$object.appendTo($photobox).css("margin-top","50px");
		}
		
		//Check to see if there is a link that we need to add to the picture
		var $link = $(this).find(".suggested-next-gallery").text("");
		if ($link.length > 0) {
			$photobox.find("img").wrap($link);
		}

	});


	//Setup Text Changing


	//Setup Thumbnail Scrolling
	$('ul.thumb-pager').buffet({
		scroll_by : 6,
		next      : $('#thumb-next'),
		prev      : $('#thumb-prev'),
		speed		: 300,
		easing	: 'easeOutExpo'
	});


	$(".gallery-slide-out").height($(".ngg-imagebrowser").outerHeight());
	

	var sliderStartPosition = $(".ngg-imagebrowser").width() + parseInt($(".ngg-imagebrowser").css('padding-left'),10) + parseInt($(".ngg-imagebrowser").css('padding-right'),10) - $(".gallery-slide-out").width();


	//sliderStartPosition = $(".ngg-imagebrowser").outerWidth() - $(".gallery-slide-out").outerWidth();

	//console.log($(".ngg-imagebrowser").outerWidth(),$(".gallery-slide-out").outerWidth(),$(".ngg-imagebrowser").outerWidth() - $(".gallery-slide-out").outerWidth());

	$(".gallery-slide-out").css('left',sliderStartPosition);



	$(".gallery-hover-div .ngg-imagebrowser-nav a").click(function(event) {
  		event.preventDefault();
  	});

  	$(".hidden-arrows a").click(function(event) {
  		event.preventDefault();
  	});

  	//Show the hidden arrows on hover
  	$(".slide-container").hover(function(){
  		$(".hidden-arrows .thumb-arrow").fadeToggle();
  	});


	//Handle the slideout hover
	var currentLeft = parseInt($(".gallery-slide-out").css('left'),10); 
  	$(".gallery-hover-div").hover(function(){

 		$(".gallery-slide-out").animate({
	      	left: $(".ngg-imagebrowser").outerWidth(true)
    	},300,'easeOutExpo');



  	},function(){
  		if (lockedOpen == false) {
  			$(".gallery-slide-out").stop().animate({
	      	left: currentLeft
    		},300,'easeOutExpo');
  		}


  	});


  	//Handle Background overlay 
  	$(".gallery-hover-div").click(function(){
  		 activateOverlay();
  	});



  	//Setup custom scrollbar

  	
	
  	function adjustPager(slideID) {
  		$("div.thumb-container").removeClass("active").eq(slideID).addClass("active");


  	}

  	function slidePager(slideID) {

  		var thumbWidth = $("ul.thumb-pager li").first().outerWidth(true);
  		var sliderLeft = slideID * thumbWidth * -1 + ($("#slideshow-pager").width() / 2) - (thumbWidth / 2);

  		var slideCount = $("ul.thumb-pager li").length;


  		if (sliderLeft > 0) {
  			sliderLeft = 0;
  		}

  		if (sliderLeft < ((thumbWidth * slideCount) - $("#slideshow-pager").width()) * -1) {
  			sliderLeft = ((thumbWidth * slideCount) - $("#slideshow-pager").width()) * -1;
  		}

  	

  		//$("ul.thumb-pager").css("left",sliderLeft);



  		$("ul.thumb-pager").animate({
		    left: sliderLeft
		  }, 500,"easeOutExpo", function() {
		    // Animation complete.
		  });

  		
  	}

  	function activateOverlay() {

  		if ($(".background-overlay").length < 1) {
  			var $overlayDiv = $("<div class='background-overlay' style='z-index:50;background-image:url(\"/wp-content/themes/carrington-business/img/dark-trans-bg.png\");display:none;position: fixed;top: 0;right: 0;bottom: 0;left: 0;overflow-x: auto;overflow-y: auto;'></div>");
  			
  			$overlayDiv.prependTo("#main").fadeIn();


  			lockedOpen = true;

  			$(".background-overlay").click(function(){
  				closeSlideout();
  			});
  		}
  		
  	
  	}

  	$(".x-close").click(function(){
  		closeSlideout();
  	});

  	function closeSlideout() {
  		lockedOpen = false;
		$(".background-overlay").fadeOut(function(){
			
			$(".background-overlay").remove();
		});

		$(".gallery-slide-out").stop().animate({
  			left: currentLeft
    	},300,'easeOutExpo');
  	}


  	(function($) {
    $.fn.hasScrollBar = function() {
        return this.get(0).scrollHeight > this.height();
    }
	})(jQuery);

});

