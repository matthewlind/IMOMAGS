
(function($){ $(function() {

    $(".featured-articles").tabs();
    $("#loadcover").fadeOut("slow");
    $(".featured-articles").tabs("rotate", 4250);
         
    $(".featured-articles .tab-content").each(function(i, o){
        $(o).click(function(){
          window.location=$("h2 > a",this).attr("href");  
        });
    });
}); })(jQuery);
