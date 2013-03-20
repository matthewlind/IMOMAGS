/**
 * custom.js
 *
 * Random effects and doodads
 */


(function($){
    $( function() {
        $("#conservation-link").hover(
            function () {
                $('#conservation-lists').fadeIn();
            },
            function () {
            }
            );
        $("#conservation-lists").hover(
            function () {
            },
            function () {
                $('#conservation-lists').fadeOut();
            }
            );
        /**
         * Automatically remove default text and replace it if nothing is entered.
         */
        $("input[type=text]").each(function(i, o) {
            var input_default = $(o).val(); 
            $(o).focus(
                function() {
                    if($(this).val() == input_default ) {
                        $(this).val("");
                    }
                }).blur(
                    function() {
                        if($(this).val() == "") {
                            $(this).val(input_default);
                        }
                    });
        });
        
// jFollow
$(function(){
	if ($(".advert").length > 0) {
		$('.advert').jfollow('#responderfollow');
	}
});

      
/*****
**
** IMO NETWORK TOPHAT
**
*****/
$(document).ready(function(){
				
	var $window = $(window);
    var $networkNav = $(".network-nav");
    var $tophat = $("#imo-tophat");
   
    // show network nav at top on load
    if ($window.scrollTop() != 0) {             
        $networkNav.slideDown(1000,function(){
	        $(this).css("top", "30px");
	    });    
    }   
    setTimeout(function() {
    // Moves status bar to top of browser window on scroll
    $window.scroll(function () { 
        $networkNav.stop().animate({
            top: -100
            }, 500, function() {
                if ($window.scrollTop() == 0) {
                    $(this).animate({ display: 'block',top: 30 },300); // return to default position                             
                }
        });
    });
    }, 1000);
      
    //hover over to reveal
	$tophat.hover(function(){
    	$networkNav.slideDown(100,function(){
    		$(this).stop().animate({top: 30});
    	});
   
    });
     	
});
    });})(jQuery);

