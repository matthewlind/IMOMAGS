jQuery(document).ready(function($) {

var url = "http://www.in-fisherman.deva/community-api/posts?skip=0&per_page=100&order_by=score_week&sort=DESC";

	$.getJSON(url,function(posts){

		$.each(posts,function(index,post){

			var postHTML = _.template( $('#post-template').html() , { post: post });
			$("#posts-container").append(postHTML);

		});

	});

});