(function($) {

$(window).ready(function() {
	var first_img_overlay 	= $(".first-img-overlay"),
		slides				= $( ".gallery-images .slides li" ),
		slides_length		= slides.length - 1,
		slides_remainder	= slides_length % 4,
		interval_array		= [];
		domain				= $("body").attr("domain");
		slug				= $(".gallery-title").attr("slug");
		
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
		
		//reload the sticky ad
		document.getElementById('sticky-iframe-ad').contentWindow.location.reload();
		//remove first image
		first_img_overlay.fadeIn(100);
		
		setTimeout(function(){ 
			//first_img_overlay.fadeOut(); 
			$(".gallery-first-image, .first-desc").remove();
		}, 101);
		//for each li inside ul add image from url attr
		// thumbs: , .gallery-carousel .slides li
		setTimeout(function(){
			
			$.each( slides, function(i) {
				var imageURL = $(this).attr("url");
				var desc = $(this).find("div").text();
				$(this).attr("slidenum",i+1);
				$(this).prepend('<div class="flex-img-wrap"><img src="' + imageURL + '" /></div><p>' + desc + '</p>');
			});
			// Add ad after every 4th image
			$.each( interval_array, function( index, value ) {
				$( ".gallery-images .slides li:nth-child("+value+")" ).after('<li class="flex-slide is-flex-ad" slidenum=""><div class="flex-ad-container"><div class="flex-ad-box"><iframe id="gallery-iframe-ad" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" height=280 width=330 src="/iframe-ad-gallery.php?ad_code=' + domain + '&gallery_title=' + slug + '"></iframe></div></div></li>');
			});
			// Add ad at the end of the gallery
			$(".gallery-images .slides").append('<li class="flex-slide is-flex-ad" slidenum=""><div class="flex-ad-container"><div class="flex-ad-box"><iframe id="gallery-iframe-ad" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" height=280 width=330 src="/iframe-ad-gallery.php?ad_code=' + domain + '&gallery_title=' + slug + '"></iframe></div></div></li>');
			
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
					var theSlide 	= slider.currentSlide,
						slide_count	= slider.count;		
					
					var curSlide = slider.find("li.flex-active-slide").attr("slidenum");
					if (curSlide == ""){
						$('.gallery-count').hide();
					}else{
						$('.gallery-count').show();
						$('.gallery-count .curr-count').text(curSlide);
					}
					
					//reload the sticky ad
					document.getElementById('sticky-iframe-ad').contentWindow.location.reload();
					
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