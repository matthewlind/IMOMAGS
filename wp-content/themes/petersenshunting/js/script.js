jQuery(window).load(function(){
	// Load The Truck, The Gear pages scrolled down to the .nav-wrap
	if (jQuery(".b2b")[0]){
		if (jQuery(".the-truck")[0] || jQuery(".the-gear")[0] || jQuery(".how-to-guide")[0] || jQuery('*[class^="diy"]')[0]) {
			var navTop = jQuery('.nav-wrap').offset().top;
		    window.scrollTo(0,(navTop - 50));
		}
    }
});
jQuery( document ).ready(function($) {
	if ($(".b2b")[0]){

		//Variables
		var windowHeight 	= $(window).height();
		var windowWidth 	= $(window).width(); 
		var pageHeader  	= $(".b2b-header");
		var headerHight 	= $(".header").height();
		var mapLeft  		= $(".b2b .map-left svg");
		var mapImage    	= $(".b2b-map-img");
		var mapImageHeight  = $(".b2b-map-img").height();
		var mapImageWidth   = $(".b2b-map-img").width();
		var mapText		 	= $(".b2b-map-text");
		
		if ($(".border-to-border")[0]){
		
			//Handels for every SVG Road Path 
			var path1 = $(".road-1");
			var path2 = $(".road-2");
			var path3 = $(".road-3");
			var path4 = $(".road-4");
			var path5 = $(".road-5");
			var path6 = $(".road-6");
			var path7 = $(".road-7");
		
			//hide the trip progress line 
			 $(".road").hide();
	
			// functions for progress lines drawing
			/////////////////////////
			function drawLines1(){
			    $.each(path1, function(i, val){
					var line = val;
					drawLine($(this), line);
			    });   
			    //draw the line
				function drawLine(container, line){
					var length = 0;
					var pathLength = line.getTotalLength();
					var docTop = $(document).scrollTop();
					var ep1 = $('.episode-1').offset().top;
					var ep2 = $('.episode-2').offset().top;
					var distanceFromTop = docTop - ep1;
					if (distanceFromTop < 0) {
						distanceFromTop = 0;
					} else {
						distanceFromTop = docTop - ep1;
					}
					var distanceLeft = ep2 - ep1 - 200;
					var percentDone = (distanceFromTop / distanceLeft);
					length = percentDone * pathLength;
					line.style.strokeDasharray = [length,pathLength].join(' ');  
					
					// Changing fill of svg elements
					if ((ep1 < (docTop + 300)) && (ep2 > (docTop + 300))) {
						$(".newmexico-polygon").attr("fill", "#f6f6f6");
						$(".newmexico-text").attr("fill", "#333");
						$(".newmexico-circle").attr("r", "11").attr("fill", "#222222");
					} else if ((ep2 < (docTop + 300)) || (ep1 > (docTop - 300))) {
						$(".newmexico-polygon").attr("fill", "#fff");
						$(".newmexico-text").attr("fill", "#888");
						$(".newmexico-circle").attr("r", "6.7").attr("fill", "#777777");
					} 
				}// end drawLine	
			}// end drawLines1
			/////////////////////////////////////
			function drawLines2(){
			    $.each(path2, function(i, val){
			      var line = val;
			      drawLine($(this), line);
			    });
			    
				//draw the line
				function drawLine(container, line){
					var length = 0;
					var pathLength = line.getTotalLength();
					var docTop = $(document).scrollTop();
					var ep2 = $('.episode-2').offset().top;
					var ep3 = $('.episode-3').offset().top;
					
					var distanceFromTop = docTop - ep2;
					if (distanceFromTop < 0) {
						distanceFromTop = 0;
					} else {
						distanceFromTop = docTop - ep2;
					}
					var distanceLeft = ep3 - ep2;
					var percentDone = (distanceFromTop / distanceLeft);
					length = percentDone * pathLength;
					line.style.strokeDasharray = [length,pathLength].join(' ');
					
					// Changing fill of the state shape
					if ((ep2 < (docTop + 300)) && (ep3 > (docTop + 300))) {
						$(".colorado-polygon").attr("fill", "#f6f6f6");
						$(".colorado-text").attr("fill", "#333");
						$(".colorado-circle").attr("r", "11").attr("fill", "#222222");
					} else if ((ep3 < (docTop + 300)) || (ep2 > (docTop - 300))) {
						$(".colorado-polygon").attr("fill", "#fff");
						$(".colorado-text").attr("fill", "#888");
						$(".colorado-circle").attr("r", "6.7").attr("fill", "#777777");	    
					} 	
				}//end drowLine
			}//end drawLines2
			/////////////////////////////////////
			function drawLines3(){
			    $.each(path3, function(i, val){
			      var line = val;
			      drawLine($(this), line);
			    });   
			    //draw the line
				function drawLine(container, line){
					var length = 0;
					var pathLength = line.getTotalLength();
					var docTop = $(document).scrollTop();
					var ep3 = $('.episode-3').offset().top;
					var ep4 = $('.episode-4').offset().top;
					
					var distanceFromTop = docTop - ep3;
					if (distanceFromTop < 0) {
						distanceFromTop = 0;
					} else {
						distanceFromTop = docTop - ep3;
					}
					var distanceLeft = ep4 - ep3;
					var percentDone = (distanceFromTop / distanceLeft);
					length = percentDone * pathLength;
					line.style.strokeDasharray = [length,pathLength].join(' '); 
					
					// Changing fill of the state shape
					if ((ep3 < (docTop + 300)) && (ep4 > (docTop + 300))) {
						$(".wyoming-polygon").attr("fill", "#f6f6f6");
						$(".wyoming-text").attr("fill", "#333");
						$(".wyoming-circle").attr("r", "11").attr("fill", "#222222");
					} else if ((ep4 < (docTop + 300)) || (ep3 > (docTop - 300))) {
						$(".wyoming-polygon").attr("fill", "#fff");
						$(".wyoming-text").attr("fill", "#888");
						$(".wyoming-circle").attr("r", "6.7").attr("fill", "#777777");	    
					} 
				}// end drawLine	     	
			}// end drawLines3
			/////////////////////////////////////
			function drawLines4(){
			    $.each(path4, function(i, val){
			      var line = val;
			      drawLine($(this), line);
			    });   
			    //draw the line
				function drawLine(container, line){
					var length = 0;
					var pathLength = line.getTotalLength();
					var docTop = $(document).scrollTop();
					var ep4 = $('.episode-4').offset().top;
					var ep5 = $('.episode-5').offset().top;
					
					var distanceFromTop = docTop - ep4;
					if (distanceFromTop < 0) {
						distanceFromTop = 0;
					} else {
						distanceFromTop = docTop - ep4;
					}
					var distanceLeft = ep5 - ep4 - 200;
					var percentDone = (distanceFromTop / distanceLeft);
					length = percentDone * pathLength;
					line.style.strokeDasharray = [length,pathLength].join(' '); 
					
					// Changing fill of the state shape
					if ((ep4 < (docTop + 300)) && (ep5 > (docTop + 300))) {
						$(".idaho-polygon").attr("fill", "#f6f6f6");
						$(".idaho-text").attr("fill", "#333");
						$(".idaho-circle").attr("r", "11").attr("fill", "#222222");
					} else if ((ep5 < (docTop + 300)) || (ep4 > (docTop - 300))) {
						$(".idaho-polygon").attr("fill", "#fff");
						$(".idaho-text").attr("fill", "#888");
						$(".idaho-circle").attr("r", "6.7").attr("fill", "#777777");	  
					} 
				}// end drawLine
			}// end drawLines4
			/////////////////////////////////////
			function drawLines5(){
			    $.each(path5, function(i, val){
			      var line = val;
			      drawLine($(this), line);
			    });   
			    //draw the line
				function drawLine(container, line){
					var length = 0;
					var pathLength = line.getTotalLength();
					var docTop = $(document).scrollTop();
					var ep5 = $('.episode-5').offset().top;
					var ep6 = $('.episode-6').offset().top;
					
					var distanceFromTop = docTop - ep5;
					if (distanceFromTop < 0) {
						distanceFromTop = 0;
					} else {
						distanceFromTop = docTop - ep5;
					}
					var distanceLeft = ep6 - ep5 - 240;
					var percentDone = (distanceFromTop / distanceLeft);
					length = percentDone * pathLength;
					line.style.strokeDasharray = [length,pathLength].join(' ');  
					
					// Changing fill of the state shape
					if ((ep5 < (docTop + 300)) && (ep6 > (docTop + 300))) {
						$(".washington-polygon").attr("fill", "#f6f6f6");
						$(".washington-text").attr("fill", "#333");
						$(".washington-circle").attr("r", "11").attr("fill", "#222222");
					} else if ((ep6 < (docTop + 300)) || (ep5 > (docTop - 300))) {
						$(".washington-polygon").attr("fill", "#fff");
						$(".washington-text").attr("fill", "#888");
						$(".washington-circle").attr("r", "6.7").attr("fill", "#777777");
					} 
				}// end drawLine
			}// end drawLine5
			/////////////////////////////////////
			function drawLines6(){
			    $.each(path6, function(i, val){
			      var line = val;
			      drawLine($(this), line);
			    });   
			    //draw the line
				function drawLine(container, line){
					var length = 0;
					var pathLength = line.getTotalLength();
					var docTop = $(document).scrollTop();
					var ep6 = $('.episode-6').offset().top;
					var ep7 = $('.episode-7').offset().top;
					// var ep8 = $('.episode-8').offset().top;
					
					var distanceFromTop = docTop - ep6;
					if (distanceFromTop < 0) {
						distanceFromTop = 0;
					} else {
						distanceFromTop = docTop - ep6;
					}
					var distanceLeft = ep7 - ep6 - 240;
					var percentDone = (distanceFromTop / distanceLeft);
					length = percentDone * pathLength;
					line.style.strokeDasharray = [length,pathLength].join(' '); 
					
					// Changing fill of the state shape
					if ((ep6 < (docTop + 300)) && (ep7 > (docTop + 300))) {
						$(".bc-polygon").attr("fill", "#f6f6f6");
						$(".bc-text").attr("fill", "#333");
						$(".bc-circle").attr("r", "11").attr("fill", "#222222");
					} else if ((ep7 < (docTop + 300)) || (ep6 > (docTop - 300))) {
						$(".bc-polygon").attr("fill", "#fff");
						$(".bc-text").attr("fill", "#888");
						$(".bc-circle").attr("r", "6.7").attr("fill", "#777777");
					} 
				    
				   // Changing fill of the state shape
				  /*
			if ((ep7 < (docTop + 300)) && (ep8 > (docTop + 300))) {
					   $(".alaska-polygon").children().attr("fill", "#f6f6f6");
					   $(".alaska-text").attr("fill", "#333");
					   $(".alaska-circle").attr("r", "11").attr("fill", "#222222");
				    } else if ((ep8 < (docTop + -700)) || (ep7 > (docTop - 300))) {
					   $(".alaska-polygon").children().attr("fill", "#fff");
					   $(".alaska-text").attr("fill", "#888");
					   $(".alaska-circle").attr("r", "6.7").attr("fill", "#777777");
				    } 
			*/ 
				}// end drawLine	 
			}// end drawLines6
	////////////////////////						
	
			//Flex slider
			$('#thumbs-1').flexslider({
				animation: "slide",
				controlNav: false,
				animationLoop: true,
				slideshow: false,
				itemWidth: 54,
				itemMargin: 5,
				asNavFor: '#slider-1'
			});
			
			$('#slider-1').flexslider({
				animation: "fade",
				controlNav: false,
				directionNav: true,   
				animationLoop: true,
				slideshow: true,                
				slideshowSpeed: 8000,          
				animationSpeed: 600,
				sync: "#thumbs-1"
			});
			
			////////////////////////
			$('#thumbs-2').flexslider({
				animation: "slide",
				controlNav: false,
				animationLoop: true,
				slideshow: false,
				itemWidth: 54,
				itemMargin: 5,
				asNavFor: '#slider-2'
			});
			
			$('#slider-2').flexslider({
				animation: "fade",
				controlNav: false,
				animationLoop: true,
				slideshow: true,                
				slideshowSpeed: 8000,          
				animationSpeed: 600,
				sync: "#thumbs-2"
			});
			////////////////////////
			$('#thumbs-3').flexslider({
				animation: "slide",
				controlNav: false,
				animationLoop: true,
				slideshow: false,
				itemWidth: 54,
				itemMargin: 5,
				asNavFor: '#slider-3'
			});
			
			$('#slider-3').flexslider({
				animation: "fade",
				controlNav: false,
				animationLoop: true,
				slideshow: true,                
				slideshowSpeed: 8000,          
				animationSpeed: 600,
				sync: "#thumbs-3"
			});
			////////////////////////
			$('#thumbs-4').flexslider({
				animation: "slide",
				controlNav: false,
				animationLoop: true,
				slideshow: false,
				itemWidth: 54,
				itemMargin: 5,
				asNavFor: '#slider-4'
			});
			
			$('#slider-4').flexslider({
				animation: "fade",
				controlNav: false,
				animationLoop: true,
				slideshow: true,                
				slideshowSpeed: 8000,          
				animationSpeed: 600,
				sync: "#thumbs-4"
			});
			////////////////////////
			$('#thumbs-5').flexslider({
				animation: "slide",
				controlNav: false,
				animationLoop: true,
				slideshow: false,
				itemWidth: 54,
				itemMargin: 5,
				asNavFor: '#slider-5'
			});
			
			$('#slider-5').flexslider({
				animation: "fade",
				controlNav: false,
				animationLoop: true,
				slideshow: true,                
				slideshowSpeed: 8000,          
				animationSpeed: 600,
				sync: "#thumbs-5"
			});
			////////////////////////
			$('#thumbs-6').flexslider({
				animation: "slide",
				controlNav: false,
				animationLoop: true,
				slideshow: false,
				itemWidth: 54,
				itemMargin: 5,
				asNavFor: '#slider-6'
			});
			
			$('#slider-6').flexslider({
				animation: "fade",
				controlNav: false,
				animationLoop: true,
				slideshow: true,                
				slideshowSpeed: 8000,          
				animationSpeed: 600,
				sync: "#thumbs-6"
			});
			////////////////////////
			$('#thumbs-7').flexslider({
				animation: "slide",
				controlNav: false,
				animationLoop: true,
				slideshow: false,
				itemWidth: 54,
				itemMargin: 5,
				asNavFor: '#slider-7'
			});
			
			$('#slider-7').flexslider({
				animation: "fade",
				controlNav: false,
				animationLoop: true,
				slideshow: true,                
				slideshowSpeed: 8000,          
				animationSpeed: 600,
				sync: "#thumbs-7"
			});
			////////////////////////
			$('#thumbs-8').flexslider({
				animation: "slide",
				controlNav: false,
				animationLoop: true,
				slideshow: false,
				itemWidth: 54,
				itemMargin: 5,
				asNavFor: '#slider-8'
			});
			
			$('#slider-8').flexslider({
				animation: "fade",
				controlNav: true,
				animationLoop: true,
				slideshow: true,                
				slideshowSpeed: 8000,          
				animationSpeed: 600,
				sync: "#thumbs-8"
			});
	  
		} // End if of .border-to-border

			if ($(".the-truck")[0]){
				$('#thumbs-truck').flexslider({
					animation: "slide",
				    controlNav: false,
				    animationLoop: true,
				    slideshow: false,
				    itemWidth: 54,
				    itemMargin: 5,
				    asNavFor: '#slider-truck'
				});
				$('#slider-truck').flexslider({
					animation: "fade",
				    controlNav: false,
				    directionNav: true,   
				    animationLoop: true,
				    slideshow: true,                
					slideshowSpeed: 8000,          
					animationSpeed: 600,
				    sync: "#thumbs-truck"
				});
				
				$('#thumbs-truck-2').flexslider({
					animation: "slide",
				    controlNav: false,
				    animationLoop: true,
				    slideshow: false,
				    itemWidth: 54,
				    itemMargin: 5,
				    asNavFor: '#slider-truck-2'
				});
				$('#slider-truck-2').flexslider({
					animation: "fade",
				    controlNav: false,
				    directionNav: true,   
				    animationLoop: true,
				    slideshow: true,                
					slideshowSpeed: 8000,          
					animationSpeed: 600,
				    sync: "#thumbs-truck-2"
				});
			
			}  // End if of .the-truck						
	
		// side map stick to top function
		function sideMapStick() {
			var docTop = $(document).scrollTop();
			var mapLeftTop = $('#article-wrap').offset().top;
			if (docTop > (mapLeftTop + 60)) {
				$(".map-left").css({"position" : "fixed", "top" : "0" });	
			}	else if (docTop < (mapLeftTop + 60)) {
				$(".map-left").css({"position" : "absolute", "top" : "60"});	
			}
		}   sideMapStick();
		
		// .map-left - hight - adjustment - function
			function heightMapLeft(){
				var mapWidth = windowHeight * 0.85;
				$(mapLeft).css({"height": (mapWidth + "px")});	
			}	heightMapLeft();
			
		// Attaches smooth animation scroll jumps to map links
		var generalDoc = $('html, body');
		var mapNavLinks = $(".map-left-links a");
		$(mapNavLinks).click(function() {
		    generalDoc.animate({
		        scrollTop: (($($.attr(this, 'href') ).offset().top) - 60)
		    }, 800, "swing");
		    return false;
		});

	
	
		if ($('*[class^="diy"]')[0]) {
			$(".shows-nav ul li:last-child").addClass("current-menu-item");
		};
		$(".current-menu-item").append("<div class='show-nav-arrow'></div>");
		// .shows-nav stick to top function
		function showsNavStick() {
			var docTop = $(document).scrollTop();
			var navTop = $('.nav-wrap').offset().top;
			if (docTop > navTop) {
				$(".shows-nav").addClass("sticky-shows-nav");
				$(".show-nav-arrow").css({"bottom" : "-8px", "left": 0, "border-width": "0 7px 5px 7px"});	
			}	else if (docTop < navTop) {
				$(".shows-nav").removeClass("sticky-shows-nav");
				$(".show-nav-arrow").css({"bottom" : "-17px", "left": 0,"right": 0, "border-width": "0 10px 7px 10px"});	
			}
		}   showsNavStick();
		
		// .diy-states stick to top function
		function showsNavStates() {
			var docTop = $(document).scrollTop();
			var navTop = $('.nav-wrap').offset().top;
			if (docTop > navTop) {
				$(".diy-states").addClass("sticky-diy-states");
			}	else if (docTop < navTop) {
				$(".diy-states").removeClass("sticky-diy-states");
			}
		}   showsNavStates();
		
		// .b2b-map-text repeting height and width of the .b2b-map-image
		function mapTextSize(){
			$(mapText).css({"display" : "block", "height": (mapImageHeight + "px"), "width": (mapImageWidth + "px") });
		}	mapTextSize();
		
		// .pageHeader - full hight - function
		function fullHightHeader(){
			if (windowWidth > 768) {
				$(pageHeader).css({"height": ((windowHeight - headerHight - 30) + "px")});
			}
		}	fullHightHeader();
	
		// Functions triggered on window resize
		$(window).on("resize", function() { 
			var windowHeight = $(window).height(); 
			var windowWidth = $(window).width(); 
			var mapImage    	= $(".b2b-map-img");
			var mapImageHeight  = $(".b2b-map-img").height();
			var mapImageWidth   = $(".b2b-map-img").width();
			var mapText		 	= $(".b2b-map-text");	
	
			// .map-left - hight - adjustment - function
			function heightMapLeft(){
				var mapWidth = windowHeight * 0.85;
				$(mapLeft).css({"height": (mapWidth + "px")});	
			}	heightMapLeft();
			
			// .pageHeader - full hight - function
			function fullHightHeader(){
				if (windowWidth > 768) {
					$(pageHeader).css({"height": ((windowHeight - headerHight - 40) + "px") });
				}
			} 	fullHightHeader();
			
			// .b2b-map-text repeting height and width of the .b2b-map-image
			function mapTextSize(){
				$(mapText).css({"height": (mapImageHeight + "px"), "width": (mapImageWidth + "px") });
			}	mapTextSize();
		});
		  	
		$(window).scroll(function() {
			
if($(window).scrollTop() >= $(".b2b").offset().top){
				$('#page').removeClass("smooth-menu");
			}else{
				$('#page').addClass("smooth-menu");
			}

			showsNavStick();
			sideMapStick();
			showsNavStates();
		    $(".road").show();
		    drawLines1();
			drawLines2();
		    drawLines3();
		    drawLines4();
		    drawLines5();
		    drawLines6();	    
		});
		
		$(".b2b").css({"opacity": 1});	
		
		// Anable to use position: fixed;
		//$('#page').removeClass("smooth-menu");
		
		// MODAL WINDOW function
		(function() {
		
		  'use strict';
		
		  // list out the vars
		  var mOverlay = getId('modal-dialog'),
		      mOpen = getId('modal_open'),
		      mClose = getId('modal_close'),
		      modal = getId('modal-holder'),
		      modalOpen = false,
		      lastFocus;
		
		
		  function getId ( id ) {
		    return document.getElementById(id);
		  }
		
		
		  // Let's open the modal
		  function modalShow () {
		    mOverlay.setAttribute('data-hidden', 'false'); 
		    modalOpen = true; 
		  }
		
		
		  function modalClose ( event ) {
		    mOverlay.setAttribute('data-hidden', 'true');
		  }
		
		//   window.onload = modalShow();
		  mOpen.addEventListener('click', modalShow);
		  mClose.addEventListener('click', modalClose);
		
		})();				
	
	}// end if .b2b
});


