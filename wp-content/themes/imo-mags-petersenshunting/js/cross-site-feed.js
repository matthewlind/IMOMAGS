jQuery(document).ready(function($) {


	
	var currentPosition = 0;
	var showAtOnce = 15;
	var sort = "post_date";
	var feedData;

	//Check to see if cross-site-feed exists:
	if ($(".cross-site-feed").length > 0) {
		//if yes, display some things
		displayCrossSiteFeed(currentPosition);
	}

	//When more button is clicked....
	$(".cross-site-feed-more-button").click(function(){
		
		currentPosition = currentPosition + showAtOnce;
		displayCrossSiteFeed(currentPosition,sort);
	});

	//When sort button is clicked:
	$(".sort-link").click(function(event){

		event.preventDefault();

		currentPosition = 0;
		$(".cross-site-feed").css("height",800);
		$(".cross-site-feed").html("");

		sort = $(this).attr("sort");
		displayCrossSiteFeed(currentPosition,sort)


	});

	function resetDisplay(slug) {
		$(".cross-site-feed").attr("term",slug);
		$(".cross-site-feed").text("");

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
		var term = $(".cross-site-feed").attr("term");

	
		
		if (term.length > 0) {
			var fileName = "/wpdb/shotshow-hunt-json.php?t=" + term;
		} else {
			var fileName = "/wpdb/shotshow-hunt-json.php";
		}
		

		var getdata = $.getJSON(fileName, function(data) {
    
	    //$(".animal-container").html("");

	    	var commentPlural;
	    		    
		    var count = 0;

		    var end = start + showAtOnce;

		    for (i = start; i < end; i++) {
		        count++;
		        if(data[i].comment_count == 1){
		    		commentPlural = " Comment";
		    	}else{
			    	commentPlural = " Comments";
		    	}
		        var $articleTemplate = $("article#excerpt-template").clone();

		        $articleTemplate.attr("id","excerpt-" + data[i].post_name + count);
		        $articleTemplate.find("a").attr("href",data[i].post_url);

		        $articleTemplate.find(".entry-category a").text("From " + data[i].brand + " Magazine");
		        $articleTemplate.find(".entry-category a").attr("href","http://" + data[i].domain)
		        
		        $articleTemplate.find("h2.entry-title a").text(data[i].post_title);

		        $articleTemplate.find("span.author").html(data[i].post_nicedate + " by " + data[i].author);
		        $articleTemplate.find("p.excerpt-body").text("");
		        $articleTemplate.find(".shot-show-sticker").hide();
		        $articleTemplate.find("img.entry-img").attr("src",data[i].img_url);
		        $articleTemplate.find("a.comment-count").text(data[i].comment_count + commentPlural);
		        
		       
				//If data[i] is from NAW, add the categories
				if (data[i].domain == "www.petersenshunting.com") {
			
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
				
			
		        $articleTemplate.appendTo(".cross-site-feed").fadeIn();
		        
		        $(data[i].terms).each(function(index) {
	        		//Hide featured posts
			        if(this.slug == 'home-featured'){
						$articleTemplate.hide();		
						}
					// Place video button on videos
					if(this.slug == 'video'){
						$articleTemplate.find("a.no-olay").addClass("video-excerpt");
					}
				});

		    }


		
		});

	}






});