jQuery(document).ready(function(){
        jQuery('.basic-popup').on("click", ".jq-close-popup .filter-fade-in", function(e){
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
        
        jQuery('body').on("click", ".jq-open-cat-popup", function(){
            jQuery(".cat-popup").addClass("popup-opened");
            jQuery(".filter-fade-out").addClass("filter-fade-in");
            jQuery(".layout-frame").addClass("filter-popup-opened");
            jQuery('html, body').animate({scrollTop:0}, 'slow');
            return false;
        });
        
        jQuery('body').on("click", ".jq-open-state-popup", function(){
            jQuery(".state-popup").addClass("popup-opened");
            jQuery(".filter-fade-out").addClass("filter-fade-in");
            jQuery(".layout-frame").addClass("filter-popup-opened");
            jQuery('html, body').animate({scrollTop:0}, 'slow');
            return false;
        });
        
        jQuery('body').on("click", ".jq-open-reply-slide", function(){
            jQuery(".post-reply-slide").addClass("slide-opened");
           // jQuery('html, body').animate({scrollTop:0}, 'slow');
            return false;
        });
        
        jQuery('body').on("click", ".jq-open-login-popup", function(){
            jQuery(".login-popup").addClass("popup-opened");
            jQuery(".filter-fade-out").addClass("filter-fade-in");
            jQuery(".layout-frame").addClass("filter-popup-opened");
            jQuery('html, body').animate({scrollTop:0}, 'slow');
            return false;
        });
        
        jQuery('.jq-explore-slider').flexslider({
            animation: "slide",
            animationSpeed: 200,
            slideshow: false,
            controlNav: false,
            directionNav: false,
            itemWidth: 123,
            itemMargin: 0,
            minItems: 2,
            maxItems: 4
        });
        
        jQuery('.jq-custom-form select').zfselect({
            rows:6
        });
     });