<?php

/**
 * Template Name: Tips
 * Description: The NAW+ Community - Tips Category
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
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

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
  	<div class="bonus-background">
		<div class="bonus">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('superpost-sidebar')) : else : ?><?php endif; ?>
		</div>
		<div id="responderfollow"></div>
		<div class="sidebar advert">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : ?><?php endif; ?>
		</div>

	</div>

	<div class="col-abc">
	<header class="header-title">
    	
    	<ul id="user-bar" style="<?php echo $displayStyle; ?>">	          
			<li class="user-name">
				Hello, <a href="/profile/<?php echo $current_user->user_nicename; ?>"><span id="current-user-name"><?php echo $current_user->display_name; ?></span></a>
			</li>
			<li><a href="/profile/<?php echo $current_user->user_nicename; ?>"><img src="/avatar?uid=<?php echo $current_user->ID; ?>" alt="User Avatar" class="recon-gravatar" /></a></li>                      
       </ul>
	       <h1>Community: Tips & Tactics</h1>
	       <div class="community-crumbs">
	       		<a href="/community">Community Home</a> &raquo; Tips & Tactics
			</div>
		</header>
		<h2 class="comm-header">Post in Tips & Tactics</h2>
		<div class="new-superpost-modal-container">
		
		<form id="fileUploadForm" method="POST" action="/slim/api/superpost/add" enctype="multipart/form-data" class="masonry-form superpost-form">		        
			        <input type="text" name="title" id="title" placeholder="Title"/>
	        <input type="text" name="post_type" id="post_type" value="tip" style="display:none;"/>
	        	           

	        <textarea name="body" placeholder="Description"></textarea>
	        
	        <input id="file" type="file" name="photo-upload" id="photo-upload" style="display:none"/>
	<!--    
	        <input type="hidden" name="clone_target" value="superpost-box">
	        <input type="hidden" name="attach_target" value="post-container">
	        <input type="hidden" name="attachment_point" value="prepend">
	        <input type="hidden" name="masonry" value="true"> 
	-->
	        <input type="hidden" name="form_id" value="fileUploadForm">
	        <input type="hidden" name="attachment_id" class="attachment_id" value="">	   
	        <input type="submit" value="Submit" class="submit" style="<?php echo $displayStyle; ?>"/>
	        <div class="fast-login-then-post-button" style="<?php echo $loginStyle; ?>">Submit & Login <img class="submit-icon" src="/wp-content/themes/imo-mags-northamericanwhitetail/img/fb.png" height=20 width=20></div>

	        <p class="login-note">
	        </p>
	        </form>
	        
	        <div class="media-section">
	
		     		
		      <form id="fileUploadForm-image" method="POST" action="/slim/api/superpost/add" enctype="multipart/form-data" class="masonry-form superpost-image-form">
		        <div id="fileupload" >
		          <div class="fileupload-buttonbar ">
		              <label class="upload-button">
		                  <span><span class="white-plus-sign">+</span><span class="button-text">ATTACH PHOTO</span></span>
		                  <input id="image-upload" type="file" name="photo-upload" id="photo-upload" />
		
		              </label>
		          </div>
		        </div>
		        <input type="hidden" name="post_type" value="photo">
		        <input type="hidden" name="form_id" value="fileUploadForm">
		
		
		      </form>
		      
		      <div class="video-button">
		        <span><span class="white-plus-sign"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/youtube.png" alt="YouTube" /></span>ADD YOUTUBE VIDEO</span>
		      </div>
		      <div class="video-url-form-holder-container" style="display:none;">
		
		        <div class="video-url-form-holder" style="">
		          <form id="video-url-form" method="POST" action="/slim/api/superpost/add" enctype="multipart/form-data" class="masonry-form superpost-image-form">
		            
		            <div class="video-body-holder">
		            <input type="text" name="body" id="video-body" placeholder="Paste YouTube URL or code here"/>
		            </div>
		            <input type="hidden" name="post_type" value="youtube">
		            <input type="hidden" name="form_id" value="fileUploadForm">
		
		
		          </form>
		
		        </div>
		        <div class="video-close-button">
		        </div>
		      </div>
		       
		      
		      
		      </div><!-- /.media-section-->
		      <h4 style="display:none" class="photo-attachement-header">Photos</h4>
		      <div class="attached-photos">
		      </div>
		      
	    </div> <!-- End new-superpost-modal-container -->
	    </div> <!-- end .col-abc -->

	    <div class="col-abc">
		
	    <h2 class="comm-header stream-header">Latest in <?php the_title(); ?></h2>
        <div id="recon-activity" term="tip" display="list" widthMode="short">


       </div>
       <span id="more-community-button">Load More<span></span></span>
   </div>
</div>
<?php get_footer(); ?>

