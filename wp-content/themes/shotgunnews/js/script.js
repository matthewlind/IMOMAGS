jQuery(document).ready(function ($) {

	//TRADING POST PAGE
	if($(".trading-post").length){
		//trading post social icons
		$(".trading-post .entry-content .wpsocialite.small").remove();
		
		$(document).bind('scroll',function(e){
		    $('.post').each(function(){
		        if (
		           $(this).offset().top < window.pageYOffset + 10
					//begins before top
					&& $(this).offset().top + $(this).height() > window.pageYOffset + 10
					//but ends in visible area
					//+ 10 allows you to change hash before it hits the top border
					        ) {
		            slug = $(this).attr("data-slug");
		            title = $(this).find(".entry-title a").attr("data-title");
					updateURL(slug,title);
		        }
		    });
		});
				
				
		function updateURL(slug,title){
			// strip out the current slug and push the new slug
		    var url = window.location.pathname.toString();
		    var newSlug = url.replace(url, slug);
			//change the url
			window.history.pushState({ slug: slug }, title, "/trading-post/" + newSlug );
			$('title').text(title);
			_gaq.push(['_trackPageview', window.location.pathname + slug]);
			//track back/foward browser history and reload the videos
			window.onpopstate = function(event) {
	        	slug = event.state.slug;
	        	$('title').text(title);
				
			};
		}
	}
});