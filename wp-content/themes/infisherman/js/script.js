jQuery(function(){
    
  
  
    jQuery('.jq-slider').flexslider({
        animation: "slide",
        animationSpeed: 200,
        slideshow: false
      });
      
    jQuery('.jq-ma-slider').flexslider({
        animation: "slide",
        animationSpeed: 200,
        slideshow: true
      });
      
    jQuery('.jq-featured-slider').flexslider({
        animation: "slide",
        animationSpeed: 200,
        slideshow: true
      });
      
    jQuery('.jq-paging-slider').flexslider({
          animation: "slide",
          animationSpeed: 200,
          slideshow: false,
          itemWidth: 312,
          itemMargin: 0,
          minItems: 1,
          maxItems: 3
        });
    
    jQuery('.jq-single-paging-slider').flexslider({
          animation: "slide",
          animationSpeed: 200,
          slideshow: false,
          itemWidth: 340,
          itemMargin: 0,
          minItems: 1,
          maxItems: 1
        });
     
    /*jQuery('.jq-cabela-slider').flexslider({
          animation: "slide",
          animationSpeed: 200,
          slideshow: false,
          itemWidth: 318,
          itemMargin: 0,
        });*/
    
    jQuery('.jq-custom-form input[type="checkbox"]').ezMark();
    
    
});