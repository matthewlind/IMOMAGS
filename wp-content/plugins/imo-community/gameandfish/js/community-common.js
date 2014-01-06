jQuery(document).ready(function($) {
	
    jQuery('.browse-panel').on("click", ".jq-open-filer", function(){
        jQuery(".browse-item").removeClass("item-active");
        jQuery(this).addClass("item-active");
        jQuery(".browse-holder").addClass("browse-panel-opened");
        jQuery(".filter-fade-out").addClass("filter-fade-in");
        jQuery(".layout-frame").addClass("filter-popup-opened");
        jQuery('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });

    jQuery('body').on("click", ".jq-filter", function(e){
        jQuery(".browse-holder").addClass("browse-panel-opened");
        jQuery(".filter-fade-out").addClass("filter-fade-in");
        jQuery(".layout-frame").addClass("filter-popup-opened");
        jQuery('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });

    jQuery('.browse-panel').on("click", ".jq-close-filter", function(e){
        jQuery(".browse-item").removeClass("item-active");
        jQuery(".browse-holder").removeClass("browse-panel-opened");
        jQuery(".filter-fade-out").removeClass("filter-fade-in");
        jQuery(".layout-frame").removeClass("filter-popup-opened");
        e.preventDefault();
    });

    jQuery('.basic-popup').on("click", ".jq-close-popup", function(e){
        jQuery(".basic-popup").removeClass("popup-opened");
        jQuery(".filter-fade-out").removeClass("filter-fade-in");
        jQuery(".layout-frame").removeClass("filter-popup-opened");
        e.preventDefault();
    });

    jQuery('body').on("click", ".jq-open-reg-popup", function(e){
        jQuery(".reg-popup").addClass("popup-opened");
        jQuery(".filter-fade-out").addClass("filter-fade-in");
        jQuery(".layout-frame").addClass("filter-popup-opened");
        jQuery('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });



});


