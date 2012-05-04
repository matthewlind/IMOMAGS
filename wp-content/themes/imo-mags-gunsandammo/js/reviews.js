jQuery(document).ready(function($) {
  

	$(".manufacturer").change(function(){
			var id=$(this).val();
			var dataString = "manufacturer=" + id;


		$.ajax({
			type: "GET",
			url: "/caliber.json",
			data: dataString,
			dataType: 'json',
			cache: false,
			success: function(data) {

				$("select.caliber").empty();

				var option = $("<option value=''>Caliber (optional)</option>");
				$("select.caliber").append(option);

				$(data).each(function(i,row){
					var option = $("<option value='" + row.slug + "'>" + row.name + "</option>");
					$("select.caliber").append(option);

				});
			}
		});

	});



	$(".reviews-select").change(function(){


		var dataString = "";

		//First, get the guntype
		if ($(".guntype").val()) {
			dataString += "guntype=" + $(".guntype").val() + '&';
	
		}

		//Then check for caliber
		if ($(".caliber").val()) {
			dataString += "manufacturer=" + $(".caliber").val();
		} else if ($(".manufacturer").val()) { //If no caliber, check for manufacturer
			dataString += "manufacturer=" + $(".manufacturer").val();
		}


		$(".reviews-cover").fadeIn();
		
		//Send the dataString and get the results
		$.ajax({
			type: "GET",
			url: "/reviews.json",
			data: dataString,
			dataType: 'json',
			cache: false,
			success: function(data) {


				populateReviews(data);


				if (data.length < 1) {
					fakePopulateReviews();
				}

				$(".reviews-cover").fadeOut();
				
			}
		});

	});



	function populateReviews(rows) {

		//first grab a review to use as a template
		var article = $('<article class="post type-post status-publish format-standard hentry category-news-brief entry entry-excerpt has-img"><a class="thumbnail-link" href="http://www.gunsandammo.deva/reviews/browning-x-bolt-review/"><img width="190" height="120" src="http://www.gunsandammo.deva/files/2012/04/Browning-X-Bolt_0011-190x120.jpg" class="entry-img wp-post-image" alt="Browning-X-Bolt_001" title="Browning-X-Bolt_001" /></a><div class="entry-summary"><span class="entry-category"><span class="review-date" style="color:#CE181E;">April 24th, 2012</span></span><h2 class="entry-title"><a rel="bookmark" href="http://www.gunsandammo.deva/reviews/browning-x-bolt-review/">Browning X-Bolt Review</a></h2><p class="review-excerpt">May 2008 The closure of Winchester&#8217;s New Haven factory in 2006 made everyone in the shooting industry wince. Now what<a href="http://www.gunsandammo.deva/reviews/browning-x-bolt-review/">&#8230;&raquo;</a></p></p></div><a class="comment-count" href="http://www.gunsandammo.deva/reviews/browning-x-bolt-review/#comments">0</a></article>');

		//Then, clear existing reviews
		$(".reviews-container").empty();

		$(rows).each(function(i,row){

			var articleClone = article.clone();


			articleClone.find("h2.entry-title a").html(row.title);//change title
			articleClone.find("a").attr("href",row.permalink);//change all urls
			articleClone.find(".entry-img").remove(); //Remove the Thumbnail
			articleClone.find(".thumbnail-link").append(row.thumbnail);//Add the new thumbnail
			articleClone.find(".review-date").text(row.date);
			articleClone.find(".review-excerpt").html(row.excerpt);

			$(".reviews-container").append(articleClone);

		});

	}

	function fakePopulateReviews() {
		var article = $('<article class="post type-post status-publish format-standard hentry category-news-brief entry entry-excerpt has-img"><a class="thumbnail-link" href=""><img width="190" height="120" src="/wp-content/themes/imo-mags-gunsandammo/img/graygun-b.png" class="entry-img wp-post-image" alt="" title="No Results Found." /></a><div class="entry-summary"><span class="entry-category"></span><h2 class="entry-title"><a rel="bookmark" href="">No Filter Results Found. <br>Please Try Again</a></h2></div></article>');
		$(".reviews-container").append(article);
	}


	$(".slider-reviews-select").change(function(){


		var dataString = "";

		//First, get the guntype
		if ($(".guntype").val()) {
			dataString += "guntype=" + $(".guntype").val() + '&';
	
		}

		//Then check for caliber
		if ($(".caliber").val()) {
			dataString += "manufacturer=" + $(".caliber").val();
		} else if ($(".manufacturer").val()) { //If no caliber, check for manufacturer
			dataString += "manufacturer=" + $(".manufacturer").val();
		}


		$(".reviews-cover").fadeIn();
		
		//Send the dataString and get the results
		$.ajax({
			type: "GET",
			url: "/reviews.json",
			data: dataString,
			dataType: 'json',
			cache: false,
			success: function(data) {


				populateSlider(data);

				if (data.length < 1) {
					fakePopulateSlider();
				}

				$('ul#scroll-reviews').css("left","0px");


				$(".reviews-cover").fadeOut();
				
			}
		});

	});

	function populateSlider(rows) {

		//first grab a review to use as a template
		var article = $("<li><a class='thumbnail-link' href='http://www.gunsandammo.deva/reviews/the-ruger-sr1911-review/'><img class='entry-img' src='http://www.gunsandammo.deva/files/2012/04/Ruger1911A-134x90.jpg'></a><a class='review-title' href='http://www.gunsandammo.deva/reviews/the-ruger-sr1911-review/'>Tackling the 1911: The Ruger SR1911 Review</a></li>")

		//Then, clear existing reviews
		$("ul#scroll-reviews").empty();

		$(rows).each(function(i,row){

			var articleClone = article.clone();


			articleClone.find("a.review-title").html(row.title);//change title
			articleClone.find("a").attr("href",row.permalink);//change all urls
			articleClone.find(".entry-img").remove(); //Remove the Thumbnail
			articleClone.find(".thumbnail-link").append(row.imo_slider_thumb);//Add the new thumbnail


			$("ul#scroll-reviews").append(articleClone);

		});

	}

	function fakePopulateSlider() {
		var article = $("<li><a class='thumbnail-link' href=''><img class='entry-img' src='/wp-content/themes/imo-mags-gunsandammo/img/graygun-s.png'></a><a class='review-title' href=''>No Results Found. Please try again.</a></li>")
		$("ul#scroll-reviews").append(article);

	}



});