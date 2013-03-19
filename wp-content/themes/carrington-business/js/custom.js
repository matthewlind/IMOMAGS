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
** IMO G&A Madness
**
*****/
$(document).ready(function(){
	/**** Voting Links ****/
	$(".open-poll").mouseover(function() {
		$(this).css("background","#ce181e");
		$(this).children("p").hide();
		$(this).children(".vote").show();
	});
	
	$(".open-poll").mouseout(function() {
		$(this).css("background","white");
		$(this).children(".vote").hide();
		$(this).children("p").show();
	});


	/*** Modal Bracket ***/	 
	$(".open-poll").click(function(event){	
		//grab the slug for the poll
		var $slug = $(this).attr('poll');
	
		$("#bracket-modal").modal({
			opacity:50,
			minHeight: 540,
	        overlayClose: true,
	        autoPosition: true,
	       
	        onShow: function(dialog) {
	        	// load the poll page div
		        $('.poll-area').load( '/ga_madness/' + $slug + ' .entry-content', function(){
		        
		        if( $(".wp-polls-form").length > 0 ){
			     	$li1 = $('.wp-polls-ans ul').find("li").eq(0);
			     	$li2 = $('.wp-polls-ans ul').find("li").eq(1);
		    		$inputImg1 = $('.wp-polls-ans ul').find("li:eq(0) .poll-image img");
		    		$inputImg2 = $('.wp-polls-ans ul').find("li:eq(1) .poll-image img");
		    		
		    		//reveal the ad and choose buttons after poll has loaded
		    		$('.extra-poll-content').fadeIn();
		    		
		    		
		    		//choose the gun
	        		$li1.click(function(event){
						$($inputImg1).css("border","4px solid #ce181e");
						$($inputImg2).css("border","4px solid white");	
						$('.vote-thumb').css("left", "165px");
						$('.vote-thumb').css("display","block");
	        		});
	        		
	        		$li2.click(function(event){
						$($inputImg1).css("border","4px solid white");
						$($inputImg2).css("border","4px solid #ce181e");
						$('.vote-thumb').css("left", "525px");
						$('.vote-thumb').css("display","block");
							
	        		});
	        		
	        		$li1.mouseover(function() {		
	        			$($inputImg1).css("border","4px solid #ce181e");
						$($inputImg2).css("border","4px solid white");	
	        		});	
				
					
					$li2.mouseover(function() {		
						$($inputImg1).css("border","4px solid white");
						$($inputImg2).css("border","4px solid #ce181e");
	        		});	
	        		
	        		$li1.mouseout(function() {		
						$($inputImg1).css("border","4px solid white");	
	        		});	
				
					
					$li2.mouseout(function() {		
						$($inputImg2).css("border","4px solid white");
	        		});	
	
	        		$(".wp-polls .Buttons").mouseover(function() {	
	        			$(".wp-polls .Buttons").css("background","black");
	        		});
        		
        		}else{
	        		$(".voted").show();
	        		$(".poll-image img").css("opacity",0.5);
        		}
        		
			 });			
			    		
			     // close the modal						
			     $("#bracket-modal a.hide-this").click(function(){
			        $.modal.close();
		        });
	        },
	      });
	 });

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

