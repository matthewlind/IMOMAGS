(function($) {
////////////////////

	
var $document 		= $(document),
	window_height	= $(window).height(),
	l_container		= $("#l_container"),
	btn_more_posts	= $("#btn_more_posts"),
	cat_id 			= btn_more_posts.data("cat"),
	post_not		= btn_more_posts.data("post-not");

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
	.fail(function() { latest_list.append( $("<p/>", {text: "Something went wrong. Try to reload the page", style: "color: red;"})); });
}



$(document).ready(function() {	
				
	l_container.on("click", "#btn_more_posts", function() {
		loadLatestPosts(11);	
	});
	
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



////////////////////	
})(jQuery);