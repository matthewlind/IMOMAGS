jQuery(document).ready(function($) {
	
	title = $(".facts").attr("title");
	slug = $(".facts").attr("slug");
	img_url = $(".facts img").attr("src");

	// Detecting IE
    var oldIE;
    if ($('html').is('#ie6, #ie7, #ie8, #ie9')) {
        oldIE = true;
    }
	if(!oldIE){
		window.history.pushState(null, title, slug );
	}

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

