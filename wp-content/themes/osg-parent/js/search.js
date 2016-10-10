(function($) {
////////////////////
var l_container	= $("#l_container");

// Load More Posts Function
//-----------------------------------------//
function loadLatestPosts() {
	var loader_anim		= $('#btn_more_posts .loader-anim'),
		post_count		= $(".c-item").length,
		latest_list		= $("#latest_list"),
		post_per_page	= 10;
							
	loader_anim.removeClass('dnone');
	
	$.ajax({
		method: "POST",
		url: ajax_object.ajax_url,
		cache: false,
		data: {
			'action'		: 's_load_latest',
			'post_count'	: post_count,
			'post_per_page'	: post_per_page,
			'search_query'	: search_query,
			'author'		: author
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
		search_query = $(this).data("search");
		author = $(this).data("author");
		loadLatestPosts();	
	});
	
});// end document.ready



////////////////////	
})(jQuery);