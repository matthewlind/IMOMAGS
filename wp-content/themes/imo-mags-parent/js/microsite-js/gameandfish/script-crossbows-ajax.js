(function($) {	
//	Ajax for 'load more posts' category 'crossbows'
	$(document).ready(function() {
		$('#load-more-posts').click(function(){
			var loader_anim			= $('#load-more-posts .loader-anim'),
				rel_link_count 		= $('.rel-link').length;
				
			loader_anim.removeClass('display-none');	
								
			var data = {
				'action': 'load_posts_action', 
				'rel_link_count': rel_link_count
			};
			jQuery.post(ajax_object.ajax_url, data, function(response) {
				$('.rel-wrap').append(response);
				loader_anim.addClass('display-none');
			});
			
			// When the last post is loaded, add text 'no more posts' to the 'load more' button
/*
			if (number_of_post_boxes == (posts_count_in_cat - 1)) {
				setTimeout(function(){  
					$('#load-more-posts').text('NO MORE POSTS').css({
						'color': '#222222',
						'cursor' : 'default'
					});
				}, 500);
			}
*/
			
			return false; // to prevent default behaviour of an <a> element
		});
	});
})(jQuery);

