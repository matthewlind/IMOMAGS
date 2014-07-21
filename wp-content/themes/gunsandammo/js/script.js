jQuery(document).ready(function($) {
	
	title = $(".facts").attr("title");
	slug = $(".facts").attr("slug");
	img_url = $(".facts img").attr("src");

	window.history.pushState(null, title, slug );
	var _gaq = _gaq || [];
	_gaq.push(['_trackPageview', window.location.pathname]);
	post_url = document.location.href;

	try{
		jQuery('meta[property=og\\:url]').attr('content',post_url);
		jQuery('meta[property=og\\:title]').attr('content',title);
		jQuery('meta[property=og\\:image]').attr('content',img_url);	
		jQuery('.fb-share').attr("data-href",post_url);
		FB.XFBML.parse();
	}catch(e){
		//console.log(e);
	}

});

