jQuery(document).ready(function($) {

	var currentPage = 1;
	var currentPosition = 0;
	var showAtOnce = 15;
	var sort = "post_date";
	var feedData;

	//Check to see if category-cross-site-feed exists:
	if ($(".category-cross-site-feed").length > 0) {
		//if yes, display some things

		displayCrossSiteFeed(currentPosition);
	}

	//When more button is clicked....
	$(".category-cross-site-feed-more-button").click(function(){
	
		//remove ads to prevent doubling
		$(".category-ad").remove();
		
		currentPosition = currentPosition + showAtOnce;
		displayCrossSiteFeed(currentPosition,sort);

		currentPage++;

		_gaq.push(['_trackPageview',"/" + window.location.pathname + "#" + currentPage]);

		if (document.getElementById('sticky-iframe-ad'))
			document.getElementById('sticky-iframe-ad').contentWindow.location.reload();
	});

	//When sort button is clicked:
	$(".sort-link").click(function(event){

		event.preventDefault();

		currentPosition = 0;
		$(".category-cross-site-feed").css("height",800);
		$(".category-cross-site-feed").html("");

		sort = $(this).attr("sort");
		displayCrossSiteFeed(currentPosition,sort)


	});

	function resetDisplay(slug) {
		$(".category-cross-site-feed").attr("term",slug);
		$(".category-cross-site-feed").text("");

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
		var term = $(".category-cross-site-feed").attr("term");
		
		var dart = $(".category-cross-site-feed").attr("dart");

		// if (term.length > 0) {
		// 	var fileName = "/wp-content/cache/superloop/naw-plus-" + term + "-" + sort + ".json";
		// } else {
		// 	var fileName = "/wp-content/cache/superloop/naw-plus-" + sort + ".json";
		// }


		var fileName = "/wpdb/network-feed-cached.php?network=everything&term=" + term + "&sort=" + sort + "&skip=" + start + "&count=" + showAtOnce;


		if (document.domain.indexOf('gunsandammo') !== -1) {
			var fileName = "/wpdb/network-feed-cached.php?network=shooting&term=" + term + "&sort=" + sort + "&skip=" + start + "&count=" + showAtOnce;
		}
		if (document.domain.indexOf('shotgunnews') !== -1) {
			var fileName = "/wpdb/network-feed-cached.php?network=shooting&term=" + term + "&sort=" + sort + "&skip=" + start + "&count=" + showAtOnce;
		}
		if (document.domain.indexOf('handguns') !== -1) {
			var fileName = "/wpdb/network-feed-cached.php?network=shooting&term=" + term + "&sort=" + sort + "&skip=" + start + "&count=" + showAtOnce;
		}
		if (document.domain.indexOf('shootingtimes') !== -1) {
			var fileName = "/wpdb/network-feed-cached.php?network=shooting&term=" + term + "&sort=" + sort + "&skip=" + start + "&count=" + showAtOnce;
		}
		if (document.domain.indexOf('rifleshooter') !== -1) {
			var fileName = "/wpdb/network-feed-cached.php?network=shooting&term=" + term + "&sort=" + sort + "&skip=" + start + "&count=" + showAtOnce;
		}
		if (document.domain.indexOf('floridasportsman') !== -1) {
			var fileName = "/wpdb/network-feed-cached.php?network=fishing&term=" + term + "&sort=" + sort + "&skip=" + start + "&count=" + showAtOnce;
		}
		if (document.domain.indexOf('in-fisherman') !== -1) {
			var fileName = "/wpdb/network-feed-cached.php?network=fishing&term=" + term + "&sort=" + sort + "&skip=" + start + "&count=" + showAtOnce;
		}
		if (document.domain.indexOf('flyfisherman') !== -1) {
			var fileName = "/wpdb/network-feed-cached.php?network=fishing&term=" + term + "&sort=" + sort + "&skip=" + start + "&count=" + showAtOnce;
		}
		if (document.domain.indexOf('petersenshunting') !== -1) {
			var fileName = "/wpdb/network-feed-cached.php?network=hunting&term=" + term + "&sort=" + sort + "&skip=" + start + "&count=" + showAtOnce;
		}
		if (document.domain.indexOf('bowhunting') !== -1) {
			var fileName = "/wpdb/network-feed-cached.php?network=hunting&term=" + term + "&sort=" + sort + "&skip=" + start + "&count=" + showAtOnce;
		}
		if (document.domain.indexOf('bowhunter') !== -1) {
			var fileName = "/wpdb/network-feed-cached.php?network=hunting&term=" + term + "&sort=" + sort + "&skip=" + start + "&count=" + showAtOnce;
		}
		if (document.domain.indexOf('gundog') !== -1) {
			var fileName = "/wpdb/network-feed-cached.php?network=hunting&term=" + term + "&sort=" + sort + "&skip=" + start + "&count=" + showAtOnce;
		}
		if (document.domain.indexOf('wildfowl') !== -1) {
			var fileName = "/wpdb/network-feed-cached.php?network=hunting&term=" + term + "&sort=" + sort + "&skip=" + start + "&count=" + showAtOnce;
		}
		if (document.domain.indexOf('northamericanwhitetail') !== -1) {
			var fileName = "/wpdb/network-feed-cached.php?network=hunting&term=" + term + "&sort=" + sort + "&skip=" + start + "&count=" + showAtOnce;
		}
		if (document.domain.indexOf('petersenshunting') !== -1) {
			var fileName = "/wpdb/network-feed-cached.php?network=hunting&term=" + term + "&sort=" + sort + "&skip=" + start + "&count=" + showAtOnce;
		}
		if (document.domain.indexOf('gameandfish') !== -1) {
			var fileName = "/wpdb/network-feed-cached.php?network=everything&term=" + term + "&sort=" + sort + "&skip=" + start + "&count=" + showAtOnce;
		}




		$(".load-spinner").show();
		var getdata = $.getJSON(fileName, function(data) {

	    //$(".animal-container").html("");
			

	    	$(".load-spinner").hide();

		    var count = 0;

		    var end = start + showAtOnce;
			
		    for (i = 0; i < showAtOnce; i++) {
		        count++;
		       
		        var $articleTemplate = $("#category-excerpt-template").clone();

		        //console.log('hey',data[i]);

		        $articleTemplate.attr("id","category-excerpt-" + data[i].post_name + count);
		        $articleTemplate.find("a").attr("href",data[i].post_url);

		        $articleTemplate.find(".entry-category a").text("From " + data[i].brand + " Magazine");
		        $articleTemplate.find(".entry-category a").attr("href","http://" + data[i].domain)



		        if (data[i].domain == document.domain || data[i].domain == 'www.gunsandammo.com') { //FIX BEFORE GOING TO PROD
		        	var $category = $articleTemplate.find(".cat-feat-label").clone();
		        	$articleTemplate.find(".cat-feat-label").remove();

		        	$.each(data[i].terms,function(index, term){
		        		var $categoryClone  = $category.clone();
		        		$categoryClone.find("a").attr("href", term.base +  "/" + term.slug);
		        		$categoryClone.find("a").text(term.name.replace("&amp;","&"));

		        		$articleTemplate.find(".entry-summary").prepend($categoryClone);



		        	});

		        } else {
		        	$articleTemplate.find("a").attr("target","_blank");
		        }


		        //console.log(data[i].domain,document.domain);

		        $articleTemplate.find(".entry-title a").html(data[i].post_title);

		        $articleTemplate.find(".author").html(data[i].post_nicedate + " by " + data[i].author);
		        $articleTemplate.find("p.excerpt-body").text("");

		        $articleTemplate.find("img.entry-img").attr("src",data[i].img_url);
		        $articleTemplate.find(".comment-count").text(data[i].comment_count);

		        $articleTemplate.find(".entry-content").html(data[i].post_content);


				//If data[i] is from NAW, add the categories





		        $articleTemplate.appendTo(".category-cross-site-feed").fadeIn();
		        

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
			//Place ads
			if ($(window).width() <  1096 ) {
				$('<div class="category-ad"><div class="image-banner"><iframe id="category-ad" width=300 height=250 marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-category-ad.php?ad_code=' + dart + '"></iframe></div></div>')
				.insertAfter(".article-brief:nth-child(5n)");
			}



		});

	}






});