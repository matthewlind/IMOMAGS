(function($) {
////////////////////

	
var $document 		= $(document),
	window_height	= $(window).height(),
	l_container		= $("#l_container"),
	btn_more_posts	= $("#btn_more_posts"),
	cat_id 			= btn_more_posts.data("cat"),
	post_not		= btn_more_posts.data("post-not");
// 	ad_sticky 		= $("#l_ad_wrap");
/*
	ad_sticky 		= $("#sticky-ad"),
	more_stories	= $("#more_stories"),
	ms_inner		= $("#ms_inner"),
	ms_loader		= $("#ms_loader"),
	ms_h1			= $("#ms_h1");
*/
	

	
// Sticky Ad Function
//-----------------------------------------//
/*
if (ad_sticky[0]) {	
	var	stick_start 	= $("#l_container"),
		stick_stop 		= $("#btn_more_home"),
		ad_fixed 		= 'adfixed',
		ad_bottom 		= 'adstick-bottom',
		ad_sticky_height= ad_sticky.height(),
		offset_stop 	= 700;
		
	if (ad_sticky_height <= 400){
		offset_stop = 360;
		ad_stickBottom = 'adstick-bottom-sm';
	}
}

function stickyAd() {
    var start	= stick_start.offset().top - 100,
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
*/
	


// Load More Posts Function
//-----------------------------------------//
function loadLatestPosts(p) {
	var loader_anim		= $('#btn_more_posts .loader-anim'),
		post_count		= $(".c-item").length,
		latest_list		= $("#latest_list"),
		post_per_page	= p;
					
	loader_anim.removeClass('dnone');
	
	$.ajax({
		method: "POST",
		url: ajax_object.ajax_url,
		cache: false,
		data: {
			'action'		: 'h_load_latest',
			'cat_id'		: cat_id,
			'post_count'	: post_count,
			'post_not'		: post_not,
			'post_per_page'	: post_per_page
		}
	})
	.done(function(response) {
		latest_list.append(response);
		loader_anim.addClass('dnone');
	})
	.fail(function() { latest_list.append( $("<p/>", {text: "The error ocurred. Try to reload the page",style: "color: red;"})); });
}


// Load 'Even More' Section
//-----------------------------------------//
/*
function evenMore() {
	var d 	= $document.scrollTop(),
	even_m 	= ms_loader.offset().top - window_height + 100;
	
	if (d > even_m) {
		ms_h1.after( $("<div/>", {'id' : 'ms_inner', 'class' : 'ms-inner'}) );
		
		loadMorePosts(5, 1);
		ms_loader.remove();
	}
}
*/


$(document).ready(function() {	
	
	// Load More Posts Button
	//-----------------------------------------//				
	l_container.on("click", "#btn_more_posts", function() {
		loadLatestPosts(11);	
	});

	
	
/*
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
		setTimeout(delWord, 3000);
		setTimeout(changeCommPhrase, 4000);
	} // end Disqus functions
*/
	
	
});// end document.ready


$(window).load(function() {
	
	var window_width	= $(window).width(),
		item_width		= 140,
		item_margin		= 30,
		min_items		= 2,
		max_items		= 2;
		
		
	if (window_width > 600) {
		item_margin		= 55;
		min_items		= 3;
		max_items		= 3;
	} else if (window_width > 410) {
		item_margin		= 50;
	} else if (window_width > 320)	{
		item_margin		= 40;
		item_width		= 140;
	} 
	
	console.log(item_margin);
	
	$('#store_slider').flexslider({
		slideshow: false,
		animation: "slide",
		animationLoop: false,
		itemWidth: item_width,
		itemMargin: item_margin,
		minItems: min_items,
		maxItems: max_items,
		controlNav: false,
		prevText: "",
		nextText: "",
		directionNav: true,
		animationSpeed: 400, 
		useCSS: false
	});
});

	
$document.scroll(function() {

//     if (ad_sticky[0]) { stickyAd(); }
/*    
    if (!$('#ms_inner').length) { evenMore(); }
*/
}); // doc scroll

////////////////////	
})(jQuery);