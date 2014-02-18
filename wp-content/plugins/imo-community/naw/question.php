<?php

/**
 * Template Name: question
 * Description: Community Questions Page
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
imo_sidebar("community");

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


include 'common-templates.php';
$crop = "/convert?w=650&h=650&fit=crop&rotate=exif";
if(mobile()){
	$crop = "/convert?w=458&h=458&fit=crop&rotate=exif";
}

?>

<!-- *********************************************************** -->
<!-- ***************** UNDERSCORE TEMPLATE ********************* -->
<!-- *********************************************************** -->
	<script type="text/template" id="new-post-template">

		<form id="new-post-form">
			 <div class="basic-form post-page">

		        <div id="attachments" class="clearfix">
			    	<input class="title-input" placeholder="Ask Your Question (Required)" type="text" name="title" value="<%= post ? post.title : "" %>">
		        </div>

		        <div class="photo-link-area">
		        	<div id="fileupload">
						<div class="fileupload-buttonbar ">
							<label class="upload-button">
								<span class="add-photo-link">ADD A PHOTO WITH YOUR QUESTION</span>
								<input id="image-upload" type="file" name="photo-upload">
							</label>
						</div>
					</div>
				</div>
				<div class="loading-gif"></div>
				<div class="dropdown-selects">
					
				    <select name="state" placeholder="Choose the state for this post:" class="alter-sel mobile-select" id="ma-state">
			            <option value="" >SELECT STATE</option>
			            <option value="AL" <%= post && post.state == "AL" ? "SELECTED" : "" %> >Alabama</option>
			            <option value="AK" <%= post && post.state == "AK" ? "SELECTED" : "" %> >Alaska</option>
			            <option value="AZ" <%= post && post.state == "AZ" ? "SELECTED" : "" %> >Arizona</option>
			            <option value="AR" <%= post && post.state == "AR" ? "SELECTED" : "" %> >Arkansas</option>
			            <option value="CA" <%= post && post.state == "CA" ? "SELECTED" : "" %> >California</option>
			            <option value="CO" <%= post && post.state == "CO" ? "SELECTED" : "" %> >Colorado</option>
			            <option value="CT" <%= post && post.state == "CT" ? "SELECTED" : "" %> >Connecticut</option>
			            <option value="DE" <%= post && post.state == "DE" ? "SELECTED" : "" %> >Delaware</option>
			            <option value="DC" <%= post && post.state == "DC" ? "SELECTED" : "" %> >District of Columbia</option>
			            <option value="FL" <%= post && post.state == "FL" ? "SELECTED" : "" %> >Florida</option>
			            <option value="GA" <%= post && post.state == "GA" ? "SELECTED" : "" %> >Georgia</option>
			            <option value="HI" <%= post && post.state == "HI" ? "SELECTED" : "" %> >Hawaii</option>
			            <option value="ID" <%= post && post.state == "ID" ? "SELECTED" : "" %> >Idaho</option>
			            <option value="IL" <%= post && post.state == "IL" ? "SELECTED" : "" %> >Illinois</option>
			            <option value="IN" <%= post && post.state == "IN" ? "SELECTED" : "" %> >Indiana</option>
			            <option value="IA" <%= post && post.state == "IA" ? "SELECTED" : "" %> >Iowa</option>
			            <option value="KS" <%= post && post.state == "KS" ? "SELECTED" : "" %> >Kansas</option>
			            <option value="KY" <%= post && post.state == "KY" ? "SELECTED" : "" %> >Kentucky</option>
			            <option value="LA" <%= post && post.state == "LA" ? "SELECTED" : "" %> >Louisiana</option>
			            <option value="ME" <%= post && post.state == "ME" ? "SELECTED" : "" %> >Maine</option>
			            <option value="MD" <%= post && post.state == "MD" ? "SELECTED" : "" %> >Maryland</option>
			            <option value="MA" <%= post && post.state == "MA" ? "SELECTED" : "" %> >Massachusetts</option>
			            <option value="MI" <%= post && post.state == "MI" ? "SELECTED" : "" %> >Michigan</option>
			            <option value="MN" <%= post && post.state == "MN" ? "SELECTED" : "" %> >Minnesota</option>
			            <option value="MS" <%= post && post.state == "MS" ? "SELECTED" : "" %> >Mississippi</option>
			            <option value="MO" <%= post && post.state == "MO" ? "SELECTED" : "" %> >Missouri</option>
			            <option value="MT" <%= post && post.state == "MT" ? "SELECTED" : "" %> >Montana</option>
			            <option value="NE" <%= post && post.state == "NE" ? "SELECTED" : "" %> >Nebraska</option>
			            <option value="NV" <%= post && post.state == "NV" ? "SELECTED" : "" %> >Nevada</option>
			            <option value="NH" <%= post && post.state == "NH" ? "SELECTED" : "" %> >New Hampshire</option>
			            <option value="NJ" <%= post && post.state == "NJ" ? "SELECTED" : "" %> >New Jersey</option>
			            <option value="NM" <%= post && post.state == "NM" ? "SELECTED" : "" %> >New Mexico</option>
			            <option value="NY" <%= post && post.state == "NY" ? "SELECTED" : "" %> >New York</option>
			            <option value="NC" <%= post && post.state == "NC" ? "SELECTED" : "" %> >North Carolina</option>
			            <option value="ND" <%= post && post.state == "ND" ? "SELECTED" : "" %> >North Dakota</option>
			            <option value="OH" <%= post && post.state == "OH" ? "SELECTED" : "" %> >Ohio</option>
			            <option value="OK" <%= post && post.state == "OK" ? "SELECTED" : "" %> >Oklahoma</option>
			            <option value="OR" <%= post && post.state == "OR" ? "SELECTED" : "" %> >Oregon</option>
			            <option value="PA" <%= post && post.state == "PA" ? "SELECTED" : "" %> >Pennsylvania</option>
			            <option value="RI" <%= post && post.state == "RI" ? "SELECTED" : "" %> >Rhode Island</option>
			            <option value="SC" <%= post && post.state == "SC" ? "SELECTED" : "" %> >South Carolina</option>
			            <option value="SD" <%= post && post.state == "SD" ? "SELECTED" : "" %> >South Dakota</option>
			            <option value="TN" <%= post && post.state == "TN" ? "SELECTED" : "" %> >Tennessee</option>
			            <option value="TX" <%= post && post.state == "TX" ? "SELECTED" : "" %> >Texas</option>
			            <option value="UT" <%= post && post.state == "UT" ? "SELECTED" : "" %> >Utah</option>
			            <option value="VT" <%= post && post.state == "VT" ? "SELECTED" : "" %> >Vermont</option>
			            <option value="VA" <%= post && post.state == "VA" ? "SELECTED" : "" %> >Virginia</option>
			            <option value="WA" <%= post && post.state == "WA" ? "SELECTED" : "" %> >Washington</option>
			            <option value="WV" <%= post && post.state == "WV" ? "SELECTED" : "" %> >West Virginia</option>
			            <option value="WI" <%= post && post.state == "WI" ? "SELECTED" : "" %> >Wisconsin</option>
			            <option value="WY" <%= post && post.state == "WY" ? "SELECTED" : "" %> >Wyoming</option>
			            <option value="AB" <%= post && post.state == "AB" ? "SELECTED" : "" %> >Alberta, Canada</option>
			            <option value="BC" <%= post && post.state == "BC" ? "SELECTED" : "" %> >British Columbia, Canada</option>
			            <option value="MB" <%= post && post.state == "MB" ? "SELECTED" : "" %> >Manitoba, Canada</option>
			            <option value="NB" <%= post && post.state == "NB" ? "SELECTED" : "" %> >New Brunswick, Canada</option>
			            <option value="NL" <%= post && post.state == "NL" ? "SELECTED" : "" %> >Newfoundland and Labrador, Canada</option>
			            <option value="NT" <%= post && post.state == "NT" ? "SELECTED" : "" %> >Northwest Territories, Canada</option>
			            <option value="NS" <%= post && post.state == "NS" ? "SELECTED" : "" %> >Nova Scotia, Canada</option>
			            <option value="NU" <%= post && post.state == "NU" ? "SELECTED" : "" %> >Nunavut, Canada</option>
			            <option value="ON" <%= post && post.state == "ON" ? "SELECTED" : "" %> >Ontario, Canada</option>
			            <option value="PE" <%= post && post.state == "PE" ? "SELECTED" : "" %> >Prince Edward Island, Canada</option>
			            <option value="QC" <%= post && post.state == "QC" ? "SELECTED" : "" %> >Quebec, Canada</option>
			            <option value="SK" <%= post && post.state == "SK" ? "SELECTED" : "" %> >Saskatchewan, Canada</option>
			            <option value="YT" <%= post && post.state == "YT" ? "SELECTED" : "" %> >Yukon, Canada</option>
                        <option value="MX" <%= post && post.state == "MX" ? "SELECTED" : "" %> >Mexico</option>
					</select>
				</div>
				


				<% if (post && post.id) { %>
						<input type="hidden" name="id" value="<%= post.id %>" >
				<% } %>

	            <div class="login-area">
	            	<p class="login-message" style="<?php echo $loginStyle; ?>">Post a photo with your question</p>
	            	<a href="#" id="imo-fb-login-button" class="imo-community-new-post fb-login join-widget-fb-login btn-fb-login">Fast Login & Submit</a>
	            	<span class="or-delim" style="<?php echo $loginStyle; ?>">OR</span>
	            	<a href="#" class="email-signup email-signup-button jq-open-reg-popup" style="<?php echo $loginStyle; ?>" >login with email address</a>
	            	<!-- <p class="login-message" style="<?php echo $loginStyle; ?>">Your post will be submitted immediately after Login</p> -->
				    <span class="btn-red btn-post btn-submit"  style="<?php echo $displayStyle; ?>"><input id="post-photo" type="submit" value="Ask Your Question"></span>
	            </div>
	            <hr>


			</div>




		</form>



	</script>
<!-- *********************************************************** -->
<!-- *********************************************************** -->
<!-- *********************************************************** -->
<!-- *********************************************************** -->
<!-- *********************************************************** -->
<!-- *********************************************************** -->
	
	
	<script type="text/template" id="single-attachment-template">
			     
      	<a href="<%= attachment.img_url %>" class="thickbox">
      			<div class="attachment-image-container">
		      		<img src="<%= attachment.img_url %>/convert?w=150&h=150&fit=crop&rotate=exif" width=75 height=75 style="height:75px">
		      	</div>
      	</a>
	  	 <div class="caption-area" name="caption-body" value="<%= attachment.body %>">
            <textarea id="" class="area caption-field" cols="30" rows="10" placeholder="Tell Your Story (optional)"></textarea>
        </div>

	</script>
	
<!-- *********************************************************** -->
<!-- *********************************************************** -->
<!-- *********************************************************** -->

<!-- *********************************************************** -->
<!-- ***************** UNDERSCORE TEMPLATE ********************* -->
<!-- *********************************************************** -->
<script type="text/template" id="post-template">
<%
if(post.score == 1){
	niceScore = post.score + ' Point';
}else{
	niceScore = post.score + ' Points';
}
newdate = post.created;
olddate = '2014-02-14 00:00:00'; 
if( newdate < olddate ){ 
	crop = "";
}else{
	crop = "/convert?w=650&h=650&fit=crop&rotate=exif";	
} %>
	<div class="dif-post">
       <% if(post.img_url){ %>
	        <div class="feat-img">
	            <a href="/community/post/<%= post.id %>"><img class="feat-img" src="<%= post.img_url %><%= crop %>" alt="<%= post.title %>" title="<%= post.img_url %>" /></a>
	        </div>
        <% }else{ %>
        	 <div class="feat-img">
	            <a href="/community/post/<%= post.id %>"><img class="feat-img" src="<?php echo plugins_url('images/crosshair.jpg' , __FILE__ ); ?>" alt="<%= post.title %>" title="<%= post.img_url %>" /></a>
	        </div>
        <% } %>
        <div class="dif-post-text">
            <h3><a href="/community/post/<%= post.id %>"><%= post.title %></a></h3>
            <div class="profile-panel">
                <div class="profile-photo">
                    <a href="/profile/<%= post.user_nicename %>"><img src="/avatar?uid=<%= post.user_id %>" alt="<%= post.user_nicename %>" title="<%= post.user_nicename %>" /></a>
                </div>
                <div class="profile-data">
                    <h4><a href="/profile/<%= post.user_nicename %>"><%= post.display_name %></a></h4>
                    <ul class="prof-tags">
                        <!--<li><a href="#"><%= post.state %></a></li>-->
                        <li><a href="/community/<%= post.post_type %>" style="text-transform:capitalize;"><%= post.post_type %></a></li>
                    </ul>
                    <ul class="replies">
                        <li><a href="/community/post/<%= post.id %>#reply_field"><%= post.comment_count %> Reply</a></li>
						<li><%= niceScore %></li>
                    </ul>
                    <ul class="prof-like">
                    	<li>
                    		<div addthis:url="http://<?php echo $_SERVER['SERVER_NAME']; ?>/community/post/<%= post.id %>" addthis:title="<%= post.title %>" class="addthis_toolbox addthis_default_style ">
								<a class="addthis_button_facebook_like"fb:like:layout="button_count"></a>
							</div>
							
                       </li>
                    </ul>
                </div>
            </div>
            <% if (post.master == 1) {  %><span class="badge"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/pic/badge-ma.png" alt="Master Angler" /></span><% } %>
        </div>
    </div>
</script>
<!-- *********************************************************** -->
<!-- *********************************************************** -->
<!-- *********************************************************** -->
<div class="page-community">
    <div class="general general-com">
    	<ul class="breadcrumbs">
	    	<li><a href="/community">NAW+ Community</a></li>
	    	<li style="margin-top:1px;text-transform:capitalize;">&raquo; Q&A</li>
	    </ul>
    	<div class="custom-title clearfix">
    		<img src="<?php echo plugins_url('images/naw-plus.png' , __FILE__ ); ?>" alt="NAW Community" class="custom-tite-logo">
            <div class="title-crumbs">
            	<h1>NAW Q&A</h1>
                <div class="sponsor"><?php imo_dart_tag("240x60"); ?></div>
			</div>
        </div>
        
		<div class="custom-slider-section">
            <?php //echo do_shortcode('[imo-slideshow community=true]'); ?>
        </div>
        <div class="photo-link-area ask-quesiton">
            <div class="fileupload-buttonbar ">
                <label class="upload-button share-photo">
                    <span class="add-photo-link">Ask a Question</span>
                </label>
            </div>
        </div>
		<div id="form-container" style="display:none;">

	    </div>

        <div class="btn-group btn-bar">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            <span class="menu-title browse-community">Browse Questions</span> <span class="caret"></span>
          </button>
          <ul class="dropdown-menu filter" role="menu">
            <li><a href="" class="filter-menu" order_by="created" id="filter-menu-default">Latest</a></li>
            <li><a href="" class="filter-menu" order_by="view_count" >Popular</a></li>
            <li><a href="" class="filter-menu" order_by="score_today" >Trending Today</a></li>
<!--             <li><a href="" class="filter-menu" order_by="score_week" >Trending This Week</a></li> 
	<li class="divider"></div>
             <li><a href="" class="filter-menu" order_by="created" post_type="report" >Rut Reports</a></li>
            <li><a href="" class="filter-menu" order_by="created" post_type="general" >General Discusion</a></li>
            <li><a href="" class="filter-menu" order_by="created" post_type="question" >Questions</a></li>-->
          </ul>
        </div>

        <div class="dif-posts">
       		<div class="loading-gif"></div>
			<div id="posts-container"></div>
         </div>
         <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
            <a href="#" class="btn-base load-more" style="display:block;">Load More</a>

            <a href="#" class="go-top jq-go-top">go top</a>

            <img src="/wp-content/themes/imo-mags-parent/images/ajax-loader.gif" id="ajax-loader" style="display:none;"/>
        </div>
		<?php social_footer(); ?>
		<div class="hr mobile-hr"></div>
		<a href="#" class="back-top jq-go-top">back to top</a>
        
    </div>
</div>

<?php get_footer(); ?>