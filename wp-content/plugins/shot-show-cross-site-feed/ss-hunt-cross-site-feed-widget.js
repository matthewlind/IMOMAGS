jQuery(document).ready(function($) {


	
	var currentPosition = 0;
	var showAtOnce = 5;
	var sort = "post_date";
	var feedData;

	//Check to see if shot-show-widget exists:
	if ($(".shot-show-widget").length > 0) {
		//if yes, display some things
		displayCrossSiteFeed(currentPosition);
	}

	function resetDisplay(slug) {
		$(".shot-show-widget").attr("term",slug);
		$(".shot-show-widget").text("");

		currentPosition = 0;
		displayCrossSiteFeed(currentPosition);

	}

	//Ignore Dropdown Click
	$(".ignore-click").click(function(event){
		event.preventDefault();
	});

	function displayCrossSiteFeed(start,sort) {
		sort = typeof sort !== 'undefined' ? sort : 'post_date'; //If sort is not set, set sort to post_date

		
		//First get any extra term
		var term = $(".shot-show-widget").attr("term");
		
		var fileName = "/wpdb/network-feed-cached.php?network=hunting&count=5&term=" + term;
	
		
		var getdata = $.getJSON(fileName, function(data) {
    
	    //$(".animal-container").html("");

	    		    
		    var count = 0;

		    var end = start + showAtOnce;

		    for (i = start; i < end; i++) {
		        count++;
		
		        
		        var $articleTemplate = $("li#ss-widget-template").clone();

		        $articleTemplate.attr("id","ss-" + data[i].post_name + count);
		        $articleTemplate.find("a.title").attr("href",data[i].post_url);
		        
		        		        
		        $articleTemplate.find("a.title").text(data[i].post_title);
		        
		        if (data[i].domain != document.domain) {
		        	$articleTemplate.find(".site a").text("From " + data[i].brand + " Magazine");
		        	$articleTemplate.find(".site a").attr("href","http://" + data[i].domain);

					$articleTemplate.find("a").attr("target","_blank");
				}else{
					$articleTemplate.find(".site a").hide();
				}
				

		        $articleTemplate.appendTo(".shot-show-widget").fadeIn();

		    }


		
		});

	}





});