(function($) {
	
/*====================================================
	Ajax for 'load more posts'
======================================================*/
	$(document).ready(function() {
		$('#load-more-posts').click(function(){
			var number_of_post_boxes = $('.rel-link').length,
				posts_count_in_cat	= ajax_object.crossbows_posts_cout; 
								
			if (number_of_post_boxes < posts_count_in_cat)	{
				$('.load-btn .loader-anim').removeClass('display-none'); 
				
				var data = {
					'action': 'load_posts_action', 
					'number_of_post_boxes': number_of_post_boxes
				};
				jQuery.post(ajax_object.ajax_url, data, function(response) {
					$('.rel-wrap').append(response);
					$('.load-btn .loader-anim').addClass('display-none');
				});
				
				// When the last post is loaded, add text 'no more posts' to the 'load more' button
				if (number_of_post_boxes == (posts_count_in_cat - 1)) {
					setTimeout(function(){  
						$('#load-more-posts').text('NO MORE POSTS').css({
							'color': '#222222',
							'cursor' : 'default'
						});
					}, 500);
				}
			} else {
				setTimeout(function(){  
					$('#load-more-posts').text('NO MORE POSTS').css({
						'color': '#222222',
						'cursor' : 'default'
					});
				}, 500);
			}
			
			
			
			
			return false; // to prevent default behaviour of an <a> element
		});
	});
})(jQuery);


jQuery(window).load(function() {				
	domain = jQuery("body").attr("domain");		
	jQuery(".inline-ad").append('<iframe width="300" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-atf.php?ad_code=' + domain + '"></iframe>');		
});		
jQuery(document).ready(function($) {
	$(".wpsocialite.small").remove();
	var windowWidth = $(window).width(),
		box1_width = $( ".post-box" ).eq(-1).width(),		
		box2_width = $( ".post-box" ).eq(-2).width(),
		box3_width = $( ".post-box" ).eq(-3).width(),
		box_width_diff = Math.abs(box1_width - box2_width)
		box_width_diff13 = Math.abs(box1_width - box3_width),
		box_width_diff23 = Math.abs(box2_width - box3_width),
		box_width_diff_real = box2_width - box1_width,
		box_width_diff_real13 = box3_width - box1_width;
		
	function moveBox() {
		if (box_width_diff > 50 && box_width_diff_real < 0) {
			$( ".post-box" ).eq(-1).css("margin", "0 26%");
		} else if (box_width_diff > 50 && box_width_diff_real > 0) {
			$( ".post-box" ).eq(-1).css({"margin" : "0 34.5%"});
		} else if ((box_width_diff < 50 || box_width_diff == 0) && box_width_diff13 > 50 && box_width_diff_real13 > 0) {
			$( ".post-box" ).eq(-2).css({"margin" : "0 1% 0 17.7%"});
		} else {
			
		}
	}//end isBox
		
	/*	// Debug
		var arrayBoxData = $( ".post-box" )
				.map(function() {
				return $( this ).width();
				})
				.get(),
		console.log(arrayBoxData);
		console.log(box1_width);
		console.log(box2_width);
		console.log(box_width_diff);
		console.log(box_width_diff_real);
	*/
	if (windowWidth > 600) {
		moveBox();
	}
		
	// Simulate a hover with a touch in touch enabled browsers
	$('body').bind('touchstart', function() {});

	// Main Nav, buy magazine dorp down menu	
	buyMag = $('li.buy-mag');
	buyMagLink = $('li.buy-mag a');
	buyMagDrop = $('.m-buymag-drop');
	
	buyMagLink.click(function(event){
		event.preventDefault();
	});
	buyMagDrop.click(function(event){
		event.stopPropagation();
	});
	buyMag.click(function(event){
		event.stopPropagation();
		buyMagDrop.toggleClass("m-display-block");
	});
	$("body, .m-buymag-drop i").click(function(){
		buyMagDrop.removeClass("m-display-block");
	});
		

}); // end of document.ready

jQuery( window ).resize(function() {
	var windowWidth = jQuery(window).width();
	
	if (windowWidth < 600) {
		jQuery( ".post-box" ).eq(-1).css("margin", "0 0 30px");
	}
});
