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

	<div class="col-abc">
	<header class="header-title">
    	
    	<h1>State Rut Reports</h1>
    	<div class="community-crumbs">
	       		<a href="/community">Community Home</a> &raquo; Rut Reports
			</div>
		</header>
		
		<div id="us-map-container" style="width:680px;height:420px;" post_type="report"></div>
		
		<div class="post-form-btn-container">
			<a class="post-form-btn">+ Start a New Post in State Rut Reports</a>
		</div>
		<div class="post_type_styled_select">
	     	<div class="state-dropdown-container-sidebar">
		    	<select id="state" name="state" class="post_type state">
		    		<option value="">Browse Canada</option>
		            <option value="/community/report/alberta">Alberta</option>
		            <option value="/community/report/british-columbia">British Columbia</option>
		            <option value="/community/report/manitoba">Manitoba</option>
		            <option value="/community/report/new-brunswick">New Brunswick</option>
		            <option value="/community/report/newfoundland-and-labrador">Newfoundland and Labrador</option>
		            <option value="/community/report/northwest-territories">Northwest Territories</option>
		            <option value="/community/report/nova-scotia">Nova Scotia</option>
		            <option value="/community/report/nunavut">Nunavut</option>
		            <option value="/community/report/ontario">Ontario</option>
		            <option value="/community/report/prince-edward-island">Prince Edward Island</option>
		            <option value="/community/report/quebec">Quebec</option>
		            <option value="/community/report/saskatchewan">Saskatchewan</option>
		            <option value="/community/report/yukon">Yukon</option>		            		
		        </select>	
			</div>	         
        </div>

		<h2 class="comm-header post-header">Post a Rut Report</h2>
		<div class="new-superpost-modal-container">
		
		<form id="fileUploadForm" method="POST" action="/slim/api/superpost/add" enctype="multipart/form-data" class="masonry-form superpost-form">
	        <input type="text" name="title" id="title" class="required-title" placeholder="Title"/>
	        <input type="text" name="post_type" id="post_type" value="report" style="display:none;"/>
	        	           

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
	        <div id="imo-fb-login-button" class="fb-login join-widget-fb-login choose-fb" style="<?php echo $loginStyle; ?>">Fast Facebook Login</div>


	        <p class="login-note">
	        </p>
	        
	        <script type="text/javascript">
			      $(document).ready(function(){
				      $(".state-chzn").chosen();
				   });
			 </script>
			 <div class="state-dropdown-container">
		          <select name="state" class="state-chzn" style="width:400px;padding:5px;" data-placeholder="Choose the state for this post:">
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
			            <option value="AB">Alberta, Canada</option>
			            <option value="BC">British Columbia, Canada</option>
			            <option value="MB">Manitoba, Canada</option>
			            <option value="NB">New Brunswick, Canada</option>
			            <option value="NL">Newfoundland and Labrador, Canada</option>
			            <option value="NT">Northwest Territories, Canada</option>
			            <option value="NS">Nova Scotia, Canada</option>
			            <option value="NU">Nunavut, Canada</option>
			            <option value="ON">Ontario, Canada</option>
			            <option value="PE">Prince Edward Island, Canada</option>
			            <option value="QC">Quebec, Canada</option>
			            <option value="SK">Saskatchewan, Canada</option>
			            <option value="YT">Yukon, Canada</option>
			            <!--<option value="AG">Aguascalientes</option>
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
			            <option value="ZT">Zacatecas</option>-->
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
		       
		      
		      
		      </div><!-- /.media-section-->
		      <h4 style="display:none" class="photo-attachement-header">Photos</h4>
		      <div class="attached-photos">
		      </div>
			  <div class="email-login" style="<?php echo $loginStyle; ?>"><a>or use your email</a></div>
	    </div> <!-- End new-superpost-modal-container -->
	    
	    </div> <!-- end .col-abc -->
	<div class="col-abc">
		
	    <h2 class="comm-header stream-header">Latest Rut <?php the_title(); ?>s</h2>
        <div id="recon-activity" term="report" display="list" widthMode="short">


       </div>
       <span id="more-community-button">Load More<span></span></span>
   </div>
</div>
<?php get_footer(); ?>
