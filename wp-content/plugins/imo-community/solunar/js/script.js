	window.mobilecheck = function() {
var mobileCheck = false;
(function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))mobileCheck = true})(navigator.userAgent||navigator.vendor||window.opera);
return mobileCheck; }

if (mobilecheck()) {
	window.location = "http://www.in-fisherman.com/solunar-calendar-mobile";
} else {


	jQuery(document).ready(function($) {


		renderSpeciesInfo($(".jq-custom-form select").val());



		//Initialize the page
		var d = new Date();
		var currentMonth = d.getMonth() + 1;
		var year = (new Date).getFullYear();
		//var year = 2015; //This needs to be changed later if we extend our contract
		var searchLocation = "";


		//Update calendar with default data a location via IP address
		updateCalendar(currentMonth,year,null);

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

		    	$.getJSON(url,function(closestLocation){

		    		var selectedMonth = $('div#zf-select-month .scrollable li.selected').attr("val");

			    	//$("#solunar-location").val(closestLocation.zip);

			    	searchLocation = closestLocation.zip;

			    	updateCalendar(selectedMonth,year,searchLocation);
		    	});
	    	});
	    }





		function updateCalendar(month,year,location) {

			$(".calendar-holder").fadeTo("normal",0.20);


			var url = "/wpdb/solunar.php?month=" + month +  "&year=" + year  ;

			if (location)
				url += "&location=" + location;



			var selectedSlug = $(".jq-custom-form select").val();

			//First, get some articles
			var articleUrl = "/wpdb/simple-infish-json.php?t=" + selectedSlug;
			var articles = Array();
			//console.log(articleUrl);
			$.getJSON(articleUrl,function(posts){



				articles[0] = posts[0];
				articles[1] = posts[1];
				articles[2] = posts[2];
				articles[3] = posts[3];

				$.getJSON(url,function(solunarDays){

					$(".calendar-holder").fadeTo("normal",1.0);

					var monthNames = [ "nothing","Jan.", "Feb.", "Mar.", "Apr.", "May", "June",
				    "July", "Aug.", "Sept.", "Oct.", "Nov.", "Dec." ];

					var dayOffset = solunarDays[0].weekdaycode;
					var locationName = solunarDays[0].city + ", " + solunarDays[0].state;

					$("h1.location-header").html("Current Location: " + locationName);

					var currentDay = 0;
					var currentCell = 0;
					var today = new Date();


					$(".calendar-data td").html("").addClass("other-month");



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


								var fishname = $("div.select-text").html();

								currentDayData.fishname = fishname;


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


					$(".a-event").parent("div").hover(function(ev){
						$(this).addClass("active");

					},function(ev){
						$(this).removeClass("active");
					});

					//also hide popup on close button click
					$(".close-popup").on('click', function () {
					    $(".cal-popup").hide();
					    $(".a-event").parent("div").removeClass("active");
					});

					//Hide the last row if it is empty
					$("tr.last-row").show();

					if ($("tr.last-row td").first().hasClass("other-month"))
						$("tr.last-row").hide();



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
		$.getJSON(url,function(posts){

			$('#related-fishing-posts').html("");

			var fishName = $("div.select-text").html();

			$(".fishing-tips-title").html( fishName + " Fishing Tips");



			$.each(posts,function(index,post){

				//console.log(post);
				var template = _.template($("#slider-template").html(),{data:post});
				$('#related-fishing-posts').append(template);
			});

			$('#related-fishing-posts').carouFredSel({
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


	$(".jq-custom-form select").zfselect({
	    rows: 30,
	    width:250
	});

	$(".jq-custom-form select").on("change",function(){
		renderSpeciesInfo($(this).val());
	});




}



