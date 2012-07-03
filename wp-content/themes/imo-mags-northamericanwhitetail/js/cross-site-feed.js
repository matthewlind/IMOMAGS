jQuery(document).ready(function($) {


	
	var currentPosition = 0;
	var showAtOnce = 10;

	var feedData;

	//Check to see if cross-site-feed exists:
	if ($(".cross-site-feed").length > 0) {
		//if yes, display some things
		displayCrossSiteFeed(currentPosition);
	}

	//When more button is clicked....
	$(".cross-site-feed-more-button").click(function(){
		
		currentPosition = currentPosition + showAtOnce;
		displayCrossSiteFeed(currentPosition);

	});

	function resetDisplay(slug) {
		$(".cross-site-feed").attr("term",slug);
		$(".cross-site-feed").text("");

		currentPosition = 0;
		displayCrossSiteFeed(currentPosition);

	}



	function displayCrossSiteFeed(start) {

		//First get any extra term
		var term = $(".cross-site-feed").attr("term");

	
		
		if (term.length > 0) {
			var fileName = "/wpdb/cache/naw-plus-" + term + ".json";
		} else {
			var fileName = "/wpdb/cache/naw-plus.json";
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

		        $articleTemplate.find("span.author").html(data[i].post_nicedate + " by " + data[i].author);
		        $articleTemplate.find("p.excerpt-body").text("");

		        $articleTemplate.find("img.entry-img").attr("src",data[i].img_url);

		      

				//If data[i] is from NAW, add the categories
				if (data[i].domain == "www.northamericanwhitetail.com") {
			
					$articleTemplate.find(".entry-category").html("");

					$categoryLinks = $articleTemplate.find(".entry-category");

					var $termsArray = $(data[i].terms);

					$(data[i].terms).each(function(index) {
						$categoryLinks.append($("<a href='/category/" + this.slug + "'>" + this.name + "</a>"));

			

						if ($termsArray.length != index + 1) {
							$categoryLinks.append(" • ");
						}

					});
					

				}

		        $articleTemplate.appendTo(".cross-site-feed").fadeIn();

		    }


		
		});

	}






});