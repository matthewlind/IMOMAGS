jQuery(document).ready(function($) {
	
	$(".wpsocialite.small").remove();
	var windowWidth 		= $(window).width(),
		box1_width 			= $( ".post-box" ).eq(-1).width(),		
		box2_width 			= $( ".post-box" ).eq(-2).width(),
		box3_width 			= $( ".post-box" ).eq(-3).width(),
		box_width_diff 		= Math.abs(box1_width - box2_width)
		box_width_diff13 	= Math.abs(box1_width - box3_width),
		box_width_diff23 	= Math.abs(box2_width - box3_width),
		box_width_diff_real = box2_width - box1_width,
		box_width_diff_real13 = box3_width - box1_width;
		
	function moveBox() {
		if (box_width_diff > 50 && box_width_diff_real < 0) {
			$( ".post-box" ).eq(-1).css("margin", "0 26%");
		} else if (box_width_diff > 50 && box_width_diff_real > 0) {
			$( ".post-box" ).eq(-1).css({"margin" : "0 34.5%"});
		} else if ((box_width_diff < 50 || box_width_diff == 0) && box_width_diff13 > 50 && box_width_diff_real13 > 0) {
			$( ".post-box" ).eq(-2).css({"margin" : "0 1% 0 17.7%"});
		} else {
			
		}
	}//end isBox
		
	if (windowWidth > 600) {
		moveBox();
	}
		
	// Simulate a hover with a touch in touch enabled browsers
	$('body').bind('touchstart', function() {});	
	
	// Main Nav, buy magazine dorp down menu	
	buyMag = $('li.buy-mag');
	buyMagLink = $('#head-subscribe');
	buyMagDrop = $('.m-buymag-drop');
	
	buyMagDrop.click(function(event){
		event.stopPropagation();
	});
	buyMagLink.click(function(event){
		event.stopPropagation();
		buyMagDrop.slideToggle(200);
	});
	$("body, .m-buymag-drop i").click(function(){
		buyMagDrop.slideUp(200);
	});
	buyMagDrop.mouseleave(function(){buyMagDrop.slideUp(200);})
	
	// add .disabled-link class to an <a> tag to disable it's dfault begavior 
	disabledLink = $('.disabled-link');
	disabledLink.click(function(event){
		event.preventDefault();
	});
	
	
	
	
	
		
	

}); // end of document.ready

// STICKY HEADER
var $document 	= $(document),
	head_inner	= $("#header_inner");

function stickyHead() {
	
}

/* Adventure Map
----------------------------*/
var stick_start 	= $(".adventure-btf"),
	stick_stop 		= $(".footer"),
	r_sticky 		= $(".route"),
	r_fixed 		= 'r-fixed',
	r_stickBottom 	= 'r-stick-bottom',
	map_circle		= $(".circle"),
    map_text		= $(".map-text");
    	
function stickyRoute() {
    
    var stick_start_top = stick_start.offset().top,
    	r_sticky_height = $('.route').height(),
    	doc_height		= $window.height(),
    	stick_stop_top 	= stick_stop.offset().top,
    	docTop			= $document.scrollTop(),
    	rout_hight 		= 800;
    	
    	if (doc_height <= 800) rout_hight = doc_height;
    	
    if (docTop >= stick_start_top && docTop <= stick_stop_top - r_sticky_height - 84) {
		r_sticky.addClass(r_fixed);
		r_sticky.removeClass(r_stickBottom);
	} else if (docTop > stick_start_top && docTop > stick_stop_top - r_sticky_height - 84) {
		r_sticky.addClass(r_stickBottom);
	} else {
		r_sticky.removeClass(r_fixed);
		r_sticky.removeClass(r_stickBottom);
	}
	
	 
	
	r_sticky.css("height", rout_hight );
}

function mapStyle(n, h, j) {
    h = h || '#59a756';
    j = j || '#41843E';
    
	map_circle.attr("fill", "#ffffff");
	$("#c" + n).attr("fill", h);
	
	map_text.css({'fill': "#999999", "font-weight" : 400});
	$("#t" + n).css({'fill': j, "font-weight" : 600});
}

jQuery( window ).resize(function() {
	var windowWidth = jQuery(window).width();
	
	if (windowWidth < 600) {
		jQuery( ".post-box" ).eq(-1).css("margin", "0 0 30px");
	}
});

document.scroll(function() {
    if (r_sticky.length) { stickyRoute(); animRoute();}
	if (adv.length) { load_half(); }
});