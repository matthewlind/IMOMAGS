(function($) {				

	jQuery(document).ready(function($) {
		
		// Filtering posts , all-stories menu item.
		var m_cat_tamplate	= $(".category"),
			m_sngl_template = $(".single"),
			posts_wrap		= $("#posts_wrap"),
			stories_links 	= $(".all-stories .sub-menu a"),
			this_url		= document.location.href,
			origin_url		= document.location.origin;
			
			term_cat_id		= ajax_object.term_cat_id;
			parent_cat_slug	= ajax_object.parent_cat_slug;
			dartDomain		= ajax_object.dart_domain;
			
			var ad_string	= '<iframe id="microsite-iframe-ad" width="310" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad-microsite.php?ad_code=' + dartDomain + '&term=' + parent_cat_slug + '">';
		
		/* If this is a category page.
		------------------------------------------*/				
		if (m_cat_tamplate[0]) {
			
			// Loading Posts on first page load 
			var	url				= window.location.href,
			    separator 		= "#",
			    subcat			= url.match(/#(.*)/g);
			    
			if (subcat) { 
				subcat = subcat.toString().replace(separator, "");
				 
				$.ajax({
					method: "POST",
					url: ajax_object.ajax_url,
					cache: false,
					data: {
						'action': 'load_posts__action',
						'cat_slug': subcat,
						'term_cat_id': term_cat_id,
						'parent_cat_slug': parent_cat_slug
					}
				})
				.done(function(response) {
					posts_wrap.empty();
					posts_wrap.prepend(response);
					$('.top-ad-home').append(ad_string);
				})
				.fail(function() { posts_wrap.prepend( $("<p/>", {text: "Something went wrong. Try to reload the page",style: "color: white;"})); });
			} else {
				$('.top-ad-home').append(ad_string);
			}		
			
			
			// Add data-cat="{cat_slug}" to each link
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
			
			// Loading Posts on menu item click 
			stories_links.click(function(e){
				e.preventDefault();
				var d = $(this),
					data_cat_slug	= d.data("cat"),
					url				= window.location.href,
				    separator 		= "#",
				    newParam		= separator + data_cat_slug;
				    
				    newUrl = url.replace(/#(.*)/g,"");
				    newUrl+=newParam;
				    document.location.href = newUrl;				     
				
				$.ajax({
					method: "POST",
					url: ajax_object.ajax_url,
					cache: false,
					data: {
						'action': 'load_posts__action',
						'cat_slug': data_cat_slug,
						'term_cat_id': term_cat_id,
						'parent_cat_slug': parent_cat_slug
					}
				})
				.done(function(response) {
					posts_wrap.empty();
					posts_wrap.prepend(response);
					$('.top-ad-home').append(ad_string);
				})
				.fail(function() { posts_wrap.prepend( $("<p/>", {text: "Something went wrong. Try to reload the page",style: "color: white;"})); });
				
			});
			
			// Load More Posts Button
			//-----------------------------------------//				
			posts_wrap.on("click", "#load_reg_posts", function(e) {
				e.preventDefault();
				
				var d = $(this),
					data_child_cat_slug = d.data("cat-load"),
					loader_anim			= $('.load-btn .loader-anim'),
					reg_post_count		= $(".link-box").length,
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
		} // if m_cat_template[0]			
		
		// for this to work url should be like http://website_name.com/main_cat_slug/post_slug . If you would have few cats in the url like in corssbow revolution, you'll have to rewrite this code		
		if (m_sngl_template[0]) {
			stories_links.each(function() {
				var d 			= $(this),
					a_href		= d.attr("href"),
					cat_slugs	= a_href.match(/(\/)\w+[^\s\/\?]*/g);
					
				if (cat_slugs) {
					var cat_slug 	= cat_slugs[cat_slugs.length -1],
						cat_slug 	= cat_slug.replace("/", ""),
						parent_cat 	= this_url.match(/(\/)\w+[^\s\/\?]*/g);
						parent_cat	= parent_cat[1],
						story_href 	= origin_url + parent_cat + "/#" + cat_slug;
					
					d.attr('href', story_href);	
				}	
			});			
		}// if m_sngl_template[0]
		
	});
	
})(jQuery);