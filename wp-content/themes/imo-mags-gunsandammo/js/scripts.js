/**
 * Scripts.js
 */

var dartadsgen_rand = Math.floor((Math.random()) * 100000000), pr_tile = 1, dartadsgen_site="gunsandammo";


jQuery(document).ready(function($) {
  
  // Add some nth-child love for IE
  $('#secondary aside:nth-child(3n)').addClass('last');
  $('.fancy > li:nth-child(2n+1)').addClass('odd');

  // A little magic for browsers that don't support the HTML5 placeholder attribute
  // via WebDesignerWall.com
  if (!Modernizr.input.placeholder) {

		$('[placeholder]').focus(function() {
		  var input = $(this);
		  if (input.val() == input.attr('placeholder')) {
			input.val('');
			input.removeClass('placeholder');
		  }
		}).blur(function() {
		  var input = $(this);
		  if (input.val() == '' || input.val() == input.attr('placeholder')) {
			input.addClass('placeholder');
			input.val(input.attr('placeholder'));
		  }
		}).blur();
		$('[placeholder]').parents('form').submit(function() {
		  $(this).find('[placeholder]').each(function() {
			var input = $(this);
			if (input.val() == input.attr('placeholder')) {
			  input.val('');
			}
		  })
		});

	}
  
  
  
 
 
  // Video Slideshow
  $("#video-slideshow").tabs();
  
  var $tabs = $('.ui-tabs').tabs();
  
  // Add Prev/Next Navigation to jQuery UI Tabs
  $(".ui-tabs").each(function() {
    $(this).append("<a href='#' class='next-tab'>Next Page &#187;</a><a href='#' class='prev-tab'>&#171; Prev Page</a>");
  });
  
  var totalSize = $(".ui-tabs-panel").size() - 1;
  
  $('.next-tab').click(function() {
    var selected = $tabs.tabs('option', 'selected');
    if (selected == totalSize) {
      selected = 0; 
    } else {
     selected++;
    }
    $tabs.tabs('select', selected);
    return false;
  });

  $('.prev-tab').click(function() {
    var selected = $tabs.tabs('option', 'selected');
    if (selected == 0) {
      selected = totalSize; 
    } else {
     selected--;
    }
    $tabs.tabs('select', selected);
    return false;
  });
  
  // Show the Prev/Next navigation only on hover
  $(".ui-tabs").mouseover(function() {
    $('.prev-tab, .next-tab').show();
  }).mouseout(function() {
    $('.prev-tab, .next-tab').hide();
  });
  

});

// Related Content slider
$(document).ready(function(){
				
	jQuery('#slides-related').jcarousel({scroll: 3});	

});
// Flash ad z-index pecking order fix
$(document).ready(function(){
	FlashHeed.heed(document.getElementById('gallery-iframe-ad'));
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
                    $(this).animate({ display: 'block',top: 30 },500); // return to default position                             
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
if(document.domain +"/ga-madness"){

	$(document).ready(function(){
			
		/*** How it Works Modal ***/
		$(".how-works").click(function(event){	
			
			$("#bracket-modal").modal({
				opacity:50,
				minHeight: 540,
		        overlayClose: true,
		        autoPosition: true,
		       
		        onShow: function(dialog) {
		        	// load the how it works page div
		        	$('#Gen').fadeIn();
			        $('.poll-area').load( '/ga-madness/how-it-works .entry-content', function(){
				    	$('#Gen').hide();
				    	$("#imo-tophat").hide();
				    	$("#bracket-modal").css("overflow","scroll");
				    	
				    });
	
			     },
	
			});
		
		});	
		
		/*** Modal Bracket ***/	 
		$(".open-poll").click(function(event){	
			//grab the slug for the poll
			var $slug = $(this).attr('poll');
			var $pollNum = $(this).attr('pollNum');
			
			//Poll content
			function loadPoll(){
			if( $(".wp-polls-form").length > 0 ){
		     	$li1 = $('.wp-polls-ans ul').find("li").eq(0);
		     	$li2 = $('.wp-polls-ans ul').find("li").eq(1);
	    		$inputImg1 = $('.wp-polls-ans ul').find("li:eq(0) .poll-image img");
	    		$inputImg2 = $('.wp-polls-ans ul').find("li:eq(1) .poll-image img");
	    		
	    		
	    		//reveal the ad and choose buttons after poll has loaded
	    		$('.extra-poll-content').fadeIn();
	    		
	    		
	    		$("input.Buttons[name='vote']").on("click",function(ev){
		    		
		    		var slug = $(this).closest("form").attr("action").split("/")[2];
		    		
		    		var selector = "[poll='" + slug + "']";
						
		    		$(selector).addClass("poll-taken");
		    		
	    		});
	    		
	    		
	    		//choose the gun
	    		$li1.click(function(event){
					$($inputImg1).css("border","4px solid #ce181e");
					$($inputImg2).css("border","4px solid white");	
					$('.vote-thumb').css("left", "165px");
					$('.vote-thumb').css("display","block");
					
					$li1.find("input[type='radio']").attr('checked', true);
					
	    		});
	    		
	    		$li2.click(function(event){
					$($inputImg1).css("border","4px solid white");
					$($inputImg2).css("border","4px solid #ce181e");
					$('.vote-thumb').css("left", "525px");
					$('.vote-thumb').css("display","block");
					
					$li2.find("input[type='radio']").attr('checked', true);
						
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
	    		$(".poll-pagination").css("top","-254px");
			}
		}
		
		
		
				
		//Voting Modal
		$("#bracket-modal").modal({
			opacity:50,
			minHeight: 540,
	        overlayClose: true,
	        autoPosition: true,
	        
	        onShow: function(dialog) {
	        	// load the poll page div
	        	$('#Gen').fadeIn();
		        $('.poll-area').load( '/ga_madness/' + $slug + ' .entry-content', function(){
		        	$("#imo-tophat").hide();
		        	$('#Gen').hide();
		        	_gaq.push(['_trackPageview',"/" + window.location.pathname + $slug]);
		        	loadPoll();
        			$(".poll-pagination").fadeIn();
        			
        		
        			//close current poll and open next poll
	        		$(".next-poll").click(function(event){
		
	        			//Get the next poll for pagination
	        			var $pollString = $pollNum;
	        			var $pollInteger;
	
	        			$pollInteger = parseInt($pollString);
	        			var $pollNumNext = $pollInteger + 1;
	        			
	        			if($pollNumNext == 3){
		        			$pollNumNext = 1;
	        			}
	        			
	        				        			
	        			var $nextPoll = $("#bracket").find(".open-poll[pollNum=" + $pollNumNext + "]");
	        			var $nextSlug =  $nextPoll.attr("poll");
		        		
		        		$('#Gen').fadeIn();		        		
	        			$('.poll-area').load( '/ga_madness/' + $nextSlug + ' .entry-content', function(){
	        				$('#Gen').hide();
	        				_gaq.push(['_trackPageview',"/" + window.location.pathname + $nextSlug]);
	        				//Update the poll number
	        				$pollNum = $pollNumNext;
	        				$(".vote-thumb").hide();
	        				loadPoll();	
	        				
	        				//fix for not reading the length when paginating
	        				if( $(".wp-polls-form").length > 0 ){
		        				$(".voted").hide();
		        				$(".poll-pagination").css("top","-228px");
	        				}
	                	});
        		
			        });
			        
			        //close current poll and open previous poll
	        		$(".prev-poll").click(function(event){
	        			
	        			//Get the next poll for pagination
	        			var $pollString = $pollNum;
	        			var $pollInteger;
	
	        			$pollInteger = parseInt($pollString);
	        			var $pollNumPrev = $pollInteger - 1;
	        			
	        			//reset poll number for loop
	        			if($pollNumPrev == 0){
		        			$pollNumPrev = 2;
	        			}
	        			
	        			var $prevPoll = $("#bracket").find(".open-poll[pollNum=" + $pollNumPrev + "]");
	        			var $prevSlug =  $prevPoll.attr("poll");
		        		
		        		//clear the html from the current poll
		        		$('#Gen').fadeIn();		        		
	        			$('.poll-area').load( '/ga_madness/' + $prevSlug + ' .entry-content', function(){
	        			
	        				$('#Gen').hide();
	        				_gaq.push(['_trackPageview',"/" + window.location.pathname + $prevSlug]);
	        				//Update the poll number
	        				$pollNum = $pollNumPrev;
	        				$(".vote-thumb").hide();
	        				loadPoll();	
	        				//fix for not reading the length when paginating
	        				if( $(".wp-polls-form").length > 0 ){
		        				$(".voted").hide();
		        				$(".poll-pagination").css("top","-228px");
	        				}
			        	});
        		
			        });
			 });			
			    		
				     // close the modal						
				     $("#bracket-modal a.hide-this, #simplemodal-overlay").click(function(){
				     	$("#imo-tophat").fadeIn();
				        $.modal.close();
				        
			        });
		        },
			 });
		 });
	
	}); 				
}


// Use cookies to color the polls that have already been taken
var getCookies = function(){
  var pairs = document.cookie.split(";");
  var cookies = new Array();
  for (var i=0; i<pairs.length; i++){
    var pair = pairs[i].split("=");
    cookies[pair[0]] = unescape(pair[1]);
  }
  return cookies;
}

function getTakenPolls(){
	
	var takenPolls = new Array();
	
	var pairs = document.cookie.split(";");
	
	for (var i=0; i<pairs.length; i++){
	
	    var pair = pairs[i].split("=");
	    

	    
	    if (pair[0].substring(0, 7) == " voted_") {
		    takenPolls.push(pair[0].substring(7,9));
		    
		}
	    
	    
    }
	
	return takenPolls;
	
}


$(document).ready(function(){

	var thePolls = getTakenPolls();
	

	
	$.each(thePolls,function(key,pollString){
		
	
		
		if (madness_poll_data[pollString]) {
			
			var selector = "[poll='" + madness_poll_data[pollString].slug + "']";
						
			$(selector).addClass("poll-taken")
			
		}
	});



});

// Category page sliders
$(document).ready(function(){
	if ($("#slideshow").length > 0) {			
		$('#slideshow').scrollface({
		  next   : $('#next'),
		  prev   : $('#prev'),
		  pager  : $('#pager'),
		  speed  : 400,
		  easing : 'easeOutExpo',
		  interval: 5000,
		  direction: 'horizontal',
		  auto: true
	 
	  });	
   }
});




$(window).load(function() {
	$('.flexslider').flexslider({
		animation: "slide",
		easing: "swing",
        animationSpeed: 200,
        slideshow: false,
        itemWidth: 140,
        itemMargin: 0,
        minItems: 2,
        maxItems: 2
		
	});
});

