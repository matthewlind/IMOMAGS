
jQuery( document ).ready(function($) {
	
	//Variables
	var windowHeight 	= $(window).height();
	var windowWidth 	= $(window).width(); 
	var pageHeader  	= $(".b2b .page-header");
	var mapLeft  		= $(".b2b .map-left svg");
	var mapImage    	= $("#b2b-map-img");
	var headerHight 	= $(".header").height();
	
	// Handles for every episode section
	var ep1 = $('.episode-1').offset().top;
	var ep2 = $('.episode-2').offset().top;
	var ep3 = $('.episode-3').offset().top;
	var ep4 = $('.episode-4').offset().top;
	var ep5 = $('.episode-5').offset().top;
	var ep6 = $('.episode-6').offset().top;
	var ep7 = $('.episode-7').offset().top;
	var ep8 = $('.episode-8').offset().top;
	
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

	// side map stick to top function
	function sideMapStick() {
		var docTop = $(document).scrollTop();
		var mapLeftTop = $('#article-wrap').offset().top;
		if (docTop > (mapLeftTop + 60)) {
			$(".map-left").css({"position" : "fixed", "top" : "0" });	
		}	else if (docTop < (mapLeftTop + 60)) {
			$(".map-left").css({"position" : "absolute", "top" : "60"});	
		}
	}
	sideMapStick();
	// .shows-nav stick to top function
	function showsNavStick() {
		var docTop = $(document).scrollTop();
		var navTop = $('.nav-wrap').offset().top;
		if (docTop > navTop) {
			$(".shows-nav").addClass("sticky-shows-nav");	
		}	else if (docTop < navTop) {
			$(".shows-nav").removeClass("sticky-shows-nav");	
		}
	}
	showsNavStick();
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
	}
}
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
	  
	  var distanceFromTop = docTop - ep2;
	  if (distanceFromTop < 0) {
		  distanceFromTop = 0;
	  } else {
		  distanceFromTop = docTop - ep2;
	  }
	  var distanceLeft = ep3 - ep2 - 140;
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
	}
}
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
	  
	  var distanceFromTop = docTop - ep3;
	  if (distanceFromTop < 0) {
		  distanceFromTop = 0;
	  } else {
		  distanceFromTop = docTop - ep3;
	  }
	  var distanceLeft = ep4 - ep3 - 140;
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
	}	     	
}
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
 
	} 
}
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
	}
}
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
	    }; 
	    
	   // Changing fill of the state shape
	  if ((ep7 < (docTop + 300)) && (ep8 > (docTop + 300))) {
		   $(".alaska-polygon").children().attr("fill", "#f6f6f6");
		   $(".alaska-text").attr("fill", "#333");
		   $(".alaska-circle").attr("r", "11").attr("fill", "#222222");
	    } else if ((ep8 < (docTop + -700)) || (ep7 > (docTop - 300))) {
		   $(".alaska-polygon").children().attr("fill", "#fff");
		   $(".alaska-text").attr("fill", "#888");
		   $(".alaska-circle").attr("r", "6.7").attr("fill", "#777777");
	    }  
	}	 
}
////////////////////////
	
	
	$(window).scroll(function() {
	showsNavStick();
	sideMapStick();
    $(".road").show();
    drawLines1();
	drawLines2();
    drawLines3();
    drawLines4();
    drawLines5();
    drawLines6();
	});
	
	


	// .pageHeader - full hight - function
	function fullHightHeader(){
		$(pageHeader).css({"height": ((windowHeight - headerHight - 40) + "px") });
	}	
	fullHightHeader();

	// Functions triggered on window resize
	$(window).on("resize", function() { 
		var windowHeight = $(window).height(); 
		var windowWidth = $(window).width(); 	


		// .map-left - hight - adjustment - function
		function heightMapLeft(){
			var mapWidth = windowHeight * 0.85;
			$(mapLeft).css({"height": (mapWidth + "px")});	
		}	
		heightMapLeft();
		
		// .pageHeader - full hight - function
		function fullHightHeader(){
			$(pageHeader).css({"height": ((windowHeight - headerHight - 40) + "px") });
		}
		fullHightHeader();
		// Consolw Logs
		console.log(windowHeight);
	});
	
});