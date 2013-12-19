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

				$(".slider-reviews-caliber").trigger('change');
				$(".reviews-select-caliber").trigger('change');
			}
		});

	});

	$(".guntype").change(function(){
			var id=$(this).val();
			var dataString = "guntype=" + id;


		$.ajax({
			type: "GET",
			url: "/manufacturer.json",
			data: dataString,
			dataType: 'json',
			cache: false,
			success: function(data) {

				$("select.manufacturer").empty();

				var option = $("<option value=''>Manufacturer</option>");
				$("select.manufacturer").append(option);

				$(data).each(function(i,row){
					var option = $("<option value='" + row.slug + "'>" + row.name + "</option>");
					$("select.manufacturer").append(option);

					

				});

				$(".slider-reviews-caliber").trigger('change');
				$(".reviews-select-caliber").trigger('change');
			}
		});

	});



	$(".reviews-select-caliber").change(function(){


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
		var article = $('<div class="post article-brief clearfix"><a href="http://www.gunsandammo.fox/2013/11/13/wwii-sub-machine-guns/" class="thumbnail-img"><img width="405" height="270" src="http://www.gunsandammo.fox/files/2013/11/WWII_sub_machine_guns.jpg" class="attachment-list-thumb wp-post-image" alt="WWII_sub_machine_guns" title="WWII_sub_machine_guns"></a><div class="article-holder"><h3 class="entry-title"><a href="http://www.gunsandammo.fox/2013/11/13/wwii-sub-machine-guns/" title="Permalink to At the Range: WWII Submachine Guns" rel="bookmark">At the Range: WWII Submachine Guns</a></h3><a class="comment-count" href="http://www.gunsandammo.fox/2013/11/13/wwii-sub-machine-guns/#comments">4</a><div class="entry-content"><p>Submachine guns were some of the most iconic weapons on WWII battlefields. Though their designs vary from one model to? <a href="http://www.gunsandammo.fox/2013/11/13/wwii-sub-machine-guns/">more <span class="meta-nav">»</span></a></p></div></div></div>');

		//Then, clear existing reviews
		$(".reviews-container").empty();

		$(rows).each(function(i,row){

			var articleClone = article.clone();


			articleClone.find("h3.entry-title a").html(row.title);//change title
			articleClone.find("a").attr("href",row.permalink);//change all urls
			articleClone.find(".attachment-list-thumb").remove(); //Remove the Thumbnail
			articleClone.find(".thumbnail-img").append(row.thumbnail);//Add the new thumbnail
			//articleClone.find(".review-date").text(row.date);
			articleClone.find(".entry-content").html(row.excerpt);

			$(".reviews-container").append(articleClone);

		});

	}

	function fakePopulateReviews() {
		var article = $('<div class="post article-brief clearfix"><a href="http://www.gunsandammo.fox/2013/11/13/wwii-sub-machine-guns/"><img width="405" height="270" src="http://www.gunsandammo.fox/files/2013/11/WWII_sub_machine_guns.jpg" class="attachment-list-thumb wp-post-image" alt="WWII_sub_machine_guns" title="WWII_sub_machine_guns"></a><div class="article-holder"><h3 class="entry-title"><a href="http://www.gunsandammo.fox/2013/11/13/wwii-sub-machine-guns/" title="Permalink to At the Range: WWII Submachine Guns" rel="bookmark">At the Range: WWII Submachine Guns</a></h3><a class="comment-count" href="http://www.gunsandammo.fox/2013/11/13/wwii-sub-machine-guns/#comments">4</a><div class="entry-content"><p>Submachine guns were some of the most iconic weapons on WWII battlefields. Though their designs vary from one model to? <a href="http://www.gunsandammo.fox/2013/11/13/wwii-sub-machine-guns/">more <span class="meta-nav">»</span></a></p></div></div></div>').append(article);
	}


	$(".slider-reviews-caliber").change(function(){


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

				$('.jq-reviews-paging-slider ul.slides').css("left","0px");


				$(".reviews-cover").fadeOut();
				
			}
		});

	});

	function populateSlider(rows) {

		//first grab a review to use as a template
		var article = $('<li style="width: 148px; float: left; display: block;"><div class="feat-post"><div class="feat-img"><a href="http://www.gunsandammo.fox/reviews/range-m16a1-review/"><img src="http://www.gunsandammo.fox/files/2013/10/m16a1_review-335x225.jpg"></a></div><div class="feat-text"><h3><a href="http://www.gunsandammo.fox/reviews/range-m16a1-review/">At the Range: M16A1 Review</a></h3></div></div></li>')

		//Then, clear existing reviews
		$(".ga-reviews-slider ul.slides").empty();

		$(rows).each(function(i,row){

			var articleClone = article.clone();


			articleClone.find(".feat-text a").text(row.title);//change title
			articleClone.find("a").attr("href",row.permalink);//change all urls
			articleClone.find(".feat-img img").remove(); //Remove the Thumbnail
			articleClone.find(".feat-img").append("<a href='" + row.permalink + "'>" + row.imo_slider_thumb + "</a>");//Add the new thumbnail


			$(".ga-reviews-slider ul.slides").append(articleClone);

		});

	}

	function fakePopulateSlider() {
		var article = $('<li style="width: 340px; float: left; display: block;"><div class="feat-post"><div class="feat-img"><a href="http://www.gunsandammo.fox/reviews/range-m16a1-review/"><img src="http://www.gunsandammo.fox/files/2013/10/m16a1_review-335x225.jpg"></a></div><div class="feat-text"><h3><a href="http://www.gunsandammo.fox/reviews/range-m16a1-review/">At the Range: M16A1 Review</a></h3></div></div></li>')
		$("ul.slides").append(article);

	}


});