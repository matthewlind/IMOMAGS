/**
 * Scripts.js
 */

var dartadsgen_rand = Math.floor((Math.random()) * 100000000), pr_tile = 1, dartadsgen_site="shotgunnews";
jQuery(document).ready(function($) {
	$(window).load(function() {
		$('.flexslider').flexslider({
			animation: "slide",
			easing: "swing",
	        animationSpeed: 200,
	        slideshow: false,
	        itemWidth: 140,
	        itemMargin: 0,
	        minItems: 2,
	        maxItems: 2
			
		}); 
	});
});

// Flash ad z-index pecking order fix
jQuery(document).ready(function($) {
	FlashHeed.heed();
});

