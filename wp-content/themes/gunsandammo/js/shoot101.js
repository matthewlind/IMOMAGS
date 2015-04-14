/*
jQuery(window).load(function() {
	domain = jQuery("body").attr("domain");
	jQuery(".inline-ad").append('<iframe width="300" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-atf.php?ad_code=' + domain + '"></iframe>');
});
*/
jQuery(document).ready(function($) {
	$(".wpsocialite.small").remove();
	var windowWidth = $(window).width(),
		box1_width = $( ".post-box" ).eq(-1).width(),		
		box2_width = $( ".post-box" ).eq(-2).width(),
		box3_width = $( ".post-box" ).eq(-3).width(),
		box_width_diff = Math.abs(box1_width - box2_width)
		box_width_diff13 = Math.abs(box1_width - box3_width),
		box_width_diff23 = Math.abs(box2_width - box3_width),
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
		
	/*	// Debug
		var arrayBoxData = $( ".post-box" )
				.map(function() {
				return $( this ).width();
				})
				.get(),
		console.log(arrayBoxData);
		console.log(box1_width);
		console.log(box2_width);
		console.log(box_width_diff);
		console.log(box_width_diff_real);
	*/
	if (windowWidth > 600) {
		moveBox();
	}

/*
	$(".m-buy-dig").hover(	
		 function() {
			 console.log("hover");
	    $(".m-dig-hover").fadeIn().slideUp();
	  }, function() {
	    $(".m-dig-hover").fadeOut().slideDown();
	  }
	);
*/

}); // end of document.ready

/*
jQuery(window).scroll(function () {
	if (jQuery(window).scrollTop() > 50) {
		jQuery('.fixed-connect-mobile').fadeIn();
	}else{
		jQuery('.fixed-connect-mobile').fadeOut("fast");
	}
});
*/
jQuery('.fixed-connect .close').click(function(){
	jQuery('.fixed-connect').remove();
});

jQuery( window ).resize(function() {
	var windowWidth = jQuery(window).width();
	
	if (windowWidth < 600) {
		jQuery( ".post-box" ).eq(-1).css("margin", "0 0 30px");
	}
});