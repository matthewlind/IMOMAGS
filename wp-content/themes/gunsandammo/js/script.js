jQuery(document).ready(function($) {

    jQuery('body').on("click", ".jq-close-popup, .overlay", function(e){
    	jQuery(".overlay").hide();
        jQuery(".basic-popup").removeClass("popup-opened");
        jQuery(".filter-fade-out").removeClass("filter-fade-in");
        jQuery(".layout-frame").removeClass("filter-popup-opened");
        e.preventDefault();
    });

    jQuery('body').on("click", ".matchup .vote-pop", function(e){
    	jQuery(".overlay").show();
        jQuery(".reg-popup").addClass("popup-opened");
        jQuery(".filter-fade-out").addClass("filter-fade-in");
        jQuery(".layout-frame").addClass("filter-popup-opened");
        jQuery('html, body').animate({scrollTop: jQuery(".basic-popup").offset().top - 100}, "slow");
        return false;
    });

});


