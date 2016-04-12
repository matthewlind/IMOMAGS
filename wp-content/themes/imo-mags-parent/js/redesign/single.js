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
	
	
$document.scroll(function() {
    if (ad_sticky[0]) { stickyAd(); }
}); // doc scroll



$(document).ready(function() {
	
	// Disqus functions
	// Load disqus javascript
	$('#load-comments').on('click', function(){ 
		var disqus_shortname = 'gundogmag';  // Enter your disqus user name
        // ajax request to load the disqus javascript
		$.ajax({
			type: "GET",
			url: "http://" + disqus_shortname + ".disqus.com/embed.js",
			dataType: "script",
			cache: true
		});
		$(this).fadeOut();
	});
	 
	if ($('#spandisqus').length){
		var commText = document.getElementById("spandisqus");
		// Delete word 'Comments' from Disqus comments count.
		function delWord() {
		    var str = commText.innerHTML; 
		    var res = str.replace("Comments", "");
		    var res = res.replace("Comment", "");
		    commText.innerHTML = res;
		}
		// If there is no comments cahnges text to "leave a comment"
		function changeCommPhrase() {
			if ($('#spandisqus').text().length <= 0 || $('#spandisqus').text() == "0 ") {
				$('.show-comm-2').text('');
				$('#spandisqus').text('');
				$('.show-comm-1').text('Leave a Comment');
			}
		}
		setTimeout(delWord, 3000);
		setTimeout(changeCommPhrase, 4000);
	} // end Disqus functions
	
	
});// end document.ready



////////////////////	
})(jQuery);