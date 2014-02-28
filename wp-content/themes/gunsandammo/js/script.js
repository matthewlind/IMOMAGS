jQuery(window).load(function() {
	jQuery('.ga-madness ul.rounds').css("overflow","visible");
});

jQuery(document).ready(function($) {
	jQuery('.gun-types select').change(function(){
		var value = jQuery(this).val();
		if(value)
		jQuery('html, body').animate({scrollTop: jQuery("h2#" + value).offset().top}, "slow");
	});
	
    jQuery('body').on("click", "body, .overlay, .jq-close-popup", function(e){
    	jQuery(".overlay").hide();
        jQuery(".basic-popup").removeClass("popup-opened");
        jQuery(".filter-fade-out").removeClass("filter-fade-in");
        jQuery(".layout-frame").removeClass("filter-popup-opened");
        jQuery("#wpadminbar, #imo-tophat, .fixed-connect").slideDown();
        jQuery("#imo-tophat").css({overflow: "visible"});
        e.preventDefault();
    });

    jQuery('body').on("click", ".vote-pop, .action-arrow, .rank", function(e){
	    jQuery(".overlay").show();
	    var modalPlacement = jQuery(this).offset().top;
	    jQuery(".basic-popup").css({top: modalPlacement + "px"})
    	jQuery(".reg-popup").addClass("popup-opened");
        jQuery(".filter-fade-out").addClass("filter-fade-in");
        jQuery(".layout-frame").addClass("filter-popup-opened");
        jQuery("#wpadminbar, #imo-tophat, .fixed-connect").slideUp();
        jQuery('html, body').animate({scrollTop: jQuery(".basic-popup").offset().top}, "slow");
	    return false;
    });

});


