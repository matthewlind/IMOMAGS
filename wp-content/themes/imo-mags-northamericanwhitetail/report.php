<?php

/**
 * Template Name: Report
 * Description: The NAW+ Community Report Category
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
	       <h1>State Rut Reports</h1>
	       <div class="community-crumbs">
	       		<a href="/community">Community Home</a> &raquo; Rut Reports
			</div>
		</header>
		<h2 class="comm-header">Post a Rut Report</h2>
		<div class="new-superpost-modal-container">
		
		<form id="fileUploadForm" method="POST" action="/slim/api/superpost/add" enctype="multipart/form-data" class="masonry-form superpost-form">
	        <input type="text" name="title" id="title" placeholder="Headline"/>
	        <input type="text" name="post_type" id="post_type" value="report" style="display:none;"/>
	        	           

	        <textarea name="body" id="body" placeholder="Tell Us Your Story."></textarea>
	        
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
	        
	        <script type="text/javascript">
			      $(document).ready(function(){
				      $(".state-chzn").chosen();
				   });
			 </script>
			 <div class="state-dropdown-container">
		          <select name="state" class="state-chzn" style="width:400px;padding:5px;" data-placeholder="Nice. Where did you find it?">
			            <option value=""></option>
			            <option value="AL">Alabama</option>
			            <option value="AK">Alaska</option>
			            <option value="AZ">Arizona</option>
			            <option value="AR">Arkansas</option>
			            <option value="CA">California</option>
			            <option value="CO">Colorado</option>
			            <option value="CT">Connecticut</option>
			            <option value="DE">Delaware</option>
			            <option value="DC">District of Columbia</option>
			            <option value="FL">Florida</option>
			            <option value="GA">Georgia</option>
			            <option value="HI">Hawaii</option>
			            <option value="ID">Idaho</option>
			            <option value="IL">Illinois</option>
			            <option value="IN">Indiana</option>
			            <option value="IA">Iowa</option>
			            <option value="KS">Kansas</option>
			            <option value="KY">Kentucky</option>
			            <option value="LA">Louisiana</option>
			            <option value="ME">Maine</option>
			            <option value="MD">Maryland</option>
			            <option value="MA">Massachusetts</option>
			            <option value="MI">Michigan</option>
			            <option value="MN">Minnesota</option>
			            <option value="MS">Mississippi</option>
			            <option value="MO">Missouri</option>
			            <option value="MT">Montana</option>
			            <option value="NE">Nebraska</option>
			            <option value="NV">Nevada</option>
			            <option value="NH">New Hampshire</option>
			            <option value="NJ">New Jersey</option>
			            <option value="NM">New Mexico</option>
			            <option value="NY">New York</option>
			            <option value="NC">North Carolina</option>
			            <option value="ND">North Dakota</option>
			            <option value="OH">Ohio</option>
			            <option value="OK">Oklahoma</option>
			            <option value="OR">Oregon</option>
			            <option value="PA">Pennsylvania</option>
			            <option value="RI">Rhode Island</option>
			            <option value="SC">South Carolina</option>
			            <option value="SD">South Dakota</option>
			            <option value="TN">Tennessee</option>
			            <option value="TX">Texas</option>
			            <option value="UT">Utah</option>
			            <option value="VT">Vermont</option>
			            <option value="VA">Virginia</option>
			            <option value="WA">Washington</option>
			            <option value="WV">West Virginia</option>
			            <option value="WI">Wisconsin</option>
			            <option value="WY">Wyoming</option>
			            <option value="CN">Canada</option>
			            <option value="AB">Alberta</option>
			            <option value="BC">British Columbia</option>
			            <option value="MB">Manitoba</option>
			            <option value="NB">New Brunswick</option>
			            <option value="NL">Newfoundland and Labrador</option>
			            <option value="NT">Northwest Territories</option>
			            <option value="NS">Nova Scotia</option>
			            <option value="NU">Nunavut</option>
			            <option value="ON">Ontario</option>
			            <option value="PE">Prince Edward Island</option>
			            <option value="QC">Quebec</option>
			            <option value="SK">Saskatchewan</option>
			            <option value="YT">Yukon</option>
			            <option value="AG">Aguascalientes</option>
			            <option value="BJ">Baja California</option>
			            <option value="BS">Baja California Sur</option>
			            <option value="CP">Campeche</option>
			            <option value="CH">Chiapas</option>
			            <option value="CI">Chihuahua</option>
			            <option value="CU">Coahuila</option>
			            <option value="CL">Colima</option>
			            <option value="DF">Distrito Federal</option>
			            <option value="DG">Durango</option>
			            <option value="GJ">Guanajuato</option>
			            <option value="GR">Guerrero</option>
			            <option value="HG">Hidalgo</option>
			            <option value="JA">Jalisco</option>
			            <option value="EM">Mexico</option>
			            <option value="MH">Michoacán</option>
			            <option value="MR">Morelos</option>
			            <option value="NA">Nayarit</option>
			            <option value="NL">Nuevo León</option>
			            <option value="OA">Oaxaca</option>
			            <option value="PU">Puebla</option>
			            <option value="QA">Querétaro</option>
			            <option value="QR">Quintana Roo</option>
			            <option value="SL">San Luis Potosi</option>
			            <option value="SI">Sinaloa</option>
			            <option value="SO">Sonora</option>
			            <option value="TA">Tabasco</option>
			            <option value="TM">Tamaulipas</option>
			            <option value="TL">Tlaxcala</option>
			            <option value="VZ">Veracruz</option>
			            <option value="YC">Yucatan</option>
			            <option value="ZT">Zacatecas</option>
			      </select>
			</div> 
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
		       <h4 style="display:none" class="photo-attachement-header">Photos</h4>
		      <div class="attached-photos">
		      </div>
		      
		      </div><!-- /.media-section-->
		      
	    </div> <!-- End new-superpost-modal-container -->
	    </div> <!-- end .col-abc -->
	    <div class="col-abc">
		
	    <h2 class="comm-header stream-header">Latest Rut <?php the_title(); ?>s</h2>
        <div id="recon-activity" term="report" display="tile" widthMode="short">


       </div>
       <span id="more-community-button">Load More<span></span></span>
   </div>
</div>
<?php get_footer(); ?>
