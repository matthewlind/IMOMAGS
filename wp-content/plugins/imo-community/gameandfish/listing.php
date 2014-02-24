<?php

/**
 * Template Name: Community Listing
 * Description: Community Homepage
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


//Path Data:
$post_type_primary = get_query_var("post_type_primary");
$post_type_secondary = get_query_var("post_type_secondary");
$post_type_tertiary = get_query_var("post_type_tertiary");

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


include 'common-templates.php';
$crop = "/convert?w=730&h=730&fit=crop&rotate=exif";
if(mobile()){
	$crop = "/convert?w=458&h=458&fit=crop&rotate=exif";
}

?>
<?php
//echo "<h1>Post Type: $post_type_primary</h1>";
//echo "<h1>Post Type Secondary: $post_type_secondary</h1>";
//echo "<h1>Post Type Tertiary: $post_type_tertiary</h1>";

?>



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
postType = post.post_type.replace("-"," ");
%>

	<div class="dif-post">
        <% if(post.img_url){ %>
	        <div class="feat-img">
	            <a href="<%= post.post_url %>"><img class="feat-img" src="<%= post.img_url %><?php echo $crop; ?>" alt="<%= post.title %>" title="<%= post.img_url %>" /></a>
	        </div>
        <% }else{ %>
        	 <div class="feat-img">
	            <a href="<%= post.post_url %>"><img class="feat-img" src="<?php echo plugins_url('images/crosshair.jpg' , __FILE__ ); ?>" alt="<%= post.title %>" title="<%= post.img_url %>" /></a>
	        </div>
        <% } %>
        <div class="dif-post-text">
            <h3><a href="<%= post.post_url %>"><%= post.title %></a></h3>
            <div class="profile-panel">
                <div class="profile-photo">
                    <a href="/profile/<%= post.user_nicename %>"><img src="/avatar?uid=<%= post.user_id %>" alt="<%= post.user_nicename %>" title="<%= post.user_nicename %>" /></a>
                </div>
                <div class="profile-data">
                    <h4><a href="/profile/<%= post.user_nicename %>"><%= post.display_name %></a></h4>
                    <ul class="prof-tags">
                        <li><%= post.state %></li>
                        <li><a href="<%= post.term_url %>"style="text-transform:capitalize;"><%= postType %></a></li>
                    </ul>
                    <ul class="replies">
                        <li><a href="<%= post.post_url %>/#reply_field"><%= post.comment_count %> Reply</a></li>
						<li><%= niceScore %></li>
                    </ul>
                    <ul class="prof-like">
                    	<li>
                    		<div addthis:url="http://<?php echo $_SERVER['SERVER_NAME']; ?>/photos/<%= post.tertiary_post_type %>/<%= post.secondary_post_type %>/<%= post.post_type %>/<%= post.id %>" addthis:title="<%= post.title %>" class="addthis_toolbox addthis_default_style ">
								<a class="addthis_button_facebook_like"fb:like:layout="button_count"></a>
							</div>

                       </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</script>
<!-- *********************************************************** -->
<!-- *********************************************************** -->
<!-- *********************************************************** -->
<!-- start nav -->
<?php
include_once('nav.php');
imo_sidebar("community");
?>
<div class="page-community">
    <div class="general general-com">
    	<div class="nav-share">
	        <label class="upload-button">
	            <a href="/photos/new/"><span class="singl-post-photo"><span>Share Your Photo Now!</span></span></a>
	            <input id="image-upload" class="common-image-upload" type="file" name="photo-upload">
	        </label>
		</div>
		<div class="btn-group btn-bar">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			<span class="menu-title browse-community" style="text-transform:normal;">Browse by State</span> <span class="caret"></span>
			</button>
			<ul class="dropdown-menu filter" role="menu">
				<li><a href="#" class="filter-menu" state="AL">alabama</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="AK">alaska</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="AZ">arizona</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="AR">arkansas</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="CA">california</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="CO">colorado</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="CT">connecticut</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="DE">delaware</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="DC">district of columbia</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="FL">florida</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="GA">georgia</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="HI">hawaii</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="ID">idaho</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="IL">illinois</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="IN">indiana</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="IA">iowa</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="KS">kansas</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="KY">kentucky</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="LA">louisiana</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="ME">maine</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="MD">maryland</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="MA">massachusetts</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="MI">michigan</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="MN">minnesota</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="MS">mississippi</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="MO">missouri</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="MT">montana</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="NE">nebraska</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="NV">nevada</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="NH">new hampshire</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="NJ">new jersey</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="NM">new mexico</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="NY">new york</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="NC">north carolina</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="ND">north dakota</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="OH">ohio</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="OK">oklahoma</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="OR">oregon</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="PA">pennsylvania</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="RI">rhode island</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="SC">south carolina</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="SD">south dakota</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="TN">tennessee</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="TX">texas</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="UT">utah</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="VT">vermont</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="VA">virginia</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="WA">washington</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="WV">west virginia</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="WI">wisconsin</a></li><div class="divider"></div>
				<li><a href="#" class="filter-menu" state="WY">wyoming</a></li><div class="divider"></div>
			</ul>
		</div>
    	<div class="custom-title clearfix">
            <div class="title-crumbs">
            	<ul class="breadcrumbs">
			    	<li><a href="/photos">All Photos</a></li>
			    	<?php 
			    	$post_type = str_replace("-", " ", $post_type_primary);
			    	if($post_type_tertiary){ ?><li style="margin-top:1px;text-transform:capitalize;"> &raquo; <a href="/photos/<?php echo $post_type_tertiary; ?>"><?php echo $post_type_tertiary; ?></a></li><?php } ?>
			    	<?php if($post_type_secondary){ ?>
			    		<li style="margin-top:1px;text-transform:capitalize;"> &raquo; <a href="/photos/<?php echo $post_type_tertiary; ?>/<?php echo $post_type_secondary; ?>"><?php $secondary = str_replace("-"," ",$post_type_secondary); echo $secondary; ?></a></li><?php } ?>
			    	<?php if($post_type_primary){ ?><li style="margin-top:1px;text-transform:capitalize;"> &raquo; <?php echo $post_type; ?></li><?php } ?>
				</ul>
                <h1><?php if( empty($post_type_primary) && !empty($post_type_secondary) && !empty($post_type_tertiary)){
		                	echo $post_type_secondary;
		                }else if( empty($post_type_primary) && empty($post_type_secondary) && !empty($post_type_tertiary) ){
		                	echo $post_type_tertiary;
		                }else if( empty($post_type_primary) && empty($post_type_secondary) && empty($post_type_tertiary) ){
		                	echo 'Game & Fish Photos';
		                }else if( !empty($post_type_primary) && !empty($post_type_secondary) && !empty($post_type_tertiary) ){
		                	echo $post_type;
		                } ?></h1>
			</div>
        </div>

        <?php //echo do_shortcode('[imo-slideshow community=true]'); ?>

        <div class="dif-posts">
			<div id="posts-container" posttype="<?php echo $post_type_primary; ?>" secondaryposttype="<?php echo $post_type_secondary; ?>" tertiaryposttype="<?php echo $post_type_tertiary; ?>"></div>
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