jQuery(document).ready(function($) {
	//Initialize the page
	var d = new Date();
	var currentMonth = d.getMonth() + 1;
	var year = 2013; //This needs to be changed later if we extend our contract
	
	
	
	//set the selected month to the current month
	$("select#month option[value=" +currentMonth+ "]").attr("selected","selected");
	
	//Update calendar on Form Submit
	$(".solunar-submit").on("click",function(ev){
		ev.preventDefault();
		
		var selectedMonth = $('div#zf-select-month .scrollable li.selected').attr("val");
		var location = $("#solunar-location").val();

		
		updateCalendar(selectedMonth,year,location); 
	});
	
	
	//Update calendar on month change
	$('div#zf-select-month').on("change",function(ev){
		var selectedMonth = $('div#zf-select-month .scrollable li.selected').attr("val");
		var location = $("#solunar-location").val();
		
		if (location)
			updateCalendar(selectedMonth,year,location); 
	});
	
	//Use HTML5 Geolocation to detect location and update calendar
	if (navigator.geolocation)
    {
    	navigator.geolocation.getCurrentPosition(function(position){
	    	console.log(position);
	    	var lat = position.coords.latitude;
	    	var url = "/wpdb/gps-to-zip.php?lat=" + position.coords.latitude +  "&lon=" + position.coords.longitude ;
	    	
	    	$.getJSON(url,function(closestLocation){
	    	
	    		var selectedMonth = $('div#zf-select-month .scrollable li.selected').attr("val");
	    		
		    	$("#solunar-location").val(closestLocation.zip)
		    	updateCalendar(selectedMonth,year,closestLocation.zip); 
	    	});
    	});
    }

	
	
	
	
	function updateCalendar(month,year,location) {
	
		$(".calendar-holder").fadeTo("normal",0.20);
		
		
		var url = "/wpdb/solunar.php?month=" + month +  "&year=" + year +  "&location=" + location ;
		
		
		
		$.getJSON(url,function(solunarDays){
		
			$(".calendar-holder").fadeTo("normal",1.0);
		
			var monthNames = [ "nothing","Jan.", "Feb.", "Mar.", "Apr.", "May", "June",
		    "July", "Aug.", "Sept.", "Oct.", "Nov.", "Dec." ];
			
			var dayOffset = solunarDays[0].weekdaycode;
			
			var currentDay = 0;
			var currentCell = 0;
			
			$(".calendar-data td").html("").addClass("other-month");
			
			
			$(".calendar-data td").each(function(key,dataCell){
				currentCell++;
				
				var $dataCell = $(dataCell);
				
				//dayOffset determines the day fo the week in which we start
				if (currentCell > dayOffset) {
					
				   var currentDayData = solunarDays[currentDay];		
					
					if (currentDayData) {
					
						$dataCell.removeClass("other-month");
						
						//format the sun/moon up down times
						currentDayData.sunrise = currentDayData.sunrise.toUpperCase().replace("A","<span>A</span>").replace("P","<span>P</span>");
						currentDayData.sunset = currentDayData.sunset.toUpperCase().replace("A","<span>A</span>").replace("P","<span>P</span>");
						currentDayData.moonrise = currentDayData.moonrise.toUpperCase().replace("A","<span>A</span>").replace("P","<span>P</span>");
						currentDayData.moonset = currentDayData.moonset.toUpperCase().replace("A","<span>A</span>").replace("P","<span>P</span>");				
						
						//Format the peaktimes
						currentDayData.monthname = monthNames[currentDayData.month];
						currentDayData.ammajorstart = currentDayData.ammajorstart.replace("M","").replace("A","<span>A</span>").replace("P","<span>P</span>");
						currentDayData.ammajorend = currentDayData.ammajorend.replace("M","").replace("A","<span>A</span>").replace("P","<span>P</span>");
						currentDayData.amminorstart = currentDayData.amminorstart.replace("M","").replace("A","<span>A</span>").replace("P","<span>P</span>");
						currentDayData.amminorend = currentDayData.amminorend.replace("M","").replace("A","<span>A</span>").replace("P","<span>P</span>");				
						currentDayData.pmmajorstart = currentDayData.pmmajorstart.replace("M","").replace("A","<span>A</span>").replace("P","<span>P</span>");
						currentDayData.pmmajorend = currentDayData.pmmajorend.replace("M","").replace("A","<span>A</span>").replace("P","<span>P</span>");
						currentDayData.pmminorstart = currentDayData.pmminorstart.replace("M","").replace("A","<span>A</span>").replace("P","<span>P</span>");
						currentDayData.pmminorend = currentDayData.pmminorend.replace("M","").replace("A","<span>A</span>").replace("P","<span>P</span>");	
						
						
						//Sometimes a day only has 3 good times. If this is the case, we trash the missing time. if not, we just trash the last one.
						var time1 = {start: currentDayData.ammajorstart, end: currentDayData.ammajorend, official: currentDayData.ammajor};				
						var time2 = {start: currentDayData.pmmajorstart, end: currentDayData.pmmajorend, official: currentDayData.pmmajor};	
						var time3 = {start: currentDayData.amminorstart, end: currentDayData.amminorend, official: currentDayData.amminor};				
						var time4 = {start: currentDayData.pmminorstart, end: currentDayData.pmminorend, official: currentDayData.pmminor};	
						
						var times = [time1,time2,time3,time4];
						
						//Remove the bad times
						var keyToRemove = null;
						_.each(times,function(time,key){
				
							if (time.official == "-----") {
							
								keyToRemove = key;
			
							}
							
						});
						
						//If there are not bad times, scrap the last time.
						if (keyToRemove == null)
							keyToRemove = 3;
						times.splice(keyToRemove,1);
						
						currentDayData.times = times;
		
						var template = _.template($("#td-template").html(),{data:currentDayData});
					
						$dataCell.append(template);
					}
		
					
					
					
					currentDay++;
				}//end iff
			
				
				
				
				
		
			}); //end each
			
			//Attach the events
			$(".a-event").click(function () {
			
				//First, hide the other popups
				$(".cal-popup").hide();
			    //$(".a-event").parent("div").removeClass("active");
			    
			    //then show the popup
			   $(this).siblings(".cal-popup").show();
			   //$(this).parent("div").addClass("active");
			});
			
			
			$(".a-event").parent("div").on("hover",function(ev){
				$(this).toggleClass("active");
				
			},function(ev){
				$(this).toggleClass("active");
			});
		
			//also hide popup on close button click
			$(".close-popup").on('click', function () {
			    $(".cal-popup").hide();
			    $(".a-event").parent("div").removeClass("active");
			});
		
			
			
		}).fail(function(){
			alert("Location not found. Please try again.")
		});
		
		
	}



});



$(".jq-custom-form select").zfselect({
    rows: 10
});


$('#foo2').carouFredSel({
    auto: false,
    prev: '#prev2',
    next: '#next2',
    mousewheel: true,
    swipe: {
        onMouse: true,
        onTouch: true
    }
});
$('#foo3').carouFredSel({
    auto: false,
    prev: '#prev3',
    next: '#next3',
    mousewheel: true,
    swipe: {
        onMouse: true,
        onTouch: true
    }
});
