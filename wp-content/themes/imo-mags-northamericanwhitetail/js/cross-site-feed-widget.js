jQuery(document).ready(function($) {


	
	var currentPosition = 0;
	var showAtOnce = 3;
	var sort = "post_date";
	var feedData;

	//Check to see if cross-site-feed-widget exists:
	if ($(".cross-site-feed-widget").length > 0) {
		//if yes, display some things
		displayCrossSiteFeed(currentPosition);
	}

	function resetDisplay(slug) {
		$(".cross-site-feed-widget").attr("term",slug);
		$(".cross-site-feed-widget").text("");

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
		var term = $(".cross-site-feed-widget").attr("term");

	
		
		if (term.length > 0) {
			var fileName = "/wp-content/cache/superloop/naw-plus-" + term + "-" + sort + ".json";
		} else {
			var fileName = "/wp-content/cache/superloop/naw-plus-" + sort + ".json";
		}
		

		var getdata = $.getJSON(fileName, function(data) {
    
	    //$(".animal-container").html("");

	    	
	    
		    var count = 0;

		    var end = start + showAtOnce;

		    for (i = start; i < end; i++) {
		        count++;
		

		        var $articleTemplate = $("article#excerpt-template").clone();

		        $articleTemplate.attr("id","excerpt-" + data[i].post_name + count);
		        $articleTemplate.find("a").attr("href",data[i].post_url);

		        $articleTemplate.find(".entry-category a").text("From " + data[i].brand + " Magazine");
		        $articleTemplate.find(".entry-category a").attr("href","http://" + data[i].domain)
		        
		        $articleTemplate.find("h2.entry-title a").text(data[i].post_title);

		        $articleTemplate.find("span.author").html("");
		        $articleTemplate.find("p.excerpt-body").text("");

		        $articleTemplate.find("img.entry-img").attr("src",data[i].img_url);
		        $articleTemplate.find("a.comment-count").text("");
		      

				//If data[i] is from NAW, add the categories
				//if (data[i].domain == "www.northamericanwhitetail.com") {
			
										
				//}

		        $articleTemplate.appendTo(".cross-site-feed-widget").fadeIn();

		    }


		
		});

	}






});