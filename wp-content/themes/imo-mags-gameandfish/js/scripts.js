/**
 * Scripts.js
 */

var dartadsgen_rand = Math.floor((Math.random()) * 100000000), pr_tile = 1, dartadsgen_site="gameandfish";


//jQuery functions
;(function($) {$(function() {
	
	//tabs for gallery filters
	$('#tabs').tabs();		
		
	//age modal screen
	$('body').ageBlock({
			title: 'Please verify your age',
			subtitle: 'You must be at least 21 years old',
			showError: false,
			error: 'You must be at least 21 years old',
			age: '21',
			process: 'process.php',
			opacity: 0.9
	});

	//scroll to registration area
	$('.upload').click(function(){
		$('html, body').animate({
        	scrollTop: $("#sign-up-area").offset().top
    	}, 1500);
	});
	
	//scroll to gallery area
	$('.gallery').click(function(){
		$('html, body').animate({
               scrollTop: $("#gallery").offset().top
        }, 1300);
    });
        
    //scroll to prize area
	$('.prizes-area').click(function(){
		$('html, body').animate({
               scrollTop: $("#prizes").offset().top
        }, 1300);
    });
     
    //scroll to rules area
	$('.rules-area').click(function(){
		$('html, body').animate({
               scrollTop: $("#footer").offset().top
        }, 1300);
			
	});
	
	//image hover
	$(function(){
		
		//prizes area
		$(".grand a").hover(function(){
			$("img", this).stop().animate({top:"-270px"},{queue:false,duration:200});
			$("span", this).stop().animate({top:"0px"},{queue:false,duration:200});
		}, function() {
			$("img", this).stop().animate({top:"0px"},{queue:false,duration:200});
			$("span", this).stop().animate({top:"-270px"},{queue:false,duration:200});
		});
		
		
		
		//bottom images at top of page
		$(".slideshow_btm a").hover(function(){
			$("img", this).stop().animate({top:"-150px"},{queue:false,duration:200});
			$("span", this).stop().animate({top:"0px"},{queue:false,duration:200});
		}, function() {
			$("img", this).stop().animate({top:"0px"},{queue:false,duration:200});
			$("span", this).stop().animate({top:"-160px"},{queue:false,duration:200});
		});
			
		
		//state prizes
		$(".box-350-states a").hover(function(){
			$("img", this).stop().animate({top:"-460px"},{queue:false,duration:200});
			$("span", this).stop().animate({top:"0px"},{queue:false,duration:200});
		}, function() {
		$("img", this).stop().animate({top:"20px"},{queue:false,duration:200});
			$("span", this).stop().animate({top:"-540px"},{queue:false,duration:200});
		});
		
		//slideshow area
		$(".box-710 a").hover(function(){
			$(".meta", this).stop().animate({bottom:"0px"},{queue:false,duration:200});
		}, function() {
			$(".meta", this).stop().animate({bottom:"-30px"},{queue:false,duration:200});
		});

	});
	    
	//scroll to top				
	$(document).ready(function(){
		// hide #back-top first
		$("#back-top").hide();
	
		// fade in #back-top
		$(function () {
			$(window).scroll(function () {
				if ($(this).scrollTop() > 100) {
					$('#back-top').fadeIn();
				} else {
					$('#back-top').fadeOut();
				}
			});

			// scroll body to 0px on click
			$('#back-top a').click(function () {
				$('body,html').animate({
					scrollTop: 0
				}, 800);
				return false;
			});
		});
		
		//prev & next buttons for gallery
		$('.scroll').buffet({
    		scroll_by : 3,
   			next      : $('.next'),
    		prev      : $('.prev')
  		});

	});
					

});
})(jQuery);
