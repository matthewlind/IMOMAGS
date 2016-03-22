jQuery(document).ready(function(jQuery) {
	
	renderSpeciesInfo(jQuery(".jq-custom-form select#sel1 option:selected").val());

	//Initialize the page
	var d = new Date();
	var currentMonth = d.getMonth() + 1;
	var year = (new Date).getFullYear();
	//var year = 2015; //This needs to be changed later if we extend our contract
	var searchLocation = "";
		

	//set the selected month to the current month
	jQuery("select#month option[value=" +currentMonth+ "]").attr("selected","selected");
	
	//Update calendar with default data a location via IP address
	updateCalendar(currentMonth,year,null);
	
	//Update calendar on Form Submit
	jQuery(".solunar-submit").on("click",function(ev){
		ev.preventDefault();
		jQuery(".calendar-loading").show();
		var selectedMonth = jQuery('select#month option:selected').val();
		var location = jQuery("#solunar-location").val();
		renderSpeciesInfo(jQuery(".jq-custom-form select#sel1 option:selected").val());
		updateCalendar(selectedMonth,year,location);
	});

	//Update calendar on month change
	jQuery('select#month').on("change",function(ev){
		jQuery(".calendar-loading").show();
		var selectedMonth = jQuery('select#month option:selected').val();

		if (location)
			updateCalendar(selectedMonth,year,searchLocation);
			
	});

	//Use HTML5 Geolocation to detect location and update calendar
	if (navigator.geolocation)
    {
    	navigator.geolocation.getCurrentPosition(function(position){
	    	//console.log(position);
	    	var lat = position.coords.latitude;
	    	var url = "/wpdb/gps-to-zip.php?lat=" + position.coords.latitude +  "&lon=" + position.coords.longitude ;

	    	jQuery.getJSON(url,function(closestLocation){

	    		var selectedMonth = jQuery('select#month option:selected').val();

		    	jQuery("#solunar-location").val(closestLocation.zip);

		    	searchLocation = closestLocation.zip;

		    	updateCalendar(selectedMonth,year,searchLocation);
	    	});
    	});
    }





	function updateCalendar(month,year,location) {
		jQuery(".calendar-holder").fadeTo("normal",0.20);


		var url = "/wpdb/solunar.php?month=" + month +  "&year=" + year  ;

		if (location)
			url += "&location=" + location;



		var selectedSlug = jQuery(".jq-custom-form select#sel1").val();

		//First, get some articles
		var articleUrl = "/wpdb/simple-infish-json.php?t=" + selectedSlug;
		var articles = Array();
		//console.log(articleUrl);
		jQuery.getJSON(articleUrl,function(posts){



			articles[0] = posts[0];
			articles[1] = posts[1];
			articles[2] = posts[2];
			articles[3] = posts[3];

			jQuery.getJSON(url,function(solunarDays){

				jQuery(".calendar-holder").fadeTo("normal",1.0);

				var monthNames = [ "nothing","Jan.", "Feb.", "Mar.", "Apr.", "May", "June",
			    "July", "Aug.", "Sept.", "Oct.", "Nov.", "Dec." ];

				var dayOffset = solunarDays[0].weekdaycode;
				var locationName = solunarDays[0].city + ", " + solunarDays[0].state;

				jQuery("h1.location-header").html("Current Location: " + locationName);

				var currentDay = 0;
				var currentCell = 0;
				var today = new Date();


				jQuery(".calendar-data td").html("").addClass("other-month");



				jQuery(".calendar-data td").each(function(key,dataCell){
					currentCell++;

					var jQuerydataCell = jQuery(dataCell);

					//dayOffset determines the day fo the week in which we start
					if (currentCell > dayOffset) {

					   var currentDayData = solunarDays[currentDay];

						if (currentDayData) {




							//calculate if day is today
							var currentDate = new Date(currentDayData.year,currentDayData.month - 1,currentDayData.day);



							if (currentDate.toDateString() == today.toDateString()) {
								currentDayData.today = "today";
							} else {
								currentDayData.today = "";
							}





							jQuerydataCell.removeClass("other-month");

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


							currentDayData.articles = articles;


							var fishname = jQuery(".jq-custom-form select#sel1 option:selected").html();

							currentDayData.fishname = fishname;


							var template = _.template(jQuery("#td-template").html(),{data:currentDayData});

							jQuerydataCell.append(template);
						}




						currentDay++;
					}//end iff


					jQuery(".calendar-loading").hide();



				}); //end each

				//Attach the events
				jQuery(".a-event").click(function () {

					//First, hide the other popups
					jQuery(".cal-popup").hide();
				    //jQuery(".a-event").parent("div").removeClass("active");

				    //then show the popup
				   jQuery(this).siblings(".cal-popup").show();
				   //jQuery(this).parent("div").addClass("active");
				});


				jQuery(".a-event").parent("div").hover(function(ev){
					jQuery(this).addClass("active");

				},function(ev){
					jQuery(this).removeClass("active");
				});

				//also hide popup on close button click
				jQuery(".close-popup").on('click', function () {
				    jQuery(".cal-popup").hide();
				    jQuery(".a-event").parent("div").removeClass("active");
				});

				//Hide the last row if it is empty
				jQuery("tr.last-row").show();

				if (jQuery("tr.last-row td").first().hasClass("other-month"))
					jQuery("tr.last-row").hide();



			}).fail(function(){
				alert("Location not found. Please try again.")
			});






		});





	}



});

var renderSpeciesInfo = function(slug) {


	var url = "/wpdb/simple-infish-json.php?t=" + slug;



	if (typeof googletag.pubads === 'function')
		googletag.pubads().refresh([dynamicAdSlot1]);

	//console.log(url);
	jQuery.getJSON(url,function(posts){

		jQuery('#related-fishing-posts').html("");

		var fishName = jQuery(".jq-custom-form select#sel1 option:selected").html();

		jQuery(".fishing-tips-title").html( fishName + " Fishing Tips");



		jQuery.each(posts,function(index,post){

			//console.log(post);
			var template = _.template(jQuery("#slider-template").html(),{data:post});
			jQuery('#related-fishing-posts').append(template);
		});

		jQuery('#related-fishing-posts').carouFredSel({
		    auto: false,
		    prev: '#prev2',
		    next: '#next2',
		    mousewheel: true,
		    swipe: {
		        onMouse: true,
		        onTouch: true
		    }
		});

	}).fail(function( jqxhr, textStatus, error ) {
  var err = textStatus + ', ' + error;
  console.log( "Request Failed: " + err);
});

}