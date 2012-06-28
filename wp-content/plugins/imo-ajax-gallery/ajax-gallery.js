jQuery(document).ready(function($) {

	$('.slideshow').scrollface({
		auto	: false,
		next	: $('.next'),
		prev	: $('.back'),
		speed	: 600,
		easing	: 'easeOutExpo',
		after   : function(old_slide, new_slide) {

			document.getElementById('gallery-iframe-ad').contentWindow.location.reload();
		}
	});


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

});

