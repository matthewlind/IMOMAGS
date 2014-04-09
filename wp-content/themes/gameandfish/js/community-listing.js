jQuery( document ).ready(function( $ ) {

	var $postTemplateCopy = $(".dif-post").first().clone();

	var querySettings = {};

	querySettings.state = null;
	querySettings.skip = 0;
	querySettings.showAtOnce = 10;
	querySettings.totalCount = 999999;
	querySettings.term = $(".posts-list").attr("slug");

	//alert("ok");

	$("a.filter-menu").click(function(ev){

		$(".posts-list").empty();
		console.log("clear");

		ev.preventDefault();



		querySettings.state = $(this).attr('state');



		getPosts();

	});


	$(".community-pager .more").click(function(ev){

		ev.preventDefault();

		if (querySettings.skip == 0) {

			getTotalCount();
		}

		querySettings.skip += querySettings.showAtOnce;

		getPosts();

		if (querySettings.skip + querySettings.showAtOnce > querySettings.totalCount) {

			$(".community-pager .more").fadeOut();
		}

	});

	function getTotalCount() {

		var url =  "http://www.gameandfishmag.deva/wpdb/network-feed-cached.php?post_type=reader_photos&domain=www.gameandfishmag.com&thumbnail_size=community-square-retina"

				 + "&term=" + querySettings.term
				 + "&get_count=1";

		if (querySettings.state != null) {
			url += "&state=" + querySettings.state;
		}

		$.getJSON(url,function(countArray){

			var count = countArray[0].count;
			querySettings.totalCount = count;
		});




	}

	function getPosts() {

		var url =  "http://www.gameandfishmag.deva/wpdb/network-feed-cached.php?post_type=reader_photos&domain=www.gameandfishmag.com&thumbnail_size=community-square-retina"

				 + "&term=" + querySettings.term
				 + "&count=" + querySettings.showAtOnce
				 + "&skip=" + querySettings.skip;

		if (querySettings.state != null) {
			url += "&state=" + querySettings.state;
		}



		console.log(url);
		$.getJSON(url,function(posts){

			if(typeof posts =='object')
			{



				$.each(posts,function(index,post){

					console.log(post);


					$postTemplate = $postTemplateCopy.clone();

					var imgURL = post.img_url;
					imgURL.replace("www.gameandfishmag.com",document.domain);


					$postTemplate.find("div.feat-img img").attr("src",imgURL.replace("www.gameandfishmag.com",document.domain));
					$postTemplate.find("div.feat-img img").attr("alt",post.post_title);
					$postTemplate.find(".dif-post-text h3 a").html(post.post_title);
					$postTemplate.find(".prof-like").remove();
					$postTemplate.find(".profile-data h4 a").html(post.author);
					$postTemplate.find(".profile-photo img").attr("src","/avatar?uid=" + post.user_id);
					$postTemplate.find("ul.replies li a").html(post.comment_count + "replies");

					$postTemplate.find("a").attr("href",post.post_url);


					$(".posts-list").append($postTemplate);


				});

				//$(".community-pager .more").fadeIn();

			} else if (querySettings.state != null) {



				var catName = $(".page-title").attr("cat-title");

				var resultsString = "<h2>Sorry, we don't have any " + catName + " photos in " + querySettings.state + ". <br><a href='/photos/new'>Want to post one?</a></h2>";

				$(".posts-list").append(resultsString);

				$(".community-pager .more").fadeOut();


			}




		});


	}



});