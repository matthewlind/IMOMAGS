jQuery(document).ready(function($) {
	
	var mapShift = $(".m-map-absolute"),
		mapRelative = $(".m-map-relative");
		
	$(".m-nav").on("click", function(e){
		e.stopPropagation();
		mapShift.addClass("m-map-shift-down");
	});
	$("body, .m-map-shift > i").on("click", function(){ 
		mapShift.removeClass("m-map-shift-down");
	});
	
}); // end doc.ready