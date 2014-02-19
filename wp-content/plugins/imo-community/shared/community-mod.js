jQuery(document).ready(function($) {



if (userIMO.perms == "editor") { //if we have moderator,admin,or editor permissions

	if (IMO_COMMUNITY_CONFIG.spid.length > 0) { //If we have spid

		if ($(".dif-full-post").length > 0) { //If were on a post single page
			//if all that is good, add the admin tools to the page




			$deletePostLink = $("<a href='#' style='color:red'>DELETE POST</a> | ");
			$deletePostLink.on("click",function(ev){

				ev.preventDefault();

				var postData = userIMO;
				postData.post_id = IMO_COMMUNITY_CONFIG.spid;

				$.ajax({
				    url: '/community-api/posts/' + postData.post_id,
				    type: 'DELETE',
				    data: postData,
				    success: function(data) {
				        if (data.error) {
							alert(data.error);
						} else {
							alert("Delete Done! Post is Gone.");
						}
				    }
				});



			});



			$(".dif-full-post").prepend($deletePostLink);

			$(".dif-full-post").prepend("ADMIN TOOLS: ");

		}

	}

}








});