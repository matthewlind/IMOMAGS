(function($) {
////////////////////

	
var $document 		= $(document),
	ad_sticky 		= $("#sticky-ad");	
	
	
if (ad_sticky[0]) {
	var	stick_start 	= $("#article"),
		stick_stop 		= $("#ad-stop"),
		ad_fixed 		= 'adfixed',
		ad_bottom 		= 'adstick-bottom',
		ad_sticky_height= ad_sticky.height(),
		offset_stop 	= 687;
		
	if (ad_sticky_height <= 400){
		offset_stop = 337;
		ad_stickBottom = 'adstick-bottom-sm';
	}
	
	function stickyAd() {
	    var start	= stick_start.offset().top - 76,
	    	stop 	= stick_stop.offset().top,
	    	stop 	= stop - offset_stop,
	    	d 		= $document.scrollTop();
	    	
	    if (d >= start && d <= stop) {
			ad_sticky.addClass(ad_fixed);
			ad_sticky.removeClass(ad_bottom);
		} else if (d >= start && d > stop) {
			ad_sticky.addClass(ad_bottom);
		} else {
			ad_sticky.removeClass(ad_fixed);
			ad_sticky.removeClass(ad_bottom);
		}
	}
} else {
	function stickyAd() { }
}	
	
	
$document.scroll(function() {
    stickyAd();
}); // doc scroll




////////////////////	
})(jQuery);