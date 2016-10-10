(function($) {
////////////////////

	
var $document 		= $(document),
	window_height	= $(window).height(),
	ad_sticky 		= $("#sticky-ad"),
	more_stories	= $("#more_stories"),
	ms_inner		= $("#ms_inner"),
	ms_loader		= $("#ms_loader"),
	ms_h1			= $("#ms_h1"),
	btn_more_stories= $("#btn_more_stories"),
	cat_id 			= btn_more_stories.data("cat"),
	post_not		= btn_more_stories.data("post-not");
	post_type		= btn_more_stories.data("post-type");

	
// Sticky Ad Function
//-----------------------------------------//
if (ad_sticky[0]) {	
	var	stick_start 	= $("#article"),
		stick_stop 		= $("#ad-stop"),
		ad_fixed 		= 'adfixed',
		ad_bottom 		= 'adstick-bottom',
		ad_sticky_height= ad_sticky.height(),
		offset_stop 	= 687;
		
	if (ad_sticky_height <= 400){
		offset_stop = 380;
		ad_stickBottom = 'adstick-bottom-sm';
	}
}

function stickyAd() {
    var start	= stick_start.offset().top - 40,
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
	


// Load More Posts Function
//-----------------------------------------//
function loadMorePosts(p, a) {
	var loader_anim		= $('#btn_more_stories .loader-anim'),
		post_count		= $(".ms-box").length,
		ms_inner		= $("#ms_inner"),
		post_per_page	= p,
		ad_after_post	= a;
		current_post_id = $("body").attr("id");
					
	loader_anim.removeClass('dnone');
	
	$.ajax({
		method: "POST",
		url: ajax_object.ajax_url,
		cache: false,
		data: {
			'action'			: 'ms_load_more',
			'cat_id'			: cat_id,
			'post_count'		: post_count,
			'post_not'			: post_not,
			'post_per_page'		: post_per_page,
			'ad_after_post' 	: ad_after_post,
			'current_post_id'	: current_post_id, 
			'post_type'			: post_type
		}
	})
	.done(function(response) {
		ms_inner.append(response);
		loader_anim.addClass('dnone');
	})
	.fail(function() { ms_inner.append( $("<p/>", {text: "The error ocurred. Try to reload the page",style: "color: red;"})); });
}


// Load 'Even More' Section
//-----------------------------------------//
function evenMore() {
	var d 	= $document.scrollTop();
	if (ms_loader[0]) { var even_m 	= ms_loader.offset().top - window_height + 100; }
	
	if (d > even_m) {
		ms_h1.after( $("<div/>", {'id' : 'ms_inner', 'class' : 'ms-inner'}) );
		
		loadMorePosts(5, 1);
		ms_loader.remove();
	}
}


$(document).ready(function() {	
	
	// Load More Posts Button
	//-----------------------------------------//				
	more_stories.on("click", "#btn_more_stories", function() {
		loadMorePosts(14, 7);	
	});
	
	
	// Disqus functions
	//-----------------------------------------//
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
/*
		setTimeout(delWord, 3000);
		setTimeout(changeCommPhrase, 4000);
*/
	} // end Disqus functions
	
	
});// end document.ready


	
$document.scroll(function() {
    if (ad_sticky[0]) { stickyAd(); }
    
    if (!$('#ms_inner').length) { evenMore(); }
}); // doc scroll

////////////////////	
})(jQuery);