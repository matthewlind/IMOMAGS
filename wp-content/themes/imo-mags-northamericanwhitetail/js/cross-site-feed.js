jQuery(document).ready(function($) {


	
	var currentPosition = 0;
	var showAtOnce = 10;

	//Check to see if cross-site-feed exists:
	if ($(".cross-site-feed").length > 0) {
		//if yes, display some things
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
		    $(data).each(function(index) {
		        count++;
		

		        var $articleTemplate = $("article#excerpt-template").clone();

		        $articleTemplate.attr("id","excerpt-" + this.post_name + count);
		        $articleTemplate.find("a").attr("href",this.post_url);

		        $articleTemplate.find(".entry-category a").text("From " + this.brand + " Magazine");
		        $articleTemplate.find(".entry-category a").attr("href","http://" + this.domain)
		        
		        $articleTemplate.find("h2.entry-title a").text(this.post_title);

		        $articleTemplate.find("span.author").html(this.post_nicedate + " by " + this.author);
		        $articleTemplate.find("p.excerpt-body").text("");

		        $articleTemplate.find("img.entry-img").attr("src",this.img_url);

		        console.log(this);

				//If this is from NAW, add the categories
				if (this.domain == "www.northamericanwhitetail.com") {
			
					$articleTemplate.find(".entry-category").html("");

					$categoryLinks = $articleTemplate.find(".entry-category");

					var $termsArray = $(this.terms);

					$(this.terms).each(function(index) {
						$categoryLinks.append($("<a href='/category/" + this.slug + "'>" + this.name + "</a>"));

						console.log($termsArray.length);
						console.log(index);

						if ($termsArray.length != index + 1) {
							$categoryLinks.append(" . ");
						}

					});
					

				}

		        $articleTemplate.appendTo(".cross-site-feed").fadeIn();

		        if (count >= showAtOnce)
		        	return false;

		    });
		});

	}


});