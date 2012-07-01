jQuery(document).ready(function($) {

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
	$('.slideshow').scrollface({
		auto	: false,
		next	: $('.next'),
		prev	: $('.back'),
		speed	: 600,
		pager  : $('#slideshow-pager'),
		easing	: 'easeOutExpo',
		before	: function(old_slide, new_slide) {
			adjustPager(new_slide.id);
		},
		after   : function(old_slide, new_slide) {

			slidePager(new_slide.id);
			document.getElementById('gallery-iframe-ad').contentWindow.location.reload();


			
		},
		pager_builder : function (pager, index, slide) {

		    return $('li a', pager).eq(index); // an element that already exists!

		 }
	});

	//Setup Thumbnail Scrolling
	$('ul.thumb-pager').buffet({
	  scroll_by : 6,
	  next      : $('#thumb-next'),
	  prev      : $('#thumb-prev'),
	  speed		: 400,
	  easing	: 'easeOutExpo'
	});


	$(".gallery-slide-out").height($(".ngg-imagebrowser").outerHeight());
	

	var sliderStartPosition = $(".ngg-imagebrowser").width() + parseInt($(".ngg-imagebrowser").css('padding-left'),10) + parseInt($(".ngg-imagebrowser").css('padding-right'),10) - $(".gallery-slide-out").width();
	$(".gallery-slide-out").css('left',sliderStartPosition);



	$(".ngg-imagebrowser-nav a").click(function(event) {
  		event.preventDefault();
  	});

	var currentLeft = parseInt($(".gallery-slide-out").css('left'),10); 
  	$(".gallery-hover-div").hover(function(){



  		$(".gallery-slide-out").animate({
	      	left: parseInt($(".gallery-slide-out").css('left'),10) == currentLeft ?
		        $(".gallery-slide-out").outerWidth() + currentLeft :
		        currentLeft
    	},300,'easeOutExpo');
  	});


  	function adjustPager(slideID) {
  		$("div.thumb-container").removeClass("active").eq(slideID).addClass("active");


  	}

  	function slidePager(slideID) {

  		var thumbWidth = $("ul.thumb-pager li").first().outerWidth(true);
  		var sliderLeft = slideID * thumbWidth * -1 + ($("#slideshow-pager").width() / 2) - (thumbWidth / 2);

  		var slideCount = $("ul.thumb-pager li").length;



  		console.log("HEYEYE");
  		console.log((slideCount * thumbWidth) * -1);
  		console.log(sliderLeft);




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

});

