<?php

/**
 * Template Name: Community Listing
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
$crop = "/convert?w=650&h=650&fit=crop";
if(mobile()){
	$crop = "/convert?w=458&h=458&fit=crop";
}

?>

<!-- *********************************************************** -->
<!-- ***************** UNDERSCORE TEMPLATE ********************* -->
<!-- *********************************************************** -->
<script type="text/template" id="post-template">
<% if(post.img_url){ %>
	<div class="dif-post">
        <div class="feat-img">
            <a href="/photos/<%= post.id %>"><img class="feat-img" src="<%= post.img_url %><?php echo $crop; ?>" alt="<%= post.title %>" title="<%= post.img_url %>" /></a>
        </div>
        <div class="dif-post-text">
            <h3><a href="/photos/<%= post.id %>"><%= post.title %></a></h3>
            <div class="profile-panel">
                <div class="profile-photo">
                    <a href="/profile/<%= post.username %>"><img src="/avatar?uid=<%= post.user_id %>" alt="<%= post.username %>" title="<%= post.username %>" /></a>
                </div>
                <div class="profile-data">
                    <h4><a href="/profile/<%= post.username %>"><%= post.display_name %></a></h4>
                    <ul class="prof-tags">
                        <!--<li><a href="#"><%= post.state %></a></li>-->
                        <li><a href="/<%= post.post_type %>"><%= post.post_type %></a></li>
                        <li><a href="/master-angler">Master Angler</a></li>
                    </ul>
                    <ul class="replies">
                        <li><a href="/photos/<%= post.id %>#reply_field"><%= post.comment_count %> Reply</a></li>
                        <li><%= post.score %> Points</li>
                    </ul>
                    <ul class="prof-like">
                        <li><div class="fb-like" data-href="<?php echo FACEBOOK_LINK; ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="true"></div></li>
                    </ul>
                </div>
            </div>
            <span class="badge"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/pic/badge-ma.png" alt="" /></span>
        </div>
    </div>
<% } %>
</script>
<!-- *********************************************************** -->
<!-- *********************************************************** -->
<!-- *********************************************************** -->

<div class="page-community">
    <div class="general general-com">
    	<div class="custom-title clearfix">
            <img src="<?php echo plugins_url('images/fishhead2.png' , __FILE__ ); ?>" alt="FishHeads" class="custom-tite-logo">
            <div class="title-crumbs">
                <h1>Fishhead Photos</h1>
                <p>Description goes here in this place holder</p>
			</div>
        </div>

        <!--<div class="title-underline">
            <h1>In-Fish Anglers <span>Your Freshwater Community</span></h1>
        </div>
        <div class="custom-slider-section mobile-hidden-section">
            <div class="general-title clearfix">
                <h2><span>Explore  more</span></h2>
            </div>
            <img src="<?php bloginfo( 'template_url' ); ?>/images/pic/slider-screen.jpg" alt="" />
        </div>-->
        <div class="general-title browse-title clearfix">
            <h2>Browse <span>Community</span></h2>
        </div>

        <div class="photo-link-area">
            <div id="fileupload">
                <div class="fileupload-buttonbar ">
                    <label class="upload-button share-photo">
                        <span class="add-photo-link">Share Photo</span>
                        <input id="image-upload" class="common-image-upload" type="file" name="photo-upload">
                    </label>
                </div>
            </div>
        </div>

        <div class="btn-group btn-bar">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            Action <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </div>



        <div class="general-title clearfix alter-title">
            <h2>Latest <span>Submissions</span></h2>
        </div>
        <div class="dif-posts">
			<div id="posts-container"></div>
         </div>
         <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
            <a href="#" class="btn-base" style="display:block;">Load More</a>

            <a href="#" class="go-top jq-go-top">go top</a>

            <img src="/wp-content/themes/imo-mags-parent/images/ajax-loader.gif" id="ajax-loader" style="display:none;"/>
        </div>
		<?php social_footer(); ?>
		<div class="hr mobile-hr"></div>
		<a href="#" class="back-top jq-go-top">back to top</a>
        <!-- example of filter by state section, put it were you need
        <br />
        <p>this is just an example of the filter section, put it were you need</p>
        <br />
        <div class="filter-by-section">
            <ul class="breadcrumbs">
                <li><a href="#">Community</a></li>
                <li>New York</li>
            </ul>
            <h1 class="filter-title">New York</h1>

        </div>
        -->

        <!-- log/reg popup start -->
        <div class="basic-popup basic-form reg-popup">
            <div class="popup-inner clearfix">
                <form action="#">
                    <fieldset>
                        <h3>Login</h3>
                        <div class="f-row">
                            <input type="text" placeholder="Email Address" />
                        </div>
                        <div class="f-row">
                            <input type="password" placeholder="Password" />
                        </div>
                        <div class="form-link">
                            <a href="#">Lost your password?</a>
                        </div>
                        <div class="f-row">
                            <div class="btn-red">
                                <input type="submit" value="Log In" />
                            </div>
                        </div>
                        <span class="or-delim">OR</span>
                        <h3>Register</h3>
                        <div class="f-row">
                            <input type="text" placeholder="Display Name" />
                        </div>
                        <div class="f-row">
                            <input type="text" placeholder="Email Address" />
                        </div>
                        <div class="f-row">
                            <input type="password" placeholder="Password" />
                        </div>
                        <div class="f-row">
                            <span class="btn-red">
                                <input type="submit" value="Submit" />
                            </span>
                        </div>
                    </fieldset>
                </form>
            </div>
            <a class="btn-close-popup jq-close-popup" href="#">close</a>
            <a class="btn-cancel jq-close-popup" href="#">Cancel</a>
        </div>
        <!-- log/reg popup end -->

    </div>
</div>
<?php get_footer(); ?>