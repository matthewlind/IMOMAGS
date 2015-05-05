jQuery(document).ready(function($) {
	
	
	$(".m-nav").click(function(e){
		e.stopPropagation();
		$(".m-map-shift").addClass("m-map-shift-down");
		$(".m-map-relative").css("height", "230px");
	});
	
	$(".m-map-shift > i, body").click(function(){
		$(".m-map-shift").removeClass("m-map-shift-down");
		$(".m-map-relative").css("height", "0");
	});
	
	
	
});