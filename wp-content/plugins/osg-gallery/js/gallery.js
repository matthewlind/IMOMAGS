jQuery(window).ready(function() {
	var first_img_overlay = jQuery(".first-img-overlay");
	
	jQuery(".span-load-gallery").click(function(){
		//remove first image
		first_img_overlay.fadeIn(100);
		
		setTimeout(function(){ 
			//first_img_overlay.fadeOut(); 
			jQuery(".gallery-first-image, .first-desc").remove();
		}, 101);
		//for each li inside ul add image from url attr
		// thumbs: , .gallery-carousel .slides li
		
		setTimeout(function(){
			
			jQuery.each( jQuery( ".gallery-images .slides li" ), function() {
				var imageURL = jQuery(this).attr("url");
				var desc = jQuery(this).find("div").text();
				jQuery(this).prepend('<div class="flex-img-wrap"><img src="' + imageURL + '" /></div><p>' + desc + '</p>');
			});
			jQuery('.gallery-images').flexslider({
			  	slideshow: false,
			  	controlNav: false,
			  	prevText: "",
				nextText: "",
			  	directionNav: true,
			  	animationSpeed: 400, 
			  	useCSS: false,
			  	startAt: 1,    
			  	//sync: ".gallery-carousel",
			  	start: function(slider){
				  	var theSlide = slider.currentSlide+1;
					jQuery('.gallery-count .curr-count').text(theSlide);
			  	},
			    after: function (slider) {
					var theSlide = slider.currentSlide+1;
					jQuery('.gallery-count .curr-count').text(theSlide);
				}
		   });
		}, 101);
		
		setTimeout(function(){
			jQuery(".first-img-overlay span, .span-load-gallery").fadeOut(300); 
			first_img_overlay.fadeOut(500);
		}, 1200);
		//jQuery(".flex-img-wrap").css("opacity", 1);
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
		

	});  	
});