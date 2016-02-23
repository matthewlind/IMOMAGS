(function($) {				

	jQuery(document).ready(function($) {

		// Filtering posts , all-stories menu item.
		var stories_links 	= $(".all-stories a"),
			this_url		= document.location.href;	
		
		stories_links.each(function() {
			var d 			= $(this),
				a_href		= d.attr("href"),
				cat_slugs	= a_href.match(/(101-)\w+[^\s\/\?]*/g);
			
			if (cat_slugs) {
				cat_slug 	= cat_slugs[cat_slugs.length -1];
				d.attr('data-cat', cat_slug);
			}	
		});
		
		
		
		stories_links.click(function(){
			var d = $(this),
				feat_container	= $(".p-feat-container"),
				feat_posts	= $(".feat-post"),
				top_ad_home	= $(".top-ad-home"),
				posts_count_in_cat	= ajax_object.crossbows_posts_cout; 
				
				
				feat_posts.remove();
				top_ad_home.remove();
								

				$('.load-btn .loader-anim').removeClass('display-none'); 
				
				var data = {
					'action': 'load_posts__action'
				};
				jQuery.post(ajax_object.ajax_url, data, function(response) {
					feat_container.prepend(response);
					
					var feat_posts_after = $(".feat-post"),
						second_feat		= feat_posts_after[1];
						console.log(feat_posts_after.length);
						console.log(second_feat);
					//top_ad_home.insertAfter(second_feat);
					//top_ad_home.show();
					//$('.load-btn .loader-anim').addClass('display-none');
				});
			
			return false; // to prevent default behaviour of an <a> element
		});
	
	});


})(jQuery);