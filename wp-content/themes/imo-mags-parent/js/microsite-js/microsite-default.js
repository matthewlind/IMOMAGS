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
		
	// Simulate a hover with a touch in touch enabled browsers
	$('body').bind('touchstart', function() {});	
	
	// Main Nav, buy magazine dorp down menu	
	buyMag = $('li.buy-mag');
	buyMagLink = $('li.buy-mag a');
	buyMagDrop = $('.m-buymag-drop');
	
	buyMagLink.click(function(event){
		event.preventDefault();
	});
	buyMagDrop.click(function(event){
		event.stopPropagation();
	});
	buyMag.click(function(event){
		event.stopPropagation();
		buyMagDrop.toggleClass("m-display-block");
	});
	$("body, .m-buymag-drop i").click(function(){
		buyMagDrop.removeClass("m-display-block");
	});
	
	// add .disabled-link class to an <a> tag to disable it's dfault begavior 
	disabledLink = $('.disabled-link');
	disabledLink.click(function(event){
		event.preventDefault();
	});
	

}); // end of document.ready

jQuery( window ).resize(function() {
	var windowWidth = jQuery(window).width();
	
	if (windowWidth < 600) {
		jQuery( ".post-box" ).eq(-1).css("margin", "0 0 30px");
	}
});