
jQuery( document ).ready(function($) {

	//Variables
	var windowHight 	= $(window).height();
	var windowWidth 	= $(window).width(); 
	var pageHeader  	= $(".b2b .page-header");
	var mapImage    	= $("#b2b-map-img");
	var headerHight 	= $(".header").height();
	console.log(windowHight);
	
	
	// Border to Border Show
	function fullHightHeader(){
		$(pageHeader).css({
			"height": ((windowHight - headerHight - 40) + "px")
		});

	}	
		fullHightHeader();

	// Functions triggered on window resize
	$(window).on("resize", function() { 
		var windowHight = $(window).height(); 
		var windowWidth = $(window).width(); 	


		
		// Border to Border Show
		function fullHightHeader(){
			$(pageHeader).css({
				"height": ((windowHight - headerHight - 40) + "px")		
			});

		}
		fullHightHeader();
		// Consolw Logs
		console.log(windowHight);
	});
	
});