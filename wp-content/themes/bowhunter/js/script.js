jQuery(document).ready(function () {
// TV-show functions
	jQuery(".air-times-btn").click(function(){
		jQuery(this).parents().eq(2).find(".m-shows-airtimes").toggleClass("height-auto");
		//jQuery(".m-shows-airtimes").toggleClass("height-auto");
	});
			
// End TV-show functions
console.log("hello");
}); // End Document Ready