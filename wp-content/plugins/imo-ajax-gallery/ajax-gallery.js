jQuery(document).ready(function($) {
	
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
	$('.slideshow').scrollface({
		auto	: false,
		next	: $('.next'),
		prev	: $('.back'),
		speed	: 600,
		pager  : $('#slideshow-pager'),
		easing	: 'easeOutExpo',
		transition: "fade",
		before	: function(old_slide, new_slide) {
			adjustPager(new_slide.id); //Changes the active thumbnail
			slidePager(new_slide.id); //SLides the pager to the new position

			$("span.current-image").text(new_slide.id + 1);
		},
		after   : function(old_slide, new_slide) {

			
			document.getElementById('gallery-iframe-ad').contentWindow.location.reload();

			//TRACK THE PAGE VIEW IN Google Analytics
			trackPage(new_slide.id);


			
		},
		pager_builder : function (pager, index, slide) {

		    return $('li a', pager).eq(index); // an element that already exists!

		 }
	});


	//Setup Text Changing

	$('.text-slideshow').scrollface({
		auto	: false,
		next	: $('.next'),
		prev	: $('.back'),
		speed	: 0,
		pager  : $('#slideshow-pager'),
		before	: function(old_slide, new_slide) {


			$(".text-slides .slide").eq(old_slide.id).fadeOut(700);
			$(".text-slides .slide").eq(new_slide.id).hide();


 
		},
		after   : function(old_slide, new_slide) {



			$(".text-slides .slide").eq(old_slide.id).hide();
			$(".text-slides .slide").eq(new_slide.id).hide();	
			$(".text-slides .slide").eq(new_slide.id).fadeIn();	
			
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


	//sliderStartPosition = $(".ngg-imagebrowser").outerWidth() - $(".gallery-slide-out").outerWidth();

	console.log($(".ngg-imagebrowser").outerWidth(),$(".gallery-slide-out").outerWidth(),$(".ngg-imagebrowser").outerWidth() - $(".gallery-slide-out").outerWidth());

	$(".gallery-slide-out").css('left',sliderStartPosition);



	$(".ngg-imagebrowser-nav a").click(function(event) {
  		event.preventDefault();
  	});


	//Handle the slideout hover
	var currentLeft = parseInt($(".gallery-slide-out").css('left'),10); 
  	$(".gallery-hover-div").hover(function(){

 		$(".gallery-slide-out").animate({
	      	left: $(".ngg-imagebrowser").outerWidth(true) + 2
    	},300,'easeOutExpo');



  	},function(){

  		$(".gallery-slide-out").stop().animate({
	      	left: currentLeft
    	},300,'easeOutExpo');

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

});

