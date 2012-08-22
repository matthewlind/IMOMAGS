jQuery(document).ready(function($) {


	
	var currentPosition = 0;
	var showAtOnce = 10;
	var sort = "post_date";
	var feedData;

	//Check to see if local-site-feed exists:
	if ($(".local-site-feed").length > 0) {
		//if yes, display some things
		displayLocalSiteFeed(currentPosition);
	}

	//When more button is clicked....
	$(".local-site-feed-more-button").click(function(){
		
		currentPosition = currentPosition + showAtOnce;
		displayLocalSiteFeed(currentPosition,sort);
	});

	//When sort button is clicked:
	$(".local-sort-link").click(function(event){

		event.preventDefault();

		currentPosition = 0;
		$(".local-site-feed").css("height",800);
		$(".local-site-feed").html("");

		sort = $(this).attr("sort");
		displayLocalSiteFeed(currentPosition,sort)


	});

	function resetDisplay(slug) {
		$(".local-site-feed").attr("term",slug);
		$(".local-site-feed").text("");

		currentPosition = 0;
		displayLocalSiteFeed(currentPosition);

	}



	function displayLocalSiteFeed(start,sort) {
		sort = typeof sort !== 'undefined' ? sort : 'post_date'; //If sort is not set, set sort to post_date

		//First get any extra term
		var term = $(".local-site-feed").attr("term");

	
		if (term.length > 0) {
			var fileName = "/wp-content/cache/superloop/naw-plus-" + term + "-" + sort + ".json";
		} else {
			var fileName = "/wp-content/cache/superloop/naw-plus-" + sort + ".json";
		}
		

		var getdata = $.getJSON(fileName, function(data) {
    
	    //$(".animal-container").html("");

	    //console.log(data);
	    
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
		        $articleTemplate.find("a.comment-count").text(data[i].comment_count);

		      

				//If data[i] is from NAW, add the categories
				if (data[i].domain == "www.northamericanwhitetail.com") {
			
					$articleTemplate.find(".entry-category").html("");

					$categoryLinks = $articleTemplate.find(".entry-category");

					var $termsArray = $(data[i].terms);

					$(data[i].terms).each(function(index) {
						var parentString = "";

				

						if (this.parent != null) {
							parentString = this.parent + "/";
						}


						$categoryLinks.append($("<a href='/category/" + parentString + this.slug + "'>" + this.name + "</a>"));

						if ($termsArray.length != index + 1) {
							$categoryLinks.append(" • ");
						}

					});
					

				} else { //If not on whitetail
					$articleTemplate.find("a").attr("target","_blank");
				}

		        $articleTemplate.appendTo(".local-site-feed").fadeIn();

		    }


		
		});

	}






});