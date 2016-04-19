(function($) {

$(window).ready(function() {
	var first_img_overlay 	= $(".first-img-overlay"),
		slides				= $( ".gallery-images .slides li" ),
		slides_length		= slides.length - 1,
		slides_remainder	= slides_length % 4,
		interval_array		= [];
		
	for (i = 4; i <= slides_length; i+=4) {
		interval_array.push(i);
	}
	
	//var last_i_a = interval_array[interval_array.length-1];
	//console.log("interval_array: " + interval_array);
	if (slides_remainder < 2) {
		interval_array.pop();
	}
	
/*
	console.log("slide length: " + slides_length);
	console.log("slides remainder: " + slides_remainder);
	console.log("interval_array: " + interval_array);
*/
	
	$(".span-load-gallery").click(function(){
		//remove first image
		first_img_overlay.fadeIn(100);
		
		setTimeout(function(){ 
			//first_img_overlay.fadeOut(); 
			$(".gallery-first-image, .first-desc").remove();
		}, 101);
		//for each li inside ul add image from url attr
		// thumbs: , .gallery-carousel .slides li
		setTimeout(function(){
			
			$.each( slides, function() {
				var imageURL = $(this).attr("url");
				var desc = $(this).find("div").text();
				$(this).prepend('<div class="flex-img-wrap"><img src="' + imageURL + '" /></div><p>' + desc + '</p>');
			});
			// Add ad after every 4th image
			$.each( interval_array, function( index, value ) {
				$( ".gallery-images .slides li:nth-child("+value+")" ).after('<li class="flex-slide is-flex-ad"><div class="flex-ad-container"><div class="flex-ad-box"></div></div></li>');
			});
			// Add ad at the end of the gallery
			$(".gallery-images .slides").append('<li class="flex-slide is-flex-ad"><div class="flex-ad-container"><div class="flex-ad-box"></div></div></li>');
						
			$('.gallery-images').flexslider({
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
					$('.gallery-count .curr-count').text(theSlide);
			  	},
			    after: function (slider) {
					var theSlide 	= slider.currentSlide+1,
						slide_count	= slider.count;
/*
						h 			= 0,
						s 			= 0;
						
					//if (last_i_a < theSlide && slides_remainder < 2) {s = 1;}
					

					if (theSlide > 24) {
						h = 5 - s;
					} else if (theSlide > 19) {
						h = 4 - s;
					} else if (theSlide > 14) {
						h = 3 - s;
					} else if (theSlide > 9) {
						h = 2 - s;
					} else if (theSlide > 4) {
						h = 1 - s;
					} else {
						h = 0;
					}
					
					if (theSlide != slide_count) {
						$('.gallery-count .curr-count').text(theSlide - h);
					}
*/
					if (theSlide != slide_count) {
						$('.gallery-count .curr-count').text(theSlide);
					}
					
				}
		   });
		}, 101);
		
		setTimeout(function(){
			$(".first-img-overlay span, .span-load-gallery").fadeOut(300); 
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


})(jQuery);