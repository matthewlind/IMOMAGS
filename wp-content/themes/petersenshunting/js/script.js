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
		
	var postoffset = 0;
	var catID = jQuery(".posts-list").attr("id");
	
	jQuery("a.paginate-photos").click(function(){
		postoffset = postoffset + 10;
		jQuery(".loading-gif").show();
		var data;
	    jQuery.ajax({
	        type: 'POST',
	        url: '/wp-admin/admin-ajax.php',
	        data: {"action": "fishhead-photos-filter", cat: catID, offset: postoffset},
	        success: function(response) {
            	if(response.length <= 1){
            		jQuery(".pager-holder").hide();
	            	jQuery('<h3 class="no-mo-videos">No more photos, please try a different category.</h3>').appendTo(".main-content-preppend");
            	}else{
	            	jQuery(response).appendTo(".main-content-preppend");
            	}
	            jQuery("#ajax-loader").hide();
	            //refresh the sticky ad on load more
                if (jQuery(window).width() >  610 ) {
                	document.getElementById('sticky-iframe-ad').contentWindow.location.reload();
                	jQuery(".sidebar.advert").css({
                    	display: 'block',
						position: 'fixed',
						top: 10
					});
                }
				FB.XFBML.parse();
	            return false;
	        }
	    });
     
	       
	});
	

	/*** Community menu ***/
	
	//Toggle Photos Menu
	jQuery('.community-mobile-menu').on('click touchstart', function(e){
		e.preventDefault();
		jQuery('.menu-hunt, .menu-fish').toggle();
	});
		
	//layout in columns
	if(jQuery(window).width() > 610){
	    var num_cols = 4,
	    container = jQuery('.community-header ul.menu'),
	    listItem = 'li',
	    listClass = 'sub-list';
	    container.each(function() {
	        var items_per_col = new Array(),
	        items = jQuery(this).find(listItem),
	        min_items_per_col = Math.floor(items.length / num_cols),
	        difference = items.length - (min_items_per_col * num_cols);
	        for (var i = 0; i < num_cols; i++) {
	            if (i < difference) {
	                items_per_col[i] = min_items_per_col + 1;
	            } else {
	                items_per_col[i] = min_items_per_col;
	            }
	        }
	        for (var i = 0; i < num_cols; i++) {
	            jQuery(this).append(jQuery('<ul ></ul>').addClass(listClass));
	            for (var j = 0; j < items_per_col[i]; j++) {
	                var pointer = 0;
	                for (var k = 0; k < i; k++) {
	                    pointer += items_per_col[k];
	                }
	                jQuery(this).find('.' + listClass).last().append(items[j + pointer]);
	            }
	        }
	    });
	    jQuery(".community-header").show().css("overflow","visible");
	}


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
		
		// .pageHeader - full hight - function
		function fullHightHeader(){
			if (windowWidth > 768) {
				$(pageHeader).css({"height": ((windowHeight - headerHight - 40) + "px")});
			}
		}	fullHightHeader();
		$(".b2b").css({"opacity": 1});	
		
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
				
				   	if (ep7 < (docTop + 300) ) {
					   $(".alaska-polygon").children().attr("fill", "#f6f6f6");
					   $(".alaska-text").attr("fill", "#333");
					   $(".alaska-circle").attr("r", "11").attr("fill", "#222222");
				    } else if (ep7 > docTop) {
					   $(".alaska-polygon").children().attr("fill", "#fff");
					   $(".alaska-text").attr("fill", "#888");
					   $(".alaska-circle").attr("r", "6.7").attr("fill", "#777777");
				    } 
			
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
				slideshow: false,                
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
				slideshow: false,                
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
				slideshow: false,                
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
				slideshow: false,                
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
				slideshow: false,                
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
				slideshow: false,                
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
				slideshow: false,                
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
				slideshow: false,                
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
				    slideshow: false,                
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
				    slideshow: false,                
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
			
/*
if($(window).scrollTop() >= $(".b2b").offset().top){
				$('#page').removeClass("smooth-menu");
			}else{
				$('#page').addClass("smooth-menu");
			}
*/

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
		
		// Anable to use position: fixed;
		$('#page').removeClass("smooth-menu");
		
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
		
		/**
		 * FUNCTION FOR MANIPULATING YOUTUBE VIDEO (like stoping the video when the modal window is closed.)
		 *
		 * Q: I have embedded a YouTube video using <iframe src="http://www.youtube.com/embed/As2rZGPGKDY" />but the function doesn't execute any function!
		 * A: You have to add ?enablejsapi=1 at the end of your URL: /embed/vid_id?enablejsapi=1.
		 * SOURCE http://stackoverflow.com/questions/7443578/youtube-iframe-api-how-do-i-control-a-iframe-player-thats-already-in-the-html/7513356#7513356
		 * SOURCE-2 http://stackoverflow.com/questions/22613303/youtube-video-still-playing-when-bootstrap-modal-closes	
		 * SOURCE-3 https://developers.google.com/youtube/js_api_reference#Operations
		 * @author       Rob W <gwnRob@gmail.com>
		 * @website      http://stackoverflow.com/a/7513356/938089
		 * @version      20131010
		 * @description  Executes function on a framed YouTube video (see website link)
		 *               For a full list of possible functions, see:
		 *               https://developers.google.com/youtube/js_api_reference
		 * @param String frame_id The id of (the div containing) the frame
		 * @param String func     Desired function to call, eg. "playVideo"
		 *        (Function)      Function to call when the player is ready.
		 * @param Array  args     (optional) List of arguments to pass to function func
		 */
		function callPlayer(frame_id, func, args) {
		    if (window.jQuery && frame_id instanceof jQuery) frame_id = frame_id.get(0).id;
		    var iframe = document.getElementById(frame_id);
		    if (iframe && iframe.tagName.toUpperCase() != 'IFRAME') {
		        iframe = iframe.getElementsByTagName('iframe')[0];
		    }
		
		    // When the player is not ready yet, add the event to a queue
		    // Each frame_id is associated with an own queue.
		    // Each queue has three possible states:
		    //  undefined = uninitialised / array = queue / 0 = ready
		    if (!callPlayer.queue) callPlayer.queue = {};
		    var queue = callPlayer.queue[frame_id],
		        domReady = document.readyState == 'complete';
		
		    if (domReady && !iframe) {
		        // DOM is ready and iframe does not exist. Log a message
		        window.console && console.log('callPlayer: Frame not found; id=' + frame_id);
		        if (queue) clearInterval(queue.poller);
		    } else if (func === 'listening') {
		        // Sending the "listener" message to the frame, to request status updates
		        if (iframe && iframe.contentWindow) {
		            func = '{"event":"listening","id":' + JSON.stringify(''+frame_id) + '}';
		            iframe.contentWindow.postMessage(func, '*');
		        }
		    } else if (!domReady ||
		               iframe && (!iframe.contentWindow || queue && !queue.ready) ||
		               (!queue || !queue.ready) && typeof func === 'function') {
		        if (!queue) queue = callPlayer.queue[frame_id] = [];
		        queue.push([func, args]);
		        if (!('poller' in queue)) {
		            // keep polling until the document and frame is ready
		            queue.poller = setInterval(function() {
		                callPlayer(frame_id, 'listening');
		            }, 250);
		            // Add a global "message" event listener, to catch status updates:
		            messageEvent(1, function runOnceReady(e) {
		                if (!iframe) {
		                    iframe = document.getElementById(frame_id);
		                    if (!iframe) return;
		                    if (iframe.tagName.toUpperCase() != 'IFRAME') {
		                        iframe = iframe.getElementsByTagName('iframe')[0];
		                        if (!iframe) return;
		                    }
		                }
		                if (e.source === iframe.contentWindow) {
		                    // Assume that the player is ready if we receive a
		                    // message from the iframe
		                    clearInterval(queue.poller);
		                    queue.ready = true;
		                    messageEvent(0, runOnceReady);
		                    // .. and release the queue:
		                    while (tmp = queue.shift()) {
		                        callPlayer(frame_id, tmp[0], tmp[1]);
		                    }
		                }
		            }, false);
		        }
		    } else if (iframe && iframe.contentWindow) {
		        // When a function is supplied, just call it (like "onYouTubePlayerReady")
		        if (func.call) return func();
		        // Frame exists, send message
		        iframe.contentWindow.postMessage(JSON.stringify({
		            "event": "command",
		            "func": func,
		            "args": args || [],
		            "id": frame_id
		        }), "*");
		    }
		    /* IE8 does not support addEventListener... */
		    function messageEvent(add, listener) {
		        var w3 = add ? window.addEventListener : window.removeEventListener;
		        w3 ?
		            w3('message', listener, !1)
		        :
		            (add ? window.attachEvent : window.detachEvent)('onmessage', listener);
		    }
		}
			
		// Stop video when modal window is closed on b2b home page, main poster, trailer
		jQuery('#modal_close').on('click', function () {
		    callPlayer('yt-player', 'pauseVideo');
		});
	}// end if .b2b
});


