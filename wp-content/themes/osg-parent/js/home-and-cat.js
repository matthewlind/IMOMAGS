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
	page_type		= 'home',
	ad_count		= 1;
	
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
		post_per_page	= p,
		d_dart 			= $("body").attr("domain"),
		d_page 			= $("body").data("page")
					
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
			'cat_slug'		: cat_slug,
			'd_dart'		: d_dart,
			'd_page'		: d_page,
			'ad_count'		: ad_count
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
		
		ad_count += 2;
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