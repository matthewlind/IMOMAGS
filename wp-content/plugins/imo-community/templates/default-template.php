<?php

/**
 * Template Name: Gear
 * Description: The NAW+ Community - Gear Category
 *
 * @package carrington-business
 *
 * This file is part of the Carrington Business Theme for WordPress
 * http://crowdfavorite.com/wordpress/themes/carrington-business/
 *
 * Copyright (c) 2008-2011 Crowd Favorite, Ltd. All rights reserved.
 * http://crowdfavorite.com
 *
 * **********************************************************************
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * **********************************************************************
 */
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }


get_header();

the_post();
$displayStyle = "display:none;";
$loginStyle = "";

if ( is_user_logged_in() ) {

	$displayStyle = "";
	$loginStyle = "display:none;";

	wp_get_current_user();

	$current_user = wp_get_current_user();
    if ( !($current_user instanceof WP_User) )
         return;
    }
?>
<div class="page-community">


	<!-- Uncomment This to add wordpress sidebar -->
  	<div id="sidebar">
  		<div class="bonus">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-community')) : else : ?>
		<?php  endif; ?>
		<div id="responderfollow"></div>
		<div class="sidebar advert">
		<script type="text/javascript">
	              document.write(unescape('%3Cscript src="http://ad.doubleclick.net/adj/imo.'+dartadsgen_site+'/;sect=;page=index;pos=btf;subs=;sz=300x250;dcopt=;tile='+pr_tile+';ord='+dartadsgen_rand+'?"%3E%3C/script%3E'));
	            </script>
	            <script type="text/javascript">
	              ++pr_tile;
	            </script>
	            <noscript>
	              <a href="http://ad.doubleclick.net/adj/imo.outdoorsbest/;sect=;page=index;pos=btf;subs=;sz=300x250;dcopt=;tile=1;ord=7391727509?">
	                <img src="http://ad.doubleclick.net/ad/imo.outdoorsbest/home;sect=;page=index;pos=btf;subs=;sz=300x250;dcopt=;tile=1;ord=7391727509?" border="0" />
	              </a>
	            </noscript>

			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : ?><?php endif; ?>
		</div>
  		</div>
	</div>



	<div class="container">
		<h1 class="community-title">Community</h1>
    <div id="app-header">

    </div>

	<ul id="app">

	</ul>

	</div>



	<!-- *********************************************************** -->
	<!-- *****************  COMMUNITY TEMPLATES   ****************** -->
	<!-- *********************************************************** -->
	<script type="text/template" id="post-list-template">

		<li style="display:inline-block;padding:15px;">


			<div class="recon-image-box" style="width:75px;float:left">
				<a href="#!<%= post.get('url') %>">
					<img src="<%= post.get('img_url') %>" class="superpost-thumb">
				</a>
			</div>

			<div style="width:900px">
				<h3><%= post.get('title') %></h3>
			</div>

			<span class="under-box">
				<a href="/profile/<%= post.get('username') %>">
					<img src="/avatar?uid=<%= post.get('user_id') %>" class="recon-gravatar" style="width:25px;">
				</a>
				<a href="/profile/<%= post.get('username') %>">
					<div class="recon-author-info">
						<span class="author-name"><%= post.get('display_name') %></span> in <span class="author-action"><%= settings.get("post_types")[post.get("post_type")].display_name %></span>
					</div>
				</a>
				<abbr class="recon-date timeago" title="2013-02-07 14:52:26">a day ago</abbr>
					<a href="<%= post.get('url') %>"><span class="comment-count">0 Replies</span> • <span class="point-count">0 Points</span></a>
			</span>

		</li>

	</script>
	<!-- *********************************************************** -->
	<!-- *********************************************************** -->
	<!-- *********************************************************** -->
	<script type="text/template" id="post-tile-template">

		<li style="display:inline-block;">


			<div class="recon-image-box" style="background-color:#c65517;width:300px;">
				<a href="#!<%= post.get('url') %>">
				<div style="width:300px">
					<h3><%= post.get('title') %></h3>
				</div>
					<img src="<%= post.get('img_url') %>" class="superpost-thumb">
				</a>
			</div>

			<div class="under-box">
				<a href="/profile/<%= post.get('username') %>">
					<img src="/avatar?uid=<%= post.get('user_id') %>" class="recon-gravatar">
				</a>
				<a href="/profile/<%= post.get('username') %>">
					<div class="recon-author-info">
						<span class="author-name"><%= post.get('display_name') %></span> in <span class="author-action"><%= settings.get("post_types")[post.get("post_type")].display_name %></span>
					</div>
				</a>
				<abbr class="recon-date timeago" title="2013-02-07 14:52:26">a day ago</abbr>
					<a href="<%= post.get('url') %>"><span class="comment-count">0 Replies</span> • <span class="point-count">0 Points</span></a>
			</div>

		</li>

	</script>
	<!-- *********************************************************** -->
	<!-- *********************************************************** -->
	<!-- *********************************************************** -->
	<script type="text/template" id="single-post-view">

		<div id="community-single-post">
			<div id="body">
				<blockquote><%= post.get("body") %></blockquote>
			</div>
			<div id="attachments">
				<% _.each(post.get("attachments"),function(attachment){ %>

				<div class="attachment-photo">
					<img src="<%= attachment.img_url.replace('thumb','medium') %>">
				</div>
				<div class="attachment-caption">
					<%= attachment.body %>
				</div>


				<% }); %>

			</div>

			<div id="comments">
				<% _.each(post.get("comments"),function(comment){ %>
					<div class="comment">

						<div class="comment-user">
							<b><%= comment.display_name %></b>
						</div>

						<div class="comment-body">
							<%= comment.body %>
						</div>
						<% _.each(comment.attachments, function(attachment){ %>

								<div class="attachment-photo">
									<img src="<%= attachment.img_url.replace('thumb','medium') %>">
								</div>
								<div class="attachment-caption">
									<%= attachment.body %>
								</div>

							<% }); %>


					</div>
				<% }); %>

			</div>



		</div>


	</script>
	<!-- *********************************************************** -->
	<!-- **************     MODERATOR TEMPLATES      *************** -->
	<!-- *********************************************************** -->
	<script type="text/template" id="post-list-table">
		<a href="#!new" class="btn btn-primary">New Post</a>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Thumb</th>
					<th>Title</th>
					<th>Body</th>
					<th>Date</th>
					<th>Post Type</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody id="post-list-table-body">


			</tbody>
		</table>
		<div id="post-list-pager-div"></div>
	</script>

	<!-- *********************************************************** -->
	<!-- *********************************************************** -->
	<!-- *********************************************************** -->
	<script type="text/template" id="user-toolbar">

    <div class="toolbar">
      Sort By:
     <select id="order_by">
        <option value="username">Username</option>
        <option value="score">All Time Score</option>
        <option value="score_today">Top Score Today</option>
        <option value="score_week">Top Score over last Week</option>
        <option value="score_month">Top Score over last Month</option>
        <option value="comment_count">Comment Count</option>
        <option value="post_count">Post Count</option>
      </select>
    </div>
	</script>
	<!-- *********************************************************** -->
	<!-- *********************************************************** -->
	<!-- *********************************************************** -->
	<script type="text/template" id="post-toolbar">

    <div class="toolbar">
    Sort By:
      <select id="order_by">

        <option value="created">Newest First</option>
        <option value="score_today">Top Score Today</option>
        <option value="score_week">Top Score this Week</option>
        <option value="score_month">Top Score this Month</option>
        <option value="score">Top Score All Time</option>
        <option value="comment_count_today">Comment Count Today</option>
        <option value="comment_count_week">Comment Count Week</option>
        <option value="comment_count_month">Comment Count Month</option>
        <option value="comment_count">Comment Count All Time</option>
        <option value="view_count">View Count All Time</option>

      </select>
    </div>
	</script>
  <!-- *********************************************************** -->
	<!-- *********************************************************** -->
	<!-- *********************************************************** -->
	<script type="text/template" id="post-list-rows">
		<% _.each(posts, function(post) { %>
			<tr>
				<td><img src="<%= post && post.get('img_url') %>" width=50></td>
				<td><%= post && post.get('title') %></td>
				<td><%= post && post.get('body') %></td>
				<td><%= post && post.get('created') %></td>
				<td><%= post && post.get('post_type') %></td>
				<td><a href="#!edit/<%= post.id %>" class="btn">edit</td>
				<td><a href="#!delete/<%= post.id %>" class="btn btn-danger">delete</td>
			</tr>
		<% }); %>
	</script>

	<!-- *********************************************************** -->
	<!-- *********************************************************** -->
	<!-- *********************************************************** -->
	<script type="text/template" id="post-list-pager-template">
		<a href="#" class="prev-list btn">Prev</a><a href="#" class="next-list btn">Next</a>
	</script>

	<!-- *********************************************************** -->
	<!-- *********************************************************** -->
	<!-- *********************************************************** -->
	<script type="text/template" id="new-post-template">
	<h3><%= post ? 'Edit' : 'Create' %> Post</h3>
		<form id="new-post-form">
			<input placeholder="title" type="text" name="title" value="<%= post ? post.get('title') : "" %>"><br>

			<textarea placeholder="body" name="body"><%= post ? post.get('body') : "" %></textarea><br>


			<select id="dynamic_select" class="post_type" name="post_type">
	         	<option value="">CATEGORY</option>
	         	<option value="report" <%= post && post.get('post_type') == "report" ? "SELECTED" : "" %> >Rut Reports</option>
	         	<option value="question" <%= post && post.get('post_type') == "question" ? "SELECTED" : "" %> >Q&A</option>
	        </select><br>

	        <select name="state" placeholder="Choose the state for this post:">
	            <option value="" >STATE</option>
	            <option value="AL" <%= post && post.get('state') == "AL" ? "SELECTED" : "" %> >Alabama</option>
	            <option value="AK" <%= post && post.get('state') == "AK" ? "SELECTED" : "" %> >Alaska</option>
	            <option value="AZ" <%= post && post.get('state') == "AZ" ? "SELECTED" : "" %> >Arizona</option>
	            <option value="AR" <%= post && post.get('state') == "AR" ? "SELECTED" : "" %> >Arkansas</option>
	            <option value="CA" <%= post && post.get('state') == "CA" ? "SELECTED" : "" %> >California</option>
	            <option value="CO" <%= post && post.get('state') == "CO" ? "SELECTED" : "" %> >Colorado</option>
	            <option value="CT" <%= post && post.get('state') == "CT" ? "SELECTED" : "" %> >Connecticut</option>
	            <option value="DE" <%= post && post.get('state') == "DE" ? "SELECTED" : "" %> >Delaware</option>
	            <option value="DC" <%= post && post.get('state') == "DC" ? "SELECTED" : "" %> >District of Columbia</option>
	            <option value="FL" <%= post && post.get('state') == "FL" ? "SELECTED" : "" %> >Florida</option>
	            <option value="GA" <%= post && post.get('state') == "GA" ? "SELECTED" : "" %> >Georgia</option>
	            <option value="HI" <%= post && post.get('state') == "HI" ? "SELECTED" : "" %> >Hawaii</option>
	            <option value="ID" <%= post && post.get('state') == "ID" ? "SELECTED" : "" %> >Idaho</option>
	            <option value="IL" <%= post && post.get('state') == "IL" ? "SELECTED" : "" %> >Illinois</option>
	            <option value="IN" <%= post && post.get('state') == "IN" ? "SELECTED" : "" %> >Indiana</option>
	            <option value="IA" <%= post && post.get('state') == "IA" ? "SELECTED" : "" %> >Iowa</option>
	            <option value="KS" <%= post && post.get('state') == "KS" ? "SELECTED" : "" %> >Kansas</option>
	            <option value="KY" <%= post && post.get('state') == "KY" ? "SELECTED" : "" %> >Kentucky</option>
	            <option value="LA" <%= post && post.get('state') == "LA" ? "SELECTED" : "" %> >Louisiana</option>
	            <option value="ME" <%= post && post.get('state') == "ME" ? "SELECTED" : "" %> >Maine</option>
	            <option value="MD" <%= post && post.get('state') == "MD" ? "SELECTED" : "" %> >Maryland</option>
	            <option value="MA" <%= post && post.get('state') == "MA" ? "SELECTED" : "" %> >Massachusetts</option>
	            <option value="MI" <%= post && post.get('state') == "MI" ? "SELECTED" : "" %> >Michigan</option>
	            <option value="MN" <%= post && post.get('state') == "MN" ? "SELECTED" : "" %> >Minnesota</option>
	            <option value="MS" <%= post && post.get('state') == "MS" ? "SELECTED" : "" %> >Mississippi</option>
	            <option value="MO" <%= post && post.get('state') == "MO" ? "SELECTED" : "" %> >Missouri</option>
	            <option value="MT" <%= post && post.get('state') == "MT" ? "SELECTED" : "" %> >Montana</option>
	            <option value="NE" <%= post && post.get('state') == "NE" ? "SELECTED" : "" %> >Nebraska</option>
	            <option value="NV" <%= post && post.get('state') == "NV" ? "SELECTED" : "" %> >Nevada</option>
	            <option value="NH" <%= post && post.get('state') == "NH" ? "SELECTED" : "" %> >New Hampshire</option>
	            <option value="NJ" <%= post && post.get('state') == "NJ" ? "SELECTED" : "" %> >New Jersey</option>
	            <option value="NM" <%= post && post.get('state') == "NM" ? "SELECTED" : "" %> >New Mexico</option>
	            <option value="NY" <%= post && post.get('state') == "NY" ? "SELECTED" : "" %> >New York</option>
	            <option value="NC" <%= post && post.get('state') == "NC" ? "SELECTED" : "" %> >North Carolina</option>
	            <option value="ND" <%= post && post.get('state') == "ND" ? "SELECTED" : "" %> >North Dakota</option>
	            <option value="OH" <%= post && post.get('state') == "OH" ? "SELECTED" : "" %> >Ohio</option>
	            <option value="OK" <%= post && post.get('state') == "OK" ? "SELECTED" : "" %> >Oklahoma</option>
	            <option value="OR" <%= post && post.get('state') == "OR" ? "SELECTED" : "" %> >Oregon</option>
	            <option value="PA" <%= post && post.get('state') == "PA" ? "SELECTED" : "" %> >Pennsylvania</option>
	            <option value="RI" <%= post && post.get('state') == "RI" ? "SELECTED" : "" %> >Rhode Island</option>
	            <option value="SC" <%= post && post.get('state') == "SC" ? "SELECTED" : "" %> >South Carolina</option>
	            <option value="SD" <%= post && post.get('state') == "SD" ? "SELECTED" : "" %> >South Dakota</option>
	            <option value="TN" <%= post && post.get('state') == "TN" ? "SELECTED" : "" %> >Tennessee</option>
	            <option value="TX" <%= post && post.get('state') == "TX" ? "SELECTED" : "" %> >Texas</option>
	            <option value="UT" <%= post && post.get('state') == "UT" ? "SELECTED" : "" %> >Utah</option>
	            <option value="VT" <%= post && post.get('state') == "VT" ? "SELECTED" : "" %> >Vermont</option>
	            <option value="VA" <%= post && post.get('state') == "VA" ? "SELECTED" : "" %> >Virginia</option>
	            <option value="WA" <%= post && post.get('state') == "WA" ? "SELECTED" : "" %> >Washington</option>
	            <option value="WV" <%= post && post.get('state') == "WV" ? "SELECTED" : "" %> >West Virginia</option>
	            <option value="WI" <%= post && post.get('state') == "WI" ? "SELECTED" : "" %> >Wisconsin</option>
	            <option value="WY" <%= post && post.get('state') == "WY" ? "SELECTED" : "" %> >Wyoming</option>
	            <option value="AB" <%= post && post.get('state') == "AB" ? "SELECTED" : "" %> >Alberta, Canada</option>
	            <option value="BC" <%= post && post.get('state') == "BC" ? "SELECTED" : "" %> >British Columbia, Canada</option>
	            <option value="MB" <%= post && post.get('state') == "MB" ? "SELECTED" : "" %> >Manitoba, Canada</option>
	            <option value="NB" <%= post && post.get('state') == "NB" ? "SELECTED" : "" %> >New Brunswick, Canada</option>
	            <option value="NL" <%= post && post.get('state') == "NL" ? "SELECTED" : "" %> >Newfoundland and Labrador, Canada</option>
	            <option value="NT" <%= post && post.get('state') == "NT" ? "SELECTED" : "" %> >Northwest Territories, Canada</option>
	            <option value="NS" <%= post && post.get('state') == "NS" ? "SELECTED" : "" %> >Nova Scotia, Canada</option>
	            <option value="NU" <%= post && post.get('state') == "NU" ? "SELECTED" : "" %> >Nunavut, Canada</option>
	            <option value="ON" <%= post && post.get('state') == "ON" ? "SELECTED" : "" %> >Ontario, Canada</option>
	            <option value="PE" <%= post && post.get('state') == "PE" ? "SELECTED" : "" %> >Prince Edward Island, Canada</option>
	            <option value="QC" <%= post && post.get('state') == "QC" ? "SELECTED" : "" %> >Quebec, Canada</option>
	            <option value="SK" <%= post && post.get('state') == "SK" ? "SELECTED" : "" %> >Saskatchewan, Canada</option>
	            <option value="YT" <%= post && post.get('state') == "YT" ? "SELECTED" : "" %> >Yukon, Canada</option>
		      </select>
		      <br>

		      <% if (post.id) { %>
		      		<input type="hidden" name="id" value="<%= post.id %>" >
		      <% } %>


				<div id="fileupload">
				  <div class="fileupload-buttonbar ">
				      <label class="upload-button">
				          <span><span class="white-plus-sign">+</span><span class="button-text">ATTACH PHOTO</span></span>
				          <input id="image-upload" type="file" name="photo-upload">

				      </label>
				  </div>
				</div>



		      <div id="attachments">
		      </div>

			<input type="submit">

		  </form>
	</script>

	<!-- *********************************************************** -->
	<!-- *********************************************************** -->
	<!-- *********************************************************** -->
	<script type="text/template" id="edit-post-attachments-template">
		<div class="single-attachment-container">





		 </div>
	</script>



	<!-- *********************************************************** -->
	<!-- *********************************************************** -->
	<!-- *********************************************************** -->
	<script type="text/template" id="single-attachment-template">




			      <div style="margin-top:20px">
				      	<a href="<%= attachment.img_url %>" class="thickbox">
				      		<img src="<%= attachment.img_url %>" width=75>
				      	</a>

				      	<input class="caption-field" name="caption-body" type="text" placeholder="Caption (optional)" value="<%= attachment.body %>">

				   </div>



	</script>

</div>
<?php get_footer(); ?>
