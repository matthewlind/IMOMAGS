jQuery(window).ready(function() {
	jQuery(".gallery-first-image").click(function(){
		//remove first image 
		jQuery(".gallery-first-image, .first-desc").remove();
		//for each li inside ul add image from url attr
		// thumbs: , .gallery-carousel .slides li
		jQuery.each( jQuery( ".gallery-images .slides li" ), function() {
			var imageURL = jQuery(this).attr("url");
			var desc = jQuery(this).find("div").text();
			jQuery(this).prepend('<img src="' + imageURL + '" /><p>' + desc + '</p>');
		});
		//jQuery('.gallery-carousel .slides').css("border-top","1px solid #ccc");
		//jQuery('.gallery-carousel .slides').css("border-bottom","1px solid #ccc");

		//load flexslider
		/*jQuery('.gallery-carousel').flexslider({
		    animation: "slide",
		    controlNav: false,
		    animationLoop: false,
		    slideshow: false,
		    itemMargin: 5,
		    asNavFor: '.gallery-images'
		});*/
		jQuery('.gallery-images').flexslider({
		  	slideshow: false,
		  	controlNav: false,
		  	prevText: "",
			nextText: "",
		  	directionNav: true,
		  	useCSS: false, 
		  	//sync: ".gallery-carousel",
		    after: function (slider) {
				var theSlide = slider.currentSlide+1;
				jQuery('.gallery-count .curr-count').text(theSlide);
			}
	   });

	});  	
});