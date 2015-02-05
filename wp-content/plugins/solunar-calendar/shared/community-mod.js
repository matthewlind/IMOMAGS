jQuery(document).ready(function($) {



if (userIMO.perms == "editor") { //if we have moderator,admin,or editor permissions

	if (IMO_COMMUNITY_CONFIG.spid.length > 0) { //If we have spid

		if ($(".dif-full-post").length > 0) { //If were on a post single page
			//if all that is good, add the admin tools to the page

			$editPostLink = $("<a href='/edit-your-post/?post_id=" + IMO_COMMUNITY_CONFIG.spid + "' style='color:red'>EDIT POST </a> <b>|</b> ");

			$deletePostLink = $("<a href='#' style='color:red'>DELETE POST </a> <b>|</b> ");
			$deletePostLink.on("click",function(ev){

				ev.preventDefault();

				var postData = userIMO;
				postData.post_id = IMO_COMMUNITY_CONFIG.spid;

				if (confirm("WARNING: Deleting a post will also delete the IP and Email for a post. If you want to ban the IP or Email, do that before you delete the post.")) {
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

				}


			});

			$banIPLink = $("<a href='#' style='color:red'>BAN IP</a> <b>|</b> ");
			$banIPLink.on("click",function(ev){

				ev.preventDefault();

				var postData = userIMO;
				postData.post_id = IMO_COMMUNITY_CONFIG.spid;

				if (confirm("Are you sure you want to ban this IP address?")) {

					$.ajax({
					    url: '/community-api/posts/ban_ip/' + postData.post_id,
					    type: 'DELETE',
					    data: postData,
					    success: function(data) {
					        if (data.error) {
								alert(data.error);
							} else {
								alert("IP IS BANNED! No new accounts can be created from this IP. Current accounts are not affected.");
							}
					    }
					});

				}


			});

			$banEmailLink = $("<a href='#' style='color:red'>BAN EMAIL</a> <b>|</b> ");
			$banEmailLink.on("click",function(ev){

				ev.preventDefault();

				var postData = userIMO;
				postData.post_id = IMO_COMMUNITY_CONFIG.spid;


				if (confirm("Are you sure you want to ban this email address?")) {


					$.ajax({
					    url: '/community-api/posts/ban_email/' + postData.post_id,
					    type: 'DELETE',
					    data: postData,
					    success: function(data) {
					        if (data.error) {
								alert(data.error);
							} else {
								alert("Email IS BANNED! No new accounts can be created from this Email. Current accounts are not affected.");
							}
					    }
					});

				}
			});

			$deleteUserLink = $("<a href='#' style='color:red'>DELETE USER</a>");
			$deleteUserLink.on("click",function(ev){

				ev.preventDefault();

				var postData = userIMO;
				postData.post_id = IMO_COMMUNITY_CONFIG.spid;

				if (confirm("WARNING: Deleting a user will also delete the IP address and Email. If you want to ban the IP or email, do that before you delete the post.")) {

					$.ajax({
					    url: '/community-api/posts/delete_user/' + postData.post_id,
					    type: 'DELETE',
					    data: postData,
					    success: function(data) {
					        if (data.error) {
								alert(data.error);
							} else {
								alert("User is deleted. They must re-register before they can post again.");
							}
					    }
					});

				}
			});

			$(".dif-full-post").prepend($deleteUserLink);
			$(".dif-full-post").prepend($banIPLink);
			$(".dif-full-post").prepend($banEmailLink);
			$(".dif-full-post").prepend($deletePostLink);
			$(".dif-full-post").prepend($editPostLink);
			$(".dif-full-post").prepend("ADMIN TOOLS: ");

		}

	}

}








});