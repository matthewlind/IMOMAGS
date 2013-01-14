/**
 * Scripts.js
 */

var dartadsgen_rand = Math.floor((Math.random()) * 100000000), pr_tile = 1, dartadsgen_site="hunting";


// Category page sliders
$(document).ready(function(){
	if ($("#slideshow").length > 0) {			
		$('#slideshow').scrollface({
		  next   : $('#next'),
		  prev   : $('#prev'),
		  pager  : $('#pager'),
		  speed  : 400,
		  easing : 'easeOutExpo',
		  interval: 5000,
		  direction: 'horizontal',
		  auto: true
	 
	  });	
   }
});
