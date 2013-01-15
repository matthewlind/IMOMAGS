jQuery(document).ready(function($) {


//If this is an ipad
var isiPad = navigator.userAgent.match(/iPad/i) != null;


//
if (isiPad && $.cookie('hide_ipad_interstitial') == null) {
	
	var $popUpHolder = $("<div class='popupHolder'></div>");

$popUpHolder.load("http://www.petersenshunting.deva/wp-content/plugins/ipad-mag-interstitial/petersenshunting.html",function() {
	$popUpHolder.find(".hide-interstitial").click(function(event){

		
		$popUpHolder.remove();
		event.preventDefault();
		
		$.cookie('hide_ipad_interstitial','Yup!');
	});
});

$("body").prepend($popUpHolder);
}








});//End document ready
