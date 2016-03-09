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
			return false; // to prevent default behaviour of an <a> element
		});
	});
})(jQuery);

