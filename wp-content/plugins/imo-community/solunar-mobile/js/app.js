jQuery(document).ready(function($) {




	//Initialize the page
	var d = new Date();
	var currentMonth = d.getMonth() + 1;
	var year = (new Date).getFullYear();

	var months = {1:"January", 2:"February", 3:"March", 4:"April", 5:"May", 6:"June", 7:"July", 8:"August", 9:"September", 10:"October", 11:"November", 12:"December"};
	var searchLocation = "";

	var geolocated = false;

	var reallySubmit = false;

	var firstRun = true;
	var calendarNotDisplayed = true;


	var currentDaySelector = "#cal-item-" + d.getUTCDate();

	//set the selected month to the current month
	var selectedMonth = currentMonth;



	var displayForm = function() {

		$(".main-wrapper").hide();

		var miniDayTemplate = _.template($("#form-template").html());

		$("body").prepend(miniDayTemplate);

		if (searchLocation.length > 0) {
			$(".zip-text").val(searchLocation);
		}


		$(".zip-text").change(function(ev){
			reallySubmit = true;
			searchLocation = $(this).val();
			//alert("HEY");
		});

		$(".fish-submit").on("click",function(){
	    	$(".form-bg").remove();
	    	$(".main-wrapper").show();

	    	if (firstRun) {



	    		$(currentDaySelector).css("background-color","#fef2e8");

	    		//alert(currentDaySelector);
	    		//alert($(currentDaySelector).offset().top);
				window.scrollTo(0, $(currentDaySelector).offset().top - 100);
	    		firstRun = false;
	    		calendarNotDisplayed = true;
	    	}


	    	if (reallySubmit) {
	    		updateCalendar(selectedMonth,year,searchLocation);
	    		window.scrollTo(0, 0);
	    	}

	    });

	    if (!window.navigator.standalone &&
	    	navigator.userAgent.match(/iPhone/i) &&
	    	navigator.userAgent.match(/Safari/i) &&
	    	!navigator.userAgent.match(/CriOS/i)) {
			$(".install-popup").fadeIn();
		}

	    $(".fish-select").on("change",function(){


	    	var fishName = $(this).find()
			renderSpeciesInfo($(this).val());
		});


		$(".close-popup").on('click', function () {
        	$(".popup, .fadeout").hide();
    	});

	}


	displayForm(false);
	renderSpeciesInfo($(".fish-select").val());

	$(".head-location").on("click",function(){
		reallySubmit = true;
		displayForm();
	});




	//renderSpeciesInfo($(".jq-custom-form select").val());






	$(".jq-view-month .month-name").text(months[currentMonth]);

	geolocateAndUpdateCalendar();



	function geolocateAndUpdateCalendar() {
		//Use HTML5 Geolocation to detect location and update calendar
		if (navigator.geolocation)
	    {
	    	navigator.geolocation.getCurrentPosition(function(position){
		    	//console.log(position);
		    	var lat = position.coords.latitude;
		    	var url = "/wpdb/gps-to-zip.php?lat=" + position.coords.latitude +  "&lon=" + position.coords.longitude ;

		    	$.getJSON(url,function(closestLocation){

		    		geolocated = true;


		    		searchLocation = closestLocation.zip;
			    	$(".zip-text").val(searchLocation)
			    	updateCalendar(selectedMonth,year,searchLocation);
		    	});
	    	});
	    } else {
	    	//IF NO LOCATION, SHOW THE FORM
	    }

	}






    $(".month-heading .arrow").on("click",function(ev){

    	if ($(this).hasClass("prev") && selectedMonth > 1) {
    		selectedMonth--;
    		$(".jq-view-month .month-name").text(months[selectedMonth]);
    		updateCalendar(selectedMonth,year,searchLocation);

    	}

    	if ($(this).hasClass("next") && selectedMonth < 12) {
    		selectedMonth++;
    		$(".jq-view-month .month-name").text(months[selectedMonth]);
    		updateCalendar(selectedMonth,year,searchLocation);

    	}

    });





	function updateCalendar(month,year,location) {


		//$(".calendar-holder").fadeTo("normal",0.20);
		$(".cal-list").fadeTo("normal",0.20);


		var url = "/wpdb/solunar.php?month=" + month +  "&year=" + year  ;

		if (location)
			url += "&location=" + location;


		$.getJSON(url,function(solunarDays){

			var $calList = $(".cal-list");

			//$(".calendar-holder").fadeTo("normal",1.0);
			$calList.fadeTo("normal",1.0);

			var monthNames = [ "nothing","Jan.", "Feb.", "Mar.", "Apr.", "May", "June",
		    "July", "Aug.", "Sept.", "Oct.", "Nov.", "Dec." ];

		    var weekday = new Array(7);
			weekday[0]="Sun";
			weekday[1]="Mon";
			weekday[2]="Tue";
			weekday[3]="Wed";
			weekday[4]="Thu";
			weekday[5]="Fri";
			weekday[6]="Sat";

			var dayOffset = solunarDays[0].weekdaycode;
			var locationName = solunarDays[0].city + ", " + solunarDays[0].state;

			$(".head-location a").html(locationName);

			var currentDay = 0;
			var currentCell = 0;
			var today = new Date();


			$(".calendar-data td").html("").addClass("other-month");

			$calList.html("");

			$(".calendar-data td").each(function(key,dataCell){
				currentCell++;

				var $dataCell = $(dataCell);

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

						$dataCell.removeClass("other-month");


						currentDayData.weekday = weekday[currentDayData.weekdaycode];



						//format the sun/moon up down times
						currentDayData.sunrise = currentDayData.sunrise.toUpperCase().replace("A","<span>A</span>").replace("P","<span>P</span>");
						currentDayData.sunset = currentDayData.sunset.toUpperCase().replace("A","<span>A</span>").replace("P","<span>P</span>");
						currentDayData.moonrise = currentDayData.moonrise.toUpperCase().replace("A","<span>A</span>").replace("P","<span>P</span>");
						currentDayData.moonset = currentDayData.moonset.toUpperCase().replace("A","<span>A</span>").replace("P","<span>P</span>");

						//Format the peaktimes
						currentDayData.monthname = monthNames[currentDayData.month];
						currentDayData.ammajorstart = currentDayData.ammajorstart.replace("AM","<span>AM</span>").replace("PM","<span>PM</span>");
						currentDayData.ammajorend = currentDayData.ammajorend.replace("AM","<span>AM</span>").replace("PM","<span>PM</span>");
						currentDayData.amminorstart = currentDayData.amminorstart.replace("AM","<span>AM</span>").replace("PM","<span>PM</span>");
						currentDayData.amminorend = currentDayData.amminorend.replace("AM","<span>AM</span>").replace("PM","<span>PM</span>");
						currentDayData.pmmajorstart = currentDayData.pmmajorstart.replace("AM","<span>AM</span>").replace("PM","<span>PM</span>");
						currentDayData.pmmajorend = currentDayData.pmmajorend.replace("AM","<span>AM</span>").replace("PM","<span>PM</span>");
						currentDayData.pmminorstart = currentDayData.pmminorstart.replace("AM","<span>AM</span>").replace("PM","<span>PM</span>");
						currentDayData.pmminorend = currentDayData.pmminorend.replace("AM","<span>AM</span>").replace("PM","<span>PM</span>");


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




						//convert Mooncode to mobile

						var desktopMooncode = currentDayData.mooncode;

						var mobileMooncode = Math.round((desktopMooncode/24) * 20);




						currentDayData.mooncode = mobileMooncode;

						if (currentDayData.peakdayflag == 'N')
							currentDayData.mooncode = 1;
						if (currentDayData.peakdayflag == 'F')
							currentDayData.mooncode = 11;

						var miniDayTemplate = _.template($("#mini-day-template").html(),{data:currentDayData});




						var fullDayTemplate = _.template($("#full-day-template").html(),{data:currentDayData});



						//console.log(currentDayData);

						$dataCell.append(miniDayTemplate);
						$calList.append(fullDayTemplate);


					}





					currentDay++;
				}//end iff






			}); //end each


	    	if (calendarNotDisplayed && firstRun) {
	    		//alert(currentDaySelector);


				$(currentDaySelector).css("background-color","#fef2e8");

	    		//alert($(currentDaySelector).offset().top);
				window.scrollTo(0, $(currentDaySelector).offset().top - 100);
	    		//firstRun = false;
	    		calendarNotDisplayed = false;
	    	}



			//Attach the events
		   $(".jq-expand-day").click(function() {



		        var activeTab = $(this).find("a.jq-expand-link").attr("href");



		        $(activeTab).slideToggle("slow");
		        return false;
		    });

		   $("a.date-scroll-link").click(function(ev) {

		   		$(".calendar-holder").hide();

		        var activeDay = $(this).attr("href");



		        //$(activeTab).slideToggle("slow");

		        var scrollBack = function(){


		        };


		        history.pushState("scrollBack","Solunar Calendar");


		        $('html, body').animate({
					scrollTop: $(activeDay).offset().top - 100
				}, 2000);


		        ev.preventDefault();
		        return false;
		    });


		}).fail(function(){
			alert("Location not found. Please try again.")
		});


	}


});





var renderSpeciesInfo = function(slug) {


	var url = "/wpdb/simple-infish-json.php?t=" + slug;

	var fishName = $(".fish-select option:selected").html();

	$(".f-title").html( fishName + " Fishing Tips");

	if (typeof googletag.pubads === 'function')
		googletag.pubads().refresh([dynamicAdSlot1]);

	//console.log(url);
	$.getJSON(url,function(posts){

		$('#related-fishing-posts').html("");
		$.each(posts,function(index,post){

			var template = _.template($("#post-exerpt-template").html(),{data:post});
			$('#related-fishing-posts').append(template);
		});

	}).fail(function( jqxhr, textStatus, error ) {
	  var err = textStatus + ', ' + error;
	  console.log( "Request Failed: " + err);
	  console.log(jqxhr);
	});

}


$(".jq-custom-form select").zfselect({
    rows: 30,
    width:250
});






