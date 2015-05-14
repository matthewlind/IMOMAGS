jQuery(document).ready(function($) {
	
	var mapShift = $(".m-map-shift"),
		mapRelative = $(".m-map-relative");
	
/*
	$(".m-nav").click(function(e){
		e.stopPropagation();
		mapShift.addClass("m-map-shift-down");
		mapRelative.css("height", "230px");
	});
*/
	$(".m-nav").on("click", function(e){
		e.stopPropagation();
		mapShift.addClass("m-map-shift-down");
		mapRelative.css("height", "230px");
	});

/*
	$(".m-map-shift > i, body").click(function(){
		mapShift.removeClass("m-map-shift-down");
		mapRelative.css("height", "0");
	});
*/
	
	$(".m-map-shift > i, body").on("click", function(){ 
		mapShift.removeClass("m-map-shift-down");
		mapRelative.css("height", "0");
	});
	
}); // end doc.ready