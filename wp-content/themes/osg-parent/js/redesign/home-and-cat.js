(function($) {
////////////////////

	
var $document 		= $(document),
	window_height	= $(window).height(),
	l_container		= $("#l_container"),
	btn_more_posts	= $("#btn_more_posts"),
	cat_id 			= btn_more_posts.data("cat"),
	post_not		= btn_more_posts.data("post-not"),
	cat_slug		= btn_more_posts.data("cat-slug"),
	sections_wrap	= $("#sections_wrap"),
	btf_loaded		= false,
	section_loader	= $("#section_loader"),
	page_type		= 'home';
	
if ($('.post-type-archive-reader_photos')[0]) {
	page_type = 'post-type-archive-reader_photos';
} else if ($('.category')[0]) {
	page_type = 'category';
}

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
			'post_per_page'	: post_per_page,
			'page_type'		: page_type,
			'cat_slug'		: cat_slug
		}
	})
	.done(function(response) {
		latest_list.append(response);
		loader_anim.addClass('dnone');
		
		//detect window width for responsive ads
		var windowWidth = window.outerWidth;
		$('.new-iframe-ad').each(function() {
	    	var newSrc = $(this).attr('src') + "&windowWidth=" + windowWidth;
	    	console.log(newSrc);
		    $(this).attr('src', newSrc);
		});
	})
	.fail(function() { latest_list.append( $("<p/>", {text: "Something went wrong. Try to reload the page", style: "color: red;"})); });
		

}
	


// Load Home BTF
//-----------------------------------------//
function loadHomeBTF() {
	if (btf_loaded == true) 
		return;
	var d = $document.scrollTop(),
		p = sections_wrap.offset().top;
	
	if (d > p) {
		$.ajax({
			method: "POST",
			url: ajax_object.ajax_url,
			cache: false,
			data: {
				'action' 	: 'load_home_btf',
				'page_type'	: page_type
			}
		})
		.done(function(response) {
			section_loader.remove();
			sections_wrap.append(response);
			
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
			
			/*
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
			*/
		})
		.fail(function() { latest_list.append( $("<p/>", {text: "Something went wrong. Try to reload the page", style: "color: red;"})); });
		
		btf_loaded = true;
	}
}



$(document).ready(function() {	
				
	l_container.on("click", "#btn_more_posts", function() {
		loadLatestPosts(10);	
	});
	
});// end document.ready


/*
$(window).load(function() {
			

});
*/

$document.scroll(function() {
	
/*
	section_subsicribe = $("#section_subsicribe");
	
	if (!section_subsicribe[0]) {
		loadHomeBTF();
	}
*/
	
	loadHomeBTF();
	
	
});

////////////////////	
})(jQuery);