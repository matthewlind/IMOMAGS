(function($) {
////////////////////

	
var $document 		= $(document),
	window_height	= $(window).height(),
	l_container		= $("#l_container"),
	btn_more_posts	= $("#btn_more_posts"),
	cat_id 			= btn_more_posts.data("cat"),
	post_not		= btn_more_posts.data("post-not"),
	cat_slug		= btn_more_posts.data("cat-slug"),
	fb_like			= btn_more_posts.data("fb-like"),
	post_type		= btn_more_posts.data("post-type"),
	sections_wrap	= $("#sections_wrap"),
	btf_loaded		= false,
	section_loader	= $("#section_loader"),
	page_type		= 'home',
	load_action		= 'h_load_latest',
	overwrite_cat_btf = sections_wrap.data("overwrite-cat-btf");
	ad_count		= 1;
	
if ($('.archive')[0]) {
	page_type = 'archive';
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
		d_page 			= $("body").data("page"),
		d_term 			= $("body").data("term"),
		d_camp 			= $("body").data("camp");
					
	loader_anim.removeClass('dnone');
	
	$.ajax({
		method: "POST",
		url: ajax_object.ajax_url,
		cache: false,
		data: {
			'action'		: load_action,
			'cat_id'		: cat_id,
			'post_count'	: post_count,
			'post_not'		: post_not,
			'post_per_page'	: post_per_page,
			'page_type'		: page_type,
			'cat_slug'		: cat_slug,
			'fb_like'		: fb_like,
			'post_type'		: post_type,
			'd_dart'		: d_dart,
			'd_page'		: d_page,
			'd_term'		: d_term,
			'd_camp'		: d_camp,
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
	    	//console.log(newSrc);
		    $(this).attr('src', newSrc);
		});
		setTimeout(function(){FB.XFBML.parse(document.getElementById('latest_list'));}, 100);
		ad_count += 2;
	})
	.fail(function() { latest_list.append( $("<p/>", {text: "Something went wrong. Try to reload the page", style: "color: red;"})); });
		

}
	


// Load Home BTF
//-----------------------------------------//
function loadCatHomeBTF() {
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
				'action' 	: 'load_cat_home_btf',
				'page_type'	: page_type,
				'cat_id'	: cat_id,
				'overwrite_cat_btf' : overwrite_cat_btf
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
	
	// SIP Section 'buy now' button
	var sbb_open = false;
	sections_wrap.on("click", "#sip_buy_btn", function(e) {
		if (sbb_open == false) {
			$('#sip_drop_down').fadeIn(300);
			sbb_open = true;
		} else {
			$('#sip_drop_down').fadeOut(200);
			sbb_open = false;
		}
		e.stopPropagation();
	});
	sections_wrap.on("click", "#sip_drop_down", function(e) {
		e.stopPropagation();	
	});

	// LOAD MORE VIDEO IN MULTIPLE VIDEO SECTION
	sections_wrap.on("click", ".mv-load", function(){
		var d 	= $(this),
			ul	= d.closest("ul").find(".mv-hidden"),
			th 	= ul.find(".mv-video-thumb");
			
		d.fadeOut(250);
		setTimeout(function(){d.slideUp(250);}, 250);
		ul.slideDown(500);
		
		$.each(th, function(i, val){
			//console.log(val);
			var url = $(this).data("mv-img");
			//console.log(i);
			$(this).css('background-image', 'url(' + url + ')'); 
		});
	});
	
	
});// end document.ready


/*
$(window).load(function() {
			

});
*/

$document.scroll(function() {
		
	loadCatHomeBTF();
	
});

////////////////////	
})(jQuery);