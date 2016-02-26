(function($) {				

	jQuery(document).ready(function($) {

		// Filtering posts , all-stories menu item.
		var posts_wrap		= $("#posts_wrap"),
			stories_links 	= $(".all-stories a"),
			this_url		= document.location.href,
			term_cat_id		= ajax_object.term_cat_id;
			parent_cat_slug	= ajax_object.parent_cat_slug;	
		
		stories_links.each(function() {
			var d 			= $(this),
				a_href		= d.attr("href"),
				//cat_slugs	= a_href.match(/(101-)\w+[^\s\/\?]*/g);
				cat_slugs	= a_href.match(/(\/)\w+[^\s\/\?]*/g);
				
			
			if (cat_slugs) {
				var cat_slug 	= cat_slugs[cat_slugs.length -1],
					cat_slug 	= cat_slug.replace("/", "");
				d.attr('data-cat', cat_slug);
			}	
		});
		
		//$(".sponsors-disclaimer").text(cat_slug);
		
		stories_links.click(function(){
			var d = $(this),
				data_cat_slug	= d.data("cat"),
				feat_container	= $(".p-feat-container"),
				reg_post_wrap	= $("#reg_post_wrap"),
				feat_message	= $(".featured-message"),
				feat_posts		= $(".feat-post"),
				top_ad_home		= $(".top-ad-home"); 
				
				
			top_ad_home.hide().appendTo(".posts-wrap");
			feat_container.fadeOut("slow").remove();
			feat_message.fadeOut().remove();
			reg_post_wrap.fadeOut().remove();
				
			var data = {
				'action': 'load_posts__action',
				'cat_slug': data_cat_slug,
				'term_cat_id': term_cat_id,
				'parent_cat_slug': parent_cat_slug
			};
			jQuery.post(ajax_object.ajax_url, data, function(response) {
				posts_wrap.prepend(response);
								
				var feat_posts_after = $(".feat-post"),
					second_feat		= feat_posts_after[1];
				
				top_ad_home.insertAfter(second_feat).show();
			});
			
			return false; // to prevent default behaviour of an <a> element
		});
		
		
		/* Load More Posts Button
		-----------------------------------------*/				
		posts_wrap.on("click", "#load_reg_posts", function(e) {
			e.preventDefault();
			
			var d = $(this),
				data_child_cat_slug = d.data("cat-load"),
				loader_anim			= $('.load-btn .loader-anim'),
				reg_post_count		= $(".reg-post").length,
				load_more_reg		= $("#load_more_reg");
				
			loader_anim.removeClass('display-none');
			
			var data = {
					'action': 'load_more_m_posts',
					'data_child_cat_slug': data_child_cat_slug,
					'parent_cat__slug': parent_cat_slug,
					'reg_post_count': reg_post_count
				};
			jQuery.post(ajax_object.ajax_url, data, function(response) {
				load_more_reg.before(response);
				
					
				loader_anim.addClass('display-none');
			});
			
		});
	});
	
	jQuery(window).ready(function() {
			
		// later add variables insted of 	=imo.gunsandammo&term=shoot101 
			
			
		$('.top-ad-home').append('<p>ADVERTISMENT</p><iframe id="microsite-iframe-ad" width="310" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad-microsite.php?ad_code=imo.gunsandammo&term=shoot101">');
		
	});


})(jQuery);