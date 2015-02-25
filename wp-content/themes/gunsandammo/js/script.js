jQuery(document).ready(function($) {
	if( $(".post-type-archive-imo_ga_vault").length ){
		title = $(".facts").attr("title");
		slug = $(".facts").attr("slug");
		img_url = $(".facts img").attr("src");
	
		var ua = window.navigator.userAgent;
	    var msie = ua.indexOf("MSIE ");
	
	    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer, return version number
	        console.log("true");
	    else                 // If another browser, return 0
	        window.history.pushState(null, title, slug );
			console.log("false");
		_gaq.push(['_trackPageview', window.location.pathname]);
	}
});

