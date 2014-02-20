jQuery(document).ready(function($) {

var spid = $("#imo-add-this-spid").text();

if (userIMO.perms == "editor") { //if we have moderator,admin,or editor permissions

	if (spid.length > 0) { //If we have spid

		if ($(".col-abc.super-content").length > 0) { //If were on a post single page
			//if all that is good, add the admin tools to the page

			$deletePostLink = $("<a href='#' style='color:red'>DELETE POST </a> <b>|</b> ");
			$deletePostLink.on("click",function(ev){

				ev.preventDefault();

				var postData = userIMO;
				postData.post_id = spid;

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
				postData.post_id = spid;

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
				postData.post_id = spid;


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

			$deleteUserLink = $("<a href='#' style='color:red'>DELETE USER</a> <b><p>&nbsp;</p></b> ");
			$deleteUserLink.on("click",function(ev){

				ev.preventDefault();

				var postData = userIMO;
				postData.post_id = spid;

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

			$(".col-abc.super-content").prepend($deleteUserLink);
			$(".col-abc.super-content").prepend($banIPLink);
			$(".col-abc.super-content").prepend($banEmailLink);
			$(".col-abc.super-content").prepend($deletePostLink);
			$(".col-abc.super-content").prepend("ADMIN TOOLS: ");

		}

	}

}








});