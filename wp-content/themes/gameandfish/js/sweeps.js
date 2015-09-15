jQuery( document ).ready(function($) {				
	var generalDoc = $('html, body');
	var buttonEnter = $('.m-sweep-text a');
	$(buttonEnter).click(function() {
	    generalDoc.stop().animate({
	        scrollTop: (($($.attr(this, 'href') ).offset().top) - 60)
	    }, 800, "swing");
	    return false;
	});
	
	
/*
	$('a[href^="#"]').on('click',function (e) {
	    e.preventDefault();

	    var target = this.hash;
	    var $target = $(target);

	    $('html, body').stop().animate({
	        'scrollTop': $target.offset().top
	    }, 900, 'swing', function () {
	        window.location.hash = target;
	    });
	});
*/
	
	
/*
	$("#button").click(function() {
	    $('html, body').animate({
	        scrollTop: $("#m-article").offset().top
	    }, 2000);
	    return false;
	});
*/
	
	
/*
	// Attaches smooth animation scroll jumps to map links
		var generalDoc = $('html, body');
		var mapNavLinks = $(".m-sweep-text a");
		$(mapNavLinks).click(function() {
		    generalDoc.animate({
		        scrollTop: (($($.attr(this, 'href') ).offset().top) - 60)
		    }, 800, "swing");
		    return false;
		});
*/
});